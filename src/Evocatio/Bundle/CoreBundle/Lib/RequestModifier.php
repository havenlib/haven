<?php

namespace Evocatio\Bundle\CoreBundle\Lib;

class RequestModifier {

    private $request;
    private $slugifier;

    function __construct(Slugifier $slugifier) {
        $this->slugifier = $slugifier;
    }

    function slug($fields) {

        if (empty($this->request))
            throw new \Exception("You should pass request through setRequest method");

        $result = $this->slugifier->slugifyRequest($this->request->request->all(), $fields);
        $this->request->request->replace($result);

        return $this;
    }

    public function getRequest() {
        return $this->request;
    }

    public function setRequest(\Symfony\Component\HttpFoundation\Request $request) {
        $this->request = clone $request;

        return $this;
    }

}

?>
