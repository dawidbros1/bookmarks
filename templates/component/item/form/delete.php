<div class="collapse border-top border-2 pt-2 mt-3 delete <?=$params['class'] ?? ""?>">
    <p class = "text-center fw-bold"> Czy jesteś pewien, że chcesz usunąć wybrany element? </p>

    <form class = "d-flex border-bottom border-2 pb-2" action = "<?=$params['action']?>" method = "POST">
        <input type = "hidden" name = "id" value = "<?=$params['id']?>">
        <button data-bs-toggle="collapse" data-bs-target=".btn1,.btn2,.delete" class="btn btn-success col-5 fw-bold" type = "button"> Nie </button>
        <button class="btn btn-danger col-5 offset-2 fw-bold" type = "submit"> Tak </button>
    </form>
</div>