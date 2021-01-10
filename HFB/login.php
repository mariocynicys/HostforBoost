<!DOCTYPE html>
<?php 

    include_once("assets/php/check_login.php");
    if(isset($_SESSION['username']) and isset($_SESSION['password'])){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        if(make_check($username, $password) == 1){
            if($_SESSION['type'] == "normal"){
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: views/normal/profile.php'); 
            }else if($_SESSION['type'] == "program_publisher"){
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: views/program_publisher/profile.php'); 
            }else if($_SESSION['type'] == "game_publisher"){
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: views/game_publisher/profile.php'); 
            }
        }
    }
    
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - HFB</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css">
</head>

<body class="text-center bg-gradient-primary" style="background: linear-gradient(-135deg,#c850c0,#4158d0);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                    </div>
                                    <form class="user" action="assets\php\login.php" method="POST">
                                        <div class="form-group"><input class="form-control form-control-user" type="text" id="user_name_id" placeholder="UserName" name="user_name" autocomplete="off" required="" maxlength="20" pattern="^[A-Za-z0-9 ]{1,20}$" title="Must be from 1 to 20 chracters and numbers"></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" data-toggle="tooltip" data-bs-tooltip="" id="password_id" placeholder="Password" name="password" minlength="8" maxlength="20" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div>
                                        </div><button class="btn btn-primary btn-block text-white btn-user" type="submit" name="login" value="login">Login</button>
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="#">Forgot Password?</a></div>
                                    <div class="text-center"><a class="small" href="register.php">Create an Account!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>