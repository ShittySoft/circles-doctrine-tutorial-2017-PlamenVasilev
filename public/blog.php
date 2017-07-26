<?php

use Authentication\Entity\User;
use Authentication\Repository\Users;
use Blog\Entity\BlogPost;
use Doctrine\ORM\EntityManager;
use Infrastructure\Authentication\Repository\DoctrineUsers;
use Infrastructure\Blog\Repository\DoctrineBlog;

require_once __DIR__ . '/../vendor/autoload.php';

/* @var $entityManager EntityManager */
$entityManager = require __DIR__ . '/../bootstrap.php';

/** @var Users $users */
$users = new DoctrineUsers($entityManager, $entityManager->getRepository(User::class));

$post = null;
$entityManager->transactional(function () use ($users, $post, $entityManager) {
    /** @var User $user */
    $user = $users->get('aa@bb.cc');

    $blogs = new DoctrineBlog($entityManager, $entityManager->getRepository(BlogPost::class));

    $post = BlogPost::create($user);
    $post->comment($_POST['post']);

    $blogs->store($post);
});

var_dump($post);