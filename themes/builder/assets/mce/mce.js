(function() {

    /*
        add this buttons to : functions/builder/settings.php
    */

    tinymce.PluginManager.add('extra', function(ed, url) {

        ed.addButton('customFont', {
            icon: 'false',
            text: '',
            image: url + '/' + 'font.svg',
            onclick: function() {
                ed.windowManager.open({
                    title: 'Custom Font',
                    body: [{
                            type: 'container',
                            html: '<p>Only applies on selected texts.</p>'
                        },
                        {
                            type: 'textbox',
                            name: 'textSize',
                            placeholder: '',
                            label: 'Font Size (px)',
                            value: ''
                        },

                        {
                            type: 'listbox',
                            name: 'listWeight',
                            label: 'Font Weight',
                            values: [{
                                text: 'Default',
                                value: ''
                            }, {
                                text: 'Light',
                                value: '300'
                            }, {
                                text: 'Normal',
                                value: '400'
                            }, {
                                text: 'Bold',
                                value: '500'
                            }, {
                                text: 'Bolder',
                                value: '600'
                            }, {
                                text: 'Extra Bold',
                                value: '800'
                            }]
                        },
                    ],
                    onsubmit: function(e) {
                        var size = '';
                        var t = e.data.textSize;
                        if (t) {
                            t = parseInt(t);
                            var isNumber = Number.isInteger(t);
                            if (isNumber == true) {
                                size = 'font-size:' + t + 'px;';
                            }
                        }

                        var weight = '';
                        var s = e.data.listWeight;
                        if (s) {
                            weight = 'font-weight:' + s + ';';
                        }

                        var dtext = ed.selection.getContent();
                        if (dtext) {
                            var tt = '<span style="' + size + weight + '">' + dtext + '</span>';
                            ed.insertContent(tt);
                        }
                    }
                });
            }
        });

        ed.addButton('four_spaces', {
            title: '4Spaces',
            text: '4S',
            onclick: function() {
                ed.execCommand(
                    "mceInsertContent",
                    false,
                    "&nbsp;&nbsp;&nbsp;&nbsp;"
                );
            }
        });



    });

})();
/*
(function() {
    tinymce.create('tinymce.plugins.extra', {


        init: function(ed, url) {


            ed.addButton('four_spaces', {
                title: '4Spaces',
                text: '4S',
                onclick: function() {
                    var return_this = 'xxx';
                    ed.execCommand("mceInsertContent", false, return_this);
                }
            });

             ed.addButton('four_spaces', {
                 title: '4Spaces',
                 text: '4S',
                 //image: url + '/' + 'meh.svg',
                 onclick: function() {
                     ed.execCommand(
                         "mceInsertContent",
                         false,
                         "&nbsp;&nbsp;&nbsp;&nbsp;"
                     );
                 }
             });


            // Register four_spaces button
            ed.addButton('sample', {
                title: 'sample',
                text: 'Green',
                //image: url + '/' + 'meh.svg',
                onclick: function() {
                    var selected_text = ed.selection.getContent();
                    var return_text = "<span style='color: green'>" + selected_text + "</span>";
                    ed.execCommand("mceInsertContent", 0, return_text);
                }
            });

            ed.addButton('xprompt', {
                title: 'xprompt',
                image: url + '/' + 'meh.svg',
                onclick: function() {
                    var xname = get_user_name($);
                    ed.execCommand(
                        'mceInsertContent',
                        false,
                        xname
                    );
                }
            });

            ed.addButton('epilink', {
                title: 'epilink',
                image: url + '/' + 'meh.svg',
                onclick: function() {

                    var return_this = 'xxx';

                    ed.execCommand('mceInsertContent', 0, return_this);
                }
            });

        }
    });

    // Register plugin
    tinymce.PluginManager.add('extra', tinymce.plugins.extra);


    function get_user_name() {
        return prompt("What is your first name?");
    }

    function get_user_name($) {

        var name;

        // Grab the input from the user
        name = prompt("What is your first name?");

        // If the user didn't enter any information, then provide a default value
        if (null === $.trim(name) || 0 === name.length) {
            name = '[User provided no input.]';
        }

        return name;

    }

})();

https://www.gavick.com/blog/wordpress-tinymce-custom-buttons

(function() {
    tinymce.PluginManager.add('gavickpro_tc_button', function( editor, url ) {
        editor.addButton( 'gavickpro_tc_button', {
            title: 'My test button',
            type: 'menubutton',
            icon: 'icon gavickpro-own-icon',
            menu: [
                {
                    text: 'Menu item I',
                    value: 'Text from menu item I',
                    onclick: function() {
                        editor.insertContent(this.value());
                    }
                },
                {
                    text: 'Menu item II',
                    value: 'Text from menu item II',
                    onclick: function() {
                        editor.insertContent(this.value());
                    },
                    menu: [
                        {
                            text: 'First submenu item',
                            value: 'Text from sub sub menu',
                            onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent(this.value());
                            }       
                        },
                        {
                            text: 'Second submenu item',
                            value: 'Text from sub sub menu',
                            onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent(this.value());
                            }       
                        }
                    ]
                },
                {
                    text: 'Menu item III',
                    value: 'Text from menu item III',
                    onclick: function() {
                        editor.insertContent(this.value());
                    }
                }
           ]
        });
    });
})();

*/