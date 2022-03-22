<?php
include '../include/config.php';
include '../include/session.php';
include 'my_query.php';

error_reporting(0);
if($_SESSION['id']==""){
    header('location:index.php');
}
if(isset($_POST['add_employee'])){    

    $status = $_POST['status'];

    $name = $_POST['emp_name'];

    $email = $_POST['emp_email'];

    $pass = sha1(md5($_POST['emp_name']));

    $table_name = 'employee';   
    
    if ($status=="add") {
        /**********************Add row********************/
        
        if(add_data($name,$email, $pass, $table_name)=="1"){
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Already!</strong> exist
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
        elseif(add_data($name,$email, $pass, $table_name)=="2") {
            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Successfully!</strong> added
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                header('location:manage_employee.php');
        }elseif(add_data($name,$email, $pass, $table_name)=="3"){
            $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Something!</strong> went wrong
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

        }
        /*************************************************/
    }elseif($status=="update"){
        /**********************Updating row****************/
        $emp_id = $_GET['u_id'];
        if(update_data($name,$email, $pass, $table_name, $emp_id)=="1"){
           
        $_SESSION['msg']='<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Successfully!</strong> updated
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
            header('location:manage_employee.php');
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong> to update
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
        /*************************************************/
    } 
     
}

//code for imployee update
    if(isset($_GET['u_id'])){
        $emp_id = $_GET['u_id'];
        $employee_datas = fetch_data('employee',$emp_id);
    }
    print_r($employee_datas);
    // exit();

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mentoring-html.dreamguystech.com/template/admin/form-horizontal.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Mar 2022 09:43:54 GMT -->

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Mentroid | <?php change_content(); ?> Employee</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/feathericon.min.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <div class="main-wrapper">

        <?php
            include 'includes/header.php';
            include 'includes/navbar.php';
        ?>

        <div class="page-wrapper">
            
            <div class="content container-fluid">
            <?php echo $msg;?>
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title"><?php change_content(); ?> Employee</h3>
                            
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?php change_content(); ?> Employee</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Inputs</h4>
                            </div>
                            <div class="card-body">
                                <form action="#" method="post" autocomplete="off">
                                    <input type="hidden" value = "<?php change_content(); ?>" name="status">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Name</label>
                                        <div class="col-md-10">
                                            <input type="text" name="emp_name" value="<?= $employee_datas[0]['name'] ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Email</label>
                                        <div class="col-md-10">
                                            <input type="email" name="emp_email" value="<?= $employee_datas[0]['email'] ?>" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Password</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control"  name="emp_password" autocomplete="off" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-0 row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary" name="add_employee">
                                            <?php change_content(); ?></button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from mentoring-html.dreamguystech.com/template/admin/form-horizontal.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Mar 2022 09:43:54 GMT -->

</html>
