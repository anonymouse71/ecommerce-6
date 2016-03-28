<?php
require_once 'dbconnect.php';
session_start();

function getCountProducts() {
    if (isset($_SESSION['GuestCarts'])) {
        return count($_SESSION['GuestCarts']);
    } else {
        return 0;
    }
}
function getOrderById($con, $id) {
    $sql = "SELECT * FROM `orders` WHERE Id = $id";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_array($result);
    }
    return NULL;
}

$order = '';
if (isset($_GET['id'])) {
    $order = getOrderById($con, $_GET['id']);
    if ($order != NULL) {
        
    }
    else {
        header("Location: 404.php");
    }
}
else {
    header("Location: 404.php");
}
?>
<!doctype html>
<html>
    <!-- Head HTML -->
    <head>
        <meta charset="utf-8">
        <title>Chi tiết đơn hàng</title>
        <link href="styles/site.css" rel="stylesheet" type="text/css">
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
                    if (isset($_SESSION['userId']) && $_SESSION['userId'] != '') {
                        ?>
                        <a href="usercontrolGuest.php">Chào <span id="txtGuestName"><?php echo $_SESSION['name']; ?></span></a>
                        <a href="logout.php">(Đăng xuất)</a> <br>
                        <?php
                    } else {
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
                            <p class="pPageTitle">Chi tiết đơn hàng <?php $order['Id']; ?></p>

                            <section>
                                Mã đơn hàng: <?php echo $order['Id']; ?> <br/>
                                Thời gian đặt hàng: <?php echo $order['CreateTime']; ?><br/>
                                Tình trạng: <?php echo $order['Status']; ?><br/>
                                Địa chỉ giao hàng: <?php echo $order['Address']; ?><br/>
                                Số điện thoại: <?php echo $order['Phone']; ?><br/>
                                Yêu cầu: <?php echo $order['Request']; ?><br/>
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
