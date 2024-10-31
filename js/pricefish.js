(function() {
   tinymce.create('tinymce.plugins.pricefish', {
      init : function(ed, url) {
         ed.addButton('pricefish', {
            title : 'Pricing Table',
            image : url + '/pricefish.png',
            onclick : function() {
				var project_id = prompt("Project ID (from http://www.pricefish.com)", "");
				if (project_id != null && project_id != '') {
					ed.execCommand('mceInsertContent', false, '[pricefish projectid="' + project_id + '"]');
					
				}
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Pricing Tables",
            author : 'PriceFish',
            authorurl : 'http://www.pricefish.com',
            infourl : 'http://www.pricefish.com.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('pricefish', tinymce.plugins.pricefish);
})();