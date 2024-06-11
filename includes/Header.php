<?php
session_start();
?>
<!doctype html>
<html lang="fa" dir="rlt">

<head>
    <meta charset="UTF-8" />
    <title>گل فروشی ايرانيان</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
    <style type="text/css">
        .lalezar-regular {
            font-family: "Lalezar", system-ui;
            font-weight: 100;
            font-style: normal;
        }


        .divTableRow {
            display: table-row;
        }

        .divTableCell {
            display: table-cell;
            padding: 3px 10px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-image: linear-gradient(#004D40, #80CBC4);
            font-family: "Lalezar";
            display: flex;
            align-items: center;
            justify-content: center;
            background-attachment: fixed;
            background-size: cover;
            position: relative;
        }

        .divTable1 {
            direction: rtl;
            border: none;
            background-color: rgba(224, 224, 224, 0.3);
            border: 2px solid rgba(224, 224, 224, 0.3);
            box-shadow: 0 0 10px #607D8B;
            border-radius: 15px;
            display: table;
            width: 1024px;
            font-size: 13pt;
            margin-left: auto;
            margin-right: auto;
            overflow-y: scroll;
            height: 97vh;
        }

        h1::before {
            content: "❁⌒❁◡❁⌒❁◡❁⌒";
            right: -50px;
        }

        h1::after {
            content: " ⌒❁◡❁⌒❁◡❁⌒❁";
            left: -50px;
        }

        a:link {
            color: #bdd7d4;
        }

        a:visited {
            color: #bdd7d4;
        }

        a:hover {
            color: #C2185B;
            text-shadow: 0 0 10px rgba(216, 27, 96, 0.5);
        }

        .set_style_link {
            text-decoration: none;
            font-weight: bold;

        }
    </style>
</head>

<body>
    <div class="back" style="position:fixed; left: 75px; top: -60px; font-size:200px; color:#80CBC4;">❁</div>
    <div class="back" style="position:fixed; right: 75px; top: -60px; font-size:200px; color:#80CBC4;">❁</div>
    <div class="back" style="position:fixed; left: 0px; top: 120px; font-size:150px; color:#4DB6AC;">❁</div>
    <div class="back" style="position:fixed; right: 0px; top: 120px; font-size:150px; color:#4DB6AC;">❁</div>
    <div class="back" style="position:fixed; left: 15px; top: 215px; font-size:270px; color:#00796B;">❁</div>
    <div class="back" style="position:fixed; right: 15px; top: 215px; font-size:270px; color:#00796B;">❁</div>
    <div class="back" style="position:fixed; left: 8px; top: 450px; font-size:225px; color:#004D40;">❁</div>
    <div class="back" style="position:fixed; right: 8px; top: 450px; font-size:225px; color:#004D40;">❁</div>
    <div class="divTable1">
        <div class="divTableRow">
            <div class="divTableCell">
                <header class="divTable2">
                    <h1
                        style="font-size:40px; text-align:center; margin-left:auto; margin-right:auto; color:#006064; text-shadow:0 0 10px #009688; position:relative">
                        گل فروشی ایرانیان</h1>
                </header>
                <nav class="divTable" style="width:100%;">
                    <ul class="divTableRow"
                        style="text-align: center; width:100%; display: flex; justify-content: space-between; gap: 8px; list-style-type:none; padding:0px; padding-right: 10px; padding-left: 10px;background-color:#004D40; border-radius: 10px; ">
                        <li><a class="set_style_link" href="index.php" style="font-size:20px;">صفحه اصلی</a></li>
                        <li><a class="set_style_link" href="register.php" style="font-size:20px;">عضويت در
                                سايت</a>
                        </li>
                        <?php
                        if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true) {
                            ?>
                            <li><a href="logout.php" class="set_style_link" style="font-size:20px;">خروج از سایت
                                    <?php echo (" ({$_SESSION["realname"]}) ") ?></a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="login.php" class="set_style_link" style="font-size:20px;">ورود به سايت</a></li>
                            <?php
                        }
                        ?>

                        <li><a class="set_style_link" href="#" style="font-size:20px;">درباره ما</a></li>
                        <li><a class="set_style_link" href="contact.php" style="font-size:20px;">ارتباط با ما</a>
                        </li>

                        <?php
                        if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] == "admin") {
                            ?>
                            <li><a href="admin_products.php" class="set_style_link" style="font-size:20px;">مدیریت
                                    محصولات</a></li>
                            <li><a href="admin_manage_order.php" class="set_style_link" style="font-size:20px;">مدیریت
                                    سفارشات</a></li>
                            <?php
                        }
                        ?>

                    </ul>
                </nav>
                <section class="divTable">
                    <section class="divTableRow">
                        <aside class="divTableCell" style="width: 25%;">بخش امكانات سايت</aside>
                        <section class="divTableCell" style="width: 75%;">