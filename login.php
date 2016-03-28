<?php
    require_once("dbconnect.php");
    session_start();
    
    function getCountProducts() {
    if (isset($_SESSION['GuestCarts'])) {
        return count($_SESSION['GuestCarts']);
    }
    else {
        return 0;
    }
}
    
    define('LOGIN_DIDNOTLOGIN', 2);
    define('LOGIN_SUCCESS', 0);
    define('LOGIN_INCORRECT', 1);
    $loginResult = LOGIN_DIDNOTLOGIN;
    
    if (isset($_SESSION['userId']) && $_SESSION['userId']!='') {
        header("Location: index.php");
    }
    else {
        $user_Email = "null";
        $user_Password = "null";

        if (isset($_POST['txtEmail'])) {
            $user_Email = $_POST['txtEmail'];
            $user_Password = $_POST['txtPassword'];
            $user_Password = md5($user_Password);
            
            $sql = "SELECT * FROM `users` WHERE Email='$user_Email' AND Password='$user_Password'";

            $result = mysqli_query($con, $sql);
            $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['userId'] = $rows['Id'];
                $_SESSION['email'] = $rows['Email'];
                $_SESSION['name'] = $rows['Name'];

                $loginResult = LOGIN_SUCCESS;
                header("Location: index.php");
            }
            else {
                $loginResult = LOGIN_INCORRECT;
            }

            
        }
    }
?>
<!doctype html>
<html>
    <!-- Head HTML -->
    <head>
        <meta charset="utf-8">
        <title>Đăng nhập</title>
        <link href="styles/site.css" rel="stylesheet" type="text/css">
        <link href="styles/login.css" rel="stylesheet" type="text/css">
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
            <div class="divWrapper_2" style="overflow: hidden">
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
                            <p class="pPageTitle">Đăng nhập</p>

                            <section>
                                <form id="formLogin" action="" method="post">
                                <table class="tableRegister">
                                    <tr>
                                        <td width="120px">Email: <span class="spanRequiredField">*</span></td>
                                        <td width="330px"><input id="txtEmail" name="txtEmail" type="text" size="30" required=""/></td>
                                    </tr>
                                    <tr>
                                        <td>Mật khẩu: <span class="spanRequiredField">*</span></td>
                                        <td><input type="password" id="txtPassword" name="txtPassword" size="30" required=""/></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input id="btnSubmit" type="submit" value="Đăng nhập"/>
                                            <input id="btnReset" type="reset" value="Nhập lại"/>
                                        </td>
                                    </tr>
                                </table>
                                </form>
                                <?php
                                    if ($loginResult===LOGIN_INCORRECT) {
                                ?>
                                    <p class="pResultLogin">Thông tin đăng nhập không chính xác.</p>
                                <?php
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
