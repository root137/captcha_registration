<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
   //   error message for invalid email password
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

<!-- login form -->
   <form action="" method="post">
      <h3>login now</h3>
      <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
                ;
            }
            ;
            ?>
      <?php
      // login successful
      if(isset($_COOKIE["register-status"])){
         
            echo '<span class="success-msg" id="success-element" >'.$_COOKIE["register-status"].'</span>';
            setcookie("register-status","Register Successful now login",time()-360);

         
      };
      
      ?>
     
      <label for="email">Email</label>
      <input type="email" name="email" required placeholder="enter your email">
      <label for="password">Password</label>
      <input type="password" name="password" required placeholder="enter your password">
      <div class="g-recaptcha" data-sitekey="6LcKXVslAAAAADxLtXDL3u2ZhlY9TdobAFXrfkK_" data-callback="callback"></div>
      <input type="submit" id="submit-button" name="submit" value="login now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">register now</a></p>
   </form>
   <script type="text/javascript">
      function callback() {
        const submitButton = document.getElementById("submit-button");
        submitButton.removeAttribute("disabled");
      }
    </script>
   <script>
      // get the element you want to remove
const elementToRemove = document.getElementById("success-element");

// remove the element after 3 seconds
setTimeout(function() {
  elementToRemove.remove();
}, 3000);
   </script>

</div>

</body>
</html>