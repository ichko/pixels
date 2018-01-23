window.onload = () => {
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/javascript");


    document.getElementById('save').onclick = event => {
        let name = document.getElementById('snippet-name').value;
        let code = editor.getValue();

    };
};
