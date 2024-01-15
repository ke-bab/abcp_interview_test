<?php

namespace NW\WebService\References\Operations\Return;

class ReturnOperation
{
    public function do(ReturnRequest $request): ReturnResponse
    {
        return new ReturnResponse();
    }
}