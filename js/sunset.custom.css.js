jQuery(document).ready(function($) {
    var updateCSS = function() {
        $('#sunset_css').val(editor.getSession().getValue());
    }

    $('#save-custom-css-form').submit(updateCSS);
});

var editor = ace.edit('customCss'); // with unique name of the editor to call it in tag id that will display
//  it's need to be cutomiz by css in order to diplay in right way
editor.setTheme("ace/theme/monokai"); // setting theme of the editor to be dark
editor.getSession().setMode("ace/mode/css"); // get the editor to css style


