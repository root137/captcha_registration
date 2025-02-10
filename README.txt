USER REGISTRATION SYSTEM
This system is designed to provide secure user registration and protect user information. It is developed using HTML, CSS, JavaScript, PHP, and MySQL with XAMPP.


System Requirements:
XAMPP
Web browser (Chrome, Firefox, Safari, etc...)


Features:
User login: User can login to the system with email and password.
User Interface: A user-friendly interface is provided to prompt the user to create an account by providing their username and password.
Password Strength Algorithm: The system algorithmically determines the strength of the chosen password by the user. The strength of the password is measured based on various criteria such as length, complexity, and randomness.
Feedback for Password Strength: The system provides suitable feedback to the user about the strength of their password. Based on the strength criteria, the system may display a message such as "Strong Password", "Weak Password", or "Password must be at least 8 characters long and contain uppercase, lowercase, special and numeric characters".
User Validation: validates user if the username and email already exists.
Captcha Implementation: To ensure that registration requests are made by human users rather than bots, a captcha function is implemented. The system uses Google reCAPTCHA to validate the registration request. The user will be prompted to complete the captcha challenge by identifying the images or answering a question.


Password Policy: 
The system implements a robust password policy to ensure password security. The password policy includes the following criteria:
Passwords must be at least 8 characters long.
Passwords must contain at least one uppercase letter, one lowercase letter, and one numeric character.
Passwords cannot be the same as the username or contain repeating characters.
Passwords are encrypted using SHA-256 before being stored in the database.

Installation Instructions:
Install XAMPP on your local machine.
Store the project folder to the XAMPP htdocs folder.
Start the Apache and MySQL servers in XAMPP.
Open a web browser and navigate to "http://localhost/login_sys".
The system is ready to use.
