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
     * @Route("/events", name="events")
     *
     */
    public function displayEvent(EventRepository $eventRepo)
    {
        $events = $eventRepo->findAll();
        return $this->render('event/events_list_inc.html.twig', [
            'events' => $events
        ]);
    }
    
    
     /**
     * @Route("/dashboard/event/add", name="addEvent")
     * @Route("/dashboard/event/edit/{id}", name="editEvent")
     */
    
    // Function to add and edit an event
    
    public function addEvent(Request $request, ObjectManager $manager , Event $event = null)
    {
        // 1-Create a new event if no event exist
        
        // set time only when it's new
        if ($event === null) {
            $event = new Event();
            $event->setOpeningDate(new \DateTime('now'));
            $event->setClosingDate(new \DateTime('tomorrow'));
        }
         
        $formEvent = $this->createForm(EventType::class, $event)
            ->add('Envoyer', SubmitType::class);
        
        
        //2 - validation of the form
        
        $formEvent->handleRequest($request);
        
        if($formEvent->isSubmitted() && $formEvent->isValid())
            {
        
            // 3 - Saving the entry in the db
            $manager->persist($event);
            $manager->flush();
            return $this->redirectToRoute('event');
            
            }
    
    return $this->render('event/add_event.html.twig', ['form' => $formEvent->createView()
               ]);
  
            
    
    }
    
    
   /**
    * 
    * @Route("/event/{id}", name="oneEvent")
    */
    
   public function displayOneEvent(EventRepository $eventRepo, ObjectManager $manager)
   {
      $repository = $this->getDoctrine()->getRepository(Event::class);

      $event = $repository->findOneBy(['id' => '503']);
      return $this->render('event/oneevent.html.twig', [
           'event' => $event
      ]);
    }
    
    
}
