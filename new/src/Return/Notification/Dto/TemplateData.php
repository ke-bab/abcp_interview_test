<?php

namespace App\Return\Notification\Dto;

use App\Return\Notification\Mail\MailInterface;
use App\Return\Notification\NotificatorInterface;
use App\Return\Repository\Model\Client;
use App\Return\Repository\Model\Creator;
use App\Return\Repository\Model\Expert;
use App\Return\Request;
use App\Return\Status;
use App\Return\Template\Template;
use function App\Return\Notification\__;

class TemplateData
{

    private int $complaintId;
    private string $complaintNumber;
    private Creator $creator;
    private Expert $expert;
    private Client $client;
    private int $consId;
    private string $consNumber;
    private string $agreementNumber;
    private string $date;
    private string $diff;

    public static function newFromRequest(
        Request $request,
        Creator $creator,
        Expert $expert,
        Client $client,
    ): self
    {
        return new self(
            $request->complaintId,
            $request->complaintNumber,
            $creator,
            $expert,
            $client,
            $request->consId,
            $request->consNumber,
            $request->agreementNumber,
            $request->date,
            self::getDiff($request)
        );
    }

    public function __construct(
        int                                  $complaintId,
        string                               $complaintNumber,
        \App\Return\Repository\Model\Creator $creator,
        \App\Return\Repository\Model\Expert  $expert,
        \App\Return\Repository\Model\Client  $client,
        int                                  $consId,
        string                               $consNumber,
        string                               $agreementNumber,
        string                               $date,
        string                               $diff
    )
    {
        $this->complaintId = $complaintId;
        $this->complaintNumber = $complaintNumber;
        $this->creator = $creator;
        $this->expert = $expert;
        $this->client = $client;
        $this->consId = $consId;
        $this->consNumber = $consNumber;
        $this->agreementNumber = $agreementNumber;
        $this->date = $date;
        $this->diff = $diff;
    }

    public function getData(): array
    {
        return [
            'COMPLAINT_ID' => $this->complaintId,
            'COMPLAINT_NUMBER' => $this->complaintNumber,
            'CREATOR_ID' => $this->creator->getId(),
            'CREATOR_NAME' => $this->creator->getFullName(),
            'EXPERT_ID' => $this->expert->getId(),
            'EXPERT_NAME' => $this->expert->getFullName(),
            'CLIENT_ID' => $this->client->getId(),
            'CLIENT_NAME' => $this->client->getFullName(),
            'CONSUMPTION_ID' => $this->consId,
            'CONSUMPTION_NUMBER' => $this->consNumber,
            'AGREEMENT_NUMBER' => $this->agreementNumber,
            'DATE' => $this->date,
            'DIFFERENCES' => $this->diff,
        ];
    }

    private static function getDiff(Request $request): string
    {
        $diff = '';
        if ($request->notificationType === NotificatorInterface::TYPE_NEW) {
            $diff = Template::__(MailInterface::TEMPLATE_NEW_POSITION, null, $request->resellerId);
        }
        if ($request->notificationType === NotificatorInterface::TYPE_CHANGE) {
            $diff = Template::__(MailInterface::TEMPLATE_STATUS_CHANGED, [
                'FROM' => Status::MAP[$request->statusFrom],
                'TO'   => Status::MAP[$request->statusTo],
            ], $request->resellerId);
        }

        return $diff;
    }
}
