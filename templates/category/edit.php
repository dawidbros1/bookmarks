<?php

declare (strict_types = 1);

use App\Component;
use App\Helper\Session;

$category = $params['category'];

?>

<div class="mt-sm-5 pt-sm-5">
    <div class="rounded d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 col-12 shadow-lg p-5 bg-light">
            <div class="text-center">
                <h3 class="text-primary">Edycja kategorii</h3>
            </div>
            <div class="p-4">
                <form action="<?=$route->get('category.edit') . "&id=" . $category->id?>" method="post">
                    <?php Component::render('form.input', ['class' => "", 'type' => "text", 'name' => "name", "placeholder" => "Nazwa kategorii", 'value' => $category->name, 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "name", 'names' => ['between']])?>

                    <?php Component::render('form.input', ['class' => "mt-3", 'type' => "text", 'name' => "image", "placeholder" => "Adres obrazka", 'value' => $category->image, 'prefix' => true])?>
                    <?php Component::render('error', ['type' => "image", 'names' => ['max', 'require']])?>

                    <?php Component::render('form.checkbox', ['class' => "form-check mt-2 border-top", 'name' => "private", "label" => "Kategoria prywatna", 'checked' => $category->private])?>

                    <div class="d-flex">
                        <?php Component::render('form.button', ['class' => "col-9 mt-3", 'text' => "Edytuj kategorie"])?>
                        <?php Component::render('button.delete')?>
                    </div>
                </form>

                <?php Component::render('form.delete', ['action' => $route->get('category.delete') . "&id=" . $category->id])?>
                <?php Component::render('button.back', ['action' => $route->get('category.list'), 'text' => "Moje kategorie"])?>
            </div>
        </div>
    </div>
</div>

<script> initDeleteButton(); </script>