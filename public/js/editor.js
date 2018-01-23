const bootstrapEditor = () => {
    const requester = new Requester();
    const editor = ace.edit("editor");
    // editor.setOptions({
    //     maxLines: Infinity
    // });

    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/javascript");
    editor.commands.addCommand({
        name: 'saveFile',
        bindKey: {
            win: 'Ctrl-S',
            mac: 'Command-S',
            sender: 'editor|cli'
        },
        exec: function (env, args, request) {
            save();
        }
    });

    document.getElementById('save-and-run').onclick = save;

    function save() {
        const id = document.getElementById('snippet-id').value;
        const name = document.getElementById('snippet-name').value;
        const iframe = document.getElementById('iframe-preview');
        const code = editor.getValue();
        const loader = new Loader().start();
        const notifier = new Notifier();

        requester.post(`snippet/save/${id}`, {
            name,
            code
        }).then(json => {
            if (json.success) {
                notifier.success('Changes saved');
                iframe.contentWindow.location.reload(true);
            } else {
                notifier.error(json.reason);
            }
            loader.stop();
        }).catch(error => {
            console.log(error);
            loader.stop();
        });
    }
}
