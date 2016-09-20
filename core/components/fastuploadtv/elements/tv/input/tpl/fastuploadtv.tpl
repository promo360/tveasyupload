<div id="fastuploadtv{$tv->id}" style="width:100%"></div>
<script type="text/javascript">
    myTV{$tv->id} = MODx.load{literal}({
    {/literal}
        xtype: 'FastUploadTV',
        renderTo: 'fastuploadtv{$tv->id}',
        url: '{$assets}connector.php',
        name: 'tv{$tv->id}',
        text: '{$lex->upload_file}',
        altText: '{$lex->replace_file}',
        clearText: '{$lex->clear_file}',
        res_id: {$res_id},
        res_alias: '{$res_alias}',
        p_id: {$p_id},
        p_alias: '{$p_alias}',
        tv_id: {$tv_id},
        ms_id: {$ms_id},
        acceptedMIMEtypes: {$MIME_TYPES},
        showValue: {$showValue},
        showPreview: {$showPreview},
        prefixFilename: {$prefixFilename},
        value: '{$tv->value}',
        lex: {$jsonlex}
    {literal}
    });
    {/literal}
</script>