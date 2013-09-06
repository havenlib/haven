<?php

namespace Haven\Bundle\SecurityBundle\Lib\Handler;

use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler {

    public function onAuthenticationSuccess(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token) {

        if ($request->isXMLHttpRequest()) {
            $response = new Response();

            $render = json_encode(array('params' => array("targetUrl" => $this->httpUtils->generateUri($request, $this->determineTargetUrl($request)))));
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($render);

            return $response;
        }

        return parent::onAuthenticationSuccess($request, $token);
    }

}

?>
