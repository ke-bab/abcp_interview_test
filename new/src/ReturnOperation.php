<?php

namespace NW\WebService\References\Operations\Return;

class ReturnOperation
{
    public function do(ReturnRequest $request): ReturnResponse
    {
        // достать записи из бд
        // создать templateData объект
        // бросить templateData в сервис уведомлений в метод send
        // получить ответ и вернуть результат
        return new ReturnResponse();
    }
}