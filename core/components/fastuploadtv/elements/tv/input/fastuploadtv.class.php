<?php
class FastUploadTVInputRender extends modTemplateVarInputRender {
    
    public function getTemplate() {
        return $this->modx->getOption('core_path').'components/fastuploadtv/elements/tv/input/tpl/fastuploadtv.tpl';
    }
    
    public function process($value,array $params = array()) {
        $js  = $this->modx->getOption('assets_url').'components/fastuploadtv/mgr/js/';
        
        $this->modx->regClientStartupScript($js.'widgets/modx.form.filefield.js');
        $this->modx->regClientStartupScript($js.'FastUploadTV.js');
        $this->modx->regClientStartupScript($js.'FastUploadTV.form.FastUploadTVField.js');

        // Set assets path
        $this->setPlaceholder('assets',$this->modx->getOption('assets_url').'components/fastuploadtv/');
        
        $this->modx->lexicon->load('fastuploadtv');
        
        $this->setPlaceholder('res_id',$this->modx->resource->get('id'));
        $this->setPlaceholder('ms_id',$this->tv->source);
        $this->setPlaceholder('jsonlex',json_encode($this->modx->lexicon->fetch('fastuploadtv.',true)));
        $this->setPlaceholder('lex',(object)$this->modx->lexicon->fetch('fastuploadtv.',true));
        
        // Resource Alias
        $resource_alias = ($this->modx->resource->get('alias')) ? $this->modx->resource->get('alias') : '';
        $this->setPlaceholder('res_alias', $resource_alias);
        
        // Parent ID
        $parent = $this->modx->resource->getOne('Parent');
        $parent_id = ($parent) ? $parent->get('id') : 0;
        $this->setPlaceholder('p_id', $parent_id);
        
        // Parent Alias
        $parent_alias = ($parent) ? $parent->get('alias') : '';
        $this->setPlaceholder('p_alias', $parent_alias);

        // Longwinded method to get tv_id to work with MIGX
        #$this->setPlaceholder('tv_id',$this->tv->get('id'));
        $rootTv = $this->modx->getObject('modTemplateVar',array(
                'name' => $this->tv->get('name')
            ));
        $this->setPlaceholder('tv_id',$rootTv->get('id'));

        $opts = unserialize($rootTv->input_properties);
        $this->setPlaceholder('showValue', ($opts['showValue']==$this->modx->lexicon('yes') ? 'true' : 'false'));
        $this->setPlaceholder('showPreview', ($opts['showPreview']==$this->modx->lexicon('yes') ? 'true' : 'false'));
        $this->setPlaceholder('prefixFilename', ($opts['prefixFilename']==$this->modx->lexicon('yes') ? 'true' : 'false'));

        $tv = $this->tv;
        
        if(isset($params['MIME'])){
            $MIME = $params['MIME'];
        } else {
            $MIME = '';
        };
        $this->setPlaceholder('MIME_TYPES',json_encode($MIME));
    }
    
    public function getLexiconTopics(){
        return array('fastuploadtv:default');
    }
}
return 'FastUploadTVInputRender';