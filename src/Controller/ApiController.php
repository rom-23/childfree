<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ApiController extends AbstractController
{
  /**
   * @Route("/about", name="about")
   * @return Response
   */
  public function about()
  {
    $view = $this->renderView('about/about.html.twig');
    return $this->json(['view' => $view], 200);
  }

  /**
   * @Route("/homepage", name="homepage")
   * @return Response
   */
  public function homepage()
  {
    $view = $this->renderView('homepage/homepage.html.twig');
    return $this->json(['view' => $view], 200);
  }


  /**
   * @Route("/offer", name="offer")
   * @return Response
   */
  public function offer()
  {
    $view = $this->renderView('offer/offer.html.twig');
    return $this->json(['view' => $view], 200);
  }


  /**
   * @Route("/login", name="login")
   * @param AuthenticationUtils $authenticationUtils
   * @return Response
   */
  public function login( AuthenticationUtils $authenticationUtils )
  {
    $error = $authenticationUtils -> getLastAuthenticationError();
    $lastUsername = $authenticationUtils -> getLastUsername();
    $view= $this -> renderView( 'security/Login.html.twig', [
      'last_username' => $lastUsername,
      'error'         => $error
    ] );
    return $this->json(['view' => $view], 200);
  }

  /**
   * @Route("/menu", name="menu")
   * @return Response
   */
  public function menu()
  {
    $view = $this->renderView('menu/menus.html.twig');
    return $this->json(['view' => $view], 200);
  }


}

;
