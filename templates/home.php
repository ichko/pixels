<?php

$count = 0;
foreach ($model['snippets'] as $snippet) {?>
<div class="snippet-container">
<div class="snippet">
    <span class="number">#<?=$count++?></span>
    <a href="snippet/edit/<?=$snippet['id']?>">
        <?=$snippet['name']?>
    </a>
    <ul class="info">
        <li>Date <b><?=$snippet['date_created']?></b></li>
        <li>Author <b><?=$snippet['username']?></b></li>
    </ul>
</div>
</div>
<?php }
