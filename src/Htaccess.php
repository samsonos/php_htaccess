<?php
/**
 * Created by PhpStorm.
 * User: onysko
 * Date: 10.12.2014
 * Time: 17:33
 */

namespace samson\htaccess;


class Htaccess extends \samson\core\CompressableExternalModule {

    /** @var string module identifier */
    public $id = 'htaccesscreate';

    /** @var string Domain address */
    public $domain = '';

    /** @var string File name */
    public $filename = '';

    public function __HANDLER()
    {
        s()->async(true);

        if ($this->filename != '' && file_exists($this->filename)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=htaccess.txt");
            header("Content-Type: application/octet-stream; ");
            header("Content-Transfer-Encoding: binary");

            echo $this->error404($this->filename);
        }
    }

    public function error404($filename)
    {
        // Try to open file for reading
        $handle = fopen($filename, "r");

        // If handle is active
        if ($handle) {
            // Create new file for writing
            $file = '';

            // Read each line of file
            while (($line = fgets($handle)) !== false) {
                // Create htaccess rule
                $string = 'RewriteRule ^'.substr(str_replace($this->domain, '', $line), 0, -2).' - [NC,L,R=404]';
                // Create 404 error rule
                $file .= $string."\r\n";
            }

            // Close read file handler
            fclose($handle);

            return $file;
        }

        // Failed
        return false;
    }
}
