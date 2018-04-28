<?php

namespace App\Controller;

use App\Entity\CategoryEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextType};
use Symfony\Component\HttpFoundation\Request;

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

    public function addCategory(Request $request)
    {
        $category = new CategoryEntity();
        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        
        
        if($form->isSubmitted() && $form->isValid()) {
            if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                $category->setHidden(false);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }


        return $this->render('category/new.html.twig', [
            'controller_name' => 'CategoryController',
            'form' => $form->createView(),
        ]);

    /*    
        $category = new CategoryEntity();
        $category->setName($title);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->flush();

        return $this->redirectToRoute('index');
    */
    }

    public function showCategories()
    {
        $categories = $this
            ->getDoctrine()
            ->getRepository(CategoryEntity::class)
            ->findAll();
        \dump($categories);

        return $this->render('category/list-categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    public function filter($letter)
    {
        $categories = $this
            ->getDoctrine()
            ->getRepository(CategoryEntity::class)
            ->findByFirstLetter($letter);
        \dump($categories);

        return $this->render('category/list-categories.html.twig', [
            'categories' => $categories,
        ]);
    }

}
