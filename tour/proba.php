<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>My website</title>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css"type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"type='text/css'>
        
	</head>
  

	<body>

    
      <?php
       require_once 'cookie.php';
       require_once 'time.php';
      ?>
           

  
        <h1><img src="img/palma.jpg" wight="100" height="111" >купить тур</h1> 
        
        <!--добавление вкладок сверху страницы-->
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'главная')">Главная страница</button>
            <button class="tablinks" onclick="openCity(event, 'Отели')">Отели</button>
            <button class="tablinks" onclick="openCity(event, 'регистрация')">Регистрация</button>
            <button class="tablinks" onclick="openCity(event, 'вход')">Войти в личный кабинет</button>
            <button class="tablinks" onclick="openCity(event, 'обратная связь')">Обратная связь</button>
        </div> 
        
        
        <div id="Отели" class="tabcontent">
            <h3>Отели</h3>
            <p>здесь представлены списки отелей</p>


            <div class="d-flex flex-wrap">
            <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
              <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Santana Beach Resort</h4>
              </div>
            <div class="card-body">
              <img src="img/1.jpg" wight="100" height="111" alt="">
              <h1 class="card-title pricing-card-title">25 488 р<small class="text-body-secondary fw-light">/ночь</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>3 звезды</li>
                <li>Уютный отель с удобным расположением, путь до пляжа занимает 2-3 минуты. Поблизости много кафе и магазинчиков. Гостей порадует приятная атмосфера, красивая зеленая территория и дружелюбный персонал.</li>
              </ul>
              
              <button type="submit" onclick="redirectToExternalSite1()" class="w-100 btn btn-lg btn-outline-primary">Перейти к отелю</button>
              
              <script>
                function redirectToExternalSite1() {
              window.location.href = "https://level.travel/hotels/9012210-Santana_Beach_Resort?adults=2&from=Moscow-RU&kids=0&nights=6&offer_date=2024-02-29&search_type=package&start_date=29.02.2024"; 
                }
              </script>

              </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
              <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Club Hotel Sera</h4>
              </div>
            <div class="card-body">
              <img src="img/2.jpg" wight="100" height="111" alt="">
              <h1 class="card-title pricing-card-title">22 306 р<small class="text-body-secondary fw-light">/ночь</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>5 звёзд</li>
                <li>Песчаный вход в море, что редко для отелей, расположенных в самой Анталье. Оригинальная зеленая территория. На территории отеля расположен популярный ювелирный магазин.</li>
              </ul>

              <button type="submit" onclick="redirectToExternalSite2()" class="w-100 btn btn-lg btn-outline-primary">Перейти к отелю</button>
              
              <script>
                function redirectToExternalSite2() {
              window.location.href = "https://level.travel/hotels/14797-Club_Hotel_Sera?adults=2&nights=4&from=Moscow-RU&search_type=package&offer_price=98970&offer_nights=4&offer_date=2024-03-04&start_date=2024-03-04"; 
                }
              </script>


              </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
              <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Мини-Отель Cabin Shale</h4>
              </div>
            <div class="card-body">
              <img src="img/3.jpg" wight="100" height="111" alt="">
              <h1 class="card-title pricing-card-title">10 963 р<small class="text-body-secondary fw-light">/ночь</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>3 звезды</li>
                <li>Почувствуйте себя как дома! Мини-отель «Мини-отель Cabin Shale» располагается в Архызе. Этот мини-отель находится 1 км от центра города.</li>
              </ul>


              
              <button type="submit" onclick="redirectToExternalSite3()" class="w-100 btn btn-lg btn-outline-primary">Перейти к отелю</button>
              
              <script>
                function redirectToExternalSite3() {
              window.location.href = "https://level.travel/hotels/9131825-mini_otel_Cabin_Shale?adults=2&nights=6&from=Moscow-RU&search_type=package&offer_price=65776&offer_nights=6&offer_date=2024-02-28&start_date=2024-02-28"; 
                }
              </script>

              </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
              <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Aladdin Beach Resort</h4>
              </div>
            <div class="card-body">
              <img src="img/4.jpg" wight="100" height="111" alt="">
              <h1 class="card-title pricing-card-title">32 195 р<small class="text-body-secondary fw-light">/ночь</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>4 звезды</li>
                <li>Большая зеленая территория. Отель ориентирован на семейный отдых с детьми, имеет хорошую детскую площадку. Напротив отеля расположен аквапарк "Титаник" (платно). Проживающие в отелях Aladdin Beach Resort и Alibaba Palace могут пользоваться территорией обоих отелей. Пользование аквапарком для резидентов этих двух отелей предоставляется бесплатно.</li>
              </ul>
              <button type="submit" onclick="redirectToExternalSite4()" class="w-100 btn btn-lg btn-outline-primary">Перейти к отелю</button>
              
              <script>
                function redirectToExternalSite4() {
              window.location.href = "https://level.travel/hotels/591-Aladdin_Beach_Resort?adults=2&nights=4&from=Moscow-RU&search_type=package&offer_price=130245&offer_nights=4&offer_date=2024-03-04&start_date=2024-03-04"; 
                }
              </script>

              </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
              <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Tonsai Bay Resort</h4>
              </div>
            <div class="card-body">
              <img src="img/5.jpg" wight="100" height="111" alt="">
              <h1 class="card-title pricing-card-title">31 333 р<small class="text-body-secondary fw-light">/ночь</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>3 звезды</li>
                <li>Очаровательный отель, утопающий в тропической зелени, расположился на берегу прекрасной бухты. Гостей ждут комфортабельные номера в уютных бунгало и внимательный персонал. Подходит для молодежного отдыха.</li>
              </ul>
              
              <button type="submit" onclick="redirectToExternalSite5()" class="w-100 btn btn-lg btn-outline-primary">Перейти к отелю</button>
              
              <script>
                function redirectToExternalSite5() {
              window.location.href = "https://level.travel/hotels/9064802-Tonsai_Bay_Resort?adults=2&nights=7&from=Moscow-RU&search_type=package&offer_price=219332&offer_nights=7&offer_date=2024-03-08&start_date=2024-03-08"; 
                }
              </script>

              </div>
            </div>
        </div>


        </div>





        </div> 
          <div id="главная" class="tabcontent">
            <h3>Приветствуем Вас в Компании "Флай"</h3>
            <p>Добро пожаловать в мир приключений и путешествий! Наша турфирма предлагает уникальные возможности для любителей путешествий всех возрастов. Мы специализируемся на создании незабываемых туров по всему миру.

Мы понимаем, что каждый клиент уникален, поэтому мы предлагаем широкий выбор туров: от роскошных курортов на берегу моря до активного отдыха в горах. Наша команда профессионалов готова создать для вас идеальный маршрут, учитывая ваши интересы и предпочтения.

Наш приоритет - ваш комфорт и безопасность. Мы работаем только с проверенными партнерами и предлагаем качественный сервис на каждом этапе вашего путешествия.

Приглашаем вас открыть новые горизонты вместе с нами! Путешествуйте с удовольствием и доверьте свой отдых профессионалам!</p>
          </div>




          <div id="регистрация" class="tabcontent">
            <!--форма регистрации-->    
            <form action="action_page.php" method="post">
                <div class="container mt-4">
                  <h1>Регистрация</h1>
                  <p>Пожалуйста, заполните форму, чтобы создать аккаунт .</p>
                  <hr>
              
                  <label for="email"><b>Email</b></label>
                  <input type="text" placeholder="Введите почту" name="email" required>

                  <label for="name"><b>Name</b></label>
                  <input type="text" placeholder="Введите Ваши ФИО" name="name" required>

                  <label for="num"><b>Enter number</b></label>
                  <input type="int" placeholder="Введите номер телефона" name="num" required>
              
                  <label for="psw"><b>Password</b></label>
                  <input type="password" placeholder="Введите пароль" name="psw" required>
              
                  <label for="psw-repeat"><b>Repeat Password</b></label>
                  <input type="password" placeholder="Повторите пароль" name="psw-repeat" required>
                  <hr>
                

                  <form>
                    <input id="html" type="checkbox">
                    <label for="html">С правилами пользования ознакомлен(а)</label>
                  </form>
                
              
                  <button type="submit" class="registerbtn">Зарегистрироваться</button>
                </div>
                
                <div class="container signin">
                  <p><a href="data/правила.pdf">Правила пользования сайтом</a> </p>
                </div>
              </form>        
          </div>

         
          <div id="вход" class="tabcontent">
            <!--форма регистрации-->  
            <form action="auth.php" method="post">
                <div class="container mt-4">
           
                <?php
            if($_COOKIE['user' == '']):
              ?>
                  <h1>Войти в личный кабинет</h1>
                  <p>Пожалуйста, заполните форму, чтобы войти в Ваш личный кабинет .</p>
                  <hr>
              
                  <label for="email"><b>Email</b></label>
                  <input type="text" placeholder="Введите почту" name="email" required>              
                  <label for="psw"><b>Password</b></label>
                  <input type="password" placeholder="Введите пароль" name="psw" required>
              
                
                  <hr>
                  <button type="submit" class="registerbtn">Войти</button>
                </div>
              </form> 
              <?php else: ?>
            <p> Привет <?=$_COOKIE['user']?>. Чтобы выйти, нажмите <a href="exit.php"> здесь</a>.</p>
          <?php endif;?>
          
          


          <!--для верхнего выбора-->
          <script>
            function openCity(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }
            </script>
            <div>

            <div id="feedback" class="tabcontent">
    <button onclick="loadFeedback()">Загрузить обратную связь</button>
    <div id="feedbackContent"></div>
</div>

          <div id="обратная связь" class="tabcontent">
            
          <?php
             require_once 'feedback.php';
            ?>
          </div>

    <div class="footer">
      <p>© 2023 Апалькова Мария</p>
    </div>
  </body>


</html>