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
    
    // Function to display the events on a page
    public function (EventRepository $eventRepo)
    {
        $events = $eventRepo->findAll();
        return $this->render('event/event.html.twig', [
            'events' => $events
        ]);
    }
    
    public function addEditEvent(Request $request)
    {
        // 1-Créer un nouvel événement
        
        $event = new Event();
        $event->setTask('Write a blog post');
        $event->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($event)
            ->add('event', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('name')
            ->add('id_user')
            ->add('place')
            ->add('opening_date')
            ->add('closing_date')
            ->add('phone')
            ->add('theme')
            ->add('website')
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
        
        
    }
            
    
}
