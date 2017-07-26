<?php

namespace Blog\Entity;

use Authentication\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

class BlogPost
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var User
     */
    private $author;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $contents;

    private $comments;

    private function __construct(string $id, User $author, string $title, string $contents)
    {
        $this->id       = $id;
        $this->author   = $author;
        $this->title    = $title;
        $this->contents = $contents;
        $this->comments = new ArrayCollection();
    }

    public static function post(User $author, string $title, string $contents) : self
    {
        return new self((string) Uuid::uuid4(), $author, $title, $contents);
    }

    public function comment(BlogPostComments $comment) : void
    {
        $this->comments[] = $comment;
    }
}
