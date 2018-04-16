<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
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
     * @Route("/product/{id}", name="product_show")
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
     * @Route("/product/edit", name="edit_product")
     * @Route("/add", name="add_product")
     */
    //ajout d'un produit
    public function editProduct(Request $request, ObjectManager $manager, Product $product = null)
    {
        //If not exist create a product
        if($product === null){
            $product = new Product();
            $group = 'insertion';
        }else{
            $group = 'edition';
        }

        //Form creation
        $formProduct = $this->createForm(ProductType::class, $product, ['validation_groups'=>$group])
                ->add('Envoyer', SubmitType::class);

        //validation of the form
        $formProduct->handleRequest($request);

        if($formProduct->isSubmitted() && $formProduct->isValid()){
            $quantity = $product->setQuantity($request->get('quantity'));


            for ($i = 1; $i < $quantity; $i++ ) {
                //TODO event relation with id event emplementation
                $manager->persist($product);
            }
            $manager->flush();
            return $this->redirectToRoute('product');
        }
        return $this->render('product/edit_product.html.twig',
            ['form' => $formProduct->createView(), ]);

    }

}
