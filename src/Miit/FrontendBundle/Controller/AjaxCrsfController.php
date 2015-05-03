<?php

namespace Miit\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AjaxCrsfController
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
class AjaxCrsfController extends Controller
{
    /**
     * @Route("/_crsftoken/", defaults={"intention" = "unkown"})
     * @Route("/_crsftoken/{intention}", name="ajax_crsf",
     *      defaults={
     *          "intention" = "unkown"
     *      }
     * )
     */
    public function indexAction(Request $request, $intention)
    {
        $csrf  = $this->get('security.csrf.token_manager');
        $token = $csrf->getToken($intention);
        
        return new JsonResponse(
            array(
                'token' => $token->getValue()
            )
        );
    }
}
