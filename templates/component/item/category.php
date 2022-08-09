<?php

declare (strict_types = 1);

$category = $params['category'];
$route = $params['route'];
$link = $params['location'] . $route->get('category.public'); // link to (category.public) without param id

?>

<div class="item col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
    <div class="name text-center"> <?=$category->name;?></div>

    <div class="position-relative">
         <a href="<?=$route->get('category.edit') . "&id=$category->id"?>"><img class="icon icon-settings" src="public/images/Item/settings.png" alt="setting-icon"></img></a>
         <a href="<?=$route->get('category.show') . "&id=$category->id"?>"><img class="image" src="<?=$category->image?>" alt="category-image"></img></a>

        <?php if ($category->private == 0): ?>
            <img src="public/images/Item/copy.png" alt="copy-image" data-link = "<?=$link . "&id=" . $category->id?>" class="icon icon-copy" title="Skopiuj link do udostępnienia" onclick="copyToClipBoard(this)">
        <?php endif;?>
    </div>
</div>