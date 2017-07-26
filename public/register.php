<?php

use Authentication\Entity\User;
use Doctrine\ORM\EntityManager;
use Infrastructure\Authentication\Repository\DatabaseUsers;
use Infrastructure\Authentication\Repository\FilesystemUsers;

require_once __DIR__ . '/../vendor/autoload.php';

/** @var EntityManager $entityManager */
$entityManager = require_once __DIR__.'/../bootstrap.php';

//$users = new FilesystemUsers(__DIR__ . '/../data/users');
$users = new DatabaseUsers($entityManager);

// @TODO form validation and pretty messages?

$users->store(User::register($_POST['emailAddress'], $_POST['password'], $users, function (string $password) : string {
    return password_hash($password, \PASSWORD_DEFAULT);
}));

var_dump($users->get($_POST['emailAddress']));
