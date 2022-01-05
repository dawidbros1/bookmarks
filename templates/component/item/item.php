<?php

declare (strict_types = 1);

$item = $params['item'];
$model = $params['model'];
$route = $params['route'];

$manage = $params['manage'] ?? true; // Public data and Create page can't have settings icon
$create = $params['create'] ?? false; // Show create page item
$index = $params['index'] ?? null; // Category class counter
$url = $params['url'] ?? null; // Copy public lunk to category

?>

<div class = "item col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
    <div class = "name text-center"> <?=$create == true ? "Dodaj stronę" : $item->name;?></div>

    <div class = "position-relative">
        <?php if ($model == "page"): ?>
            <?php if ($create == true): ?>
                    <a href = "<?=$route->get('page.create') . "&category_id=" . $item->id?>"><img class = "image bg-light p-3" src = "public/images/plus.png"></img></a>
                <?php else: ?>
                    <a href = "<?=$item->link?>"><img class = "image bg-light" src = "<?=$item->image?>"></img></a>
            <?php endif;?>
        <?php endif;?>

        <?php if ($create == false && $manage == true): ?>
            <a href = "<?=$route->get($model . '.edit') . "&id=$item->id"?>"><img class = "icon icon-settings" src = "public/images/settings.png"></img></a>
        <?php endif;?>

        <?php if ($model == "category"): ?>
            <a href = "<?=$route->get('category.show') . "&id=" . $item->id?>"><img class = "image" src = "<?=$item->image?>"></img></a>
            <img src="public/images/copy.png" alt="#" class = "icon icon-copy <?=$item->private ? "d-none" : ""?>" title="Skopiuj link do udostępnienia" onclick="copyToClipBoard(<?=$index?>)">
            <input type="hidden" class="copy" value="<?=$url . $route->get('category.public') . "&id=" . $item->id?>">
        <?php endif;?>
    </div>
</div>

