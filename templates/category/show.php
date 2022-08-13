<?php

declare (strict_types = 1);

use App\Component\Component;
use App\Model\Page;

$category = $params['category'];
$manage = $params['manage'];

?>

<div class="p-3 pt-2">
    <div class="row">
        <div class="col-12 text-center p-1 bg-light"><?=$category->name?></div>

        <!-- ITEM => Create Page -->
        <?php if ($manage == true): ?>
            <?php Component::render('item.page', ['class' => "p-3", 'page' => $category->pages[0], 'route' => $route, 'manage' => false, "_blank" => ""])?>
            <?php array_shift($category->pages)?>
        <?php endif;?>

        <?php foreach ($category->pages as $page): ?>
            <?php Component::render('item.page', ['page' => $page, 'route' => $route, 'manage' => $manage])?>
        <?php endforeach;?>
    </div>
</div>