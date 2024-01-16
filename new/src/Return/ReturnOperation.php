<?php

namespace App\Return;

use App\Return\Notification\Dto\Result;
use App\Return\Notification\Dto\TemplateData;
use App\Return\Notification\NotificatorInterface;
use App\Return\Repository\Model\ContractorInterface;
use App\Return\Repository\RepositoryInterface;

class ReturnOperation
{
    private RepositoryInterface $repository;
    private NotificatorInterface $notificator;

    public function __construct(RepositoryInterface $repository, NotificatorInterface $notificator)
    {
        $this->repository = $repository;
        $this->notificator = $notificator;
    }

    /**
     * @throws \Exception
     */
    public function do(Request $request): Result
    {
        // достать записи из бд
        $reseller = $this->repository->findSeller($request->resellerId);
        $client = $this->repository->findClient($request->clientId);
        $creator = $this->repository->findCreator($request->creatorId);
        $expert = $this->repository->findExpert($request->expertId);
        // проверить id seller и client
        if ($client->getType() !== ContractorInterface::TYPE_CUSTOMER || $client->seller()->getId() !== $reseller->getId()) {
            throw new \Exception("bad client id");
        }
        // создать templateData объект
        $template = TemplateData::newFromRequest($request, $creator, $expert, $client);
        // бросить templateData в сервис уведомлений
        return $this->notificator->send($template);
    }
}