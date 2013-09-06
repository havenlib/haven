<?php

namespace Haven\Bundle\SecurityBundle\Lib\Firewall;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Firewall\ExceptionListener as BaseExceptionListener;

class ExceptionListener extends BaseExceptionListener {

    protected function setTargetPath(Request $request) {
        // Do not save target path for XHR and non-GET requests
        // You can add any more logic here you want
        if ($request->isXmlHttpRequest()) {
            $response = new Response();
            $render = json_encode(array('message' => "test", 'render' => $render));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }


        parent::setTargetPath($request);
    }

}

?>