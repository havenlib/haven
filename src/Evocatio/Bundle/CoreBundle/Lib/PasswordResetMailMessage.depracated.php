<?php
namespace Evocatio\Bundle\CoreBundle\Lib;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. 104329 test_test_butlere@globetrotter.net
 */

/**
 *  Description of PasswordResetMailMessage
 *  Courriel utiliser pour l'initialisation du mot de passe
 * @author themaster
 */
class PasswordResetMailMessage extends BaseMailMessage {

    public function __construct() {
        parent::__construct();
        $this->setFrom(array("/default/" => sfConfig::get('app_uda_from_email', 'noreply@uda.ca') ,
             "/uda.ca/" => sfConfig::get('app_nonuda_from_email', 'noreply@agencered.ca'),
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

}