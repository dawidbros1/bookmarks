<div class="px-3 px-md-4 px-lg-5 py-1">
   <h1 class="text-center font-bold text-2xl mb-4">Serdecznie witamy na stronie</h1>

   <p class="mb-4">
      Chcesz mieć szybki dostęp do swoich ulubionych stron bez konieczności szukania ich w zakładkach przeglądarki? Nasza aplikacja umożliwia łatwe zarządzanie linkami i dostęp do nich z każdego urządzenia. Dzięki przyjaznemu graficznemu interfejsowi możesz tworzyć foldery i udostępniać je znajomym. Skorzystaj z naszej aplikacji i uporządkuj swoje linki już dziś!
   </p>

   <div class="col-12 col-md-10 col-xl-7 col-xxl-5 mx-auto">
      <div class="row box">
         <div class="col-4"><img src="./public/images/Home/fast.jpg" class="img-fluid" alt="Zdjęcie 1"></div>
         <div class="col-8">
            <div class="text-center fw-bold">Szybki dostęp do ulubionych stron</div>
            <div>
               Dzięki naszemu serwisowi szybko znajdziesz swoje ulubione strony bez konieczności ich szukania w
               zakładkach przeglądarki.
            </div>
         </div>
      </div>

      <div class="row box">
         <div class="col-8">
            <div class="text-center fw-bold">Dostęp z każdego urządzenia</div>
            <div>
               Niezależnie od tego, czy korzystasz z komputera, tabletu czy telefonu, nasz serwis jest dostępny na
               wszystkich urządzeniach.
            </div>
         </div>
         <div class="col-4"><img src="./public/images/Home/responsive.png" class="img-fluid" alt="Zdjęcie 1"></div>
      </div>

      <div class="row box">
         <div class="col-4"><img src="./public/images/Home/interface.jpg" class="img-fluid" alt="Zdjęcie 1"></div>
         <div class="col-8">
            <div class="text-center fw-bold">Graficzny interfejs</div>
            <div>
               Dzięki przyjaznemu dla oka interfejsowi korzystanie z naszego serwisu jest proste i przyjemne.
            </div>
         </div>
      </div>

      <div class="row box">
         <div class="col-8">
            <div class="text-center fw-bold">Udostępniaj zawartości znajomym</div>
            <div>Dzięki naszemu serwisowi możesz łatwo dzielić się swoimi ulubionymi stronami z przyjaciółmi i rodziną.
            </div>
         </div>
         <div class="col-4"><img src="./public/images/Home/sharing.jpg" class="img-fluid" alt="Zdjęcie 1"></div>
      </div>

      <div class="row box">
         <div class="col-4"><img src="./public/images/Home/subfolders.jpg" class="img-fluid" alt="Zdjęcie 1"></div>
         <div class="col-8">
            <div class="text-center fw-bold">Umieszczaj strony w folderach</div>
            <div> Za pomocą naszego serwisu możesz tworzyć foldery i umieszczać w nich swoje ulubione strony, aby je
               łatwo znaleźć w przyszłości.
            </div>
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