<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;


class UserEntityTest extends TestCase
{

    public function testCanSetLogin()
    {
        $category = new UserEntity();
        $category->setLogin('Admin');
        $this->assertEquals('Admin', $category->getLogin());
    }
}

