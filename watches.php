<?php
    require_once 'dbconnect.php';
    session_start();
    
    function getCountProducts() {
    if (isset($_SESSION['GuestCarts'])) {
        return count($_SESSION['GuestCarts']);
    }
    else {
        return 0;
    }
}
    
    $watchesCodeName = '';
    $watchesId = '';
    if (isset($_GET['id'])) {
        $watchesId = $_GET['id'];
    }
    
    if ($watchesId === '') {
        header("Location: 404.php");
    }
    else {
        $sql = "SELECT * FROM `watches` WHERE Id = '$watchesId'";
        $result = mysqli_query($con, $sql);
        
        if (mysqli_num_rows($result) === 1) {
            $watches = mysqli_fetch_array($result);
            $watchesCodeName = $watches['CodeName'];
        }
        else {
            header("Location: 404.php");
        }

    }
?>
<!doctype html>
<html>
    <!-- Head HTML -->
    <head>
        <meta charset="utf-8">
        <title><?php echo $watches['Name']; ?></title>
        <link href="styles/site.css" rel="stylesheet" type="text/css">
        <link href="styles/watches.css" rel="stylesheet" type="text/css">
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
                            <!--p class="pPageTitle"><?php ///echo $watches['Name']; ?></p>-->

                            <div class="divWatchesPicture">
                                <img class="imgWatchesPicture" src="images/<?php echo $watches['Picture']; ?>"/>
                            </div>
                            
                            <div class="divWatchesRight">
                                <p id="pProductName"><?php echo $watches['Name']; ?></p>
                          
                                <p class="pWatchesBasicInfo">Mã sản phẩm: <?php echo $watches['CodeName']; ?> </p>
                                <p class="pWatchesBasicInfo">Hãng sản xuất: <?php echo $watches['Type']; ?> </p>
                                <p class="pWatchesBasicInfo">Xuất xứ: <?php echo $watches['Origin']; ?> </p>
                                <p class="pWatchesBasicInfo">Năm sản xuất: <?php echo $watches['Year']; ?></p>
                                <p class="pWatchesBasicInfo">Giá bán: <span class="spanProductPrice"><?php echo number_format(floatval($watches['Price']), 0, ".", ","); ?> VNĐ</span> </p>
                                
                                <form id="AddCart" action="guestcart.php" method="post">
                                <div class="divAddCart">
                                    <input type="hidden" name="txtProductId" value="<?php echo $watchesId; ?>"/>
                                    Số lượng: <input type="number" value="1" min="1" name="txtProductQuantity" id="inputQuantity"/> <input type="submit" value="MUA HÀNG" name="btnButton" id="btnSubmitAddCart"/>
                                </div>
                                </form>
                            </div>

                            <div class="divWatchesDetails">
                                <p class="pProductDetailTitle" style="margin-top: 5px;">Mô tả sản phẩm</p>
                                <pre class="preWatchesDetails"><?php echo $watches['Details']; ?></pre>
                            </div>
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
