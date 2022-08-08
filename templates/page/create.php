<?php

declare (strict_types = 1);

use App\Component\Component;
use App\Helper\Session;

?>

<?php Component::render('item.form.open')?>
<div class="text-center">
    <h3 class="text-primary">Dodawanie strony</h3>
</div>
<div class="p-4">
    <form action="<?=$route->get('page.create')?>" method="post" class= "mb-2">
        <?php Component::render('form.input', ['mt' => "mt-0", 'type' => "text", 'name' => "name", "description" => "Nazwa strony", 'value' => $params['name'] ?? ''])?>
        <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

        <?php Component::render('form.input', ['mt' => "mt-2", 'type' => "text", 'name' => "image", "description" => "Adres obrazka", 'value' => $params['image'] ?? ''])?>
        <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

        <?php Component::render('form.input', ['mt' => "mt-2", 'type' => "text", 'name' => "link", "description" => "Link do strony", 'value' => $params['link'] ?? ''])?>
        <?php Component::render('error', ['type' => "link", 'names' => ['max', 'require']])?>

        <input type="hidden" name="category_id" value="<?=$params['category_id']?>">

        <?php Component::render('form.submit', ['class' => "btn-success", 'text' => "Utwórz stronę"])?>
    </form>

    <?php Component::render('button.link', ['action' => $route->get('category.show') . "&id=" . $params['category_id'], 'text' => "Powrót"])?>
</div>
<?php Component::render('item.form.close')?>