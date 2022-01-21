<!DOCTYPE html>
<html lang="en">
<?php

session_start(); //temp session
error_reporting(0); // hide undefine index
include("connection/connect.php"); // connection
if(isset($_POST['submit'] )) //if submit btn is pressed
{
     if(empty($_POST['firstname']) ||  //fetching and find if its empty
   	    empty($_POST['lastname'])|| 
		empty($_POST['email']) ||  
		empty($_POST['phone'])||
		empty($_POST['password'])||
		empty($_POST['cpassword']) ||
		empty($_POST['cpassword']))
		{
			$message = "All fields must be Required!";
		}
	else
	{
		//cheching username & email if already present
	$check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
	$check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");
		

	
	if($_POST['password'] != $_POST['cpassword']){  //matching passwords
       	$message = "Password not match";
    }
	elseif(strlen($_POST['password']) < 6)  //cal password length
	{
		$message = "Password Must be >=6";
	}
	elseif(strlen($_POST['phone']) < 10)  //cal phone length
	{
		$message = "invalid phone number!";
	}

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
       	$message = "Invalid email address please type a valid email!";
    }
	elseif(mysqli_num_rows($check_username) > 0)  //check username
     {
    	$message = 'username Already exists!';
     }
	elseif(mysqli_num_rows($check_email) > 0) //check email
     {
    	$message = 'Email Already exists!';
     }
	else{
       
	 //inserting values into db
	$mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
	mysqli_query($db, $mql);
		$success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
														<script type='text/javascript'>
														function countdown() {
															var i = document.getElementById('counter');
															if (parseInt(i.innerHTML)<=0) {
																location.href = 'login.php';
															}
															i.innerHTML = parseInt(i.innerHTML)-1;
														}
														setInterval(function(){ countdown(); },1000);
														</script>'";
		
		
		
		
		 header("refresh:5;url=login.php"); // redireted once inserted success
    }
	}

}


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Доставка еды Бишкек</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
     
         <!--header starts-->
         <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
               <div class="container">
                  <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                  <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-picky-logo.png" alt=""> </a>
                  <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                     <ul class="nav navbar-nav">
							<li class="nav-item"> <a class="nav-link active" href="index.php">Домой <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Рестораны <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Авторизоваться</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Зарегистрироваться</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Ваши заказы</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Выйти</a> </li>';
							}

						?>
							 
                        </ul>
                  </div>
               </div>
            </nav>
            <!-- /.navbar -->
         </header>
         <div class="page-wrapper">
            <div class="breadcrumb">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">
					  <span style="color:red;"><?php echo $message; ?></span>
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					   
					</a></li>
                    
                  </ul>
               </div>
            </div>
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body">
                              
							  <form action="" method="post">
                                 <div class="row">
								  <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">Имя пользователя</label>
                                       <input class="form-control" type="text" name="username" id="example-text-input" placeholder="Имя пользователя">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Имя</label>
                                       <input class="form-control" type="text" name="firstname" id="example-text-input" placeholder="Имя">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Фамилия</label>
                                       <input class="form-control" type="text" name="lastname" id="example-text-input-2" placeholder="Фамилия">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Адрес электронной почты</label>
                                       <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите адрес электронной почты"> <small id="emailHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Телефонный номер</label>
                                       <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Телефонный номер"> <small class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Пароль</label>
                                       <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Пароль">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Повторите пароль</label>
                                       <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Повторите пароль">
                                    </div>
									 <div class="form-group col-sm-12">
                                       <label for="exampleTextarea">Адресс доставки</label>
                                       <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
                                    </div>
                                   
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Регистрация" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                           
						   </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                     </div>
                     <!-- WHY? -->

                     <!-- /WHY? -->
                  </div>
               </div>
            </section>
            <section class="app-section">
               <div class="app-wrap">
                  <div class="container">
                     <div class="row text-img-block text-xs-left">
                        <div class="container">
                           <div class="col-xs-12 col-sm-6  right-image text-center">
                              <figure> <img src="images/app.png" alt="Right Image"> </figure>
                           </div>
                            <div class="col-xs-12 col-sm-6 left-text">
                                <h3>Лучшее приложение для доставки еды</h3>
                                <p>Теперь вы можете приготовить еду практически, где бы вы ни находились, благодаря бесплатной простой в использовании программе доставки еды и напитков & amp; Takeout App.</p>
                                <div class="social-btns">
                                    <a href="#" class="app-btn apple-button clearfix">
                                        <div class="pull-left"><i class="fa fa-apple"></i> </div>
                                        <div class="pull-right"> <span class="text">Доступно на</span> <span class="text-2">App Store</span> </div>
                                    </a>
                                    <a href="#" class="app-btn android-button clearfix">
                                        <div class="pull-left"><i class="fa fa-android"></i> </div>
                                        <div class="pull-right"> <span class="text">Доступно на</span> <span class="text-2">Play store</span> </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
             <!-- start: FOOTER -->
             <footer class="footer">
                 <div class="container">
                     <!-- top footer statrs -->
                     <footer class="footer">
                         <div class="container">
                             <!-- top footer statrs -->
                             <div class="row top-footer">
                                 <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                                     <a href="#"> <img src="images/food-picky-logo.png" alt="Footer logo"> </a> <span>Order Delivery &amp; Take-Out </span> </div>
                                 <div class="col-xs-12 col-sm-2 about color-gray">
                                     <h5>О нас</h5>
                                     <ul>
                                         <li><a href="#">О нас</a> </li>
                                         <li><a href="#">История</a> </li>
                                         <li><a href="#">Наша команда</a> </li>
                                         <li><a href="#">Мы нанимаем</a> </li>
                                     </ul>
                                 </div>
                                 <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                                     <h5>Как это работает</h5>
                                     <ul>
                                         <li><a href="#">Введите ваше местоположение</a> </li>
                                         <li><a href="#">Выберите ресторан</a> </li>
                                         <li><a href="#">Выберите еду</a> </li>
                                         <li><a href="#">Оплата кредитной картой</a> </li>
                                         <li><a href="#">Ждать доставки</a> </li>
                                     </ul>
                                 </div>
                                 <div class="col-xs-12 col-sm-2 pages color-gray">
                                     <h5>Страницы</h5>
                                     <ul>
                                         <li><a href="#">Страница результатов поиска</a> </li>
                                         <li><a href="#">Страница регистрации пользователя</a> </li>
                                         <li><a href="#">Страница с ценами</a> </li>
                                         <li><a href="#">Сделать заказ</a> </li>
                                         <li><a href="#">Добавить в корзину</a> </li>
                                     </ul>
                                 </div>
                                 <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                                     <h5>Популярные локации</h5>
                                     <ul>
                                         <li><a href="#">Сараево</a> </li>
                                         <li><a href="#">Тузла</a> </li>
                                         <li><a href="#">Загреб</a> </li>
                                         <li><a href="#">Белград</a> </li>
                                         <li><a href="#">Градачац</a> </li>
                                         <li><a href="#">Расколоть</a> </li>
                                         <li><a href="#">Шибеник</a> </li>
                                     </ul>
                                 </div>
                             </div>
                             <!-- top footer ends -->
                             <!-- bottom footer statrs -->
                             <div class="bottom-footer">
                                 <div class="row">
                                     <div class="col-xs-12 col-sm-3 payment-options color-gray">
                                         <h5>Варианты оплаты</h5>
                                         <ul>
                                             <li>
                                                 <a href="#"> <img src="images/psuqf.png" alt="Paypal"> </a>
                                             </li>
                                             <li>
                                                 <a href="#"> <img src="images/1wer.png" alt="Mastercard"> </a>
                                             </li>

                                         </ul>
                                     </div>
                                     <div class="col-xs-12 col-sm-4 address color-gray">
                                         <h5>Адрес</h5>
                                         <p>Концептуальный дизайн заказа и доставки еды oline, запланированный как справочник ресторана</p>
                                         <h5>Телефон: <a href="tel:+080000012222">0707 777 888</a></h5> </div>
                                     <div class="col-xs-12 col-sm-5 additional-info color-gray">
                                         <h5>Дополнительная информация</h5>
                                         <p>Присоединяйтесь к тысячам других ресторанов, которые извлекают выгоду из своего меню на TakeOff.</p>
                                     </div>
                                 </div>
                             </div>
                             <!-- bottom footer ends -->
                         </div>
                     </footer>
                     <!-- end:Footer -->

                     <!-- Bootstrap core JavaScript
                     ================================================== -->
                     <script src="js/jquery.min.js"></script>
                     <script src="js/tether.min.js"></script>
                     <script src="js/bootstrap.min.js"></script>
                     <script src="js/animsition.min.js"></script>
                     <script src="js/bootstrap-slider.min.js"></script>
                     <script src="js/jquery.isotope.min.js"></script>
                     <script src="js/headroom.js"></script>
                     <script src="js/foodpicky.min.js"></script>
</body>

</html>