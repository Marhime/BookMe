<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\EventRepository;
use App\Repository\ProductRepository;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProductController extends Controller
{
    /**
     * @Route("/product", name="product")
     */
    //    Récupération de la liste des produits
    public function index(ProductRepository $productRepository)
    {
        $productsList = $productRepository->findAll();

        return $this->render('product/display_products_inc.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $productsList
        ]);
    }


    /**
     * @Route("", name="product_show")
     */
    public function display($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('product/product_inc.html.twig',
            ['product' => $product]);

    }

    /**
     * @Route("", name="event_product_show")
     */
    public function displayEventProduct($event)
    {
        $productEvent = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($event);

        if (!$productEvent) {
            throw $this->createNotFoundException(
                "Il n'y a pas encore de stand pour ".$event
            );
        }
        return $this->render(
            'product/event_product_inc.html.twig',
            array('productEvent' => $productEvent)
        );

    }


    /**
     * @Route("event/{idEvent}/product/edit/{idProduct}", name="edit_product")
     * @Route("event/{idEvent}/product/add", name="add_product")
     * 
     */
    
    //add a product
    
    public function editProduct(Request $request, ObjectManager $manager, EventRepository $eventRepository, ProductRepository $productRepository, $idEvent, $idProduct = null)
    {
        //If doesn't exist create a product

        $event = $eventRepository->find($idEvent);
        if($idProduct === null){
            $product = new Product();
            $group = 'insertion';
        }else{
            $product = $productRepository->find($idProduct);
            $group = 'edition';
        }

        //Form creation
        $formProduct = $this->createForm(ProductType::class, $product, ['validation_groups'=>$group])
                ->add('Envoyer', SubmitType::class);

        //validation of the form
        $formProduct->handleRequest($request);

        if($formProduct->isSubmitted() && $formProduct->isValid()){
            $product->setEvent($event);
            //TODO event relation with id event emplementation
            $manager->persist($product);

            $manager->flush();
            return $this->redirectToRoute('oneEvent', ['id' => $event->getId()]);
        }
        return $this->render('product/edit_product.html.twig',
            ['form' => $formProduct->createView(), ]);

    }

    /**
     * @Route("event/product/delete/{id}", name="delete_product")
     */
    public function deleteProduct(Product $product, ObjectManager $manager)

    {
        $idEvent = $product->getEvent()->getId();
        if($product->getEvent()->getOwner()->getId() !== $this->getUser()->getId())
        {
            throw $this->createAccessDeniedException("Vous n'êtes pas autorisé à supprimer ce produit");
        }
        $manager->remove($product);
        $manager->flush();
        return $this->redirectToRoute('oneEvent', ['id' => $idEvent]);
    }


}
