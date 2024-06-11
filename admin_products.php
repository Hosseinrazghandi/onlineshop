<?php
include ("includes/header.php");
if (
   !(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] ==
      "admin")
) {
   ?>
   <script type="text/javascript">

      location.replace("index.php");

   </script>
   <?php
}

$link = mysqli_connect("localhost", "root", "", "shop_db");

if (mysqli_connect_errno())
   exit("خطای با شرح زير رخ داده است :" . mysqli_connect_error());

$url = $pro_code = $pro_name = $pro_qty = $pro_price = $pro_image = $pro_detail = "";

$btn_caption = "افزودن كالا";
if (isset($_GET['action']) && $_GET['action'] == 'EDIT') {
   $id = $_GET['id'];
   $query = "SELECT * FROM products WHERE pro_code='$id'";
   $result = mysqli_query($link, $query);
   if ($row = mysqli_fetch_array($result)) {
      $pro_code = $row['pro_code'];
      $pro_name = $row['pro_name'];
      $pro_qty = $row['pro_qty'];
      $pro_price = $row['pro_price'];
      $pro_image = $row['pro_image'];
      $pro_detail = $row['pro_detail'];
      $url = "?id=$pro_code&action=EDIT";
      $btn_caption = "ويرايش كالا";

   }

}
?>

<br />
<form name="add_product" action="action_admin_products.php<?php if (!empty($url))
   echo ($url); ?>" method="POST" enctype="multipart/form-data">
   <table style="width: 100%;" border="0" style="margin-left: auto;margin-right: auto;">

      <tr>
         <td style="width: 22%; font-size:20px;">کد کالا <span style="color: red;">*</span></td>
         <td style="width: 78%; font-size:20px;"><input type="text" id="pro_code" name="pro_code"
               value="<?php echo ($pro_code) ?>" />
         </td>
      </tr>

      <tr>
         <td style="font-size:20px;">نام کالا <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="text" style="text-align: right;" id="pro_name" name="pro_name"
               value="<?php echo ($pro_name) ?>" /></td>
      </tr>

      <tr>
         <td style="font-size:20px;">موجودی کالا <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="text" style="text-align: left;" id="pro_qty" name="pro_qty"
               value="<?php echo ($pro_qty) ?>" /></td>
      </tr>

      <tr>
         <td style="font-size:20px;">قیمت کالا <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="text" style="text-align: left;" id="pro_price" name="pro_price"
               value="<?php echo ($pro_price) ?>" /> تومان </td>
      </tr>

      <tr>
         <td style="font-size:20px;">آپلود تصویر کالا <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="file" style="text-align: left;" id="pro_image" name="pro_image"
               size="30" />
            <?php if (!empty($pro_image))
               echo ("<img src='images/products/$pro_image' width='80' height='40' />"); ?>
         </td>
      </tr>

      <tr>
         <td style="font-size:20px;">توضیحات تکمیلی کالا <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><textarea id="pro_detail" name="pro_detail" cols="45" rows="10" wrap="virtual">
          <?php echo ($pro_detail) ?>
       </textarea></td>
      </tr>

      <tr>
         <td><br /><br /></td>
         <td><input type="submit" value="<?php echo ($btn_caption) ?>"
               style="padding: 5px 21px 5px; border-radius: 5px; font-family:inherit; background-color:#26A69A " />&nbsp;&nbsp;&nbsp;<input
               type="reset" value="جديد"
               style="padding: 5px 21px 5px; border-radius: 5px; font-family:inherit; background-color:#26A69A " /></td>
      </tr>

   </table>
</form>

<?php

$query = "SELECT * FROM products";
$result = mysqli_query($link, $query);

?>

<table style="width: 100%; border:none;  margin-bottom:30px;">
   <tr>
      <td style="border: 3px solid #009688; border-radius:10px; color:#bdd7d4; background-color:#004D40; ">كد كالا</td>
      <td style="border: 3px solid #009688; border-radius:10px; color:#bdd7d4; background-color:#004D40; ">نام كالا</td>
      <td style="border: 3px solid #009688; border-radius:10px; color:#bdd7d4; background-color:#004D40; ">موجودي كالا
      </td>
      <td style="border: 3px solid #009688; border-radius:10px; color:#bdd7d4; background-color:#004D40; ">قيمت كالا
      </td>
      <td style="border: 3px solid #009688; border-radius:10px; color:#bdd7d4; background-color:#004D40; ">تصوير كالا
      </td>
      <td style="border: 3px solid #009688; border-radius:10px; color:#bdd7d4; background-color:#004D40; ">ابزار مديريتي
      </td>
   </tr>

   <?php
   while ($row = mysqli_fetch_array($result)) {
      ?>
      <tr>
         <td style="border:3px solid #004D40; border-radius:10px; text-align:center;"><?php echo ($row['pro_code']) ?></td>
         <td style="border:3px solid #004D40; border-radius:10px; text-align:center;"><?php echo ($row['pro_name']) ?></td>
         <td style="border:3px solid #004D40; border-radius:10px; text-align:center;"><?php echo ($row['pro_qty']) ?></td>
         <td style="border:3px solid #004D40; border-radius:10px; text-align:center;">
            <?php echo ($row['pro_price']) ?>&nbsp; تومان</td>
         <td style="border:3px solid #004D40; border-radius:10px; text-align:center;"><img
               src="images/products/<?php echo ($row['pro_image']) ?>" width="150px" height="50px"
               style="border-radius: 10px;" /></td>
         <td style="border:3px solid #004D40; border-radius:10px; text-align:center;">
            <b><a href="action_admin_products.php?id=<?php echo ($row['pro_code']) ?>&action=DELETE"
                  style="text-decoration: none; color:#004D40;">حذف</a></b>
            &nbsp;|&nbsp;
            <b><a href="admin_products.php?id=<?php echo ($row['pro_code']) ?>&action=EDIT"
                  style="text-decoration: none; color:#004D40;">ويرايش</a></b>
         </td>
      </tr>
      <?php
   }
   ?>

</table>



<?php
include ("includes/footer.php");
?>