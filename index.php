<?php
include '../include/config.php';
include '../include/session.php';
error_reporting(0);
if ($_SESSION['id']!=""){
    header('location:dashboard.php');
  }
// if($_SESSION['id']!=""){

//     header('location:dashboard.php');

// }

if (isset($_POST['admin_login'])) {

        $email = ($_POST['email']);

        $pass = sha1(md5($_POST['password']));

        //echo sha1(md5(1234));
        //exit();

        $sql = "SELECT * FROM employee WHERE email='$email' AND password='$pass' AND profile = 1";

        $result = mysqli_query($CONN, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if($row['status']==1){

                $_SESSION['id'] = $row['id'];

                $_SESSION['name'] = $row['name'];
                
                $_SESSION['email'] = $row['email'];

                header("Location: dashboard.php");

                exit();

            }else{

                $msg = '<div class="alert alert-danger alert-dismissible fade show" id="admin_login_warning" role="alert">
                <strong>Deactivated!</strong> Your account is deactivated
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';

            }            

        }
        else {

            // header("Location: index.php?error=Incorect User name or password");
            $msg = '<div class="alert alert-danger alert-dismissible fade show" id="admin_login_warning" role="alert">
                <strong>Login failed!</strong> Please check email & password.
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';

        }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mentoring-html.dreamguystech.com/template/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Mar 2022 09:43:46 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Mentroid - Login</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <?php echo $msg; ?>
                <div class="loginbox">
                    
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            <form  method="post" action="#">
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block w-100"  name="admin_login" type="submit">Login</button>
                                </div>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from mentoring-html.dreamguystech.com/template/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Mar 2022 09:43:46 GMT -->

</html>