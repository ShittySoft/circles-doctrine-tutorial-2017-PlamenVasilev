<?php
/**
 * Created by PhpStorm.
 * User: admin-php5
 * Date: 26.07.17
 * Time: 11:40
 */

namespace Infrastructure\Authentication\Repository;


use Authentication\Entity\User;
use Authentication\Repository\Users;
use Doctrine\ORM\EntityManager;

final class DatabaseUsers implements Users
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function has(string $emailAddress): bool
    {
        $user = $this->entityManager->find(User::class, $emailAddress);
        return $user instanceof User;
    }

    public function get(string $emailAddress): User
    {
        return $this->entityManager->find(User::class, $emailAddress);
    }

    public function store(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}