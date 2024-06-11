<?php

include ("includes/header.php");

$link = mysqli_connect("localhost", "root", "", "shop_db");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

$query = "SELECT * FROM products";

$result = mysqli_query($link, $query);


?>

<table style="width: 100%; margin-bottom:20px; height:100vh;">
    <tr>

        <?php

        $counter = 0;
        while ($row = mysqli_fetch_array($result)) {
            $counter++;
            ?>


            <td
                style=" background-color:rgba(238, 238, 238,0.51); vertical-align: top; width: 33%; padding: 10px; border-radius: 20px;  text-align: center; height:70px;">

                <h4 style="color: #004D40; height: 40px; font-size:30px;"><?php echo ($row['pro_name']) ?></h4>
                <a href="product_detail.php?id=<?php echo ($row['pro_code']) ?>" style="text-decoration: none;">
                    <img src="images/products/<?php echo ($row['pro_image']) ?>" width="250px" height="150px"
                        style="border-radius: 10px; " />
                </a>
                <br />

                قيمت : <?php echo ($row['pro_price']) ?> &nbsp; تومان
                <br />

                تعداد موجودي : <span style="color:#C2185B;"><?php echo ($row['pro_qty']) ?></span>
                <br />

                توضيحات : <div style="color:#00897B; height: 163px;"> <?php echo (substr($row['pro_detail'], 0, 230)) ?> ...
                </div>

                <br /><br />
                <b><a href="product_detail.php?id=<?php echo ($row['pro_code']) ?>"
                        style="text-decoration: none; background-color:#004D40; padding: 10px 75px 10px; border-radius:10px;">سفارش
                        دادن</a></b>
                <br /><br />

            </td>

            <?php
            if ($counter % 3 == 0)
                echo ("</tr><tr>");
        }
        
        if ($counter % 3 != 0)
            echo ("</tr>");

        ?>
</table>

<?php
include ("includes/footer.php"); 
?>