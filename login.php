
<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: main.php");
    exit;
}
require_once "DBconfig.php";
$username = $passwd = "";
$username_err = $password_err = $login_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["passwd"]))){
        $password_err = "Please enter your password.";
    } else{
        $passwd = trim($_POST["passwd"]);
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT user__id, username, passwd FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $user__id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($passwd, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user__id"] = $user__id;
                            $_SESSION["username"] = $username;                            
                            header("location: main.php");
                        } else{
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Error. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body style= "background-color: rgba(49,46,43,255);">
    <div class="text-center text-white fs-3 fst-italic text">
        <div style="width:15%;" class="mx-auto">
            <img src = "images/king.png" alt = "king" class = "img-thumbnail border-0" style = "background-color: rgba(49,46,43,255);">
        </div>
        <h1>Chess Mate</h1>
        <p>Log in and you will win!</p>   
    </div>


    <div class="row">
        <div class="col-4">
            <img src = "images/horse2.png" alt = "horse_login">
        </div>
        <div class="col-4">
            <div>
                <?php if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                } ?>
                <form style="background-color: rgba(39,37,34,255);"class="need-validation text-light pb-2 rounded mt-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row mb-4 justify-content-center g-3 align-items-center">
                        <div class="col-9">
                            <input type="text" placeholder="Username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class = "invalid-feedback"><?php echo $username_err;?></span>
                        </div>
                    </div>
                    <div class="row mb-4  justify-content-center g-3 align-items-center">
                        <div class="col-9">
                            <input type="password" placeholder="**********" name="passwd" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $passwd; ?>">
                            <span class = "invalid-feedback"><?php echo $password_err;?></span>
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-center">
                        <input style="width:100px;" class="btn btn-secondary width" type="submit" value="Submit">
                    </div>
                </form>
            </div>
            <p class = "mx-auto text-center mt-2 text-white">Don't have an account? <a class = "link-info" href="index.php">Sign up now</a></p>
        </div>
        <div class="col-4">
            <img src = "images/horse.png" alt = "horse2_login" class = "d-none d-lg-block">
        </div>
    </div>
</body>
</html>