<?php

/**
 * Ceci est la définition de base d'un message, pour être extends au besoin spécifiques,
 * offre des helpers souvent utilisé (http: https:, $env urls, message str_replace etc..)
 *
 * @author themaster
 * @version 0.1
 */
abstract class BaseMailMessage {

    private static $_env;
    private static $_protocol;
    private static $_app;
    private static $_BaseUrl;
    protected $_BaseHtmlBody;
    protected $_BaseTextBody;
    protected $_BaseSujet;
    protected $_From;
    protected $_Destinataire;

    public function __construct() {
        $this_env = sfContext::getInstance()->getConfiguration()->getEnvironment();
    }

    public static function getEnv() {
        if (!self::$_env)
            self::$_env = sfContext::getInstance()->getConfiguration()->getEnvironment();
        return self::$_env;
    }

    public static function getProtocol() {
        if (!self::$_protocol)
            self::$_protocol = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
        return self::$_protocol;
    }

    public static function getApplication() {
        if (!self::$_app)
            self::$_app = sfContext::getInstance()->getConfiguration()->getApplication();
        return self::$_app;
    }

    public static function getBaseUrl() {
        if (!self::$_BaseUrl) {
            self::$_BaseUrl = self::getProtocol() . '://' . $_SERVER['SERVER_NAME'] . '/';
            if (self::getEnv() != 'prod') {
                self::$_BaseUrl .= self::getApplication() . '_' . self::getEnv() . '.php/';
            }
        }
        return self::$_BaseUrl;
    }

    /**
     *
     * Définit le sujet du mail
     * @param string $sujet qui peut contenir des emplacement à remplacer dedans dans le format %toReplace%
     */
    public function setBaseSujet($BaseSujet) {
        $this->_BaseSujet = $BaseSujet;
    }

    /**
     *
     * Définit l'envoyeur du mail
     * @param mixte $From , si $From est un string, from sera toujours le string,
     * si c'est un array pour tout les froms $key => $value le from sera $key pour tous les mails sous la form *.$value, (*.evocatio.com)
     * Le default sera la $key de celui dont le $value est "default" sinon le premier
     * Il faudra probablement changer les points pour des _ dans la $key bien sur
     */

    
    public function setFrom($From) {
        $this->_From = $From;
    }

    /**
     * 
     * Défini le Body html en string avec valeur à remplacer en format %toReplace%
     * @param string $BaseHtmlBody
     */
    public function setBaseHtmlBody($BaseHtmlBody) {
        $this->_BaseHtmlBody = $BaseHtmlBody;
    }

    /**
     *
     * Défini le Body text en string avec valeur à remplacer en format %toReplace%
     * @param string $BaseTextBody
     */
    public function setBaseTextBody($BaseTextBody) {
        $this->_BaseTextBody = $BaseTextBody;
    }

    /**
     * Défini un tableau contenant tout les modificateurs qui peuvent être appliqué au message lors d'un envoi multiple
     * Ainsi que les infos d'envoi (target), mettre les
     * devrait peut être être un objet ? est abstrait parce que devrait être rempli pour l'instance de la super classe
     * @param array $Destinataire (doit contenir les infos du target qui sont à remplacer dans le array ( user_email => array ( "toReplace" => $value, ... )
     * @example setDestinataire( array ( "moi@ici.com" => array ( "Nom" => "Moi", "Désignation" => "Monsieur", "Date" => today() , ... ))
     */
    public function setDestinataire(array $Destinataire) {
        $this->_Destinataire = $Destinataire;
    }

    /**
     *
     * Retourne le sujet du message avec les variables remplacé
     * @param int $indice qui défini quel dynamique content à prendre (devra devenir $current avec iterator)
     */
    public function getSujet() {
        if (!$this->_BaseSujet) {
            throw new Exception("Il n'y a pas de sujet pour le message", -1);
        }
        return $this->addDynamicContent($this->_BaseSujet, $this->getDestinataireData());
    }

    /**
     *
     * Retourne le bodyHtml du message avec les variables remplacé
     * @param int $indice qui défini quel dynamique content à prendre (devra devenir $current avec iterator)
     */
    public function getHtmlBody() {
        return $this->addDynamicContent($this->_BaseHtmlBody, $this->getDestinataireData());
    }

    /**
     *
     * Retourne le bodyText du message avec les variables remplacé
     * @param int $indice qui défini quel dynamique content à prendre (devra devenir $current avec iterator)
     */
    public function getTextBody() {
        return $this->addDynamicContent($this->_BaseTextBody, $this->getDestinataireData());
    }

    public function Next(){
        return next($this->_Destinataire);
    }

    /**
     *
     * @param array $Destinataire (doit contenir les infos du target qui sont à remplacer dans le array
     *      (array ( "toReplace1" => $value1,"toReplace2" => $value2, ... ), array ( "toReplace1" => $value1,"toReplace2" => $value2, ... )
     * @example setDestinataire( array (array( "Nom" => "Moi", "Désignation" => "Monsieur", "Date" => today() , ... ), array( "Nom" => "elle", "Désignation" => "Madame", "Date" => lastWeek() , ... ) )
     */
    protected function getDestinataireData() {
//        if ($this->_Destinataire[$indice])
            return current($this->_Destinataire);
//        return null;
    }

    public function getCurrentTo(){
        return key($this->_Destinataire);
    }

    public function getFrom($to = null) {
        if (!is_string($this->_From)) {
//            la boucle cherche pour les namespace dans les mails et done la valeur voulu à return value si toujours pas de valeur après assign default
            if(!$to)
                $to=$this->getCurrentTo();
            foreach ($this->_From as  $namespace => $email) {
                if (preg_match($namespace, $to ) !== 0) {
                    $returnValue = $email;
                }
                if (empty($returnValue))
                    $returnValue = $this->_From["/default/"];
            }
        }else {
            $returnValue = $this->_From;
        }
        return $returnValue;
    }

    protected function addDynamicContent($Template, $Destinataire = array()) {
        if ($Destinataire){
                $Template = preg_replace(array_keys($Destinataire), array_values($Destinataire), $Template);
        }
        return $Template;
    }

}

