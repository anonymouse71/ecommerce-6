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

function getUserById($con, $userId) {
    $sql = "SELECT * FROM `users` WHERE Id = '$userId'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_array($result);
    } else {
        return '';
    }
}
function getSex($sex) {
    if (intval($sex) === 0) {
        return "Nam";
    } else {
        return "Nữ";
    }
}

$user = '';
if (isset($_SESSION['userId'])) 
{
    $user = getUserById($con, $_SESSION['userId']);
} 
else {
    header("Location: login.php");
}

$result = NULL;
if (isset($_SESSION['userId'])) {
    if (isset($_POST['txtAddress'])) {
        $userId = $user['Id'];
        $userSex = $_POST['txtSex'];
        $userDoB = $_POST['txtDoB'];
        $userIdCard = $_POST['txtIdCard'];
        $userAddress = $_POST['txtAddress'];
        $userPhone = $_POST['txtPhone'];

        $sql = "UPDATE `users` SET `Sex`='$userSex', `DoB`='$userDoB', `IdCard`='$userIdCard', `Address`='$userAddress',`Phone`='$userPhone' WHERE Id='$userId'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $user = getUserById($con, $_SESSION['userId']);
        }
    }
}
?>
<!doctype html>
<html>
    <!-- Head HTML -->
    <head>
        <meta charset="utf-8">
        <title>Thông tin khách hàng</title>
        <link href="styles/site.css" rel="stylesheet" type="text/css">
        <link href="styles/usercontrolGuest.css" rel="stylesheet" type="text/css">
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
                            <p class="pPageTitle">Thông tin tài khoản</p>

                            <section>
                                <form id="formUpdateUserInfors" action="" method="post">

                                    <table>
                                        <tr>
                                            <td width="160px">Email: </td>
                                            <td><?php echo $user['Email']; ?></td>
                                        </tr> 
                                        <tr>
                                            <td>Họ tên: </td>
                                            <td><?php echo $user['Name']; ?></td>
                                        </tr> 
                                        <tr>
                                            <td>Giới tính: </td>
                                            <td>
                                                <input type="radio" name="txtSex" value="0" <?php if (intval($user['Sex'])===0) {echo "checked=''";} ?>/> Nam &nbsp;
                                                <input type="radio" name="txtSex" value="1" <?php if (intval($user['Sex'])!=0) {echo "checked=''";} ?>/> Nữ 
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>Ngày sinh: </td>
                                            <td>
                                                <input type="date" name="txtDoB" value="<?php echo $user['DoB']; ?>" required="" />
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>Chứng minh thư: </td>
                                            <td>
                                                <input type="text" name="txtIdCard" value="<?php echo $user['IdCard']; ?>" size="30" required="" />
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>Địa chỉ: </td>
                                            <td><input type="text" name="txtAddress" value="<?php echo $user['Address']; ?>" size="30" required="" /></td>
                                        </tr> 
                                        <tr>
                                            <td>Số điện thoại: </td>
                                            <td><input type="text" name="txtPhone" value="<?php echo $user['Phone']; ?>" size="30" required="" /></td>
                                        </tr> 
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" name="btnSubmit" value="Cập nhật" /> <input type="reset" name="btnReset" value="Nhập lại" /></td>
                                        </tr>
                                    </table>
                                </form>

                                <?php
                                if (isset($_SESSION['userId'])) {
                                    if (isset($_POST['txtAddress'])) {
                                        if ($result) {
                                ?>
                                    <p class="pResultLogin">Cập nhập thông tin thành công.</p>
                                <?php
                                        } else {
                                ?>
                                    <p class="pResultLogin">Cập nhập thông tin thất bại.</p>
                                <?php
                                        }
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
