<?php

namespace App\Return\Notification\Dto;

class Result implements \JsonSerializable
{
    private NotifyResult $notificationEmployeeByEmail;
    private NotifyResult $notificationClientByEmail;
    private NotifyResult $notificationClientBySms;


    public function __construct(
        ?NotifyResult $notificationEmployeeByEmail = null,
        ?NotifyResult $notificationClientByEmail = null,
        ?NotifyResult $notificationClientBySms = null,
    )
    {
        $this->notificationEmployeeByEmail = $notificationEmployeeByEmail ?? new NotifyResult();
        $this->notificationClientByEmail = $notificationClientByEmail ?? new NotifyResult();
        $this->notificationClientBySms = $notificationClientBySms ?? new NotifyResult();
    }

    public function setEmployeeSuccess(): void
    {
        $this->notificationEmployeeByEmail->setSuccess();
    }

    public function setEmployeeError(string $error): void
    {
        $this->notificationEmployeeByEmail->setFailure($error);
    }

    public function setClientByEmailSuccess(): void
    {
        $this->notificationClientByEmail->setSuccess();
    }

    public function setClientByEmailError(string $error): void
    {
        $this->notificationClientByEmail->setFailure($error);
    }
    public function setClientBySmsSuccess(): void
    {
        $this->notificationClientBySms->setSuccess();
    }

    public function setClientBySmsError(string $error): void
    {
        $this->notificationClientBySms->setFailure($error);
    }

    public function jsonSerialize(): array
    {
        return [
            'notificationEmployeeByEmail' => $this->notificationEmployeeByEmail,
            'notificationClientByEmail' => $this->notificationClientByEmail,
            'notificationClientBySms' => $this->notificationClientBySms,
        ];
    }
}
