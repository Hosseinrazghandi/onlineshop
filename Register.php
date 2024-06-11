<?php
include ("includes/header.php");


if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true) {
   ?>
   <script type="text/javascript">

      location.replace("index.php");	

   </script>
   <?php
} 
?>
<script type="text/javascript">

   function check_empty() {
      var username = "";
      username = document.getElementById("username").value;
      if (username == "")
         alert('وارد کردن نام کاربری الزامی است');
      else {
         var r = confirm("از صحت اطلاعات وارد شده اطمینان دارید؟");
         if (r == true)
            document.register.submit();
      }
   }

</script>
<br />
<form name="register" action="action_register.php" method="POST">
   <table style="width: 100%;" border="0" style="margin-left: auto;margin-right: auto;">

      <tr>
         <td style="width: 40%; font-size:20px;">نام واقعي <span style="color: red;">*</span></td>
         <td style="width: 60%; font-size:20px;"><input type="text" id="realname" name="realname" /></td>
      </tr>

      <tr>
         <td style="font-size:20px;">نام كاربري <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="text" style="text-align: left;" id="username" name="username" /></td>
      </tr>

      <tr>
         <td style="font-size:20px;">كلمه عبور <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="password" style="text-align: left;" id="password" name="password" /></td>
      </tr>

      <tr>
         <td style="font-size:20px;">تكرار كلمه عبور <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="password" style="text-align: left;" id="repassword" name="repassword" /></td>
      </tr>

      <tr>
         <td style="font-size:20px;">پست الكترونيكي <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="text" style="text-align: left;" id="email" name="email" /></td>
      </tr>

      <tr>
         <td><br /><br /></td>
         <td>
            <input type="button" value="ثبت نام" onclick="check_empty()" style="padding: 5px 21px 5px; border-radius: 5px; font-family:inherit; background-color:#26A69A " />
            &nbsp;&nbsp;&nbsp;
            <input type="reset" value="جديد" style="padding: 5px 21px 5px; border-radius: 5px; font-family:inherit; background-color:#26A69A "/>
         </td>
      </tr>

   </table>
</form>


<?php
include ("includes/footer.php");
?>