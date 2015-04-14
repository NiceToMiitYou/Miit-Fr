<?php

namespace Miit\CoreDomainBundle\Manager;

use Miit\CoreDomainBundle\Repository\UserRepository;
use Miit\CoreDomain\Common\Email;

/**
 * Class UserManager
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserManager
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, \Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->userRepository = $userRepository;
        $this->mailer         = $mailer;
        $this->twig           = $twig;
    }

    /**
     * @param Email $email
     */
    public function sendNewUserEmail(Email $email, $password)
    {
        if(!$this->mailer->getTransport()->isStarted()){
            $this->mailer->getTransport()->start();
        }

        $bodyHtml = $this->twig->render(
            'MiitFrontendBundle:mailing:newUser.html.twig',
            array('html' => true,  'password' => $password)
        );

        $bodyText = $this->twig->render(
            'MiitFrontendBundle:mailing:newUser.html.twig',
            array('html' => false, 'password' => $password)
        );

        $message = $this->mailer->createMessage();

        $message->setBody($bodyHtml, 'text/html');
        $message->addPart($bodyText, 'text/plain', 'UTF8');

        $message->addTo($email->getValue());
        $message->setFrom(array('no-reply@miit.fr' => 'Miit.fr'));      

        $this->mailer->send($message);
        $this->mailer->getTransport()->stop();
    }
}