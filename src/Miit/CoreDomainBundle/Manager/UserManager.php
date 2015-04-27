<?php

namespace Miit\CoreDomainBundle\Manager;

use DomainDrivenDesign\Domain\Command\CommandBus as CommandBusInterface;

use Miit\CoreDomainBundle\Repository\UserRepository;
use Miit\CoreDomainBundle\Repository\TeamRepository;

use Miit\CoreDomain\Common\Email;
use Miit\CoreDomain\User\UserId;
use Miit\CoreDomain\User\Command\RegisterUserCommand;
use Miit\CoreDomain\User\Command\PromoteUserCommand;
use Miit\CoreDomain\User\Command\AddTeamUserCommand;
use Miit\CoreDomain\Team\TeamId;
use Miit\CoreDomain\Team\Team;

use Monolog\Logger;

/**
 * Class UserManager
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class UserManager
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var TeamRepository
     */
    private $teamRepository;

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
    public function __construct(
        logger $logger,
        CommandBusInterface $commandBus,
        UserRepository $userRepository,
        TeamRepository $teamRepository,
        \Swift_Mailer $mailer,
        \Twig_Environment $twig
    ) {
        $this->logger         = $logger;
        $this->commandBus     = $commandBus;
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
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