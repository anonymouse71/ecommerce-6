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
function getUserByEmail($con, $userEmail) {
    $sql = "SELECT * FROM `users` WHERE Email = '$userEmail'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        return mysqli_fetch_array($result);
    }
    return '';
}

define('REGIS_DIDNOTREGIS', -1);
define('REGIS_SUCCESS', 0);
define('REGIS_INCORRECT', 1);
define('REGIS_FAIL', 2);
$regisResult = REGIS_DIDNOTREGIS;

$email = "null";
$password = "null";
$repeatpassword = "null";
$name = "null";

if (isset($_SESSION['userId']) && $_SESSION['userId'] != '') {
    header("Location: index.php");
} else {
    if (isset($_POST['btnSubmit'])) {
        $email = $_POST['txtEmail'];
        $password = $_POST['txtPassword'];
        $repeatpassword = $_POST['txtRepeatPassword'];
        $name = $_POST['txtName'];

        if ($password != $repeatpassword) {
            $regisResult = REGIS_INCORRECT;
        } else {
            $password = md5($password);
            $sql = "INSERT INTO `users` (`Email`, `Password`, `Name`, `CreateTime`) VALUES ('$email', '$password', '$name', CURRENT_TIME())";
            if (mysqli_query($con, $sql)) {
                $result = REGIS_SUCCESS;
                $myuser = getUserByEmail($con, $email);
                $_SESSION['userId'] = $myuser['Id'];
                $_SESSION['email'] = $myuser['Email'];
                $_SESSION['name'] = $myuser['Name'];
                
                header("Location: usercontrolGuest.php");
            } else {
                $regisResult = REGIS_FAIL;
            }
        }
    }
}
?>
<!doctype html>
<html>
    <!-- Head HTML -->
    <head>
        <meta charset="utf-8">
        <title>Đăng ký tài khoản</title>
        <link href="styles/site.css" rel="stylesheet" type="text/css">
        <link href="styles/register.css" rel="stylesheet" type="text/css">
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
                            <p class="pPageTitle">Đăng ký tài khoản</p>

                            <section>

                                    <form id="formRegister" action="" method="post">
                                        <table class="tableRegister">
                                            <tr>
                                                <td width="200px">Email: <span class="spanRequiredField">*</span></td>
                                                <td width="330px"><input name="txtEmail" type="text" size="30" required=""/></td>
                                            </tr>
                                            <tr>
                                                <td>Mật khẩu: <span class="spanRequiredField">*</span></td>
                                                <td><input name="txtPassword" type="password" size="30" required=""/></td>
                                            </tr>
                                            <tr>
                                                <td>Nhập lại mật khẩu: <span class="spanRequiredField">*</span></td>
                                                <td><input name="txtRepeatPassword" type="password" size="30" required=""/></td>
                                            </tr>
                                            <tr>
                                                <td>Họ tên: <span class="spanRequiredField">*</span></td>
                                                <td><input name="txtName" type="text" size="30" required=""/></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input name="btnSubmit" type="submit" value="Đăng ký"/>
                                                    <input name="btnReset" type="reset" value="Nhập lại"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>


                                <p class="pResultLogin">
                                    <?php
                                    if ($regisResult === REGIS_INCORRECT) {
                                        echo "Mật khẩu nhập đã không trùng khớp";
                                    } else {
                                        if ($regisResult === REGIS_FAIL) {
                                            echo "Đăng ký thất bại.";
                                        }
                                    }
                                    ?>
                                </p>
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
