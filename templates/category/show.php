<?php

declare (strict_types = 1);

use App\Component\Component;

$category = $params['category'];
$manage = $params['manage'] ?? false;

?>

<div class="p-3 pt-2">
    <div class="row">
        <div class="col-12 text-center p-1 bg-light"><?=$category->name?></div>

        <?php if ($manage == true): ?>
            <?php Component::render('item.page', ['item' => $category, 'route' => $route, 'create' => true])?>
        <?php endif;?>

        <?php foreach ($category->pages as $page): ?>
            <?php Component::render('item.page', ['item' => $page, 'route' => $route, 'manage' => $manage])?>
        <?php endforeach;?>
    </div>
</div>