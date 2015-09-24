var FastUploadTV = function(config) {
    config = config || {};
    FastUploadTV.superclass.constructor.call(this,config);
};
Ext.extend(FastUploadTV,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},form:{}
});
Ext.reg('FastUploadTV',FastUploadTV);
FastUploadTV = new FastUploadTV();