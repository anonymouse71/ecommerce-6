<?php
//	require_once("configure.php");
include("dbconnect.php");
header('Content-Type: text/html; charset=utf-8');

session_start();
function getCountProducts() {
    if (isset($_SESSION['GuestCarts'])) {
        return count($_SESSION['GuestCarts']);
    }
    else {
        return 0;
    }
}

$name = "null";
$email = "null";
$title = "null";
$details = "null";

if (isset($_POST['txtName'])) {
    $name = $_POST['txtName'];
    $email = $_POST['txtEmail'];
    $title = $_POST['txtTitle'];
    $details = $_POST['txtDetails'];

    $sql = "INSERT INTO feedbacks (`UserId`, `Title`, `Details`, `CreateTime`) VALUES (1, '$title', '$details', CURRENT_TIME())";
}
?>

<!doctype html>
<html>
    <!-- Head HTML -->
    <head>
        <meta charset="utf-8">
        <title>Liên hệ</title>
        <link href="styles/site.css" rel="stylesheet" type="text/css">
        <link href="styles/contact.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="javascript.js"></script>
    </head>

    <!-- Body HTML -->
    <body>
        <div class="divContainer">
            <!-- Header -->
            <header>
                <a href="#">
                    <img src="styles/Banner.png" alt="Shop Đồng Hồ" height="90" id="imgBanner" />
                </a>  
                <div class="divGuestCart">
                    <?php
                        if (isset($_SESSION['userId']) && $_SESSION['userId']!='') {
                    ?>
                        <a href="usercontrolGuest.php">Chào <span id="txtGuestName"><?php echo $_SESSION['name']; ?></span></a>
                        <a href="logout.php">(Đăng xuất)</a> <br>
                    <?php
                        }
                        else {
                    ?>
                        <a href="login.php">Đăng nhập</a> <span style="color:#FFF">|</span>
                        <a href="register.php">Đăng ký</a> <br>
                    <?php      
                        }
                    ?>
                    <a href="guestcart.php">Giỏ hàng của bạn: <span id="txtCountGuestCart"><?php echo getCountProducts(); ?></span> sản phẩm</a>
                </div>
            </header>

            <!-- Top Menu -->
            <div class="divTopMenu">
                <nav>
                    <ul id="ulTopMenu"> 
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="products.php">Sản phẩm</a></li>
                        <li><a href="contact.php">Liên hệ</a></li>
                        <li><a href="search.php">Tìm kiếm</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Body Wrapper Second Level -->
            <div class="divWrapper_2">
                <!-- Body Wrapper First Level -->
                <div class="divWrapper_1">
                    <!-- Left Menu -->
                    <div class="divLeftMenu">
                        <nav>
                            <ul id="ulLeftMenu">
                                <script language="javascript">
                                    showLeftMenu();
                                </script>
                            </ul>
                        </nav>
                    </div>

                    <!-- Main -->
                    <div class="divMain">
                        <article class="articleContent">
                            <p class="pPageTitle">Liên hệ</p>

                            <!-- Contact -->
                            <section id="Contact">
                                <p>Tên nhóm: <span id="CompanyName">ABC</span> </p>
                                <p>Địa chỉ: <span id="Address"></span></p>
                                <p>Số điện thoại: <span id="PhoneNumber"></span></p>
                                <p>Email: <span id="Email"></span></p>

                                <script language="javascript">
                                    ShowContact();
                                </script>
                            </section>

                            <!-- Feedback -->
                            <section id="sectionFeedback">
                                <p class="pPageTitle">Phản hồi</p>

                                <?php
                                    if (!isset($_POST['txtName'])) {
                                ?>

                                    <form id="form1" name="formFeedback" method="post" action="#">
                                        <table class="tableFeedback" cellpadding="5" cellspacing="5"">
                                            <tr>
                                                <th width="106" style="text-align: left" scope="row">Họ tên:</th>
                                                <td width="459" style="text-align: left"><input name="txtName" type="text" id="txtName" size="40" required></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left" scope="row">Email:</th>
                                                <td style="text-align: left">
                                                    <input name="txtEmail" type="text" id="txtEmail" size="40" required></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left" scope="row">Tiêu đề:</th>
                                                <td style="text-align: left">
                                                    <input name="txtTitle" type="text" id="txtTitle" size="60" required></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left" scope="row" valign="top">Nội dung</th>
                                                <td style="text-align: left">
                                                    <textarea name="txtDetails" cols="60" rows="6" id="txtDetails" required></textarea></td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>
                                                    <input type="submit" value="Gửi phản hồi"/>
                                                    &nbsp; 
                                                    <input type="reset" value="Nhập lại"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>

                                <?php
                                    } else {
                                        if (mysqli_query($con, $sql)) {
                                ?>
                                    <p class="pResultFeedback">Gửi phản hồi thành công.</p>		
                                <?php
                                        } else {
                                ?>
                                    <p class="pResultFeedback">Gửi phản hồi thất bại.</p>	
                                <?php
                                    }
                                }
                                ?>
                            </section>

                        </article>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer>
                <span class="spanFooterTitle"><b>THỰC TẬP WEB - CỬA HÀNG ĐỒNG HỒ ONLINE</b></span> <br>
                <span id="spanFooter">Students' Informations</span> 
                <script language="javascript">
                    showFooterDetails();
                </script>
            </footer>
        </div>
    </body>
</html>
