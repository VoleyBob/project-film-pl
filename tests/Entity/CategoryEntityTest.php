<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;


class CategoryEntityTest extends TestCase
{

    public function testCanSetName()
    {
        $category = new CategoryEntity();
        $category->setName('Popularne');
        $this->assertEquals('Popularne', $category->getName());
    }

    public function testIfHiddenIsBool()
    {
        $category = new CategoryEntity();
        $this->assertTrue($category->getHidden());
    }

    /**
     * @dataProvider namesAndUrlsProvider
     */
    public function testCanSetUrl($name, $url)
    {
        $category = new CategoryEntity();
        $category->setName($name);
        $this->assertEquals($url, $category->getUrl());
    }

    public function namesAndUrlsProvider()   //jeden test; 4 asercje
    {
        return [
            ['aaaa', 'aaaa'],
            ['1 1 1 ', '1 1 1 '],
            ['ABCDEXYZ', 'abcdexyz'],
            ['Popularne Stand-Upy', 'popularne stand-upy'],
        ];
    }


}
