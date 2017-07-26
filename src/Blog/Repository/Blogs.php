<?php

namespace Blog\Repository;

use Blog\Entity\BlogPost;

interface Blogs
{
    public function get(string $id) : BlogPost;
    public function store(BlogPost $post) : void;
}