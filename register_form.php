<?php

@include 'config.php';

if (isset($_POST['submit'])) {
    // storing data in database
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $captcha = $_POST['captcha'];
    $userTypedCaptcha = $_POST['userTypedCaptcha'];
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];


    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);
    // validation
    if (mysqli_num_rows($result) > 0) {

        $error[] = 'user already exist!';

    } else {

        if ($captcha != $userTypedCaptcha) {
            $error[] = 'Captcha didnot Match';
        } else {
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            setcookie("register-status", "Register Successful now login", time() + 360);
            header('location:login_form.php');
        }
    }

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="form-container">
        <!-- register user form -->
        <form action="" method="post">
            <h3>register now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
                ;
            }
            ;
            ?>
            <label for="name">Name</label>
            <input type="text" name="name" required placeholder="enter your name">
            <label for="email">Email</label>
            <input type="email" id="userTypes" name="email" required placeholder="enter your email">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="enter your password">
            <span id="password-error" class="error"></span>
            <label for="email">Confirm Password</label>
            <input type="password" id="confirm-password" name="cpassword" required placeholder="confirm your password">

            <span id="confirm-password-error" class="error"></span>
            <span id="password-match" class="success"></span>
            <label class="user-type" for="user">User Type</label>

            <select name="user_type">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <div class="form-group">
                <div class="captcha-img">
                    <input type="password" id="captcha" name="captcha">
                    <span class="captcha fancy-text"> </span>
                </div>
                <input class="input-captcha" type="text" name="userTypedCaptcha" placeholder="Enter captcha"
                    spellcheck="false" required>
            </div>
            <input type="submit" id="submit-btn" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="login_form.php">login now</a></p>
        </form>

    </div>
    <script>
        const captcha = document.querySelector(".captcha"),
            reloadBtn = document.querySelector(".reload-btn"),
            inputField = document.querySelector(".inputcaptcha"),
            checkBtn = document.querySelector(".check-btn"),
            statusTxt = document.querySelector(".status-text");
        var captchaText = "";
        var inputElement = document.getElementById("captcha");
        var inputtedValue = document.getElementById("userTypes");

        //storing all captcha characters in array
        let allCharacters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', '#',
            'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd',
            'e', 'f', 'g', 'h', '@', 'j', 'k', 'm', 'n', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x', 'y', '&', 'z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9
        ];

        function getCaptcha() {
            for (let i = 0; i < 6; i++) { //getting 6 random characters from the array
                let randomCharacter = allCharacters[Math.floor(Math.random() * allCharacters.length)];
                captchaText += `${randomCharacter}`;
                captcha.innerText += `${randomCharacter}`; //passing 6 random characters inside captcha innerText
            }
        }

        getCaptcha();
        inputElement.value = captchaText.trim();







        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('password-error');
        const confirmInput = document.getElementById('confirm-password');
        const confirmError = document.getElementById('confirm-password-error');
        const passwordMatch = document.getElementById('password-match');
        // Validate password on input
        passwordInput.addEventListener('input', () => {
            const password = passwordInput.value;
            let error = '';
            if (password.length < 8) {
                error = 'Password must be at least 8 characters long!';
            } else if (!password.match(/[a-z]/)) {
                error = 'Password must contain at least one lowercase letter!';
            } else if (!password.match(/[A-Z]/)) {
                error = 'Password must contain at least one uppercase letter!';
            } else if (!password.match(/[0-9]/)) {
                error = 'Password must contain at least one number!';
            } else if (!password.match(/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/)) {
                error = 'Password must contain at least one special character!';
            }
            passwordError.innerText = error;
        });
        // Validate password confirmation on input
        confirmInput.addEventListener('input', () => {
            const password = passwordInput.value;
            const confirm = confirmInput.value;
            let error = '';
            if (password !== confirm) {
                error = 'Passwords do not match';
                passwordMatch.innerText = '';
            } else {
                if (confirm != '') {
                    passwordMatch.innerText = 'Passwords matched!';
                }
            }
            confirmError.innerText = error;
        });
    </script>

</body>

</html>