<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
# use App\Model\Wheather;

class FilmController extends Controller
{
    public function showFilm()
    {
        return $this->render('film/film.html.twig');
        \dump(get_called_class());
        \dump(debug_backtrace()[0]['function']);
        die();
    }
}
