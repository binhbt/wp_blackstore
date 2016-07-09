// Add Button Hộp thông báo
(function() {  
    tinymce.create('tinymce.plugins.download', {  
        init : function(ed, url) {  
            ed.addButton('download', {  
                title : 'Download',				
                image : url+'/button-download.png',  
                onclick : function() {  
                     ed.selection.setContent('[download title="Download" link="Link in here"][/download]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('download', tinymce.plugins.download);  
})();
// Add Tabs button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.tabs', {  
        init : function(ed, url) {  
            ed.addButton('tabs', {  
                title : 'Download tabs',  
                image : url+'/button-tabs.png',  
                onclick : function() {  
                     ed.selection.setContent('[tabs tab1=\"Tab 1\" tab2=\"Tab 2\" tab3=\"Tab 3\"]<br /><br />[tab id=1]Tab content 1[/tab]<br />[tab id=2]Tab content 2[/tab]<br />[tab id=3]Tab content 3[/tab]<br /><br />[/tabs]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);  
})();
// Add Youtube button
(function() {  
    tinymce.create('tinymce.plugins.youtube', {  
        init : function(ed, url) {  
            ed.addButton('youtube', {  
                title : 'Thêm một video youtube',  
                image : url+'/button-youtube.png',  
                onclick : function() {  
                     ed.selection.setContent('[youtube id="Điều ID video (ví dụ Wq4Y7ztznKc)"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('youtube', tinymce.plugins.youtube);  
})();

// Add Vimeo button
(function() {  
    tinymce.create('tinymce.plugins.vimeo', {  
        init : function(ed, url) {  
            ed.addButton('vimeo', {  
                title : 'Thêm một Vimeo video',  
                image : url+'/button-vimeo.png',  
                onclick : function() {  
                     ed.selection.setContent('[vimeo id="Điền video ID (vd: 10145153)"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('vimeo', tinymce.plugins.vimeo);  
})();
// Add Page navi
(function() {  
    tinymce.create('tinymce.plugins.pnv', {  
        init : function(ed, url) {  
            ed.addButton('pnv', {  
                title : 'Chia nhỏ bài viết',  
                image : url+'/phan-trang.png',  
                onclick : function() {  
                     ed.selection.setContent('<!--nextpage-->');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('pnv', tinymce.plugins.pnv);  
})();