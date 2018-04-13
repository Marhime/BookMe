<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


// Event Controller

class EventController extends Controller
{
    
    /**
     * @Route("/event", name="event")
     */
    
    // Function to display the events on a page
    public function displayEvent (EventRepository $eventRepo)
    {
        $events = $eventRepo->findAll();
        return $this->render('event/event.html.twig', [
            'events' => $events
        ]);
    }
    
    
     /**
     * @Route("/event/addEvent", name="event")
     */
    
    // Function to add and edit an event
    
    public function addEvent(Request $request, ObjectManager $manager)
    {
        // 1-Créer un nouvel événement
        
        $event = new Event();
        $event->setOpeningDate(new \DateTime('now'));
        $event->setClosingDate(new \DateTime('tomorrow'));
        
        
         
        $form = $this->createForm(EventType::class, $event)
            ->add('Add Event', SubmitType::class);
            
               
        return $this->render('event/add_event.html.twig', ['form' => $form->createView()
               ]);
    }
  
            
    
}
