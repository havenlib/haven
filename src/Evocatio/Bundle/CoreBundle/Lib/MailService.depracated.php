<?php
namespace Evocatio\Bundle\CoreBundle\Lib;
/**
 * Service de mail standardiser qui envoi tout les notifications aux users définie dans la config pour les environnements différent de prod
 * Aussi il remplace le from de uda.ca pour un autre si le courriel est destiné à uda.ca (sinon le serveur le refuse)
 *
 * @author themaster
 */
class MailService {
    /**
     *
     * @param BaseMailMessage $mailMessage
     * @param <type> $to the adresse to send to in case of non production environment
     */
    public static function sendCurrentMessage($mailMessage, $to = null) {
        if(true) {
            $courriel_destinataire = $mailMessage->getCurrentTo();
        } else {
            if (!$to)
                throw new Exception("Impossible d'envoyer un mail au client en environnement de test, un usager de test doit être configurer", -1);
            $courriel_destinataire = $to;
//            sera affiché seulement si le body à un placeholder %message%
            $mailMessage->setMessage('<p>COURRIEL DE TEST SERA NORMALEMENT ENVOYÉ À: ' . $mailMessage->getCurrentTo() . "</p>");
        }

        $mail = new \Swift_Message();
        $mail->setFrom($mailMessage->getFrom($courriel_destinataire))
                ->setTo(array($courriel_destinataire => "test"))
                ->setSubject($mailMessage->getSujet())
                ->setBody($mailMessage->getTextBody())
                ->addPart($mailMessage->getHTMLBody(), "text/html");
        /* Multipart Email sending process */

//        sfContext::getInstance()->getMailer()->send($mail);
    }
    
    public static function sendAllMessages($mailMessage, $to = null){
        do{
            self::sendCurrentMessage($mailMessage, $to);
        }while($mailMessage->Next() !== false);
    }

}

