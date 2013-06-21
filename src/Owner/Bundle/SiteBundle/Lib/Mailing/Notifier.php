<?php

namespace Owner\Bundle\SiteBundle\Lib\Mailing;

use Evocatio\Bundle\CoreBundle\Lib\Mailing\MailMessage;
use Evocatio\Bundle\CoreBundle\Lib\Mailing\Notifier as BaseNotifier;

class Notifier extends BaseNotifier {

    public function createContactMail($data) {
        $mail = new MailMessage();
        $mail->setTo(array($this->notification['from_adresses']['default']['email']), $this->notification['from_adresses']['default']['name']);
        $mail->setFrom(array($data['email']), $fullname = $data['firstname'] . " " . $data['lastname']);

        $mail->setBody($data['message']);
        $this->addToPool($mail);
    }

}

?>
