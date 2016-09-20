<?php
/**
 * Upload files to a directory
 *
 * @param string $path The target directory
 *
 * @package fastuploadtv
 * @subpackage processors.browser.file
 */
class fastBrowserFileUploadProcessor extends modBrowserFileUploadProcessor {
    
    public function initialize() {
        $this->setDefaultProperties(array(
            'source' => 1,
            'path' => false,
        ));
        return true;
    }
    
    public function getLanguageTopics() {
        $langs = parent::getLanguageTopics();
        $langs[] = 'fastuploadtv';
        return $langs;
    }
    
    public function process() {
        if (!$this->getSource()) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }
        
        // Check a file has been uploaded
        if (count($_FILES) < 1) {
            return $this->failure($this->modx->lexicon('fastuploadtv.err_file_ns'));
        }
        
        // Ensure we have been passed the TV's id
        if (!$this->getProperty('tv_id')) {
            return $this->failure($this->modx->lexicon('fastuploadtv.error_tvid_ns'));
        }
        
        // Grab the TV object
        $TV = $this->modx->getObject('modTemplateVar',$this->getProperty('tv_id'));
        if (! $TV instanceof modTemplateVar) {
            return $this->failure($this->modx->lexicon('fastuploadtv.error_tvid_invalid')."<br />\n[".$this->getProperty('tv_id')."]");
        }
        
        // Initialize and check perms for this mediasource
        $this->source = $TV->getSource('web');
        $this->source->initialize();
        if (!$this->source->checkPolicy('create')) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }
        
        // Grab the path option & prepare path
        $opts = unserialize($TV->input_properties);
        $path = $this->preparePath($opts['path']);
        
        // Prepare file names (prevent duplicate overwrites)
        $prefix = (empty($opts['prefix'])) ? '' : $opts['prefix'];
        $files = $this->prepareFiles($prefix);
        
        // Do the upload
        $success = $this->source->uploadObjectsToContainer($path, $files);
        
        // Check for upload errors
        if (empty($success)) {
            $msg = '';
            $errors = $this->source->getErrors();
            
            // Remove 'directory already exists' error
            if (isset($errors['name'])) {
                unset($errors['name']);
            }
            
            if (count($errors) > 0) {
                foreach ($errors as $k => $msg) {
                    $this->modx->error->addField($k,$msg);
                }
                return $this->failure($msg);
            }
        }
        
        // Generate the file's url
        $fName = array_shift($files);
        $url = $path.$fName['name'];
        $url = str_replace('//','/',$url);
       
        return $this->success(stripslashes($url));
            /* stripslashes(json_encode( (object)array('success' => true, 'msg' => $url))); */
    }
    
    /**
     * Prepare the save path using the TV's defined pathing string
     */
    private function preparePath($pathStr) {
        
        // If the pathStr starts '@SNIPPET ' then run the snippet to get path
        if (strpos($pathStr,'@SNIPPET ') !== false) {
            $snippet = str_replace('@SNIPPET ','',$pathStr);
            return $this->modx->runSnippet($snippet, $this->getProperties());
        }

        // Parse path string and return it
        $path = $this->parsePlaceholders($pathStr);
        return $path;
    }
    
    /**
     * Prepare file name (prevent accidental overwrites)
     */
    private function prepareFiles($prefix) {
        $files = $_FILES;
        
        $fastuploadtv_translit = (bool)$this->modx->getOption('fastuploadtv.translit', null, false);
        
        foreach ($files as &$file) {
            $pathInfo = pathinfo($file['name']);
            $ext = $pathInfo['extension'];
            
            $filename = ($this->getProperty('prefixFilename') == 'true') ? $prefix : $prefix.$pathInfo['filename'];
            $filename = $this->parsePlaceholders($filename);
            
            if ($fastuploadtv_translit) {
                $filename = modResource::filterPathSegment($this->modx, $filename); // cleanAlias (translate) 
                $filename = str_replace(array(')','('),array('',''),$filename);
            
                $ext = strtolower($ext);
            }
            
            $file['name'] = $filename . '.'. $ext;
        }
        return $files;
    }
    
    /**
     * Parse placeholders in input fields
     */
    private function parsePlaceholders($str) {
        $bits = array(
            '{id}'      => $this->getProperty('res_id'),    // Resource ID
            '{pid}'     => $this->getProperty('p_id'),      // Resource Parent ID
            '{alias}'   => $this->getProperty('res_alias'), // Resource Alias
            '{palias}'  => $this->getProperty('p_alias'),   // Resource Parent Alias
            '{tid}'     => $this->getProperty('tv_id'),     // TV ID
            '{uid}'     => $this->modx->user->get('id'),    // User ID
            '{rand}'    => substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyz', ceil(6/strlen($x)) )),1,6), // Random string
            '{t}' => time(),    // Timestamp
            '{y}' => date('Y'), // Year
            '{m}' => date('m'), // Month
            '{d}' => date('d'), // Day
            '{h}' => date('H'), // Hour
            '{i}' => date('i'), // Minute
            '{s}' => date('s'), // Second
        )
        return str_replace(array_keys($bits), $bits, $str);
    }
}
return 'fastBrowserFileUploadProcessor';