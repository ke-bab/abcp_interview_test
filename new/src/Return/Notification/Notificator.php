<?php

namespace App\Return\Notification;

use App\Return\Notification\Dto\MetaData;
use App\Return\Notification\Dto\Result;
use App\Return\Notification\Dto\TemplateData;
use App\Return\Notification\Mail\MailData;
use App\Return\Notification\Mail\MailInterface;
use App\Return\Notification\Sms\SmsInterface;
use App\Return\Repository\Model\Client;
use App\Return\Repository\Model\Reseller;

class Notificator implements NotificatorInterface
{
    private MailInterface $mail;
    private SmsInterface $sms;

    /**
     * В целом можно было сделать более общий интерфейс отправителя, и передавать параметр - через что отправлять,
     * смс или емайл, но и так тоже будет работать.
     * @param MailInterface $mail
     * @param SmsInterface $sms
     */
    public function __construct(MailInterface $mail, SmsInterface $sms)
    {
        $this->mail = $mail;
        $this->sms = $sms;
    }

    public function send(
        TemplateData $templateData,
        Reseller     $reseller,
        Client       $client,
        string       $event,
        ?int         $statusTo
    ): Result
    {
        $result = new Result();
        // пусть емейл будет тут захардкожен
        $resellerEmail = "reseller@email.com";
        $empEmails = ["emp1@email.com", "emp2@email.com"];
        $clientEmail = 'client@email.com';
        $clientMobileNumber = '+79998887766';
        $metadata = new MetaData($reseller->getId(), $client->getId(), $event, $statusTo);
        // шлем от селлера сотрудникам
        $this->sendEmp(
            $resellerEmail,
            $clientEmail,
            $templateData,
            $reseller,
            $metadata,
            $result,
            $empEmails
        );
        // отправляем клиенту
        $this->sendClient(
            $resellerEmail,
            $clientEmail,
            $templateData,
            $reseller,
            $metadata,
            $result,
            $clientEmail,
            $clientMobileNumber,
            $event
        );
        return $result;
    }

    // методы вынесены для разделения что бы читать было проще
    private function sendEmp(
        string       $resellerEmail,
        string       $email,
        TemplateData $templateData,
        Reseller     $reseller,
        MetaData     $metadata,
        Result       $result,
        array        $empEmails
    ): void
    {
        $atLeastOneFailed = false;
        foreach ($empEmails as $email) {
            try {
                $this->mail->send(
                    new MailData(
                        $resellerEmail,
                        $email,
                        __(MailInterface::TEMPLATE_COMPLAINT_EMPLOYEE_EMAIL_SUBJECT, $templateData, $reseller->getId()),
                        __(MailInterface::TEMPLATE_COMPLAINT_EMPLOYEE_EMAIL_BODY, $templateData, $reseller->getId())
                    ),
                    $metadata
                );
            } catch (\Exception $e) {
                $atLeastOneFailed = true;
            }
        }
        if (!$atLeastOneFailed) {
            $result->setEmployeeSuccess();
        } else {
            $result->setEmployeeError("не удалось отправить почту"); // тут должен быть текст ошибки исключения
        }
    }

    private function sendClient(
        string       $resellerEmail,
        string       $email,
        TemplateData $templateData,
        Reseller     $reseller,
        MetaData     $metadata,
        Result       $result,
        string       $clientEmail,
        string       $clientMobile,
        string       $event
    ): void
    {
        if ($event === Events::CHANGE_RETURN_STATUS) {
            try {
                $this->mail->send(new MailData(
                    $resellerEmail,
                    $clientEmail,
                    __(MailInterface::TEMPLATE_COMPLAINT_CLIENT_EMAIL_SUBJECT, $templateData, $reseller->getId()),
                    __(MailInterface::TEMPLATE_COMPLAINT_CLIENT_EMAIL_BODY, $templateData, $reseller->getId())
                ), $metadata);
                $result->setClientByEmailSuccess();
            } catch (\Exception $e) {
                $result->setClientByEmailError("не удалось отправить клиенту по емайл");
            }

            try {
                $this->sms->send($clientMobile, $templateData, $metadata);
                $result->setClientBySmsSuccess();
            } catch (\Exception $e) {
                $result->setClientBySmsError("не удалось отправить по смс");
            }
        } else {
            $result->setClientByEmailError("уведомление не отправлено т.к. статус не менялся");
            $result->setClientBySmsError("уведомление не отправлено т.к. статус не менялся");
        }
    }
}