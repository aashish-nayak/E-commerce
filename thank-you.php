<?php
include "admin/include/connect.php";
include "admin/include/functions.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = strip_tags(trim($name));
    $phone = $_POST['phone'];
    $phone = strip_tags(trim($phone));
    $email = $_POST['email'];
    $email = strip_tags(trim($email));
    $city = $_POST['city'];
    $city = strip_tags(trim($city));
    $query = $_POST['message'];
    $query = strip_tags(trim($query));
    $date  = date("Y-m-d");
    $result = mysqli_query($conn, "INSERT INTO enquiry(name,email,phone,enquiry,date,city)VALUES('$name','$email','$phone','$query','$date','$city')");


    $info = siteDetails();
    // Email Headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From:" . $name . '<' . $email . ">\r\n";

    $toinfo  = $info['e-mail-1'];
    $subject = 'Enquiry from Website';
    $body = "<b>Name:</b> " . $name . "<br>";
    $body .= "<b>Phone:</b> " . $phone . "<br>";
    $body .= "<b>Email:</b> " . $email . "<br>";
    $body .= "<b>Query:</b> " . $query . "<br>";
    mail($toinfo, $subject, $body, $headers);
}
if (isset($_POST['order-now'])) {
    // Billing Details 
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $zipcode = $_POST['zipcode'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    // Shipping Details 
    $s_fname = $_POST['s_fname'];
    $s_lname = $_POST['s_fname'];
    $s_address = $_POST['s_address'];
    $s_address2 = $_POST['s_address2'];
    $s_city = $_POST['s_city'];
    $s_state = $_POST['s_state'];
    $s_country = $_POST['s_country'];
    $s_zipcode = $_POST['s_zipcode'];
    $s_email = $_POST['s_email'];
    $s_phone = $_POST['s_phone'];
    $result = mysqli_query($conn, "INSERT INTO customers (name,email,phone,address,city,state,country,zipcode,password)VALUES('$fname $lname','$email','$phone','$address $address2','$city','$state','$country','$zipcode','$password')");
    if ($result) {
        $id = mysqli_insert_id($conn);
        if($_POST['s_fname']==""&&$_POST['s_lname']==""&&$_POST['s_zipcode']==""){
            $sql = "INSERT INTO shipping (customer_id,name,email,phone,address,city,state,country,zipcode)VALUES('$id','$fname $lname','$email','$phone','$address $address2','$city','$state','$country','$zipcode')";
        }else{
            $sql = "INSERT INTO shipping (customer_id,name,email,phone,address,city,state,country,zipcode)VALUES('$id','$s_fname $s_lname','$s_email','$s_phone','$s_address $s_address2','$s_city','$s_state','$s_country','$s_zipcode')";
        }
        $result2 = mysqli_query($conn, $sql);
    }
}
?>

<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <title>Thank You - Khaitan Orfin</title>
    <?php include "include/head-links.php"; ?>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            /* outline:1px solid ;*/
        }

        body {
            background: #ffffff;
            background: linear-gradient(to bottom, #ffffff 0%, #e1e8ed 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#e1e8ed', GradientType=0);
            height: 100%;
            margin: 0;
            background-repeat: no-repeat;
            background-attachment: fixed;

        }

        .wrapper-1 {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .wrapper-2 {
            padding: 30px;
            text-align: center;
        }

        .h1 {
            font-family: 'Kaushan Script', cursive;
            font-size: 8em;
            letter-spacing: 3px;
            color: #e31d24;
            margin: 0;
            margin-bottom: 20px;
        }

        .wrapper-2 p {
            margin: 0;
            font-size: 1.3em;
            color: #aaa;
            font-family: 'Source Sans Pro', sans-serif;
            letter-spacing: 1px;
        }

        .go-home {
            color: #fff;
            background: #e31d24;
            border: none;
            padding: 10px 50px;
            margin: 30px 0;
            border-radius: 30px;
            text-transform: capitalize;
            cursor: pointer;
            box-shadow: 0 10px 16px 1px rgba(174, 199, 251, 1);
        }

        .footer-like {
            margin-top: auto;
            background: #D7E6FE;
            padding: 6px;
            text-align: center;
        }

        .footer-like p {
            margin: 0;
            padding: 4px;
            color: #5892FF;
            font-family: 'Source Sans Pro', sans-serif;
            letter-spacing: 1px;
        }

        .footer-like p a {
            text-decoration: none;
            color: #5892FF;
            font-weight: 600;
        }

        @media (min-width:360px) {
            .h1 {
                font-size: 8em;
            }

            .go-home {
                margin-bottom: 20px;
            }
        }

        @media (min-width:600px) {
            .content {
                max-width: 1000px;
                margin: 0 auto;
            }

            .wrapper-1 {
                height: initial;
                margin: 0 auto;
                margin-top: 50px;
                box-shadow: 4px 8px 40px 8px rgba(88, 146, 255, 0.2);
            }

        }
    </style>
</head>

<body id="bg">
    <?php include "include/nav.php"; ?>
    <main id="content">
        <div class=content>
            <div class="wrapper-1" style="margin:50px auto;">
                <div class="wrapper-2">
                    <h1 class="h1">Thank you !</h1>
                    <p>
                        <?php if (isset($_POST['submit'])) { ?>
                            Dear <b><?php echo $name; ?></b>, Thank You for Contacting Us. We get back to you soon</b>.
                        <?php } ?></p>
                    <a href="<?= trimurl($env, 'index.php') ?>"><button class="go-home">
                            go home
                        </button></a>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "include/footer.php"; ?>
    <!-- Begin Fb's Quick View | Modal Area -->
    <?php include_once "include/model-popup.php"; ?>
</body>

</html>