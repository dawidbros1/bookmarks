<?php

declare (strict_types = 1);

$categories = $params['categories'];

?>

<div class = "p-3">
    <div class = "row">
        <?php foreach ($categories as $category): ?>
            <div class = "item col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
                <div class = "name text-center"> <?=$category->name?> </div>
                <img class = "image" src = "<?=$category->image?>"></img>
                <img class = "settings" src = "public/images/settings.png"></img>
            </div>
        <?php endforeach;?>
    </div>
</div>