<?php

namespace App\Controller;

use App\Entity\UserEntity;
use App\Entity\CommentEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextType, PasswordType, EmailType};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CommentController extends Controller
{
    public function showComment()
    {
        return $this->render('comment/comment.html.twig');
        \dump(get_called_class());
        \dump(debug_backtrace()[0]['function']);
        die();
    }


    public function addComment(Request $request)
    {
        $comment = new CommentEntity();
        $form = $this->createFormBuilder($comment)
            ->add('content', TextType::class)
            ->add('user', EntityType::class, [
                'class' => UserEntity::class,
            ])
            ->add('save', SubmitType::class)
            ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
//          return $this->redirectToRoute('index');
        return $this->redirectToRoute('newComment');
        }
            
        return $this->render('comment/new.html.twig', [
            'controller_name' => 'CommentController',
            'form' => $form->createView(),
        ]);

    }




}
