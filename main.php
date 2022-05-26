<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body  style= "background-color: rgba(49,46,43,255);">
    <div class="mt-3 text-center text-white fs-3 fst-italic text">
            <div style="width:15%;" class="mx-auto">
                <img src = "images/king.png" alt = "king" class = "img-thumbnail border-0" style = "background-color: rgba(49,46,43,255);">
            </div>
            <h1>Chess Mate</h1>  
    </div>
    <div class="row">
        <div class="col-4">
            <img src = "images/horse2.png" alt = "horse2_main">
        </div>
        <div class="col-4 container text-center" style="width:400px;">
            <div style="background-color: rgba(39,37,34,255);">
                <div style="height:96.66px;"class="row">
                    <form action="http://localhost:3000" class="col">
                        <input style="width:85px;height:85px;margin-top:15px;margin-left:25px;background-color:lightgray;" class="border rounded border-dark" type="submit" value="1+0"></form>
                    <form action="http://localhost:3000" class="col">
                        <input style="width:85px;height:85px;margin-top:15px;background-color:lightgray;" class="border rounded border-dark" type="submit" value="1+1"></form>
                    <form action="http://localhost:3000" class="col">
                        <input style="width:85px;height:85px;margin-top:15px;margin-right:25px;background-color:lightgray;" class="border rounded border-dark" type="submit" value="2+1"></form>
                </div>
                <div style="height:111.66px;" class="row">
                    <form action="http://localhost:3000" class="col">
                        <input style="width:85px;height:85px;margin-top:15px;margin-left:25px;background-color:lightgray;" class="border rounded border-dark" type="submit" value="3+0"></form>
                    <form action="http://localhost:3000" class="col">
                        <input style="width:85px;height:85px;margin-top:15px;background-color:lightgray;" class="border rounded border-dark" type="submit" value="3+2"></form>
                    <form action="http://localhost:3000" class="col">
                        <input style="width:85px;height:85px;margin-top:15px;margin-right:25px;background-color:lightgray;" class="border rounded border-dark" type="submit" value="5+3"></form>
                </div>
                <div style="height:121.66px;" class="row">
                    <form action="http://localhost:3000" class="col">
                        <input style="width:85px;height:85px;margin-left:25px;background-color:lightgray;" class="border rounded border-dark" type="submit" value="10+0"></form>
                    <form action="http://localhost:3000" class="col">
                        <input style="width:85px;height:85px;background-color:lightgray;" class="border rounded border-dark" type="submit" value="10+5"></form>
                    <form action="http://localhost:3000" class="col">
                        <input style="width:85px;height:85px;margin-right:25px;background-color:lightgray;" class="border rounded border-dark" type="submit" value="15+10"></form>
                </div>
                <div class="text-center">
                    <div class="border rounded" style="width:250px;margin-left:auto;margin-right:auto;background-color:lightgray;margin-bottom:15px;">
                        <strong class="text-black"><?php require_once "DBconfig.php";session_start(); echo $_SESSION['username'];?> (<?php $query = mysqli_query($link,"SELECT `elo` FROM `users` WHERE `username` = '".$_SESSION['username']."'");while ($row = $query->fetch_assoc()) {
                echo $row['elo'];}?>)</strong>
                    </div>
                    <div class="border rounded" style="width:250px;margin-left:auto;margin-right:auto;background-color:lightgray;">
                        <form method="get" action="logout.php">
                            <button style="padding: 0;border: none;background: none;" type="submit"><strong>Logout</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <img src = "images/horse.png" alt = "horse_main">
        </div>
    </div>
</body>
</html>