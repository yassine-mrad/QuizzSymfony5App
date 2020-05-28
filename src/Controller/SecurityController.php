<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EtudiantType;
use App\Form\EnseignantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {   
         if ($this->getUser()) {
            
            return $this->redirectToRoute('Home');
            
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
     /**
     * @Route("admin/inscription", name="security_registration")
     */
    public function registration(Request $request,EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $enseignant=new User();
        $form =$this->createForm(EnseignantType::class,$enseignant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $hash=$encoder->encodePassword($enseignant,$enseignant->getPassword());
            $enseignant->setPassword($hash);
            $manager->persist($enseignant);
            $manager->flush();
            return $this->redirectToRoute('easyadmin');
        }
        
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/inscription", name="Etudiant_registration")
     */
    public function registrationEtudiant(Request $request,EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $enseignant=new User();
        $form =$this->createForm(EtudiantType::class,$enseignant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $hash=$encoder->encodePassword($enseignant,$enseignant->getPassword());
            $enseignant->setPassword($hash);
            $manager->persist($enseignant);
            $manager->flush();
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('security/Etudiant_registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
