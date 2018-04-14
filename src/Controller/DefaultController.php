<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
# use App\Model\Wheather;

class DefaultController extends Controller
{
    public function index()
    {
        \dump(get_called_class());
        die();
#        $wheather = new Wheather();
#        return $this->render('index.html.twig', ['temperature' => $wheather->getTemperature(), ]);
    }
}
