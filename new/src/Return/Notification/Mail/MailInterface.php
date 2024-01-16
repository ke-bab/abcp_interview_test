<?php

namespace App\Return\Notification\Mail;

use App\Return\Notification\Dto\MetaData;

interface MailInterface
{
    public const TEMPLATE_NEW_POSITION = 'NewPositionAdded';
    public const TEMPLATE_STATUS_CHANGED = 'PositionStatusHasChanged';

    public const TEMPLATE_COMPLAINT_EMPLOYEE_EMAIL_SUBJECT = 'complaintEmployeeEmailSubject';
    public const TEMPLATE_COMPLAINT_EMPLOYEE_EMAIL_BODY = 'complaintEmployeeEmailBody';

    public const TEMPLATE_COMPLAINT_CLIENT_EMAIL_SUBJECT = 'complaintClientEmailSubject';
    public const TEMPLATE_COMPLAINT_CLIENT_EMAIL_BODY = 'complaintClientEmailBody';

    public function send(MailData $data, MetaData $metadata);
}