<?php

declare (strict_types = 1);

$category = $params['item'];
$route = $params['route'];

$manage = $params['manage'] ?? true; // Public data and Create page can't have settings icon
$index = $params['index'] ?? null; // Category class [ copy ] counter
$url = $params['url'] ?? null; // Copy public link to category

?>

<div class="item col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
    <div class="name text-center"> <?=$category->name;?></div>

    <div class="position-relative">
         <?php if ($manage == true): ?>
               <a href="<?=$route->get('category.edit') . "&id=$category->id"?>"><img class="icon icon-settings" src="public/images/Item/settings.png" alt="setting-icon"></img></a>
         <?php endif;?>

         <a href="<?=$route->get('category.show') . "&id=" . $category->id?>"><img class="image" src="<?=$category->image?>" alt="category-image"></img></a>
         <img src="public/images/Item/copy.png" alt="copy-image" class="icon icon-copy <?=$category->private ? "d-none" : ""?>" title="Skopiuj link do udostępnienia" onclick="copyToClipBoard(<?=$index?>)">
         <input type="hidden" class="copy" value="<?=$url . $route->get('category.public') . "&id=" . $category->id?>">
    </div>
</div>