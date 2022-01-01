<?php

declare (strict_types = 1);

use App\Error;
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
                <form action="<?=$route->get('category.edit')?>" method="post">
                    <div class="input-group">
                        <span class="input-group-text bg-primary"></span>
                        <input type="name" name="name" class="form-control" placeholder="Nazwa kategorii" value="<?=$category->name?>">
                    </div>

                    <?php Error::render('input', Session::getNextClear('error:name:between'))?>

                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary"></span>
                        <input type="text" name="image" class="form-control" placeholder="Adres obrazka" value="<?=$category->image?>">
                    </div>

                    <?php Error::render('input', Session::getNextClear('error:image:max'))?>
                    <?php Error::render('input', Session::getNextClear('error:image:require'))?>

                    <div class="form-check mt-2 border-top">
                        <input class="form-check-input" type="checkbox" id="private" name = "private" <?php if ($category->private) {echo "checked";}?>>
                        <label class="form-check-label" for="private"> Kategoria prywatna </label>
                    </div>

                    <input type = "hidden" name = "id" value = "<?=$category->id?>">

                    <div class="d-flex">
                        <div class="d-grid col-9 mt-3">
                            <button class="btn btn-primary" type="submit"> Edytuj kategorie </button>
                        </div>

                        <div class="d-grid offset-1 col-2 mt-3">
                            <button id = "delete" class="btn btn-danger" type = "button" class="btn btn-danger" data-bs-toggle="collapse" data-bs-target=".delete" aria-expanded="false"> USUŃ </button>
                        </div>
                    </div>
                </form>

                <div class="collapse delete">
                    <p class = "border-top text-center fw-bold"> Czy jesteś pewien, że chcesz usunąć wybraną kategorię? </p>

                    <form action = "<?=$route->get('category.delete')?>" method = "POST">
                        <input type = "hidden" name = "id" value = "<?=$category->id?>">
                        <button class="btn btn-danger col-12" type = "submit"> Tak </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script> initDeleteButton(); </script>