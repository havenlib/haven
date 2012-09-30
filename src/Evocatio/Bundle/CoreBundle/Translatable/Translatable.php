<?php
namespace Evocatio\Bundle\CoreBundle\Translatable;

use Evocatio\Bundle\CoreBundle\Entity\Language;
use Evocatio\Bundle\CoreBundle\Lib\Locale;

/**
 * Description of Translatable
 *
 * @author Stéphan Champagne <sc@evocatio.com>
 */
abstract class Translatable {
    private $transArray = array();

    /**
     * Sert à optimiser l'affichage en créant un array pour les translations (au besoin seulement).
     * @param <type> $language
     * @return <type>
     */
    public function getTranslationByLang($language) {
        if($language instanceof Language) {
            $index = $language->getSymbol();
        }else{
            $index = $language;
        }
        if(empty($this->transArray[$index])) {
            $this->transArray[$index] =  $this->getTranslations()->filter(function ($trans) use ($language) {
                        if($language instanceof Language) {
                            return $trans->getTransLang() == $language;
                        }
                        else {
                            return $trans->getTransLang()->getSymbol() == $language;
                        }
                    })
                    ->first();
        }
        
        return $this->transArray[$index];
    }

    /**
     * Adds the translations for the given languages
     * @param <type> $languages
     * @return <array>
     */
    public function addTranslations($languages) {
        foreach ($languages as $language) {
            $this->addTranslationForLanguage($language);
        }
    }

    /**
     * Adds a translation to the object for the given language, use by addTranslations
     * @param <type> $language
     */
    protected function addTranslationForLanguage($language) {

        if(!$trans = $this->getTranslationByLang($language)) {
            $tc = $this->getTranslationClass();
            $trans = new $tc();
            $trans->setTransLang($language);
            $trans->setParent($this);
            $this->getTranslations()->add($trans);
        }
    }

    /**
     * Returns the given attribut translation in the given language (or default language if non given)
     * @param <type> $attribut
     * @param <type> $language
     * @return String
     */
    protected function getTranslated($attribut, $language = null) {
        $language = $language?$language:Locale::getPrimaryLanguage(Locale::getDefault());

        return $this->getTranslationByLang($language)?$this->getTranslationByLang($language)->{"get".$attribut}():false;
    }

    protected function getTranslationClass(){
        throw new \Exception("Vous devez définir la fonction getTranslationClass dans ".get_called_class());
    }

}
?>
