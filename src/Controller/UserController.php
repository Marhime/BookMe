<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{

    /**
     * @Route("/register", name="register")
     * @Route("/dashboard/edit/{id}", name="edit_user")
     */
    public function registerUser(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = New User();
        $formUser = $this->createForm(UserType::class, $user)
            ->add('Envoyer', SubmitType::class);

        // 2) handle the submit
        $formUser->handleRequest($request);
        if($formUser->isSubmitted() && $formUser->isValid())
        {
            // 3) Encode the password
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $user->setRoles(implode('|', $user->getRoles()));
            $entityManager->flush();

            // 5) redirection
            return $this->redirectToRoute('home');
        }
        // 6) Where is the form ??
        return $this->render('user/register.html.twig', [
            'formUser' => $formUser->createView()
        ]);
    }
    
    /**
     * 
     * @Route("/dashboard/editUser/{id}", name="edit_user")
     */
    public function editUser(Request $request, ObjectManager $manager, User $user = null)
    {
        
        $form = $this->createForm(EditUserType::class, $user)
            ->add('Envoyer',SubmitType::class);
        
        $form->handleRequest($request); 
        
        if($form->isSubmitted() && $form->isValid()){
        // save user edit
            
            $user->setRoles('ROLE_USER');
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('dash_orga');
            
        }
        
       
        return $this->render('orga_dashboard/edit_dash.html.twig',[
                'form' => $form->createView(),
                ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

    }

    //function to acess to the orga dashboard
    //TODO limit acess to orga roles
    /**
     * @Route("/dashboard/{id}", name="dash_orga")
     */
    public function dashOrga($id)
    {
        $orga = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        if (!$orga) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }
        return $this->render('orga_dashboard/main_dash.html.twig',
            ['orga' => $orga]);
    }
}
