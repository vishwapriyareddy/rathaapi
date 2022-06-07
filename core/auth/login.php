<?php
require_once('../modules/auth.php');
session_start();

/* $token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token); */

$_SESSION['admin_token'] = null;

if (isset($_POST['admin_login'])) {

    $admin_id = $_POST['admin_id'];
    $admin_pass = md5($_POST['admin_pass']);
    $admin_status = AdminLogin($admin_id, $admin_pass);
    if ($admin_status !== 0) {
        $_SESSION["admin_id"] = $admin_id;
        // $_SESSION["admin_token"] = $token;
        header("location: ../admin/dashboard");
    } else {
        $admin_err_msg = 'Admin not found!';
    }
}

if (isset($_POST['user_login'])) {
    $user_id = $_POST['user_id'];
    $user_pass = md5($_POST['user_pass']);
    $user_status = UserLogin($user_id, $user_pass);
    if ($user_status !== 0) {
        $_SESSION["user_id"] = $user_id;
        header("location: ../user/dashboard");
    } else {
        $user_err_msg = 'User not found!';
    }
}

require('./components/header.php'); ?>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Admin Login</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">User Login</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form class="mb-3" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Admin_Id</label>
                                    <input type="email" class="form-control" id="admin-id" name="admin_id" placeholder="Enter_admin_id" autofocus required value="admin@pharma" />
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="admin-pass" class="form-control" name="admin_pass" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required value="admin" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <p class="text-danger"><?php if (isset($admin_err_msg)) {
                                                            echo $admin_err_msg;
                                                        } else {
                                                            echo '';
                                                        } ?></p>
                                <div class="my-4">
                                    <button class="btn btn-primary d-grid w-100" name="admin_login" type="submit">Authorize</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form class="mb-3" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="email" class="form-label">User_Id</label>
                                    <input type="email" class="form-control" id="email" name="user_id" placeholder="Enter_user_id" value="user@rathna" autofocus required />
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="user_pass" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" value="user" required />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <p class="text-danger"><?php if (isset($user_err_msg)) {
                                                            echo $user_err_msg;
                                                        } else {
                                                            echo '';
                                                        } ?></p>
                                <div class="my-4">
                                    <button class="btn btn-primary d-grid w-100" name="user_login" type="submit">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
<script>
    // $(function() {
    //     $('form').submit(function(e) {
    //         e.preventDefault();
    //         const admin_id = $('#admin-id').val();
    //         const admin_pass = $('#admin-pass').val();
    //         const admin = {
    //             'admin_id': admin_id,
    //             'admin_pass': admin_pass
    //         }
    //         $.ajax({
    //             type: "POST",
    //             url: "",
    //             data: admin,
    //             success: function() {
    //                 console.log(admin);
    //             }
    //         });
    //     });
    // });
</script>
<?php require('./components/footer.php');
