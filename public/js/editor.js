const bootstrapEditor = () => {
    const requester = new Requester();
    const editor = ace.edit("editor");

    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/javascript");

    document.getElementById('save').onclick = event => {
        const id = document.getElementById('snippet-id').value;
        const name = document.getElementById('snippet-name').value;
        const code = editor.getValue();
        const loader = new Loader().start();
        const notifier = new Notifier();

        requester.post(`snippet/save/${id}`, {
            name,
            code
        }).then(json => {
            if (json.success) {
                notifier.success('Changes saved');
            } else {
                notifier.error(json.reason);
            }
            loader.stop();
        }).catch(error => {
            console.log(error);
            loader.stop();
        });
    };

    document.getElementById('run').onclick = event => {
        const code = editor.getValue();
        eval(code);
    };
}
