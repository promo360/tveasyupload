var EasyUpload = function(config) {
    config = config || {};
    EasyUpload.superclass.constructor.call(this,config);
};
Ext.extend(EasyUpload,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},form:{}
});
Ext.reg('EasyUpload',EasyUpload);
EasyUpload = new EasyUpload();