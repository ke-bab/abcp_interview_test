<?php

use NW\WebService\References\Operations\Return\ReturnOperation;
use NW\WebService\References\Operations\Return\ReturnRequest;

$req = ReturnRequest::new($_REQUEST);
$operation = new ReturnOperation();
$res = $operation->do($req);
echo json_encode($res);

