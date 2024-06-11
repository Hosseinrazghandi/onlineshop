<?php
include ("includes/header.php");
//در صورتی که کاربر وارد شده به تارنما مدیر نباشد به صفحه اصلی منتقل شود 
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] ==
    "admin")) {
?>
<script type="text/javascript">
<!--
location.replace("index.php");	 // منتقل شود index.php به صفحه
-->
</script>
<?php
} // if پایان

if (!(isset($_GET['action']) && $_GET['action']=='DELETE')){
	
	//بررسی خالی نبودن فیلدهای نمون برگ اطلاعات کالا
	if (isset($_POST['pro_code']) && !empty($_POST['pro_code']) && isset($_POST['pro_name']) &&
		!empty($_POST['pro_name']) && isset($_POST['pro_qty']) && !empty($_POST['pro_qty']) &&
		isset($_POST['pro_price']) && !empty($_POST['pro_price']) && isset($_POST['pro_detail']) &&
		!empty($_POST['pro_detail'])) {

		$pro_code = $_POST['pro_code'];
		$pro_name = $_POST['pro_name'];
		$pro_qty = $_POST['pro_qty'];
		$pro_price = $_POST['pro_price'];
		$pro_image = basename($_FILES["pro_image"]["name"]);
		$pro_detail = $_POST['pro_detail'];


	} else
		exit("برخی از فیلد ها مقدار دهی نشده است");
	
}

$link = mysqli_connect("localhost", "root", "", "shop_db");//اتصال به پایگاه داده 

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

if (isset($_GET['action'])) {

    $id = $_GET['id'];
	
    switch ($_GET['action']) {
        case 'EDIT'://ویرایش اطلاعات محصول انتخابی
            $query = "UPDATE products SET
             pro_code='$pro_code',
             pro_name='$pro_name',
             pro_qty='$pro_qty',
             pro_price='$pro_price',
             pro_detail='$pro_detail'          
             WHERE pro_code='$id'";

            if (mysqli_query($link, $query) === true)
                echo ("<p style='color:green;'><b>محصول انتخاب شده با موفقيت ويرايش شد</b></p>");
            else
                echo ("<p style='color:red;'><b>خطا در ويرايش محصول</b></p>");
			
            break;
			
        case 'DELETE':
			$query = "SELECT pro_image  FROM products
             WHERE pro_code='$id'";
			$result=mysqli_query($link, $query);
			$row = mysqli_fetch_array($result);
			$pro_image=$row['pro_image'];
			
            $query = "DELETE  FROM products
             WHERE pro_code='$id'";

            if (mysqli_query($link, $query) === true){
                echo ("<p style='color:green;'><b>محصول انتخاب شده با موفقيت حذف شد</b></p>");
				unlink("images/products/".$pro_image);
			}
            else
                echo ("<p style='color:red;'><b>خطا در حذف محصول</b></p>");
			
            break;
			
    } //switch
    mysqli_close($link);// بستن اتصال
    include ("includes/footer.php");
    exit(); //جلوگیری از ادامه اجرای کدها
			
} //if


$target_dir = "images/products/";
$target_file = $target_dir . basename($_FILES["pro_image"]["name"]);//مسیر ارسال پرونده تصویری نام و پسوند
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);//جداسازی پسوند پرونده تصویری


$check = getimagesize($_FILES["pro_image"]["tmp_name"]);//اطلاعات پرونده در صورتی که تصویری باشد را بر می گرداند
if ($check !== false) {
    echo "پرونده انتخابی یک تصویر از نوع - " . $check["mime"] . " است  <br />";
    $uploadOk = 1;
} else {
    echo "پرونده انتخاب شده یک تصویر نیست  <br />";
    $uploadOk = 0;
}


if (file_exists($target_file)) {
    echo "پرونده ای با همین نام در سرویس دهنده میزبان وجود دارد  <br />";
    $uploadOk = 0;
}

if ($_FILES["pro_image"]["size"] > 500000) {
    echo "اندازه پرونده انتخابی بیشتر از 500 کیلوبایت است  <br />";
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !=
    "jpeg" && $imageFileType != "gif") {
    echo "فقط پسوندهای JPG, JPEG, PNG & GIF برای پرونده مجاز هستند  <br />";
    $uploadOk = 0;
}
//ارسال پرونده تصویری به سرویس دهنده میزبان
if ($uploadOk == 0) {
    echo "پرونده انتخاب شده به سرویس دهنده میزبان ارسال نشد <br />";
} else {
    if (move_uploaded_file($_FILES["pro_image"]["tmp_name"], $target_file)) {
        echo "پرونده " . basename($_FILES["pro_image"]["name"]) .
            " با موفقیت به سرویس دهنده میزبان انتقال یافت  <br />";
    } else {
        echo "خطا در ارسال پرونده به سرویس دهنده میزبان رخ داده است <br />";
    }
}
//درج مشخصات کالا در جدول محصولات پایگاه داده
if ($uploadOk == 1) {

    $query = "INSERT INTO products 
    (pro_code,
     pro_name,
     pro_qty,
     pro_price,
     pro_image,
     pro_detail) VALUES
      ('$pro_code',
       '$pro_name',
       '$pro_qty',
       '$pro_price',
       '$pro_image',
       '$pro_detail')";

    if (mysqli_query($link, $query) === true)
        echo ("<p style='color:green;'><b>کالا با موفقیت به انبار اضافه شد</b></p>");
    else
        echo ("<p style='color:red;'><b>خطا در ثبت مشخصات کالا در انبار</b></p>");
} else
    echo ("<p style='color:red;'><b>خطا در ثبت مشخصات کالا در انبار</b></p>");

mysqli_close($link);

include ("includes/footer.php");
?>
