<?php

declare (strict_types = 1);

use App\Component\Component;

$categories = $params['categories'];

?>

<div class="p-3 pt-2">
    <div class="row">
        <?php foreach ($categories as $index => $category): ?>
            <?php Component::render('item.category', ['item' => $category, 'route' => $route, 'url' => $params['url'], 'index' => $index])?>
        <?php endforeach;?>

        <?php if (empty($categories)): ?>
        <div>
            <h2 class = "text-center">Tu jeszcze nic nie ma.</h2>
            <h2 class = "text-center">Dodaj swoją pierwszą <a class="text-decoration-none" href = "<?=$route->get('category.create')?>">kategorię</a></h2>
        </div>
        <?php endif?>
    </div>
</div>