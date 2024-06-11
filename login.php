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
<br />
<form name="login" action="action_login.php" method="POST">
   <table style="width: 100%;" border="0" style="margin-left: auto;margin-right: auto;">

      <tr>
         <td style="font-size:20px;">نام كاربري <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="text" style="text-align: left;" id="username" name="username" /></td>
      </tr>

      <tr>
         <td style="font-size:20px;">كلمه عبور <span style="color: red;">*</span></td>
         <td style="font-size:20px;"><input type="password" style="text-align: left;" id="password" name="password" /></td>
      </tr>

      <tr>
         <td ><br /><br /></td>
         <td><input type="submit" value="ورود" type="submit" value="ورود"  style="padding: 5px 27px 5px; border-radius: 5px; font-family:inherit; background-color:#26A69A " />&nbsp;&nbsp;&nbsp;<input type="reset" value="جديد" type="submit" value="ورود"  style="padding: 5px 27px 5px; border-radius: 5px; font-family:inherit; background-color:#26A69A " /></td>
      </tr>

   </table>
</form>


<?php
include ("includes/footer.php");
?>