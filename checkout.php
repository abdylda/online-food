<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{


												foreach ($_SESSION["cart_item"] as $item)
												{

												$item_total += ($item["price"]*$item["quantity"]);

													if($_POST['submit'])
													{

													$SQL="insert into users_orders(u_id,title,quantity,price) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";

														mysqli_query($db,$SQL);

														$success = "Thankyou! Your Order Placed successfully!";



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
    <title>Starter Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>

    <div class="site-wrapper">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.html"> <img class="img-rounded" src="images/food-picky-logo.png" alt=""> </a>
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


										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">ваши заказы</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">выйти</a> </li>';
							}

						?>

                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">

                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Выберите Ресторан</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Выберите свою любимую еду</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active" ><span>3</span><a href="checkout.php">Заказ и оплата онлайн</a></li>
                    </ul>
                </div>
            </div>

                <div class="container">

					   <span style="color:green;">
								<?php echo $success; ?>
										</span>

                </div>




            <div class="container m-t-30">
			<form action="" method="post">
                <div class="widget clearfix">

                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Сводка корзины</h4> </div>
                                        <div class="cart-totals-fields">

                                            <table class="table">
											<tbody>



                                                    <tr>
                                                        <td>Итого по корзине</td>
                                                        <td> <?php echo $item_total."сом"; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Доставка и обработка</td>
                                                        <td>	бесплатная доставка</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Всего</strong></td>
                                                        <td class="text-color"><strong> <?php echo $item_total."сом"; ?></strong></td>
                                                    </tr>
                                                </tbody>




                                            </table>
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Оплата при доставке</span>
                                                    <br> <span>Отправьте чек на адрес магазина, улицу магазина, город магазина, штат / округ магазина, почтовый индекс магазина.</span> </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="mod"  type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Paypal <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure?');" name="submit"  class="btn btn-outline-success btn-block" value="Заказать сейчас"> </p>
                                    </div>
									</form>
                                </div>
                            </div>

                    </div>
                </div>
				 </form>
            </div>
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
        <div class="row top-footer">
            <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                <a href="#"> <img src="images/food-picky-logo.png" alt="Footer logo"> </a> <span>Доставка и вывоз заказа</span> </div>
            <div class="col-xs-12 col-sm-2 about color-gray">
                <h5>О нас</h5>
                <ul>
                    <li><a href="#">О нас</a> </li>
                    <li><a href="#">История</a> </li>
                    <li><a href="#">Наша команда</a> </li>
                    <li><a href="#">Мы нанимаем</a> </li>
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
<?php
}
?>