<?php
namespace Evocatio\Bundle\CoreBundle\Lib;
/**
 * Description of LocalesManager
 *
 * @author Stéphan Champagne <sc@evocatio.com>
 */
class Locale extends \Symfony\Component\Locale\Locale {
    static public function getSystemLocales() {
//        gets the string of installed locales and split in array
        $locales = shell_exec('locale -am');
        $locales = preg_split('/\n/', $locales);
//        remove the capitalized C POSIX and others, keep unique values
        array_walk($locales, function(&$string) {
            return (strtolower(substr($string,0,2))==substr($string,0,2));
        })
        ;
        return array_unique($locales);
    }

    static public function getAvailableDisplaySystemLocales($locale){
        $available = self::getSystemLocales();
        echo "<pre>";
        print_r($available);
        echo "</pre>";
//        die();
        return $available;
    }

    static public function getAvailableSystemLocales(){
        $available = self::getSystemLocales();
        return array_intersect_key(self::getLocales(),array_flip($available));
    }

}