<?php

declare (strict_types = 1);

use App\Error;
use App\Helper\Session;

?>

<div class="mt-sm-5 pt-sm-5">
    <div class="rounded d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 col-12 shadow-lg p-5 bg-light">
            <div class="text-center">
                <h3 class="text-primary">Dodawanie kategorii</h3>
            </div>
            <div class="p-4">
                <form action="<?=$route->get('category.create')?>" method="post">
                    <div class="input-group">
                        <span class="input-group-text bg-primary"></span>
                        <input type="name" name="name" class="form-control" placeholder="Nazwa kategorii" value="<?=$params['name'] ?? ''?>">
                    </div>

                    <?php Error::render('input', Session::getNextClear('error:name:between'))?>

                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary"></span>
                        <input type="text" name="image" class="form-control" placeholder="Adres obrazka" value="<?=$params['image'] ?? ''?>">
                    </div>

                    <?php Error::render('input', Session::getNextClear('error:image:max'))?>
                    <?php Error::render('input', Session::getNextClear('error:image:require'))?>

                    <div class="form-check mt-2 border-top">
                        <input class="form-check-input" type="checkbox" id="private" name = "private">
                        <label class="form-check-label" for="private"> Kategoria prywatna </label>
                    </div>

                    <div class="d-grid col-12 mx-auto mt-3">
                        <button class="btn btn-primary" type="submit"><span></span> Utwórz kategorie </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>