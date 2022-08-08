<?php

declare (strict_types = 1);

use App\Component\Component;
use App\Helper\Session;

$page = $params['page'];
$categories = $params['categories'];

?>

<?php Component::render('item.form.open')?>
<div class="text-center">
    <h3 class="text-primary">Edycja strony</h3>
</div>
<div class="p-4">
    <form action="<?=$route->get('page.edit')?>" method="post" class="mb-2">
        <?php Component::render('form.input', ['mt' => 'mt-0', 'type' => "text", 'name' => "name", "description" => "Nazwa strony", 'value' => $page->name])?>
        <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

        <?php Component::render('form.input', ['mt' => "mt-2", 'type' => "text", 'name' => "image", "description" => "Adres obrazka", 'value' => $page->image])?>
        <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

        <?php Component::render('form.input', ['mt' => "mt-2", 'type' => "text", 'name' => "link", "description" => "Link do strony", 'value' => $page->link])?>
        <?php Component::render('error', ['type' => "link", 'names' => ['max', 'require']])?>

        <?php Component::render('form.select', ['name' => "category_id", "label" => "Wybierz kategorię", 'selected' => ['id' => $page->category_id], 'options' => $categories, 'show' => "name"])?>
        <?php Component::render('error', ['type' => "category_id", 'names' => ['author']])?>

        <input type="hidden" name="id" value="<?=$page->id?>">

        <div class="d-flex">
            <?php Component::render('form.submit', ['class' => "btn-success", 'col' => "col-8", 'text' => "Zapisz zmiany"])?>
            <?php Component::render('button.dropdown', ['class' => "offset-1 btn-danger", 'col' => "col-3", 'text' => ["USUŃ", "UKRYJ"], 'target' => "delete"])?>
        </div>
    </form>

    <?php Component::render('item.form.delete', ['action' => $route->get('page.delete'), "id" => $page->id])?>
    <?php Component::render('button.link', ['action' => $route->get('category.show') . "&id=" . $page->category_id, 'text' => "Powrót"])?>
</div>

<?php Component::render('item.form.close')?>

<script>
    initDeleteButton();
</script>