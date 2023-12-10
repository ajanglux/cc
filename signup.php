<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'User already Exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'Password not Matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password) VALUES('$name','$email','$pass')";
         mysqli_query($conn, $insert);
         header('location:signin.php');
      }
   }

};


?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/7ae8808938.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Create Account | Explore Era</title>
    </head>

    <body>
        <img src="../Project/img/EEA2.png" class="logo">
            
            <hr style="height: 8%;">
            <p id="text">
                Welcome! <br>First things first...
            </p>

            <div class="account__container">
                <form action="" method="POST" class="account__wrap">
                    <h1>Create an Account</h1>
                    
                    <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">'.$error.'</span>';
                        };
                    };
                    ?>

                    <div class="account__box">
                        <input type="text" class="account__input" placeholder="Full Name" name="name" required />
                    </div>
                    <div class="account__box">
                        <input type="text" class="account__input" placeholder="Enter Email" name="email" required />
                    </div>
                    <div class="account__box">
                        <input type="password" class="account__input" placeholder="Password" name="password" required />
                    </div>
                    <div class="account__box">
                        <input type="password" class="account__input" placeholder="Confirm Password" name="cpassword" required>
                    </div>
                    <button class="button account__submit" name="submit">
                        <span class="button__text">Sign up</span>
                    </button>

                    <p id="haveacc">Already have an account?<a href="signin.php">Sign in</a></p> 
        
                    <div class="socmed">
                        <i class="fa-brands fa-facebook-f"><span style="padding-left: 20px;"></span></i>
                        <i class="fa-brands fa-instagram"><span style="padding-left: 20px;"></span></i>
                        <i class="fa-brands fa-google"><span style="padding-left: 20px;"></span></i>
                </div>
            </form>
    </body>
</html>