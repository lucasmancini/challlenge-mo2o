<?php


namespace App\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        return $this->render('index.html.twig');
    }

}
