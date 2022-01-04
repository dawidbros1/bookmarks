<?php

declare (strict_types = 1);

use App\Component;
use App\Helper\Session;

?>

<div class="mt-sm-5 pt-sm-5">
    <div class="rounded d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 col-12 shadow-lg p-5 bg-light">
            <div class="text-center">
                <h3 class="text-primary">Dodawanie strony</h3>
            </div>
            <div class="p-4">
                <form action="<?=$route->get('page.create') . "&category_id=" . $params['category_id']?>" method="post">
                    <?php Component::render('form.input', ['class' => "", 'type' => "text", 'name' => "name", "placeholder" => "Nazwa strony", 'value' => $params['name'] ?? '', 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

                    <?php Component::render('form.input', ['class' => "mt-3", 'type' => "text", 'name' => "image", "placeholder" => "Adres obrazka", 'value' => $params['image'] ?? '', 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

                    <?php Component::render('form.input', ['class' => "mt-3", 'type' => "text", 'name' => "link", "placeholder" => "Link do strony", 'value' => $params['link'] ?? '', 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "link", 'names' => ['max', 'require']])?>

                    <?php Component::render('form.button', ['text' => "Utwórz stronę"])?>
                </form>

                <?php Component::render('button.back', ['action' => $route->get('category.show') . "&id=" . $params['category_id']])?>
            </div>
        </div>
    </div>
</div>