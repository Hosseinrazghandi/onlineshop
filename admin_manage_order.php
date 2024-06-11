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

?>

<br />

<?php

$query = "SELECT * FROM orders";
$result = mysqli_query($link, $query);

?>

<table style="width: 100%; border-radius:20px;">



	<?php
	while ($row = mysqli_fetch_array($result)) {
		?>
		<tr bgcolor="<?php if ($row['state'] == '3')
			echo ("#FF3333");
		else
			echo ("#C7CAF1"); ?>">
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7;">كد سفارش</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7;">نام خریدار</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7;">نام محصول</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7;">تاریخ سفارش</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7;">تعداد سفارش</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7;">قيمت كالا</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7;">قیمت نهایی</td>
		</tr>
		<tr>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;"><?php echo ($row['id']) ?></td>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;">
				<?php
				$query = "SELECT * FROM users  WHERE username='{$row['username']}'";
				$result2 = mysqli_query($link, $query);
				$row_user = mysqli_fetch_array($result2);
				echo ($row_user['realname'])
					?>
			</td>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;">
				<?php
				$query = "SELECT * FROM products WHERE pro_code='{$row['pro_code']}'";
				$result2 = mysqli_query($link, $query);
				$row_product = mysqli_fetch_array($result2);
				echo ($row_product['pro_name'])
					?>
			</td>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;"><?php echo ($row['orderdate']) ?></td>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;"><?php echo ($row['pro_qty']) ?></td>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;">
				<?php echo ($row['pro_price']) ?>&nbsp; تومان
			</td>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;">
				<?php
				echo ($row['pro_qty'] * $row['pro_price']);
				?>
				&nbsp; تومان
			</td>
		</tr>
		<tr bgcolor="<?php if ($row['state'] == '3')
			echo ("#FF3333");
		else
			echo ("#C7CAF1"); ?>">
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7; text-align:center;">شماره تماس</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7; text-align:center;">آدرس</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7; text-align:center;">کد مرسوله پستی</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7; text-align:center;">وضعیت سفارش</td>
			<td style="border-radius: 10px; background-color:#6A1B9A; color:#E1BEE7; text-align:center;" colspan="3">ابزار مديريتی</td>
		</tr>
		<tr>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;"><?php echo ($row['mobile']) ?></td>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;"><?php echo ($row['address']) ?></td>
			<td style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;"><?php echo ($row['trackcode']) ?></td>
			<td style="background-color:#88FFC9; border-radius:10px; text-align:center;">
				<?php
				switch ($row['state']) {
					case 0:
						echo ("تحت بررسی");
						break;
					case 1:
						echo ("آماده برای ارسال");
						break;
					case 2:
						echo ("ارسال شده ");
						break;
					case 3:
						echo ("سفارش لغو شده است");
						break;
				}
				?>
			</td>

			<td colspan="3" style="border-radius: 10px; background-color:#E1BEE7; color:#6A1B9A; text-align:center;">
				</br>
				<b><a href="action_admin_manage_order.php?id=<?php echo ($row['id']) ?>&action=BARASI"
						style="text-decoration: none; background-color:#004D40; border-radius:10px; padding: 1px 50px 1px; margin-top:10px; margin-bottom:10px;">تحت
						بررسی</a></b>
				</br>
				</br>
				<b><a href="action_admin_manage_order.php?id=<?php echo ($row['id']) ?>&action=AMADEHERSAL"
						style="text-decoration: none; background-color:#004D40; border-radius:10px; padding: 1px 35px 1px; margin-top:10px; margin-bottom:10px;">آماده
						برای ارسال</a></b>

				</br>
				</br>
				<b><a href="action_admin_manage_order.php?id=<?php echo ($row['id']) ?>&action=ERSALSHODEH"
						style="text-decoration: none; background-color:#004D40; border-radius:10px; padding: 1px 50px 1px; margin-top:10px; margin-bottom:10px;">ارسال
						شده</a></b>
				</br>
				</br>
				<b><a href="action_admin_manage_order.php?id=<?php echo ($row['id']) ?>&action=LAGHV"
						style="text-decoration: none; color:#F00; background-color:#004D40; border-radius:10px; padding: 1px 35px 1px; margin-top:10px; margin-bottom:10px;">سفارش
						لغو شده</a></b>
				</br>
				</br>
			</td>
		</tr>

		<tr style="height: 45px;">
			<td colspan="7"></td>
		</tr>
		<?php
	}
	?>

</table>

<?php
include ("includes/footer.php");
?>