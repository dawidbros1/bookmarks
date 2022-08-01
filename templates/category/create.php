<?php

declare (strict_types = 1);

use App\Component;

?>

<?php Component::render('item.form.open')?>

<div class="text-center">
    <h3 class="text-primary">Dodawanie kategorii</h3>
</div>

<div class="p-4">
    <form action="<?=$route->get('category.create')?>" method="post">
        <?php Component::render('form.input', ['mt' => "mt-0", 'type' => "text", 'name' => "name", "description" => "Nazwa kategorii", 'value' => $params['name'] ?? '', 'prefix' => true])?>
        <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

        <?php Component::render('form.input', ['type' => "text", 'name' => "image", "description" => "Adres obrazka", 'value' => $params['image'] ?? '', 'prefix' => true])?>
        <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

        <?php Component::render('form.checkbox', ['class' => "form-check border-top", 'name' => "private", "checked" => $params['private'] ?? 0, "label" => "Kategoria prywatna"])?>

        <?php Component::render('form.submit', ['text' => "Utwórz kategorie"])?>
    </form>

    <?php Component::render('button.back', ['action' => $route->get('category.list'), 'text' => "Moje kategorie"])?>
</div>

<?php Component::render('item.form.close')?>