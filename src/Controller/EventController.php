<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

// Event Controller
class EventController extends Controller
{
    /**
     * @Route("/event", name="event")
     */
    public function displayEvent(EventRepository $eventRepo)
    {
        $events = $eventRepo->findAll();
        return $this->render('event/event.html.twig', [
            'events' => $events
        ]);
    }
    
}
