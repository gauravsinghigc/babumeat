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
    <title> Verify Account | <?php echo APP_NAME; ?></title>

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
                            <h3 class="m-t-2 text-center"><?php echo $AdminVerifyPageString; ?></h3>
                            <hr>
                            <form role="form" action="../../../controller/authcontroller.php" method="POST">
                                <?php FormPrimaryInputs($url = true); ?>
                                <div class="form-group">
                                    <p><?php echo $AdminVerifyPassText; ?></p>
                                    <label for="inputUsernameEmail">Enter OTP</label>
                                    <input type="text" name="SubmittedOTP" value="" placeholder="* * * * * *" required="" class="form-control text-center otp-input" id="inputUsernameEmail">
                                </div>
                                <button type="submit" name="RequestAccountVerifications" class="btn btn btn-secondary btn-block p-2 fs-18">
                                    <i class="fa fa-check-circle-o fs-18 text-success"></i> Verify Account
                                </button>
                            </form>
                        </div>
                        <?php include '../../../include/admin/login-footer.php'; ?>
                    </div>
                </div>

            </div>
        </div>

        <?php include '../../../include/admin/footer_files.php'; ?>

</body>

</html>