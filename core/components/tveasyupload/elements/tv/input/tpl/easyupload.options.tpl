<div id="tv-input-properties-form{$tv}"></div>
{literal}
<style>
    .tveasyuploadInfo {
        margin-top: 20px;
    }
    .tveasyuploadInfo h4 {
        margin-top: 10px;
    }
    .tveasyuploadInfo ul {
        margin-left:20px;
        font-size:12px;
        margin-top:5px;
        color: #666;
    }
    .tveasyuploadInfo ul li span {
        font-family:mono;
        font-weight:bold;
    }
</style>
<div class="tveasyuploadInfo">
    {/literal}{include file="$options_desc_tpl"}{literal}
</div>

<script type="text/javascript">
// <![CDATA[
var params = {
{/literal}{foreach from=$params key=k item=v name='p'}
 '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last},{/if}
{/foreach}{literal}
};
var oc = {'change':{fn:function(){Ext.getCmp('modx-panel-tv').markDirty();},scope:this}};

{/literal}
EasyUploadLex = {$tveulex};
function __(key){
    return EasyUploadLex[key];
};
{literal}

MODx.load({
    xtype: 'panel'
    ,layout: 'form'
    ,autoHeight: true
    ,cls: 'form-with-labels'
    ,border: false
    ,labelAlign: 'top'
    ,items: [{
        xtype: 'textfield',
        fieldLabel: __('tveasyupload.save_path'),
        name: 'inopt_path',
        id: 'inopt_path{/literal}{$tv}{literal}',
        value: params['path'] || '',
        anchors: '98%',
        listeners: oc
    },{
        xtype: MODx.expandHelp ? 'label' : 'hidden'
        ,forId: 'inopt_path{/literal}{$tv}{literal}'
        ,html: __('tveasyupload.save_path_desc')
        ,cls: 'desc-under'
    },{
        xtype: 'textfield',
        fieldLabel: __('tveasyupload.file_prefix'),
        name: 'inopt_prefix',
        id: 'inopt_prefix{/literal}{$tv}{literal}',
        value: params['prefix'] || '',
        anchors: '98%',
        listeners: oc
    },{
        xtype: MODx.expandHelp ? 'label' : 'hidden'
        ,forId: 'inopt_prefix{/literal}{$tv}{literal}'
        ,html: __('tveasyupload.file_prefix_desc')
        ,cls: 'desc-under'
    },{
        xtype: 'textfield',
        fieldLabel: __('tveasyupload.mime_types'),
        name: 'inopt_MIME',
        id: 'inopt_MIME{/literal}{$tv}{literal}',
        value: params['MIME'] || '',
        anchors: '98%',
        listeners: oc
    },{
        xtype: MODx.expandHelp ? 'label' : 'hidden'
        ,forId: 'inopt_MIME{/literal}{$tv}{literal}'
        ,html: __('tveasyupload.mime_types_desc')
        ,cls: 'desc-under'
    },{
        xtype: 'modx-combo-boolean',
        fieldLabel: __('tveasyupload.show_value'),
        name: 'inopt_showValue',
        id: 'inopt_showValue{/literal}{$tv}{literal}',
        value: params['showValue'] || 0,
        anchors: '98%',
        listeners: oc
    },{
        xtype: MODx.expandHelp ? 'label' : 'hidden'
        ,forId: 'inopt_MIME{/literal}{$tv}{literal}'
        ,html: __('tveasyupload.show_value_desc')
        ,cls: 'desc-under'
    },{
        xtype: 'modx-combo-boolean',
        fieldLabel: __('tveasyupload.show_preview'),
        name: 'inopt_showPreview',
        id: 'inopt_showPreview{/literal}{$tv}{literal}',
        value: params['showPreview'] || 0,
        anchors: '98%',
        listeners: oc
    },{
        xtype: MODx.expandHelp ? 'label' : 'hidden'
        ,forId: 'inopt_MIME{/literal}{$tv}{literal}'
        ,html: __('tveasyupload.show_preview_desc')
        ,cls: 'desc-under'
    }]
    ,renderTo: 'tv-input-properties-form{/literal}{$tv}{literal}'
});
// ]]>
</script>
{/literal}
