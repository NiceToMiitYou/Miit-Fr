<?php

namespace Miit\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TranslationController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class TranslationController extends Controller
{
    /**
     * @Route("/dist/js/translations.js", name="translations_script")
     */
    public function translationsAction(Request $request)
    {
        $params = array(
            'messages' => $this->get('translator')->getMessages()
        );

        $rendered = $this->renderView('MiitFrontendBundle::translations.js.twig', $params);
        
        // Instanciate the response
        $response = new Response($rendered);

        // This is Javascript
        $response->headers->set('Content-Type', 'application/javascript');

        return $response;
    }
}
