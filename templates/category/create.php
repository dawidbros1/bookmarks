<?php

declare (strict_types = 1);

use App\Component;
use App\Helper\Session;

?>

<div class="mt-sm-5 pt-sm-5">
    <div class="rounded d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 col-12 shadow-lg p-5 bg-light">
            <div class="text-center">
                <h3 class="text-primary">Dodawanie kategorii</h3>
            </div>
            <div class="p-4">
                <form action="<?=$route->get('category.create')?>" method="post">
                    <?php Component::render('form.input', ['mt' => "mt-0", 'type' => "text", 'name' => "name", "description" => "Nazwa kategorii", 'value' => $params['name'] ?? '', 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

                    <?php Component::render('form.input', ['type' => "text", 'name' => "image", "description" => "Adres obrazka", 'value' => $params['image'] ?? '', 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

                    <?php Component::render('form.checkbox', ['class' => "form-check border-top", 'name' => "private", "label" => "Kategoria prywatna"])?>

                    <?php Component::render('form.button', ['text' => "Utwórz kategorie"])?>
                </form>

                <?php Component::render('button.back', ['action' => $route->get('category.list'), 'text' => "Moje kategorie"])?>
            </div>
        </div>
    </div>
</div>