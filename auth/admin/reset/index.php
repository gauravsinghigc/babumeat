<?php
//require modolues
require '../../../require/modules.php';

//checklogin
if (isset($_SESSION['LOGIN_USER_ID'])) {
    header("location: " . DOMAIN . "/admin/dashboard");
    die("$DOMAIN/admin/dashboard");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <title> Reset Password | <?php echo APP_NAME; ?></title>

    <?php include '../../../include/admin/header_files.php'; ?>
</head>

<body>
    <div id="container" style="background-image:url('<?php echo STORAGE_URL_D; ?>/bg/app-bg.jpg');background-size:cover;">
        <!-- LOGIN FORM -->
        <!--===================================================-->
        <div class="lock-wrapper">
            <div class="row">
                <div class="col-xs-12">
                    <div class="lock-box">
                        <div class="main mb-1-pr pb-2">
                            <center>
                                <img src="<?php echo $MAIN_LOGO; ?>" class="config-logo rounded">
                            </center>
                            <h1 class="text-center m-t-3 m-b-5"><?php echo APP_NAME; ?></h1>
                            <h3 class="m-t-2 text-center"><?php echo $AdminResetPageString; ?></h3>
                            <hr>
                            <form role="form" action="../../../controller/authcontroller.php" method="POST">
                                <?php FormPrimaryInputs($url = true); ?>
                                <div class="form-group">
                                    <label for="inputUsernameEmail">New Password</label>
                                    <input type="password" name="Password1" value="" id="Pass1 required="" class=" form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputUsernameEmail">Re-Enter New Password</label>
                                    <input type="password" name="Password2" id="Pass2" value="" required="" class="form-control" oninput="CheckPassMatch()">
                                </div>
                                <button type="submit" name="RequestForPasswordChange" class="btn btn btn-secondary btn-block p-2 fs-18">
                                    <i class="fa fa-edit fs-18 text-success"></i> Change Password
                                </button>
                            </form>
                        </div>
                        <?php include '../../../include/admin/login-footer.php'; ?>
                    </div>
                </div>

            </div>
        </div>

        <script>
            function CheckPassMatch() {
                var Pass1 = document.getElementById("Pass1").value;
                var Pass2 = document.getElementById("Pass2").value;
                if (Pass1 != Pass2) {
                    document.getElementById("msg1").innerHTML = "<span class='text-danger'><i class='fa fa-warning'></i> Password Mismatch</span>";
                    document.getElementById("msg2").innerHTML = "<span class='text-danger'><i class='fa fa-warning'></i> Password Mismatch</span>";
                    document.getElementById("Pass1").style.borderColor = "red";
                    document.getElementById("Pass2").style.borderColor = "red";
                    document.getElementById("Pass1").style.backgroundColor = "rgba(255, 0, 0, 0.1)";
                    document.getElementById("Pass2").style.backgroundColor = "rgba(255, 0, 0, 0.1)";
                    document.getElementById("Pass1").style.color = "red";
                    document.getElementById("Pass2").style.color = "red";
                    document.getElementById("Pass1").style.boxShadow = "0 0 0 0.2rem rgba(255, 0, 0, 0.5)";
                    document.getElementById("Pass2").style.boxShadow = "0 0 0 0.2rem rgba(255, 0, 0, 0.5)";
                    document.getElementById("Pass1").style.transition = "0.5s";
                    document.getElementById("Pass2").style.transition = "0.5s";
                    document.getElementById("Pass1").style.borderRadius = "0.25rem";
                    document.getElementById("Pass2").style.borderRadius = "0.25rem";
                    document.getElementById("Pass1").style.fontSize = "1rem";
                    document.getElementById("btn").classList.add("disabled");
                } else {
                    document.getElementById("msg1").innerHTML = "";
                    document.getElementById("msg2").innerHTML = "";
                    document.getElementById("Pass1").style.borderColor = "green";
                    document.getElementById("Pass2").style.borderColor = "green";
                    document.getElementById("Pass1").style.backgroundColor = "rgba(0, 255, 0, 0.1)";
                    document.getElementById("Pass2").style.backgroundColor = "rgba(0, 255, 0, 0.1)";
                    document.getElementById("Pass1").style.color = "green";
                    document.getElementById("Pass2").style.color = "green";
                    document.getElementById("Pass1").style.boxShadow = "0 0 0 0.2rem rgba(0, 255, 0, 0.5)";
                    document.getElementById("Pass2").style.boxShadow = "0 0 0 0.2rem rgba(0, 255, 0, 0.5)";
                    document.getElementById("Pass1").style.transition = "0.5s";
                    document.getElementById("Pass2").style.transition = "0.5s";
                    document.getElementById("Pass1").style.borderRadius = "0.25rem";
                    document.getElementById("Pass2").style.borderRadius = "0.25rem";
                    document.getElementById("Pass1").style.fontSize = "1rem";
                    document.getElementById("btn").classList.remove("disabled");
                }
            }
        </script>
        <?php include '../../../include/admin/footer_files.php'; ?>

</body>

</html>