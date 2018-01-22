<?php

$count = 0;
foreach ($model['snippets'] as $snippet) {?>
<ul class="snippet">
    <span class="number"><?=$count++?></span>
    <span class="right info"><?=$snippet['date_created']?></span>
    <li><a href="snippet/edit/<?=$snippet['id']?>">
        <?=$snippet['name']?>
    </a></li>
    <li>Author: <?=$snippet['username']?></li>
</ul>
<?php }
