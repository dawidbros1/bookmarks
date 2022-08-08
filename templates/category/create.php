<?php

declare (strict_types = 1);

use App\Component\Component;

?>

<?php Component::render('item.form.open')?>

<div class="text-center">
    <h3 class="text-primary">Dodawanie kategorii</h3>
</div>

<div class="p-4">
    <form action="<?=$route->get('category.create')?>" method="post" class="mb-2">
        <?php Component::render('form.input', ['mt' => "mt-0", 'type' => "text", 'name' => "name", "description" => "Nazwa kategorii", 'value' => $params['name'] ?? '', 'prefix' => true])?>
        <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

        <?php Component::render('form.input', ['mt' => "mt-2", 'type' => "text", 'name' => "image", "description" => "Adres obrazka", 'value' => $params['image'] ?? '', 'prefix' => true])?>
        <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

        <?php Component::render('form.checkbox', ['mt' => "mt-2", 'class' => "form-check", 'name' => "private", "checked" => $params['private'] ?? 0, "label" => "Kategoria prywatna"])?>

        <?php Component::render('form.submit', ['class' => "btn-success", 'text' => "Utwórz kategorie"])?>
    </form>

    <?php Component::render('button.link', ['action' => $route->get('category.list'), 'text' => "Moje kategorie"])?>
</div>

<?php Component::render('item.form.close')?>