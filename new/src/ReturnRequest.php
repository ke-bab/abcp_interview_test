<?php

namespace NW\WebService\References\Operations\Return;

/**
 * ReturnRequest содержит данные запроса.
 * Поля публичные что бы не плодить кучу геттеров, для простоты, все равно это дто.
 * Поля statusFrom и statusTo вынесены в отдельные поля потому что так удобнее отправлять с фронта - если у нас
 * прилетает form-data то там довольно неудобно отправить массив, проще прислать плоский список аргументов.
 * Подразумеваем что нам приходит form-data а не json - в этом случае все поля - строки, и нам надо вытащить инты.
 */
class ReturnRequest
{
    public int $resellerId;
    public int $clientId;
    public int $creatorId;
    public int $expertId;
    public int $notificationType;
    public int $statusFrom;
    public int $statusTo;

    public function __construct(
        int  $resellerId,
        int  $creatorId,
        int  $clientId,
        int  $expertId,
        int  $notificationType,
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
    }

    /**
     * @throws \Exception
     */
    public static function new(array $request): ReturnRequest
    {
        return new ReturnRequest(
            self::validateInt('resellerId', $request['resellerId']),
            self::validateInt('clientId', $request['clientId']),
            self::validateInt('creatorId', $request['creatorId']),
            self::validateInt('expertId', $request['expertId']),
            self::validateInt('notificationType', $request['notificationType']),
            self::validateIntOptional('statusFrom', $request['statusFrom']),
            self::validateIntOptional('statusTo', $request['statusTo']),
        );

    }

    /**
     * @throws \Exception
     */
    public static function validateInt(string $name, string $value): int
    {
        if (!empty($value)) {
            return (int)$value;
        }
        throw new \Exception("$name is empty");
    }

    public static function validateIntOptional(string $name, string $value): ?int
    {
        if (!empty($value)) {
            return (int)$value;
        } else {
            return null;
        }
    }
}