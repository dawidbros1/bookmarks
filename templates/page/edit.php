<?php

declare (strict_types = 1);

use App\Component;
use App\Helper\Session;

$page = $params['page'];

?>

<div class="mt-sm-5 pt-sm-5">
    <div class="rounded d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 col-12 shadow-lg p-5 bg-light">
            <div class="text-center">
                <h3 class="text-primary">Edycja strony</h3>
            </div>
            <div class="p-4">
                <form action="<?=$route->get('page.edit')?>" method="post">
                    <div class="input-group">
                        <span class="input-group-text bg-primary"></span>
                        <input type="name" name="name" class="form-control" placeholder="Nazwa strony" value="<?=$page->name?>">
                    </div>

                    <?php Component::render('error', ['text' => Session::getNextClear('error:name:between')])?>

                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary"></span>
                        <input type="text" name="image" class="form-control" placeholder="Adres obrazka" value="<?=$page->image?>">
                    </div>

                    <?php Component::render('error', ['text' => Session::getNextClear('error:image:max')])?>
                    <?php Component::render('error', ['text' => Session::getNextClear('error:image:require')])?>

                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary"></span>
                        <input type="text" name="link" class="form-control" placeholder="Link" value="<?=$page->link?>">
                    </div>

                    <?php Component::render('error', ['text' => Session::getNextClear('error:link:max')])?>
                    <?php Component::render('error', ['text' => Session::getNextClear('error:link:require')])?>

                    <input type = "hidden" name = "id" value = "<?=$page->id?>">

                    <div class="d-flex">
                        <div class="d-grid col-9 mt-3">
                            <button class="btn btn-primary" type="submit"> Edytuj stronę </button>
                        </div>

                        <div class="d-grid offset-1 col-2 mt-3">
                            <button id = "delete" class="btn btn-danger" type = "button" class="btn btn-danger" data-bs-toggle="collapse" data-bs-target=".delete" aria-expanded="false"> USUŃ </button>
                        </div>
                    </div>
                </form>

                <?php Component::render('button.back', ['route' => $route->get('category.show') . "&id=" . $page->category_id])?>

                <div class="collapse delete">
                    <p class = "border-top text-center fw-bold"> Czy jesteś pewien, że chcesz usunąć wybraną stronę? </p>

                    <form action = "<?=$route->get('page.delete')?>" method = "POST">
                        <input type = "hidden" name = "id" value = "<?=$page->id?>">
                        <button class="btn btn-danger col-12" type = "submit"> Tak </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script> initDeleteButton(); </script>