<?php


use Dictionary\Status;

require '../vendor/autoload.php';


$status = str_replace('/', '', $_SERVER['PATH_INFO']);

if(is_numeric($status)) {
    $s = Status::from((int) $status);
    header(sprintf('HTTP/1.1 %d %s', $s->value, $s->name()));
    header('X-Powered-By: 300');
    header('Host: 1.1.1.1',true, $s->value);
    exit;
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../template');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    //sys_get_temp_dir(),
]);

if(!empty($status)) {
    $errorText = '';
}


echo $twig->render('index.html.twig', ['cases' => Status::cases()]);

