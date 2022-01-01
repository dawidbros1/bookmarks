<?php

declare (strict_types = 1);

$categories = $params['categories'];

?>

<div class = "p-3">
    <div class = "row">
        <?php foreach ($categories as $category): ?>
            <div class = "item col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
                    <div class = "name text-center"> <?=$category->name?> </div>
                    <a href = "<?=$route->get('category.show') . "&id=" . $category->id?>"><img class = "image" src = "<?=$category->image?>"></img></a>
                    <a href = "<?=$route->get('category.edit') . "&id=$category->id"?>"><img class = "settings" src = "public/images/settings.png"></img></a>
            </div>
        <?php endforeach;?>
    </div>
</div>