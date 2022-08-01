<?php

declare (strict_types = 1);

use App\Component;

$category = $params['category'];

?>

<?php Component::render('item.form.open')?>

<div class="text-center">
    <h3 class="text-primary">Edycja kategorii</h3>
</div>

<div class="p-4">
    <form action="<?=$route->get('category.edit')?>" method="post">
        <?php Component::render('form.input', ['mt' => "mt-0", 'type' => "text", 'name' => "name", "description" => "Nazwa kategorii", 'value' => $category->name, 'prefix' => true])?>
        <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

        <?php Component::render('form.input', ['type' => "text", 'name' => "image", "description" => "Adres obrazka", 'value' => $category->image, 'prefix' => true])?>
        <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

        <?php Component::render('form.checkbox', ['class' => "form-check border-top", 'name' => "private", "label" => "Kategoria prywatna", 'checked' => $category->private])?>

        <input type="hidden" name="id" value="<?=$category->id?>">

        <div class="d-flex">
            <?php Component::render('form.submit', ['col' => "col-8"])?>
            <?php Component::render('button.dropdown', ['text' => "USUŃ", 'target' => ".delete"])?>
        </div>
    </form>

    <?php Component::render('form.delete', ['action' => $route->get('category.delete'), "id" => $category->id, 'target' => ".delete", 'class' => "delete"])?>
    <?php Component::render('button.back', ['action' => $route->get('category.list'), 'text' => "Moje kategorie"])?>
</div>

<?php Component::render('item.form.close')?>

<script>
    initDeleteButton();
</script>