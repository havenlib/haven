<?php

namespace Evocatio\Bundle\CoreBundle\Lib\Mailing;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Evocatio\Bundle\CoreBundle\Lib\Mailing\MailMessage;
use Symfony\Component\Translation\Translator;

/**
 * Evocatio\Bundle\CoreBundle\Lib\Notifier
 */
class Notifier {

    protected $mailer;
    protected $templating;
//    protected $notification_from;
//    protected $notification_to;
    protected $notification;
    protected $pool;
    protected $translator;
    protected $authorize;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, $notification, Translator $translator) {
        $this->mailer = $mailer;
        $this->templating = $templating;
//        $this->notification_from = $notification_from;
//        $this->notification_to = $notification_to;
        $this->notification = $notification;
        $this->pool = array();
        $this->translator = $translator;
//        $this->authorize = $authorize;
    }

//    private function getNotificationEmailAdress($name = null) {

    /**
     *
     * @param BaseMailMessage $mailMessage
     * @param <type> $to the adresse to send to in case of non production environment
     */
    public function sendCurrentMessage(MailMessage $mailMessage, $to = null) {
//        if($mailMessage->getEnv()=="prod") {
//        $courriel_destinataire = $mailMessage->getCurrentTo();
//        } else {
//            if (!$to)
//                throw new \Exception("Impossible d'envoyer un mail au client en environnement de test, un usager de test doit être configurer", -1);
//            $courriel_destinataire = $to;
//            $mailMessage->setMessage('<p>COURRIEL DE TEST SERA NORMALEMENT ENVOYÉ À: ' . $mailMessage->getCurrentTo() . "</p>");
//        }
//        $mail = new \Swift_Message();
//        $mail->setFrom($mailMessage->getFrom($courriel_destinataire))
//                ->setTo(array($courriel_destinataire => $mailMessage->getCurrentTo()))
//                ->setSubject($mailMessage->getSujet())
//                ->setCc($mailMessage->getCc())
//                ->setBody($mailMessage->getTextBody())
//                ->addPart($mailMessage->getHTMLBody(), "text/html");

        $mail = $mailMessage;
        /* Multipart Email sending process */
        $this->mailer->send($mail);
    }

    public function send() {
        foreach ($this->getPool() as $key => $mail) {
            $this->sendCurrentMessage($mail);
            unset($this->pool[$key]);
        }
    }

    public function addToPool(MailMessage $mail) {
        $this->pool[] = $mail;
    }

    public function getPool() {
        return $this->pool;
    }

    public function clearPool() {
        $this->pool = array();
    }

    public function createDefaultMail() {
        $mail = new MailMessage();
        $mail->setFrom(array($this->notification['from_adresses']['default']['email']), $this->notification['from_adresses']['default']['name']);

        $this->addToPool($mail);
    }

//    public function createAccountCreationConfirmationNotification($persona, $confirmation_code, $confirmation_url) {
//        $mail = new MailMessage();
//
//        switch ($persona->getDiscriminator()) {
//            case "prestige":
//                $destinataire = $persona->getWeb()->first()->getWeb();
//                break;
//            case "client":
//                $destinataire = $persona->getWeb()->first()->getWeb();
//                $mail->setLanguage($persona->getLanguage());
//                break;
//        }
//
//
//        $body = $this->templating->render("WebsiteSiteBundle:Mails:accountCreationConfirmationNotification.html.twig", array(
//            "persona_discriminator" => $persona->getDiscriminator()
//            , "lang" => $mail->getLanguage() ? $mail->getLanguage()->getSymbol() : null
//            , "confirmation_code" => $confirmation_code
//            , "confirmation_url" => $confirmation_url));
//
//
//        $mail->setBaseHtmlBody($body);
//        $mail->setDestinataire(array($destinataire => array()));
//        $mail->setFrom(array("/default/" => $this->notification_from["default"]));
//        $mail->setBaseSujet($this->translator->trans("object." . $persona->getDiscriminator() . "_account_creation_confirmation", array(), "mails", $mail->getLanguage() ? $mail->getLanguage()->getSymbol() : null));
//
//
//        $this->addToPool($mail);
//    }
}

?>
