<?php
/**
 * Created by PhpStorm.
 * User: admin-php5
 * Date: 26.07.17
 * Time: 15:42
 */

namespace Blog\Entity;


use Authentication\Entity\User;
use Ramsey\Uuid\Uuid;

class BlogPostComments
{
    private $id;
    private $blogPost;
    private $author;
    private $comment;
    private $createdAt;

    public static function create(BlogPost $blogPost, User $author, string $comment): self
    {
        $id = (string) Uuid::uuid4();
        return new self($id, $blogPost, $author, $comment);
    }

    public function __construct($id, BlogPost $blogPost, User $author, string $comment)
    {
        $this->id = $id;
        $this->blogPost = $blogPost;
        $this->user = $author;
        $this->comment = $comment;
        $this->createdAt = new \DateTime();
    }
}