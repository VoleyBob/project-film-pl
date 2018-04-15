<?php

namespace App\Controller;

use App\Entity\CategoryEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
# use App\Model\Wheather;

class CategoryController extends Controller
{
    public function showFilms($id)
    {
        $category = $this
            ->getDoctrine()
            ->getRepository(CategoryEntity::class)
            ->find($id);
        \dump($category);

        return $this->render('category/list-films-from-category.html.twig');
    }

    public function addCategory()
    {
        
        $category = new CategoryEntity();
        $category->setName('Die Hard 2');
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->flush();

        return $this->redirectToRoute('index');
    }
}
