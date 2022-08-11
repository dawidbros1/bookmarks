<?php

declare (strict_types = 1);

use App\Component\Component;

$category = $params['category'];

?>

<?php Component::render('item.form.open')?>

<div class="text-center">
    <h3 class="text-primary">Edycja kategorii</h3>
</div>

<div class="p-4">
    <form action="<?=$route->get('category.edit')?>" method="post" class = "mb-2">
        <?php Component::render('form.input', ['mt' => "mt-0", 'type' => "text", 'name' => "name", "description" => "Nazwa kategorii", 'value' => $category->name])?>
        <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

        <?php Component::render('form.input', ['mt' => "mt-2", 'type' => "text", 'name' => "image", "description" => "Adres obrazka", 'value' => $category->image])?>
        <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

        <?php Component::render('form.checkbox', ['mt' => "mt-2", 'name' => "private", "label" => "Kategoria prywatna", 'checked' => $category->private, 'id' => "private"])?>

        <input type="hidden" name="id" value="<?=$category->id?>">

        <div class="d-flex">
            <?php Component::render('form.submit', ['class' => "btn-success", 'col' => "col-8", 'text' => "Zapis zmiany"])?>
            <?php Component::render('button.dropdown', ['class' => "offset-1 btn-danger", 'col' => "col-3", 'text' => ["USUŃ", "UKRYJ"], 'target' => "delete"])?>
        </div>
    </form>

    <?php Component::render('item.form.delete', ['action' => $route->get('category.delete'), "id" => $category->id])?>
    <?php Component::render('button.link', ['action' => $route->get('category.list'), 'text' => "Moje kategorie"])?>
</div>

<?php Component::render('item.form.close')?>

<script>
    initDeleteButton();
</script>