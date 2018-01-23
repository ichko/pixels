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
<input type="hidden" id="snippet-id" value="<?=$model['id']?>">
<div id="preview">
    <canvas id="canvas"></canvas>
</div>

<div id="editor-container">
    <div id="editor"><?=$model['code']?></div>
</div>

<script>
    function initUserCode() {
        <?=$model['code']?>
    }

    window.onload = () => {
        bootstrapEditor();
        initUserCode();
    };
</script>
