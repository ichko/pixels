<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/mode-javascript.js"></script>
<script src="https://ace.c9.io/build/src/ace.js"></script>
<script src="/public/js/editor.js"></script>

<style>
#editor {
    position: absolute;
    width: 500px;
    height: 400px;
}
</style>

<div class="top">
    <h4><?=$model['name']?></h4>
    <ul class="info">
        <li><input type="text" value="<?=$model['name']?>"></li>
        <li>Author: <b><?=$model['username']?></b></li>
    </ul>
    <ul class="right info">
        <li id="run" class="btn">Run</li>
        <li id="save" class="btn">Save</li>
    </ul>
</div>
<div id="preview">
    <canvas id="canvas"></canvas>
<div>
<div id="editor"><?=$model['code']?></div>
<script>
    window.addEventListener('load', () => {
        <?=$model['code']?>
    });
</script>
