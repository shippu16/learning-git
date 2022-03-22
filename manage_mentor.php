<?php
include '../include/config.php';
include '../include/session.php';
// error_reporting(0);
if($_SESSION['id']==""){
    header('location:index.php');
}
include 'my_query.php';
$mentor_datas = fetch_data('mentor_profile','');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Mentoring - Mentor List Page</title>

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

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">List of Mentor</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Mentor</li>
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
                                                <th>Mentor Name</th>
                                                <th>Course</th>
                                                <th>Member Since</th>
                                                <th>Earned</th>
                                                <th class="text-center">Account Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($mentor_datas as $key => $mentor_data) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.php" class="avatar avatar-sm me-2"><img
                                                            class="avatar-img rounded-circle"
                                                            src="assets/img/profiles/avatar-08.jpg"
                                                            alt="User Image"></a>
                                                        <a href="profile.php">James Amen</a>
                                                    </h2>
                                                </td>
                                                <td>Maths</td>
                                                <td>14 Jan 2019 <br><small>02.59 AM</small></td>
                                                <td>$3100.00</td>
                                                <td>
                                                    <div class="status-toggle d-flex justify-content-center">
                                                        <input type="checkbox" id="status_<?=$mentor_data['id']?>" class="check" checked>
                                                        <label for="status_<?=$mentor_data['id']?>" class="checktoggle">checkbox</label>
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

    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from mentoring-html.dreamguystech.com/template/admin/mentor.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Mar 2022 09:43:49 GMT -->

</html>