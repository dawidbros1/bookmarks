<div class="px-3 px-md-4 px-lg-5 py-1">
   <h1 class="text-center font-bold text-2xl mb-4">Serdecznie witamy na stronie</h1>

   <p class="mb-4">
      Serwis, na którym właśnie się znajdujesz, służy do tworzenia linków do zewnętrznych stron. Korzystając z
      naszego serwisu, możesz udostępnić zgromadzone przez siebie grupy odnośników znajomym za pomocą
      pojedynczego linka.
   </p>

   <div class="justify-center d-flex flex-wrap">
      <div class="box-item">
         <div class="title">Szybki dostęp do ulubionych stron</div>
         <img src="./public/images/Home/fast.jpg" />
      </div>

      <div class="box-item">
         <div class="title">Dostęp z każdego urządzenia</div>
         <img src="./public/images/Home/responsive.png" />
      </div>

      <div class="box-item">
         <div class="title">Graficzny interfejs</div>
         <img src="./public/images/Home/interface.jpg" />
      </div>

      <div class="box-item">
         <div class="title">Udostępniaj zawartości znajomym</div>
         <img src="./public/images/Home/sharing.jpg" />
      </div>

      <div class="box-item">
         <div class="title">Umieszczaj elementy w folderach</div>
         <img src="./public/images/Home/subfolders.jpg" />
      </div>

      <div class="box-item">
         <div class="title">Dowolnie rozmieszczaj elementy</div>
         <img src="./public/images/Home/sort.jpg" />
      </div>
   </div>
</div>

<?php if (!$user): ?>
   <div class="px-6 py-1 mt-4 register pb-4">
      <div class="text-center"> Nie masz jeszcze konta? </div>
      <a href="<?=$route->get('auth.register')?>">
         <button class="bg-primary text-white font-bold py-2 px-4 rounded">
            Zarejestruj się
         </button>
      </a>
   </div>
<?php endif;?>