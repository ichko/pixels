<style>
    body {
        overflow: hidden!important;
    }
</style>

<div class="settings clear">
    <span class="show-settings">Show settings</span>
    <div class="right controls">
        <button id="save-and-run" class="button">Save and run</button>
    </div>
    <ul class="info">
        <li><input id="snippet-name" type="text" value="<?=$model['name']?>"></li>
        <li class="meta">Author <b><?=$model['username']?></b></li>
        <li class="meta">Date created <b><?=$model['date_created']?></b></li>
    </ul>
</div>
<input type="hidden" id="snippet-id" value="<?=$model['id']?>">

<div id="editor-container">
    <div id="editor"><?=$model['code']?></div>
</div>
<iframe id="iframe-preview" src="/snippet/view/<?=$model['id']?>"></iframe>

<script>
    window.onload = bootstrapEditor;
</script>
