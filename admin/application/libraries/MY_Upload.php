<?php

class MY_Upload extends CI_Upload {
    
    function is_allowed_filetype()
    {
        if (count($this->allowed_types) == 0 OR ! is_array($this->allowed_types))
        {
            $this->set_error('upload_no_file_types');
            return FALSE;
        }
                 
        foreach ($this->allowed_types as $val)
        {
            $mime = $this->mimes_types(strtolower($val));
        
            if (is_array($mime))
            {
                if (in_array($this->file_type, $mime, TRUE))
                {
                    return TRUE;
                }
            }
            else
            {
                if ($mime == $this->file_type)
                {
                    return TRUE;
                }    
            }        
        }
        # START EDIT #
        $log_file = BASEPATH . 'logs/unknown_mimes.log';
        
        if (file_exists($log_file))
        {
            $file = file($log_file);
            
            if ( ! in_array($mime, $file))
            {
                $file[] = $mime;
                $mime = implode("\n", $file);
            }
        }
        
        file_put_contents($log_file, $mime);
        
        # END EDIT #
        return FALSE;
    }
}

// End of file: MY_Upload.php
// Location: ./system/application/libraries/MY_Upload.php 