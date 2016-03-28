<?php
    session_start();
    require_once 'dbconnect.php';
    
    function getCountProducts() {
    if (isset($_SESSION['GuestCarts'])) {
        return count($_SESSION['GuestCarts']);
    }
    else {
        return 0;
    }
}
    
    $typeWatches = '';
    if (isset($_GET['type'])) {
        $typeWatches = $_GET['type'];
    }
    
    $products = array();
    
    if ($typeWatches === '') {
        $sql = "SELECT * FROM `watches` ORDER BY Id ASC";
    }
    else {
        $sql = "SELECT * FROM `watches` WHERE Type='$typeWatches' ORDER BY Id ASC";   
    }
    
    $result = mysqli_query($con, $sql);
    $products = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html>
    <!-- Head HTML -->
    <head>
        <meta charset="utf-8">
        <title>Danh mục đồng hồ</title>
        <link href="styles/site.css" rel="stylesheet" type="text/css">
        <link href="styles/products.css" rel="stylesheet" type="text/css">
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
                            <!-- Page Title -->
                            <p class="pPageTitle">Danh mục đồng hồ - 
                            <?php
                                if ($typeWatches === '') {
                                    echo "Tất cả";
                                }
                                else {
                                    echo $typeWatches;
                                }
                            ?>
                            </p>

                            <section>
                                <div class="divProducts">
                                    <?php
                                        ///$sql = "SELECT * FROM `watches` WHERE Type='$typeWatches' ORDER BY Id ASC";
                                        $result = mysqli_query($con, $sql);
                                        while($product = mysqli_fetch_array($result)) {

                                    ?>
                                    <div class="divProduct">
                                        <a href="watches.php?id=<?php echo $product['Id']; ?>">
                                            <img src="images/<?php echo $product['Picture']; ?>" width="156px" height="280px"/>
                                        </a>
                                        <div class="divProductDetail">
                                            <a href="watches.php?id=<?php echo $product['Id']; ?>">
                                                <span class="spanProductName"><?php echo $product['Name']; ?></span> <br/> 
                                            </a>
                                            <span class="spanProductPriceLabel">Giá bán:</span> <span class="spanProductPrice"><?php echo $product['Price']; ?>đ</span>
                                        </div>
                                    </div>
                                    <?php

                                        }
                                    ?>
                                </div>
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
