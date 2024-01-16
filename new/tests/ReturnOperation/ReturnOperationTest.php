<?php

namespace App\Return\Test;

use App\Return\Notification\Mail\MailInterface;
use App\Return\Notification\Notificator;
use App\Return\Notification\NotificatorInterface;
use App\Return\Notification\Sms\SmsInterface;
use App\Return\Repository\ContractorRepository;
use App\Return\Request;
use App\Return\ReturnOperation;
use App\Return\Status;
use Mockery;
use PHPUnit\Framework\TestCase;

class ReturnOperationTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testReturnSuccess()
    {
        $sms = Mockery::mock(SmsInterface::class);
        $sms->shouldReceive("send");
        $mail = Mockery::mock(MailInterface::class);
        $mail->shouldReceive("send");
        $notificator = new Notificator($mail, $sms);
        $repo = new ContractorRepository();
        $service = new ReturnOperation($repo, $notificator);

        $result = $service->do($this->newRequest());

        $this->assertTrue($result->getNotificationClientByEmail()->isSent());
        $this->assertNull($result->getNotificationClientByEmail()->getError());
        $this->assertTrue($result->getNotificationClientBySms()->isSent());
        $this->assertNull($result->getNotificationClientBySms()->getError());
        $this->assertTrue($result->getNotificationEmployeeByEmail()->isSent());
        $this->assertNull($result->getNotificationEmployeeByEmail()->getError());
    }

    /**
     * @throws \Exception
     */
    private function newRequest(): Request
    {
        return Request::new([
            'resellerId' => 124,
            'clientId' => 123,
            'creatorId' => 111,
            'expertId' => 122,
            'notificationType' => NotificatorInterface::TYPE_CHANGE,
            'complaintId' => 111,
            'complaintNumber' => 'b33',
            'consumptionId' => 121,
            'consumptionNumber' => 'bop',
            'agreementNumber' => 'yes',
            'date' => '2024-01-01',
            'statusFrom' => Status::PENDING,
            'statusTo' => Status::REJECTED,
        ]);
    }
}