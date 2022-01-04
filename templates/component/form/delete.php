<div class="collapse delete">
    <p class = "border-top text-center fw-bold"> Czy jesteś pewien, że chcesz usunąć ten element? </p>

    <form action = "<?=$params['action'] ?? ""?>" method = "POST">
        <input type = "hidden" name = "id" value = "<?=$category->id?>">
        <button class="btn btn-danger col-12" type = "submit"> Tak </button>
    </form>
</div>