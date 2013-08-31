<?php

namespace Owner\Bundle\SiteBundle\Lib\Mailing;

use Haven\Bundle\CoreBundle\Lib\Mailing\MailMessage;
use Haven\Bundle\CoreBundle\Lib\Mailing\Notifier as BaseNotifier;

class Notifier extends BaseNotifier {

    public function createContactMail($data) {
        $mail = new MailMessage();
        $mail->setTo(array($this->notification['to_adresses']['default']['email']), $this->notification['to_adresses']['default']['name']);
        $mail->setFrom(array($data['email']), $fullname = $data['firstname'] . " " . $data['lastname']);

        /**
         * Rajoute des %% aux clées du tableau de coordonées pour les utiliser comme des "placeholders" dans le message.
         * array(firtsname => "John Doe") vers array(%firtsname% => "John Doe")
         */
        foreach ($data as $key => $value) {
            $data["%" . $key . "%"] = $value;
            unset($data[$key]);
        }

        $message = $this->translator->trans('message.contact', $data, "mails");

        $body = $this->templating->render("OwnerSiteBundle:Mail:template/default.html.twig", array(
            "message" => $message
        ));

        $mail->setSubject($subject = $this->translator->trans('subject.contact', array(), "mails"));
        $mail->setBody($body, 'text/html');

        $this->addToPool($mail);
    }

    public function createNewUserNotification($reset, $reset_url) {
        $mail = new MailMessage();
        $mail->setTo(array($reset->getUser()->getEmail()));
        $mail->setFrom(array($this->notification['from_adresses']['default']['email']), $this->notification['from_adresses']['default']['name']);

        $data['%confirmation_code%'] = $reset->getConfirmation();
        $data['%confirmation_url%'] = $reset_url;

        $message = $this->translator->trans('message.new_user_account', $data, "mails");

        $body = $this->templating->render("OwnerSiteBundle:Mail:template/default.html.twig", array(
            "message" => $message
        ));

        $mail->setSubject($subject = $this->translator->trans('subject.new_user_account', array(), "mails"));
        $mail->setBody($body, 'text/html');

        $this->addToPool($mail);
    }

}

?>
