<?php

namespace Evocatio\Bundle\CoreBundle\Lib\Mailing;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Website\Bundle\SiteBundle\Lib\Mails\DossierUpdateMailMessage;
use Evocatio\Bundle\CoreBundle\Lib\Mailing\MailMessage;

/**
 * Evocatio\Bundle\CoreBundle\Lib\Notifier
 */
class NotifierDeprecated {

    protected $mailer;
    protected $templating;
    protected $notification_from;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, $notification_from, $notification_to) {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->notification_from = $notification_from;
        $this->notification_to = $notification_to;
    }

    /**
     *
     * @param BaseMailMessage $mailMessage
     * @param <type> $to the adresse to send to in case of non production environment
     */
    public function sendCurrentMessage(BaseMailMessage $mailMessage, $to = null) {
//        if($mailMessage->getEnv()=="prod") {
        $courriel_destinataire = $mailMessage->getCurrentTo();
//        } else {
//            if (!$to)
//                throw new \Exception("Impossible d'envoyer un mail au client en environnement de test, un usager de test doit être configurer", -1);
//            $courriel_destinataire = $to;
//            $mailMessage->setMessage('<p>COURRIEL DE TEST SERA NORMALEMENT ENVOYÉ À: ' . $mailMessage->getCurrentTo() . "</p>");
//        }

        $mail = new \Swift_Message();
        $mail->setFrom($mailMessage->getFrom($courriel_destinataire))
                ->setTo(array($courriel_destinataire => $mailMessage->getCurrentTo()))
                ->setSubject($mailMessage->getSujet())
                ->setBody($mailMessage->getTextBody())
                ->addPart($mailMessage->getHTMLBody(), "text/html");
        /* Multipart Email sending process */
        $this->mailer->send($mail);
    }

}

?>
