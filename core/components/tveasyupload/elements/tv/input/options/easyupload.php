<?php 
$root = $modx->getOption('core_path').'components/tveasyupload/elements/tv/input/';


// Dirty hack 'cos i cant seem to get the lexicon topic loaded to js
$modx->lexicon->load('tveasyupload:default');
$L = new stdClass;



$mlang = $modx->getOption('cultureKey');
$LL = $modx->lexicon->getFileTopic($mlang,'tveasyupload','default');

$modx->controller->setPlaceholder('tveulex',json_encode($LL));

return $modx->smarty->fetch($root.'tpl/easyupload.options.tpl');