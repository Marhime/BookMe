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
            $event->setOwner($this->getUser());
            
            // 3 - Saving the entry in the db
            $manager->persist($event);
            $manager->flush();
            return $this->redirectToRoute('oneEvent');
            
            }
    
    return $this->render('event/add_event.html.twig', ['form' => $formEvent->createView()
               ]);
  
            
    
    }
    
    /**
     * 
     * @Route("/dashboard/edit/{id}", name="edit_event")
     */
    public function editEvent(Request $request, ObjectManager $manager)
    {
        
        $form = $this->createForm(EventType::class)
            ->add('Envoyer',SubmitType::class);
        
        $form->handleRequest($request); 
        
        if($form->isSubmitted() && $form->isValid()){
        // save user edit
            
            $user->setRoles('ROLE_USER');
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('dash_orga');
            
        }
        
       
        return $this->render('orga_dashboard/event_dash.html.twig',[
                'form' => $form->createView(),
                ]);
    }
    
    /**
     * @Route("/dashboard/delete/{id}", name="delete_event")
     */
    public function deleteEvent(Event $event, ObjectManager $manager)
    {
        $manager->remove($event);
        $manager->flush();
        $this->redirectToRoute('dash_orga');
        return $this->redirectToRoute('dash_orga');
    }
    
   /**
    * 
    * @Route("/event/{id}", name="oneEvent")
    */
    
    // Afficher un événement
    
   public function display($id)
    {
        $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->find($id);

        if (!$event) {
            throw $this->createNotFoundException(
                'No event found for id '.$id
            );
        }
        return $this->render('event/oneEvent.html.twig',
            ['event' => $event]);

    }
    
    /**
     * @Route("dashboard/listEvent", name="eventListOwner")
     */

     // afficher les événement de l'orga

     public function displayEventByOwner($owner)
     {
        $eventOwner = $this->getDoctrine()
        ->getRepository(Event::class)
        ->find($owner);

        if (!$eventOwner) {
            throw $this->createNotFoundException(
                'No event found for id '.$owner
            );
        }
        return $this->render('event/event_list_owner_inc.html.twig',
            ['eventOwner' => $eventOwner]);
     }
    
}
