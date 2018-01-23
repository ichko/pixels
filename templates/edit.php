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

<div id="editor-container">
    <div id="editor"><?=$model['code']?></div>
</div>
<iframe class="iframe-preview" src="/snippet/view/<?=$model['id']?>"></iframe>

<script>
    window.onload = bootstrapEditor;
</script>
