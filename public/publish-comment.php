<?php

use Authentication\Entity\User;
use Blog\Entity\BlogPost;
use Blog\Entity\BlogPostComments;
use Doctrine\Common\Util\Debug;
use Infrastructure\Authentication\Repository\DoctrineUsers;
use Infrastructure\Blog\Repository\DoctrineBlogPosts;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

/* @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = require __DIR__ . '/../bootstrap.php';

$users = new DoctrineUsers($entityManager, $entityManager->getRepository(User::class));
$blogPosts = new DoctrineBlogPosts($entityManager, $entityManager->getRepository(BlogPost::class));

$blogPostComment = null;

$entityManager->transactional(function () use ($users, $blogPosts, & $blogPostComment) {
    $user = $users->get($_POST['emailAddress']);
    $id = Uuid::fromString($_POST['postId']);
    $blogPost = $blogPosts->get($id);

    $blogPostComment = BlogPostComments::create($blogPost, $user, $_POST['comment']);
    $blogPost->comment($blogPostComment);
});

Debug::dump($blogPostComment);