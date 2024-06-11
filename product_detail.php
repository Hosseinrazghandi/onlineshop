<?php
include ("includes/header.php");


$link = mysqli_connect("localhost", "root", "", "shop_db");

if (mysqli_connect_errno())
    exit("خطای با شرح زير رخ داده است :" . mysqli_connect_error());

$pro_code=0;
if (isset($_GET['id']))
	 $pro_code=$_GET['id'];

$query = "SELECT * FROM products WHERE pro_code='$pro_code'";         

$result = mysqli_query($link, $query);     

?>

 <div style="width: 100%; padding: 10px; margin-left:auto; margin-right:auto; position:relative;" >

  
  <?php

    if ($row = mysqli_fetch_array($result)) {//در صورتی که رکورد وجود داشته باشد دستورات بدنه شرط اجرا می شود
  
   ?> 

  
	<div style=" border:none; vertical-align: top; text-align:center; margin-left:auto; margin-right:auto; position:absolute; left:-50px; top:-60px;" >

       <h4 style="color: #004D40; height: 20px; font-size:40px;"><?php echo ($row['pro_name']) ?></h4>
 
       <img src="images/products/<?php echo ($row['pro_image']) ?>" style="border-radius: 10px; border:2px solid #004D40; width:180; height:270px;" />
     
       <br/>

    قيمت  : <?php echo ($row['pro_price']) ?> &nbsp; تومان
    <br/>

    تعداد موجودي  : <span style="color:#C2185B;"><?php echo ($row['pro_qty']) ?></span>
    <br/>

     توضيحات  : <div style="color:#006064; margin-bottom:5px; width: 100%;"> <?php echo ($row['pro_detail']) ?> </div>

    <b><a href="order.php?id=<?php echo ($row['pro_code']) ?>" style="text-decoration: none; background-color:#004D40; padding-left:30px; padding-right:30px; border-radius:10px;">سفارش و خرید پستی</a></b>
    <br/><br/>
           
    </div>  
    
<?php
   
	  
}

?>  

</div>

<?php
include ("includes/footer.php");
?>
   
