<?php


use Dictionary\Status;

require 'vendor/autoload.php';

$status = substr($_SERVER['PATH_INFO'], 1);

if(is_numeric($status)) {
    $s = Status::from((int) $status);
    header(sprintf('HTTP/1.1 %d %s', $s->value, $s->name()));
    header('X-Powered-By: 300');
    header('Host: 1.1.1.1',true, $s->value);
    exit;
}


header(sprintf('HTTP/1.1 %d %s', 200, 'OK'));
var_dump(Status::cases());

foreach (Status::cases() as $case) {
    echo sprintf("<a href='/{$case->value}'>{$case->name()}</a> <br>");
}
