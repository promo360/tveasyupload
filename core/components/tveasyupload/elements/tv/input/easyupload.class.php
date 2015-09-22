<?php
class EasyUploadInputRender extends modTemplateVarInputRender {

    public function getTemplate() {
        return $this->modx->getOption('core_path').'components/tveasyupload/elements/tv/input/tpl/easyupload.tpl';
    }
    
public function process($value,array $params = array()) {
    	$js  = $this->modx->getOption('assets_url').'components/tveasyupload/mgr/js/';


        $this->modx->regClientStartupScript($js.'widgets/modx.form.filefield.js');
        $this->modx->regClientStartupScript($js.'EasyUpload.js');
 		$this->modx->regClientStartupScript($js.'EasyUpload.form.EasyUploadField.js');


 		// Set assets path
 		$this->setPlaceholder('assets',$this->modx->getOption('assets_url').'components/tveasyupload/');
 		
 		$this->modx->lexicon->load('tveasyupload');
 		
 		$this->setPlaceholder('res_id',$this->modx->resource->get('id'));
		$this->setPlaceholder('ms_id',$this->tv->source);
        $this->setPlaceholder('jsonlex',json_encode($this->modx->lexicon->fetch('tveasyupload.',true)));
        $this->setPlaceholder('lex',(object)$this->modx->lexicon->fetch('tveasyupload.',true));
        
        // Parent ID
        $parent = $this->modx->resource->getOne('Parent');
        $parent_id = ($parent) ? $parent->get('id') : 0;
 		$this->setPlaceholder('p_id', $parent_id);

        // Longwinded method to get tv_id to work with MIGX
        #$this->setPlaceholder('tv_id',$this->tv->get('id'));
        $rootTv = $this->modx->getObject('modTemplateVar',array(
                'name' => $this->tv->get('name')
            ));
        $this->setPlaceholder('tv_id',$rootTv->get('id'));

        $opts = unserialize($rootTv->input_properties);
        $this->setPlaceholder('showValue', ($opts['showValue']==$this->modx->lexicon('yes') ? 'true' : 'false'));
        $this->setPlaceholder('showPreview', ($opts['showPreview']==$this->modx->lexicon('yes') ? 'true' : 'false'));

        $tv = $this->tv;



		if(isset($params['MIME'])){
			$MIME = $params['MIME'];
		} else {
			$MIME = '';
		};
 		$this->setPlaceholder('MIME_TYPES',json_encode($MIME));
    }//
    
    
    public function getLexiconTopics(){
    	return array('tveasyupload:default');
    }
}
return 'EasyUploadInputRender';
