let editor;
let Input;

window.onload = function() {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/c_cpp");
    Input = ace.edit("input");
}

function changeLanguage(){
    let language = $("#languages").val();

    if(language == 'c' || language =='cpp')
        editor.session.setMode("ace/mode/c_cpp");
    else if(language == 'php')
        editor.session.setMode("ace/mode/php");
    else if(language == 'py')
        editor.session.setMode("ace/mode/python");
    else if (language  == 'js')
        editor.session.setMode("ace/mode/javascript");
}

function executeCode(){
    $.ajax({
        
        url: "../app/compiler.php",

        method: "POST",

        data: {
            language: $("#languages").val(),
            code: editor.getSession().getValue(),
            input: Input.getSession().getValue()
        },

        success: function(response){
            document.getElementById("output").innerHTML = response;
        }
    })
}