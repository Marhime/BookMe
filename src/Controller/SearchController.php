<?php

namespace App\Controller;

use Algolia\SearchBundle\IndexManagerInterface;
use App\Entity\Event;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{

    protected $indexManager;

    public function __construct(IndexManagerInterface $indexingManager)
    {
        $this->indexManager = $indexingManager;
    }

    /**
     * @Route("/search", name="search")
     */
    public function search()
    {
        $em = $this->getDoctrine()->getManagerForClass(Event::class);

        $posts = $this->indexManager->search('query', Event::class, $em);

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }


}
