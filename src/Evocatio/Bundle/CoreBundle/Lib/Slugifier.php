<?php

namespace Evocatio\Bundle\CoreBundle\Lib;

class Slugifier {

    public function slugifyRequest($requestT, $fields) {
//        $requestT = array_pop($requestT);

        $sluggify = function (&$array, $fields) use (&$sluggify) {
                    if (array_key_exists("slug", $array)) {
                        $preSlugArray = array();
                        foreach ($fields as $field) {
                            if (!isset($array[$field]))
                                throw new \Exception($field . " field doesn't exist for slugification on the entity");
                            $preSlugArray[] .= trim($array[$field]);
                        }

                        $slug = (substr($slug = $this->slugifyString(implode("-", $preSlugArray)), -1) == "-") ? substr($slug, 0, -1) : $slug;
                        $array["slug"] = ($array["slug"] == "") ? $slug : $this->slugifyString($array["slug"]);
                    }

                    foreach ($array as &$child) {
                        if (is_array($child))
                            $sluggify($child, $fields);
                    }
                };

        $sluggify($requestT, $fields);

        return $requestT;
    }

    /**
     * recursive look into the ArrayFiles to find all ["uploads"], and transform them to ["files"] and merge them with arrayRequest.
     * It changes the uploadedFiles to array's and moves the files to a new location configured in %secure_upload_dir%
     * @param type $arrayFile
     * @param type $arrayRequest
     */
//    private function changeSlugs($arrayRequest, &$fields) {
//        if (array_key_exists("slug", $arrayRequest)) {
//            $preSlugArray = null;
//            foreach ($fields as $key => $field) {
//                $preSlugArray[] .= trim($arrayRequest[$field]);
//            }
//
//            $slug = (substr($slug = $this->slugifyString(implode("-", $preSlugArray)), -1) == "-") ? substr($slug, 0, -1) : $slug;
//            $arrayRequest["slug"] = ($arrayRequest["slug"] == "") ? $slug : $this->slugifyString($arrayRequest["slug"]);
//        }
//        foreach ($arrayRequest as $key => &$child) {
//            if (is_array($child)) {
//                $this->changeSlugs($child, $fields);
////                unset($child);
//            }
//        }
//    }

    public function slugifyString($string, $separator = "-") {
        $string = $this->normalizeUtf8String($string);

        return strtolower(preg_replace('/[^A-Z^a-z^0-9^\/]+/', $separator, preg_replace('/([a-z\d])([A-Z])/', '\1_\2', preg_replace('/([A-Z]+)([A-Z][a-z])/', '\1_\2', preg_replace('/::/', '/', $string)))));
    }

    private function normalizeUtf8String($s) {
        $original_string = $s;

        // Normalizer-class missing!
        if (!class_exists("Normalizer", $autoload = false))
            return $original_string;


        // maps German (umlauts) and other European characters onto two characters before just removing diacritics
        $s = preg_replace('@\x{00c4}@u', "AE", $s);    // umlaut Ä => AE
        $s = preg_replace('@\x{00d6}@u', "OE", $s);    // umlaut Ö => OE
        $s = preg_replace('@\x{00dc}@u', "UE", $s);    // umlaut Ü => UE
        $s = preg_replace('@\x{00e4}@u', "ae", $s);    // umlaut ä => ae
        $s = preg_replace('@\x{00f6}@u', "oe", $s);    // umlaut ö => oe
        $s = preg_replace('@\x{00fc}@u', "ue", $s);    // umlaut ü => ue
        $s = preg_replace('@\x{00f1}@u', "ny", $s);    // ñ => ny
        $s = preg_replace('@\x{00ff}@u', "yu", $s);    // ÿ => yu
        // maps special characters (characters with diacritics) on their base-character followed by the diacritical mark
        // exmaple:  Ú => U´,  á => a`
        $s = \Normalizer::normalize($s, \Normalizer::FORM_D);


        $s = preg_replace('@\pM@u', "", $s);    // removes diacritics


        $s = preg_replace('@\x{00df}@u', "ss", $s);    // maps German ß onto ss
        $s = preg_replace('@\x{00c6}@u', "AE", $s);    // Æ => AE
        $s = preg_replace('@\x{00e6}@u', "ae", $s);    // æ => ae
        $s = preg_replace('@\x{0132}@u', "IJ", $s);    // ? => IJ
        $s = preg_replace('@\x{0133}@u', "ij", $s);    // ? => ij
        $s = preg_replace('@\x{0152}@u', "OE", $s);    // Œ => OE
        $s = preg_replace('@\x{0153}@u', "oe", $s);    // œ => oe

        $s = preg_replace('@\x{00d0}@u', "D", $s);    // Ð => D
        $s = preg_replace('@\x{0110}@u', "D", $s);    // Ð => D
        $s = preg_replace('@\x{00f0}@u', "d", $s);    // ð => d
        $s = preg_replace('@\x{0111}@u', "d", $s);    // d => d
        $s = preg_replace('@\x{0126}@u', "H", $s);    // H => H
        $s = preg_replace('@\x{0127}@u', "h", $s);    // h => h
        $s = preg_replace('@\x{0131}@u', "i", $s);    // i => i
        $s = preg_replace('@\x{0138}@u', "k", $s);    // ? => k
        $s = preg_replace('@\x{013f}@u', "L", $s);    // ? => L
        $s = preg_replace('@\x{0141}@u', "L", $s);    // L => L
        $s = preg_replace('@\x{0140}@u', "l", $s);    // ? => l
        $s = preg_replace('@\x{0142}@u', "l", $s);    // l => l
        $s = preg_replace('@\x{014a}@u', "N", $s);    // ? => N
        $s = preg_replace('@\x{0149}@u', "n", $s);    // ? => n
        $s = preg_replace('@\x{014b}@u', "n", $s);    // ? => n
        $s = preg_replace('@\x{00d8}@u', "O", $s);    // Ø => O
        $s = preg_replace('@\x{00f8}@u', "o", $s);    // ø => o
        $s = preg_replace('@\x{017f}@u', "s", $s);    // ? => s
        $s = preg_replace('@\x{00de}@u', "T", $s);    // Þ => T
        $s = preg_replace('@\x{0166}@u', "T", $s);    // T => T
        $s = preg_replace('@\x{00fe}@u', "t", $s);    // þ => t
        $s = preg_replace('@\x{0167}@u', "t", $s);    // t => t
        // remove all non-ASCii characters
        $s = preg_replace('@[^\0-\x80]@u', "", $s);
        $s = preg_replace('@[\/]@u', "", $s);


        // possible errors in UTF8-regular-expressions
        if (empty($s))
            return $original_string;
        else
            return $s;
    }

}

?>
