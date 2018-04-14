<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
# use App\Model\Wheather;

class DefaultController extends Controller
{
    public function index()
    {
        return $this->render('index.html.twig');
        \dump(get_called_class());
        \dump(debug_backtrace()[0]['function']);
        die();
#        $wheather = new Wheather();
#        return $this->render('index.html.twig', ['temperature' => $wheather->getTemperature(), ]);
    }
}
