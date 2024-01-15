<?php

namespace App\Return;

/**
 * ReturnRequest содержит данные запроса.
 * Поля публичные что бы не плодить кучу геттеров, для простоты, все равно это дто.
 * Поля statusFrom и statusTo вынесены в отдельные поля потому что так удобнее отправлять с фронта - если у нас
 * прилетает form-data то там довольно неудобно отправить массив, проще прислать плоский список аргументов.
 * Подразумеваем что нам приходит form-data а не json - в этом случае все поля - строки, и нам надо вытащить инты.
 */
class Request
{
    public int $resellerId;
    public int $clientId;
    public int $creatorId;
    public int $expertId;
    public int $notificationType;
    public ?int $statusFrom;
    public ?int $statusTo;
    public int $complaintId;
    public string $complaintNumber;
    public int $consId;
    public string $consNumber;
    public string $agreementNumber;
    public string $date;

    public function __construct(
        int  $resellerId,
        int  $creatorId,
        int  $clientId,
        int  $expertId,
        int  $notificationType,
        int $complaintId,
        string $complaintNumber,
        int $consId,
        string $consNumber,
        string $agreementNumber,
        string $date,
        ?int $statusFrom,
        ?int $statusTo,
    )
    {
        $this->resellerId = $resellerId;
        $this->creatorId = $creatorId;
        $this->clientId = $clientId;
        $this->expertId = $expertId;
        $this->notificationType = $notificationType;
        $this->statusFrom = $statusFrom;
        $this->statusTo = $statusTo;
        $this->complaintId = $complaintId;
        $this->complaintNumber = $complaintNumber;
        $this->consId = $consId;
        $this->consNumber = $consNumber;
        $this->agreementNumber = $agreementNumber;
        $this->date = $date;
    }

    /**
     * @throws \Exception
     */
    public static function new(array $request): Request
    {
        return new Request(
            self::validateInt('resellerId', $request['resellerId']),
            self::validateInt('clientId', $request['clientId']),
            self::validateInt('creatorId', $request['creatorId']),
            self::validateInt('expertId', $request['expertId']),
            self::validateInt('notificationType', $request['notificationType']),

            self::validateInt('complaintId', $request['complaintId']),
            self::validateString('complaintNumber', $request['complaintNumber']),
            self::validateInt('consumptionId', $request['consumptionId']),
            self::validateString('consumptionNumber', $request['consumptionNumber']),
            self::validateString('agreementNumber', $request['agreementNumber']),
            self::validateString('date', $request['date']),

            self::validateIntOptional('statusFrom', $request['statusFrom']),
            self::validateIntOptional('statusTo', $request['statusTo']),
        );

    }

    /**
     * @throws \Exception
     */
    public static function validateInt(string $name, string $value): int
    {
        if (empty($value)) {
            throw new \Exception("$name is empty");
        }

        return (int)$value;
    }

    /**
     * @throws \Exception
     */
    public static function validateString(string $name, string $value): int
    {
        if (empty($value)) {
            throw new \Exception("$name is empty");
        }

        return $value;
    }

    public static function validateIntOptional(string $name, string $value): ?int
    {
        if (empty($value)) {
            return null;
        } else {
            return (int)$value;
        }
    }
}