<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
# use App\Model\Wheather;

class UserController extends Controller
{
    public function login()
    {
        return $this->render('user/login.html.twig');
        \dump(get_called_class());
        \dump(debug_backtrace()[0]['function']);
        die();
    }

    public function showUserDetails()
    {
        return $this->render('user/show-user-details.html.twig');
        \dump(get_called_class());
        \dump(debug_backtrace()[0]['function']);
        die();
    }
}
