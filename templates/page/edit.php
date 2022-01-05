<?php

declare (strict_types = 1);

use App\Component;
use App\Helper\Session;

$page = $params['page'];
$categories = $params['categories'];

?>

<div class="mt-sm-5 pt-sm-5">
    <div class="rounded d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 col-12 shadow-lg p-5 bg-light">
            <div class="text-center">
                <h3 class="text-primary">Edycja strony</h3>
            </div>
            <div class="p-4">
                <form action="<?=$route->get('page.edit')?>" method="post">
                    <?php Component::render('form.input', ['mt' => 'mt-0', 'type' => "text", 'name' => "name", "description" => "Nazwa strony", 'value' => $page->name, 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

                    <?php Component::render('form.input', ['type' => "text", 'name' => "image", "description" => "Adres obrazka", 'value' => $page->image, 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

                    <?php Component::render('form.input', ['type' => "text", 'name' => "link", "description" => "Link do strony", 'value' => $page->link, 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "link", 'names' => ['max', 'require']])?>

                    <?php Component::render('form.select', ['name' => "category_id", "label" => "Wybierz kategorię", 'search' => $page->category_id, 'options' => $categories, 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "category_id", 'names' => ['author']])?>

                    <input type = "hidden" name = "id" value = "<?=$page->id?>">

                    <div class="d-flex">
                        <?php Component::render('form.button', ['div' => "col-9", 'text' => "Edytuj stronę"])?>
                        <?php Component::render('button.delete')?>
                    </div>
                </form>

                <?php Component::render('form.delete', ['action' => $route->get('page.delete'), "id" => $page->id])?>
                <?php Component::render('button.back', ['action' => $route->get('category.show') . "&id=" . $page->category_id])?>
            </div>
        </div>
    </div>
</div>

<script> initDeleteButton(); </script>