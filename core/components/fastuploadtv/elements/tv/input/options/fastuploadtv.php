<?php 
$root = $modx->getOption('core_path').'components/FastUploadTV/elements/tv/input/';


// Dirty hack 'cos i cant seem to get the lexicon topic loaded to js
$modx->lexicon->load('FastUploadTV:default');
$L = new stdClass;


$mlang = $modx->getOption('cultureKey');
$LL = $modx->lexicon->getFileTopic($mlang,'FastUploadTV','default');

$modx->controller->setPlaceholder('tveulex',json_encode($LL));


// Options Description
$options_desc_tpl = $modx->getOption('core_path').'components/FastUploadTV/lexicon/'.$mlang.'/options.desc.tpl';
if (!file_exists($options_desc_tpl)) {
    $options_desc_tpl = $modx->getOption('core_path').'components/FastUploadTV/lexicon/en/options.desc.tpl';
}
$modx->smarty->assign("options_desc_tpl", $options_desc_tpl);


return $modx->smarty->fetch($root.'tpl/FastUploadTV.options.tpl');