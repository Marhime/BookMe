<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="root")
     */
    //route for root
    public function root()
    {
        //redirection vers la route home en cas de redirection vers de terre '/'
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/home", name="home")
     */
    //render the homepage
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
