<?php

namespace Owner\Bundle\SiteBundle\Lib\Mailing;

use Evocatio\Bundle\CoreBundle\Lib\Mailing\MailMessage;
use Evocatio\Bundle\CoreBundle\Lib\Mailing\Notifier as BaseNotifier;

class Notifier extends BaseNotifier {

    public function createContactMail($data) {
        $mail = new MailMessage();
        $mail->setTo(array($this->notification['to_adresses']['default']['email']), $this->notification['to_adresses']['default']['name']);
        $mail->setFrom(array($data['email']), $fullname = $data['firstname'] . " " . $data['lastname']);

        $subject = $this->translator->trans('subject.contact', array(), "mails");
        $message = $this->translator->trans('message.contact', array(), "mails");

        $body = $this->templating->render("OwnerSiteBundle:Mailing:template/base.html.twig", array(
            "message" => $message
        ));

        $mail->setBody($body);
        $mail->setSubject($subject);
        $this->addToPool($mail);
    }

}

?>
