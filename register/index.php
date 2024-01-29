<?php
require '../assets/landing_page/internal_auth_check.php';
?>
<?php
define('TITLE', "Signup");
check_logged_out();
include '../assets/landing_page/header.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-lg-4">

            <form class="form-auth" action="includes/register.inc.php" method="post" enctype="multipart/form-data">

                <?php insert_csrf_token(); ?>

                <div class="text-center">
                    <img class="mb-1" src="../assets/images/logo.png" alt="" width="180">
                </div>
               

                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Create an Account</h6>

                <div class="text-center mb-3">
                    <small class="text-success font-weight-bold">
                        <?php
                            if (isset($_SESSION['STATUS']['signupstatus']))
                                echo $_SESSION['STATUS']['signupstatus'];

                        ?>
                    </small>
                </div>

                <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
                    <sub class="text-danger">
                        <?php
                            if (isset($_SESSION['ERRORS']['usernameerror']))
                                echo $_SESSION['ERRORS']['usernameerror'];

                        ?>
                    </sub>
                </div>

                <div class="form-group">
                    <label for="email" class="sr-only">Email address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                    <sub class="text-danger">
                        <?php
                            if (isset($_SESSION['ERRORS']['emailerror']))
                                echo $_SESSION['ERRORS']['emailerror'];

                        ?>
                    </sub>
                </div>
                <div class="form-group">
                    <label for="role" class="sr-only">Select Role</label>
                    <select name="role" id="role" class="form-control" >
                        <option value="user">User(Patient or Donor)</option>
                        <option value="Clinic">Clinic</option>
                        <option value="Lab">Lab</option>
                    </select>
                    
                </div>

                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group mb-4">
                    <label for="confirmpassword" class="sr-only">Confirm Password</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                    <sub class="text-danger mb-4">
                        <?php
                            if (isset($_SESSION['ERRORS']['passworderror']))
                                echo $_SESSION['ERRORS']['passworderror'];

                        ?>
                    </sub>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name='signupsubmit'>Signup</button>

               

            </form>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>



<?php
include '../assets/landing_page/footer.php';
?>