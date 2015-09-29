<?php
$corePath = $modx->getOption('core_path',null,MODX_CORE_PATH).'components/fastuploadtv/';
$assetsUrl = $modx->getOption('assets_url',null,MODX_ASSETS_URL).'components/fastuploadtv/';

$modx->lexicon->load('fastuploadtv:default');

switch ($modx->event->name) {
    case 'OnTVInputRenderList':
        $modx->event->output($corePath.'elements/tv/input/');
        break;
    case 'OnTVInputPropertiesList':
        $modx->event->output($corePath.'elements/tv/input/options/');
        break;
    case 'OnDocFormPrerender':
        $js  = $modx->getOption('assets_url').'components/fastuploadtv/mgr/js/';
        $modx->regClientStartupScript($js.'widgets/modx.form.filefield.js');
        $modx->regClientStartupScript($js.'FastUploadTV.js');
        $modx->regClientStartupScript($js.'FastUploadTV.form.FastUploadTVField.js');
        break;
    case 'OnWebPageInit':
        $mTypes = $modx->getOption('manipulatable_url_tv_output_types',null,'image,file').',fastuploadtv';
        $modx->setOption('manipulatable_url_tv_output_types', $mTypes);
        break;
    case 'OnFileManagerUpload':
        $translit = (bool)$this->modx->getOption('fastuploadtv.translit', null, false);
        if ($translit) {
            $currentdoc = $modx->newObject('modResource');
            foreach($files as $file)
            {
                if($file['error'] == 0)
                {
                  $pathInfo = pathinfo($file['name']);
                  $oldPath = $directory.$file['name'];
                  $newPath = $currentdoc->cleanAlias($pathInfo['filename']).'.'. $pathInfo['extension'];
                  $source->renameObject($oldPath, $newPath);
                }
            }
        }
        break;
}