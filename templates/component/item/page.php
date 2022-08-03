<?php

declare (strict_types = 1);

$page = $params['item'];
$route = $params['route'];

$manage = $params['manage'] ?? true; // Public data and Create page can't have settings icon
$create = $params['create'] ?? false; // Show create page item

?>

<div class="item col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
    <div class="name text-center"> <?=$create == true ? "Dodaj stronę" : $page->name;?></div>

    <div class="position-relative">
         <?php if ($create == true): ?>
               <a href="<?=$route->get('page.create') . "&category_id=" . $page->id?>"><img class="image bg-light p-3" src="public/images/Item/plus.png" alt="create-page-image"></img></a>
         <?php else: ?>
               <a href="<?=$page->link?>" target="_blank"><img class="image bg-light" src="<?=$item->image?>" alt="page-image"></img></a>
         <?php endif;?>

        <?php if ($create == false && $manage == true): ?>
            <a href="<?=$route->get('page.edit') . "&id=$page->id"?>"><img class="icon icon-settings" src="public/images/Item/settings.png" alt="setting-icon"></img></a>
        <?php endif;?>
    </div>
</div>