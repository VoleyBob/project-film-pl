<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

class CommentEntityTest extends TestCase
{

    public function testIfCommentHasUser()
    {
        $comment = new CommentEntity();
//        $comment->setContent('Coś ');
//        $this->assertEquals('Popularne', $comment->getName());
        $user = new UserEntity();
        $comment->setUser($user);
        $this->assertNotNull($comment->getUser());
    }

}