FastUploadTV = {};

FastUploadTV.Button = function(config) { 
    config = config || {};
    Ext.applyIf(config,{
        cls: 'button',
        fileUpload: true,
        labelAlign: 'above',
        anchors: '98%',
        border: false,
        hideLabels: true,
        baseParams: {
            action: 'browser/file/upload'
        },
        items: [{
            xtype: 'displayfield',
            name: 'filename',
            value: ''
        },{
            xtype: 'fileuploadfield',
            buttonText: 'Select file...',
            buttonOnly: true,
            float: 'left',
            align: 'left'
        },{
            xtype: 'hidden',
            name: 'tv_id',
            value: this.tv_id
        },{
            xtype: 'hidden',
            name: 'res_id',
            value: this.res_id
        }],
        listeners: {
            'afterRender': { fn: function(){
            
                this.tvField = document.getElementById(this.tvFieldId);
            
                // Bind clicks to auto upload file on selection
                this.items.items[1].fileInput.dom.eub = this;
                this.items.items[1].fileInput.dom.addEventListener('change',function(){
                        this.eub.onInputFileChange();
                    });
                    
                // Fix dodgy upload button positioning
                var wrap = Ext.get(this.renderTo).select('div.x-form-element').elements[1];
                    wrap.style.paddingLeft = '10px';
                    
                // Create the preview image img
                this.previewImage = document.createElement('img');
                this.previewImage.width = '200';
                this.previewImage.style.marginTop = '5px';
                // this.previewImage.src = this.tvField.value;
                document.getElementById(this.renderTo+'preview').appendChild(this.previewImage);
                // Hide img if file or not set
                this.updatePreview();
                this.showHidePreview();
                
                // Set the tv_id and res_id fields
                var resid = this.getField('res_id');
                    resid.setValue(this.res_id);
                var tvid = this.getField('tv_id');
                    tvid.setValue(this.tv_id);

                // Make 'reset' button visible
                this.resetter = document.getElementById('modx-tv-reset-'+this.tv_id);
                this.resetter.tveu = this;
                this.resetter.addEventListener('click',function(){
                    this.tveu.resetTV();
                });

                this.showHideResetter();
                    
                // Update the filename (if it exists)
                this.updateFileNameField();
                
                // Set file input MIME types
                this.items.items[1].fileInput.dom.setAttribute('accept',this.acceptedMIMEtypes);
                            
            },scope: this},
            'success': {fn:function(res){
                
                // Generate full image url
                var URL = res.result.message;
                
                // Update TV value field
                this.tvField.value = URL

                // Update the preview image
                this.updatePreview(URL);
                
                // Update the file name field
                this.updateFileNameField();
                
                // Show/Hide preview image based on file type
                this.showHidePreview();

                
                // Mark resource as Dirty
                Ext.getCmp('modx-panel-resource').markDirty();
                
            },scope:this}
        }
    });
    MODx.Panel.superclass.constructor.call(this,config);
    this.config = config;
};
Ext.extend(FastUploadTV.Button,MODx.FormPanel,{

    
onInputFileChange: function(){
        var filename = this.items.items[1].fileInput.dom.value.split('\\').pop();
        this.filename = filename;
        this.submit();
    }//


,updatePreview: function(URL){
        if(URL == null){ URL = this.tvField.value; };
        URL = URL.replace(MODx.config.base_path,'');
        var phpThumbUrl = '../connectors/system/phpthumb.php?h=150&w=150&zc=0&src='+URL+'&wctx=web&source='+this.ms_id
        this.previewImage.src = phpThumbUrl;
        this.showHideResetter();
        // this.getField('filename').setValue('HELLLOOOOO');
    }//

,showHidePreview: function(show){
        if(show == null){
            var src = this.tvField.value;
        } else {
            if(show == false){
                src ='';
            }
        };
        if(src == ''){
            this.previewImage.style.display="none";
        } else {
            // Grab file extension
            var images = Array('png','jpg','gif','jpeg','bmp');
            var ext = src.split('.').pop();
            if( images.indexOf(ext) != -1){
                // Is an image file, show the preview
                this.previewImage.style.display = 'block';
            } else {
                this.previewImage.style.display = 'none';
            };
        };
        this.showHideResetter();
    }//


,updateFileNameField: function( forceValue ){
        var src = this.tvField.value;
        if(forceValue != null){ src = forceValue; };
        var filename = src.split('/').pop();
        this.getField('filename').setValue(filename);
        
        
        // Change 'upload' button text depending on value
        if(src == ''){
            this.items.items[1].button.setText('Upload file...')
            this.showHideResetter(false);
        } else {
            this.items.items[1].button.setText('Replace file...');
            this.showHideResetter(src);
        };
    }//
    
    
,showHideResetter: function(show){
        // Ensure exists
        if(this.resetter == null){
            this.resetter = document.getElementById('modx-tv-reset-'+this.tv_id);
        };

        // Update reset button state
        if(this.tvField.value == '' || show === false){
            this.resetter.style.display = 'none';
        } else {
            this.resetter.style.display = 'auto';
            this.resetter.style.opacity = 1;
        };
    }//
    
,resetTV: function(){
        this.updateFileNameField('');
        this.updatePreview('');
        this.showHidePreview(false);
    }//

});
Ext.reg('fastuploadtv-button',FastUploadTV.Button);