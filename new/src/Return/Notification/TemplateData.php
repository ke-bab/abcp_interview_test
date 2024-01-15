<?php

namespace App\Return\Notification;

use App\Return\Repository\Client;
use App\Return\Repository\Creator;
use App\Return\Repository\Expert;
use App\Return\Request;

class TemplateData
{
    public const TYPE_NEW    = 1;
    public const TYPE_CHANGE = 2;

    public const TEMPLATE_NEW_POSITION = 'NewPositionAdded';
    public const TEMPLATE_STATUS_CHANGED = 'PositionStatusHasChanged';

    public const STATUS_COMPLETED = 'Completed';
    public const STATUS_PENDING = 'Pending';
    public const STATUS_REJECTED = 'Rejected';

    public const STATUS_MAP = [
        0 => self::STATUS_COMPLETED,
        1 => self::STATUS_PENDING,
        2 => self::STATUS_REJECTED,
    ];

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
        int                            $complaintId,
        string                         $complaintNumber,
        \App\Return\Repository\Creator $creator,
        \App\Return\Repository\Expert  $expert,
        \App\Return\Repository\Client  $client,
        int                            $consId,
        string                         $consNumber,
        string                         $agreementNumber,
        string                         $date,
        string                         $diff
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
        if ($request->notificationType === self::TYPE_NEW) {
            $diff = __(self::TEMPLATE_NEW_POSITION, null, $request->resellerId);
        }
        if ($request->notificationType === self::TYPE_CHANGE) {
            $diff = __(self::TEMPLATE_STATUS_CHANGED, [
                'FROM' => self::STATUS_MAP[$request->statusFrom],
                'TO'   => self::STATUS_MAP[$request->statusTo],
            ], $request->resellerId);
        }

        return $diff;
    }
}
