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
function getProductById($con, $productId) {
    $sql = "SELECT * FROM `watches` WHERE Id = '$productId'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) === 1) {
        $myWatches = mysqli_fetch_array($result);
        return $myWatches;
    }

    return '';
}
function deleteProductFromCart($productId) {
    unset($_SESSION['GuestCarts'][$productId]);
}

$cartProducts = array();
if (isset($_SESSION['GuestCarts'])) {
    $cartProducts = $_SESSION['GuestCarts'];
    
    if (isset($_GET['delete'])) {
        echo $_GET['delete'];
        ///unset($_SESSION['GuestCarts'][$_GET['delete']]);
        deleteProductFromCart($_GET['delete']);
    }
}

$addProductId = '';
$addProductQuantity = 0;
if (isset($_POST['txtProductQuantity'])) {
    $addProductId = $_POST['txtProductId'];
    $addProductQuantity = $_POST['txtProductQuantity'];
    if (!isset($cartProducts[$addProductId])) {
        $cartProducts[$addProductId] = intval($addProductQuantity);
    } else {
        $cartProducts[$addProductId] = $cartProducts[$addProductId] + intval($addProductQuantity);
    }

    $_SESSION['GuestCarts'] = $cartProducts;
}

?>

<!doctype html>
<html>
    <!-- Head HTML -->
    <head>
        <meta charset="utf-8">
        <title>Giỏ hàng của bạn</title>
        <link href="styles/site.css" rel="stylesheet" type="text/css">
        <link href="styles/guestcart.css" rel="stylesheet" type="text/css">
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
                            <p class="pPageTitle">Giỏ hàng của bạn</p>

                            <section>
                                <p>Bạn có <?php echo getCountProducts(); ?> món hàng trong giỏ hàng.</p>
                                <table class="tableCart" id="tableCart" border="1" cellpadding="5" cellspacing="0">
                                    <!-- Top Table -->
                                    <tr id="trTop_TableCart">
                                        <th width="200px">Sản phẩm</th>
                                        <th width="140px">Giá tiền</th>
                                        <th width="100px">Số lượng</th>
                                        <th width="140px">Thành tiền</th>
                                        <th width="80px">Xóa</th>
                                    </tr>
                                    <?php
                                    $total = 0.0;
                                    
                                    if (getCountProducts() > 0) {
                                        $products = $_SESSION['GuestCarts'];
                                        foreach ($products as $product) {
                                            $thisWatches = getProductById($con, array_search($product, $products));

                                            if ($thisWatches != '') {
                                                $total += floatval($thisWatches['Price'])*floatval($product);
                                                ?>
                                                <tr>
                                                    <td><a class="aContent" href="watches.php?id=<?php echo $thisWatches['Id']; ?>"><?php echo $thisWatches['CodeName']; ?></a></td>
                                                    <td><?php echo number_format(floatval($thisWatches['Price']), 0, ".", ",") . " VNĐ"; ?></td>
                                                    <td><?php echo $product; ?></td>
                                                    <td><?php echo number_format(floatval($thisWatches['Price']) * floatval($product), 0, ".", ",") . " VNĐ"; ?></td>
                                                    <td style="text-align: center"><a class="aContent" href="guestcart.php?delete=<?php echo $thisWatches['Id']; ?>">Xóa</a></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                    <tr id="trBottom_TableCart">
                                        <td colspan="3" style="text-align: right">Tổng cộng: </td>
                                        <td colspan="2" style="font-weight: bold"><?php echo number_format($total, 0, ".", ","); ?> VNĐ</td>
                                    </tr>
                                </table>
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
