<div class="collapse delete">
    <p class = "border-top text-center fw-bold"> Czy jesteś pewien, że chcesz usunąć wybrany element? </p>

    <form action = "<?=$params['action'] ?? ""?>" method = "POST">
        <input type = "hidden" name = "id" value = "<?=$params['id'] ?? 0?>">
        <button class="btn btn-danger col-12" type = "submit"> Tak </button>
    </form>
</div>