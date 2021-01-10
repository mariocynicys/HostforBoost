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
    <title>Register - HFB</title>
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
        <div class="card shadow-lg o-hidden border-0 my-5" style="background: rgb(255,255,255);">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <form class="user" action="assets\php\register.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="first_name_id" placeholder="First Name" name="first_name" autocomplete="off" required="" minlength="1" maxlength="20" pattern="^[A-Za-z ]{1,20}$" title="Must be from 1 to 20 chracters"></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text" id="last_name_id" placeholder="Last Name" name="last_name" autocomplete="off" required="" minlength="1" maxlength="20" pattern="^[A-Za-z ]{1,20}$" title="Must be from 1 to 20 chracters"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="user_name_id" placeholder="UserName" name="user_name" autocomplete="off" required="" maxlength="20" pattern="^[A-Za-z0-9 ]{1,20}$" title="Must be from 1 to 20 chracters and numbers"></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="email" id="email_id" placeholder="Email" name="email" inputmode="email" autocomplete="off" required="" pattern="^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="100"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><select class="custom-select" required="" style="border-radius: 150px;border-style: solid;height: 50px;" name="user_type">
                                            <option value="normal" selected="">Normal User</option>
                                            <option value="game_publisher">Game Publisher</option>
                                            <option value="program_publisher">Program Publisher</option>
                                        </select></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password" data-toggle="tooltip" data-bs-tooltip="" id="password_id" placeholder="Password" name="password" autocomplete="off" required="" minlength="8" maxlength="20" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></div>
                                </div><button class="btn btn-primary btn-block text-white btn-user" type="submit" name="register" value="register">Register Account</button>
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="login.php">Already have an account? Login!</a></div>
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