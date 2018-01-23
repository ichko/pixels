<script src="https://rawgit.com/ajaxorg/ace-builds/master/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/public/js/editor.js"></script>

<div class="top clear">
    <div class="right controls">
        <button id="run" class="button">Run</button>
        <button id="save" class="button">Save</button>
    </div>
    <ul class="info">
        <li><input id="snippet-name" type="text" value="<?=$model['name']?>"></li>
        <li>Author: <b><?=$model['username']?></b></li>
    </ul>
</div>

<div id="preview">
    <canvas id="canvas"></canvas>
</div>

<div id="editor-container">
    <div id="editor"><?=$model['code']?></div>
</div>

<script>
    window.addEventListener('load', () => {
        // <-?=$model['code']?>
    });
</script>
