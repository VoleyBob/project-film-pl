<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
# use App\Model\Wheather;

class CategoryController extends Controller
{
    public function listFilmsFromCategory()
    {
        return $this->render('category/list-films-from-category.html.twig');
        \dump(get_called_class());
        \dump(debug_backtrace()[0]['function']);
        die();
    }
}