<?php

namespace Evocatio\Bundle\CoreBundle\Generic;

use \Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader {

    private $kernel;

    public function __construct(\AppKernel $kernel) {
        $this->kernel = $kernel;
    }

    /**
     * Upload a file in web directory. If $location parameter is not 
     * precised, file will be moved in /web/uploads/tmp directory by 
     * default else it will be moved in /web/your_directory.
     * 
     * @param type $file
     * @param string $location
     * @return boolean
     * 
     */
    public function moveFile(UploadedFile $file, $location = null) {
        $relative_location = ($location) ? $location : "tmp";
        $location = $this->kernel->getRootDir() . "/../web/uploads/" . $relative_location;

        if (!file_exists($location))
            mkdir($location, 0777, true);

        $file->move($location, $file->getClientOriginalName());

        return $relative_location . "/" . $file->getClientOriginalName();
    }

    public function moveFiles($data, $location = null) {
        if (is_array($data)) {
            foreach ($data as $d) {
                $this->moveFiles($d, $location);
            }
        } else if ($data instanceof UploadedFile) {
            $this->moveFile($data, $location);
        }
    }

}

?>
