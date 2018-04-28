<?php

namespace App\Controller;

use App\Entity\UserEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextType, PasswordType, EmailType};
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{
    public function login()
    {
        return $this->render('user/login.html.twig');
        \dump(get_called_class());
        \dump(debug_backtrace()[0]['function']);
        die();
    }

    public function profile()
    {
        return $this->render('user/show-user-details.html.twig');
        \dump(get_called_class());
        \dump(debug_backtrace()[0]['function']);
        die();
    }


    public function addUser(Request $request)
    {
        $user = new UserEntity();
        $form = $this->createFormBuilder($user)
            ->add('login', TextType::class)
            ->add('password', PasswordType::class)
            ->add('email', EmailType::class)
            ->add('save', SubmitType::class)
            ->getForm();
        
        $form->handleRequest($request);
        
//        $user->password = md5($password);

        $password = $user->getPassword();
//        $password = password_hash($password,PASSWORD_DEFAULT);
        $password = md5($password);
        $user->setPassword($password);


        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
            
        return $this->render('user/new.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView(),
        ]);
    }


}

