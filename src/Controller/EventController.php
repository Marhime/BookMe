<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Event Controller
class EventController extends Controller
{
    /**
     * @Route("/event", name="event")
     */
    public function displayEvent()
    {
        return $this->render('event/event.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
    
}
