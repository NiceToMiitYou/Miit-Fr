<?php

namespace Miit\CoreDomainBundle\Manager;

use Miit\CoreDomain\Common\Email;

use Monolog\Logger;

/**
 * Class EmailManager
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class EmailManager
{
    /**
     * @var array
     */
    private $context;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param UserRepository    $userRepository
     * @param \Swift_Mailer     $mailer,
     * @param \Twig_Environment $twig
     */
    public function __construct(
        Logger $logger,
        \Swift_Mailer $mailer,
        \Twig_Environment $twig
    ) {
        $this->logger  = $logger;
        $this->mailer  = $mailer;
        $this->twig    = $twig;
        $this->context = array();
    }

    /**
     * Add to the context
     * 
     * @param string $key
     * @param mixed  $value
     */
    public function add($key, $value)
    {
        $this->context[$key] = $value;
    }

    /**
     * Reset the context
     */
    public function reset()
    {
        $this->context = array();
    }

    /**
     * @param string $template
     * 
     * @return array
     */
    private function generateTemplate($template)
    {
        // Generate HTML Template
        $context['html'] = true;
        $bodyHtml = $this->twig->render($template, $this->context);

        // Generate NON-HTML Template
        $context['html'] = false;
        $bodyText = $this->twig->render($template, $this->context);

        return array($bodyText, $bodyHtml);
    }

    /**
     * @param Email  $email
     * @param string $template
     */
    private function sendMessage(Email $email, $template)
    {
        if(!$this->mailer->getTransport()->isStarted()){
            $this->mailer->getTransport()->start();
        }

        list($bodyText, $bodyHtml) = $this->generateTemplate($template);

        $message = $this->mailer->createMessage();

        $message->setBody($bodyHtml, 'text/html');
        $message->addPart($bodyText, 'text/plain', 'UTF8');

        $message->addTo($email->getValue());
        $message->setFrom(array('no-reply@itevents.fr' => 'Miit.fr'));      

        $this->mailer->send($message);
        $this->mailer->getTransport()->stop();

        $this->logger->debug('E-mail send.', array(
            'to'       => sprintf('%s', $email),
            'template' => $template,
            'html'     => $bodyHtml,
            'text'     => $bodyText,
            'data'     => $context,
        ));
    }

    /**
     * @param Email  $email
     * @param string $password
     */
    public function sendNewUser(Email $email, $password)
    {
        $this->add('user_password', $password);

        $this->sendMessage($email, 'MiitFrontendBundle:mailing:newUser.html.twig');
    }

    /**
     * @param Email $email
     */
    public function sendInviteUser(Email $email)
    {
        $this->sendMessage($email, 'MiitFrontendBundle:mailing:inviteUser.html.twig');
    }

    /**
     * @param Email $email
     */
    public function sendCreatedTeam(Email $email)
    {
        $this->sendMessage($email, 'MiitFrontendBundle:mailing:createdTeam.html.twig');
    }
}