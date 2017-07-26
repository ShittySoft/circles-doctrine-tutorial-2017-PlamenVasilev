<?php
/**
 * Created by PhpStorm.
 * User: admin-php5
 * Date: 26.07.17
 * Time: 14:18
 */

namespace Blog\Entity;


use Authentication\Entity\User;

class BlogPost
{
    /**
     * @var User
     */
    private $user;

    private $id;

    private $title;

    private $post;


    public function __construct($id)
    {

        $this->id = $id;
    }

    public static function create(User $authenticatedUser): self
    {
        $id = uniqid('id', true);
        $obj = new self($id);
        $obj->setUser($authenticatedUser);

        return $obj;
    }

    public function comment($post): void
    {
        $this->post = $post;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }
}