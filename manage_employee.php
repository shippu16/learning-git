<?php
include '../include/config.php';
include '../include/session.php';
error_reporting(0);
if($_SESSION['id']==""){
    header('location:index.php');
}
include 'my_query.php';
$employee_datas = fetch_data('employee');

//delete employee
if(isset($_POST['update_employee'])){
    $row_id = $_POST['row_id'];
    $deleted_emp = delete_data('employee',$row_id);
    if ($deleted_emp==1) {
        // header('location:manage_employee.php');
        $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Deleted !</strong> Successfully
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }else{
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show"  role="alert">
                <strong>Failed!</strong> to delete
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
    }
}

// Update Employee
if(isset($_POST['updated_emp_status'])){
    $row_id = $_POST['emp_id'];
    $status = $_POST['status'];
    $table_name = $_POST['table_name'];
    $result = update_data('','','',$table_name, $row_id, $status);
    
    echo $result;
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Employee List</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/feathericon.min.css">

    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

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
            <?php echo $_SESSION['msg']; unset($_SESSION['msg']);?>
		
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">List of Employee</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript:(0);">Employee</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="datatable table table-hover table-center mb-0">
                                        <thead>
                                        
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Email</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($employee_datas as $key => $employee_datas) {
                                        ?>
                                            <tr>
                                            <td><?='<b>'.$i++.'.</b> ' .$employee_datas['name']?></td>    
                                            <td><?= $employee_datas['email']?></td>
                                            <td>
                                                <div class="status-toggle d-flex justify-content-center">
                                                    <input type="checkbox" value="<?=$employee_datas['id']?>" id="status_<?=$employee_datas['id']?>" class="check" <?php
                                                    if ($employee_datas['status']==1) {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                                    <label for="status_<?=$employee_datas['id']?>" class="checktoggle">checkbox</label>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a class="btn btn-sm bg-success-light" href="add_employee.php?u_id=<?=$employee_datas['id']?>">
                                                        <i class="fe fe-pencil"></i>
                                                    </a>
                                                    <a data-bs-toggle="modal" onclick="delete_data(<?=$employee_datas['id']?>)" class="btn btn-sm bg-danger-light">
                                                        <i class="fe fe-trash"></i> 
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
        
        <div class="modal fade" id="delete_modal" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-content p-2">
                            <h4 class="modal-title">Delete</h4>
                            <form action="#" method="post">
                                <input type="hidden" id="row_id" value="" name="row_id" id="">
                                <p class="mb-4">Are you sure want to delete?</p>
                                <button type="submit" name="update_employee" class="btn btn-primary">Delete </button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>

    <script src="assets/js/script.js"></script>
    <script>
        function delete_data(id) {
            $('#row_id').val(id);
            $('#delete_modal').modal('show');
        }
        $('.check').on('change',function(){
            var row_id = $(this).val();
            var status = '';
            console.log(row_id);
            
            if ($(this).is(':checked')) {
                var status = 1;
            }else{
                var status = 0;
            }
            $.ajax({
                type: "POST",
                url: "manage_employee.php",
                data: {
                    emp_id : row_id,
                    status : status,
                    table_name : 'employee',
                    updated_emp_status : 'updated_emp_status' 
                },
                success:  function(data){
                    console.log(data);
                   if (data=="1") {
                       console.log('updated');
                   }else{
                        console.log('failed updated');
                   } 
                }
            });
           
        })
    </script>
</body>

<!-- Mirrored from mentoring-html.dreamguystech.com/template/admin/mentee.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Mar 2022 09:43:49 GMT -->

</html>