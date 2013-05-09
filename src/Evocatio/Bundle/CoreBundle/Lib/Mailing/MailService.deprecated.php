<?php

namespace Evocatio\Bundle\CoreBundle\Lib\Mailing;
/**
 * Service de mail standardiser qui envoi tout les notifications aux users définie dans la config pour les environnements différent de prod
 * Aussi il remplace le from de uda.ca pour un autre si le courriel est destiné à uda.ca (sinon le serveur le refuse)
 *
 * @author themaster
 */

class MailService {
    
    private $mailer;
    public function __construct(\Swift_Mailer $mailer) {
        $this->mailer = $mailer;
    }
    
    /**
     *
     * @param BaseMailMessage $mailMessage
     * @param <type> $to the adresse to send to in case of non production environment
     */
    public function sendCurrentMessage(BaseMailMessage $mailMessage, $to = null) {
        if($mailMessage->getEnv()=="prod") {
            $courriel_destinataire = $mailMessage->getCurrentTo();
        } else {
            if (!$to)
                throw new \Exception("Impossible d'envoyer un mail au client en environnement de test, un usager de test doit être configurer", -1);
            $courriel_destinataire = $to;
            $mailMessage->setMessage('<p>COURRIEL DE TEST SERA NORMALEMENT ENVOYÉ À: ' . $mailMessage->getCurrentTo() . "</p>");
        }

        $mail = new \Swift_Message();
        $mail->setFrom($mailMessage->getFrom($courriel_destinataire))
                ->setTo(array($courriel_destinataire => $mailMessage->getNom()))
                ->setSubject($mailMessage->getSujet())
                ->setBody($mailMessage->getTextBody())
                ->addPart($mailMessage->getHTMLBody(), "text/html");
        /* Multipart Email sending process */

        $this->mailer->send($mail);
    }
    
    public function sendAllMessages(BaseMailMessage $mailMessage, $to = null){
        do{
//            print_r($mailMessage->getCurrentTo());
            self::sendCurrentMessage($mailMessage, $to);
        }while(is_array($mailMessage->Next()));
    }

}

