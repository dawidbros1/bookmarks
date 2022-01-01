<?php

declare (strict_types = 1);

$category = $params['category'];

?>

<div class = "p-3">
    <div class = "row">

        <div class = "col-12 text-center p-1 bg-light"><?=$category->name?></div>

        <div class = "item col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
            <div class = "name text-center"> Dodaj stronę </div>
            <a href = "<?=$route->get('page.create') . "&category_id=" . $category->id?>"><img class = "image p-3 bg-light" src = "public/images/plus.png"></img></a>
        </div>

        <?php foreach ($category->pages as $page): ?>
            <div class = "item col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
                    <div class = "name text-center"> <?=$page->name?> </div>
                    <a href = "<?=$page->link?>" target = "_blank"><img class = "image" src = "<?=$page->image?>"></img></a>
                    <a href = "<?=$route->get('page.edit') . "&id=$page->id"?>"><img class = "settings" src = "public/images/settings.png"></img></a>
            </div>
        <?php endforeach;?>
    </div>
</div>