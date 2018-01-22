window.onload = () => {
    var editor = ace.edit("editor");
    // editor.session.setMode(new JavaScriptMode());

    document.getElementById('save').onclick = event => {
        $name = document.getElementById('snippet-name').value;
        $code = document.getElementById('editor').value;

    };
};
