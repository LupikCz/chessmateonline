<?php
require_once "DBconfig.php";
 
$username = $passwd = $confirm_passwd = "";
$username_err = $passwd_err = $confirm_passwd_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "You forgot to enter a username";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Only letters, numbers, and underscores can be used in username";
    } elseif(strlen(trim($_POST["username"]))>15){
        $username_err = "Username cant be longer than 15 characters";
    } else{
        $sql = "SELECT user__id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                print "\nError, please try again later.";
            }
            mysqli_stmt_close($stmt);
        } else{
            print "\nError, please try again later.";
        }
    }
    if(empty(trim($_POST["passwd"]))){
        $passwd_err = "You forgot to enter a password";     
    } elseif((strlen(trim($_POST["passwd"])) < 6)or(strlen(trim($_POST["passwd"])) > 20)){
        $passwd_err = "password must have between 6-20 characters.";
    } else{
        $passwd = trim($_POST["passwd"]);
    }
    if(empty(trim($_POST["confirm_passwd"]))){
        $confirm_passwd_err = "You forgot to confirm a password";     
    } else{
        $confirm_passwd = trim($_POST["confirm_passwd"]);
        if(empty($passwd_err) && ($passwd != $confirm_passwd)){
            $confirm_passwd_err = "password did not match.";
        }
    }
    if(empty($username_err) && empty($passwd_err) && empty($confirm_passwd_err)){
        $sql = "INSERT INTO users (username, passwd) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_passwd);
            $param_username = $username;
            $param_passwd = password_hash($passwd, PASSWORD_DEFAULT);
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                print "\nError, please try again later.";
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
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body style= "background-color: rgba(49,46,43,255);">
    <div class="text-center text-white fs-3 fst-italic text">
        <div style="width:15%;" class="mx-auto">
            <img src = "images/king.png" alt = "king" class = "img-thumbnail border-0" style = "background-color: rgba(49,46,43,255);">
        </div>
        <h1>Chess Mate</h1>
        <p>Just make an account and play!</p>   
    </div>
    <div class="row">
        <div class="col-4">
            <img src = "images/horse2.png" alt = "horse_login">
        </div>
        <div class="col-4">
            <div>
                <form style="background-color: rgba(39,37,34,255);"class="text-light pb-2 rounded mt-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row mb-4 justify-content-center g-3 align-items-center">
                        <div class="col-9">
                            <input type="text" placeholder="Username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class = "invalid-feedback"><?php echo $username_err;?></span>
                        </div>
                    </div>
                    <div class="row mb-4  justify-content-center g-3 align-items-center">
                        <div class="col-9">
                            <input type="password" placeholder="Password" name="passwd" class="form-control <?php echo (!empty($passwd_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $passwd; ?>">
                            <span class = "invalid-feedback"><?php echo $passwd_err;?></span>
                        </div>
                    </div>
                    <div class="row mb-4  justify-content-center g-3 align-items-center">
                        <div class="col-9">
                            <input type="password" placeholder="Confirm password" name="confirm_passwd" class="form-control <?php echo (!empty($confirm_passwd_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_passwd; ?>">
                            <span class = "invalid-feedback"><?php echo $confirm_passwd_err;?></span>
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-center">
                        <input style="width:100px;" class="btn btn-secondary width" type="submit" value="Submit">
                    </div>
                </form>
            </div>
            <p class = "mx-auto text-center mt-2 text-white">Already have an account? <a class = "link-info" href="login.php">Log in</a></p>
        </div>
        <div class="col-4">
            <img src = "images/horse.png" alt = "horse2_login" class = "d-none d-lg-block">
        </div>
    </div>
</body>
</html>