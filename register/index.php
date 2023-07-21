<?php
include_once('../layouts/guest/header.php'); ?>
<div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post" action="../includes/service.php">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="first_name" id="exampleFirstName"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="last_name" id="exampleLastName"
                                            placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail"
                                        placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <select name="status" class="form-control" id="status" style="border-radius: 10rem;height: 50px;" required>
                                        <option value="">Choise your Role</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" name="confirm_password" placeholder="Repeat Password" required>
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="register">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="../login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include_once('../layouts/guest/footer.php');
