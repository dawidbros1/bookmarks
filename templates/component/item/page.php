<?php

declare (strict_types = 1);

$page = $params['page'];

?>

<div class="item col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
    <div class="name text-center"> <?=$page->name?></div>

    <div class="position-relative">
        <a href="<?=$page->link?>" target="<?=$params['_blank'] ?? "_blank"?>"><img class="image bg-light <?=$params['class'] ?? ""?>" src="<?=$page->image?>" alt="page-image"></img></a>

        <?php if ($params['manage'] == true): ?>
            <a href="<?=$params["route"]->get('page.edit') . "&id=$page->id"?>"><img class="icon icon-settings" src="public/images/Item/settings.png" alt="setting-icon"></img></a>
        <?php endif;?>
    </div>
</div>