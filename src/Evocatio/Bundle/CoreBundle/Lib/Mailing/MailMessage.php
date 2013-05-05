<?php

namespace Evocatio\Bundle\CoreBundle\Lib\Mailing;

use Evocatio\Bundle\CoreBundle\Lib\Mailing\BaseMailMessage;

class MailMessage extends BaseMailMessage {

    public function __construct($env = 'dev') {
        parent::__construct($env);
        $this->setFrom(array("/default/" => 'info@preemploiprestige.qc.ca',
            "/evocatio.com/" => "sig@stephanchampagne.com"));
    }

    protected function getDestinataireData() {
        if (!isset($this->_Destinataire[$this->getCurrentTo()]["/%message%/"]))
            $this->_Destinataire[$this->getCurrentTo()]["/%message%/"] = null;
        return parent::getDestinataireData();
    }

    public function setMessage($message) {
        $this->_Destinataire[$this->getCurrentTo()]["/%message%/"] = $message;
    }

    public function setParameters($params = array()) {
        foreach ($params as $name => $value) {
            $this->_Destinataire[$this->getCurrentTo()]["/%" . $name . "%/"] = $value;
        }
    }

    public function addParam($name, $value) {
        $this->_Destinataire[$this->getCurrentTo()]["/%" . $name . "%/"] = $value;
    }

}
?>
