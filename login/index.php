<?php
include_once('../layouts/guest/header.php');
$notif = isset($_GET['notif']) ? $_GET['notif'] : '';

?>
<div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <?php if($notif == 'success'){ ?>
                                        <span class="text-success">Registration Successful</span>
                                        <?php }elseif($notif == 'error'){ ?>
                                        <span class="text-danger">Registration Fail</span>
                                        <?php } ?>
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="post" action="../includes/service.php">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <input type="hidden" name="action" value="login">
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="../register">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
<?php
include_once('../layouts/guest/footer.php');
