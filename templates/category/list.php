<?php

declare (strict_types = 1);

use App\Component;

$categories = $params['categories'];

?>

<div class = "p-3">
    <div class = "row">
        <?php foreach ($categories as $index => $category): ?>
            <?php Component::render('item.item', ['item' => $category, 'model' => "category", 'route' => $route, 'url' => $params['url'], 'index' => $index])?>
        <?php endforeach;?>
    </div>
</div>


