<?php

namespace Miit\ApiBundle\OAuth;

use FOS\OAuthServerBundle\Storage\GrantExtensionInterface;

use OAuth2\Model\IOAuth2Client;

/**
 * Class RealTimeGrantExtension
 * 
 * @author Boris Tacyniak <boris.tacyniak@itevents>
 */
class RealTimeGrantExtension implements GrantExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function checkGrantExtension(IOAuth2Client $client, array $inputData, array $authHeaders)
    {
        // Check that the input data is correct
        if (!isset($inputData['f22bc372e4297549cb8660226b5d7df1617f94bf'])) {
            return false;
        }

        if ($inputData['f22bc372e4297549cb8660226b5d7df1617f94bf'] === '423b3a6f2421a58bd22d4815cb91d98c12c8ba6e') {
            return array(
                'scope' => 'api realtime'
            );
        }

        return false;
    }
}