<?php

namespace Miit\FrontendBundle\Controller;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\RegisterUserCommand;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class WelcomeController extends Controller
{
    /**
     * @Route("/", name="welcome_home")
     */
    public function indexAction(Request $request)
    {
        return $this->render('MiitFrontendBundle:www:index.html.twig');
    }

    /**
     * @Route("/login", name="welcome_login")
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
 
        return $this->render('MiitFrontendBundle:www:login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    /**
     * @Route("/register", name="welcome_register")
     */
    public function registerAction(Request $request)
    {
        $session = $request->getSession();

        $form = $this->createForm('registration_type');

        $form->handleRequest($request);
        
        // Redirect if valid
        if ($form->isValid()) {

            $registration = $form->getData();

            $userId   = UserId::newInstance();
            $email    = new Email($registration->user->email);
            $username = $registration->user->username;
            $password = $registration->user->password;

            $command = new RegisterUserCommand($userId, $username, $email, $password);
        
            $this->get('command_bus')->dispatch($command);

            return $this->redirect($this->generateUrl('welcome_home'));
        }

        return $this->render('MiitFrontendBundle:www:register.html.twig', array(
            'registration_form' => $form->createView(),
        ));
    }
}
