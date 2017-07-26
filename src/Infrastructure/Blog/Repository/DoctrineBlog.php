<?php

namespace Infrastructure\Blog\Repository;

use Blog\Entity\BlogPost;
use Blog\Repository\Blogs;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

final class DoctrineBlog implements Blogs
{
    /**
     * @var ObjectManager
     */
    private $objectManager;
    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    public function __construct(ObjectManager $objectManager, ObjectRepository $objectRepository)
    {

        $this->objectManager = $objectManager;
        $this->objectRepository = $objectRepository;
    }

    public function get(string $id): BlogPost
    {
        // TODO: Implement get() method.
        return $this->objectRepository->find($id);
    }

    public function store(BlogPost $blogPost): void
    {
        // TODO: Implement store() method.
        $this->objectManager->persist($blogPost);
    }
}