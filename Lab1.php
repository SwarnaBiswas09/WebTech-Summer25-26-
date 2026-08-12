<!DOCTYPE html>
<html>
<head>
<title>Student Registration Form</title>
</head>
<body>
<h2>Student Registration Form</h2>
<?php
// PHP VALIDATION LOGIC
$studentName = $username = $email = $phone = $age = "";
$studentID = $website = $dob = "";
$nameErr = $usernameErr = $emailErr = $phoneErr = "";
$ageErr = $passwordErr = $confirmPasswordErr = "";
$studentIDErr = $websiteErr = $dobErr = "";
$password = $confirmPassword = "";
$success = false;

// FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // --- Validate Full Name ---
   if (empty($_POST["studentName"])) {
       $nameErr = "Full Name is required";
   } else {
       $studentName = $_POST["studentName"];
       // Only letters and spaces
       if (!preg_match("/^[a-zA-Z ]+$/", $studentName)) {
           $nameErr = "Only letters and spaces allowed";
       } elseif (strlen($studentName) < 3) {
           $nameErr = "Full Name must contain at least 3 characters";
       } elseif (strlen($studentName) > 50) {
           $nameErr = "Full Name must not contain more than 50 characters";
       }
   }

   // --- Validate Username ---
   if (empty($_POST["username"])) {
       $usernameErr = "Username is required";
   } else {
       $username = $_POST["username"];
       // Only letters, numbers and underscore
       if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
           $usernameErr =
               "Only letters, numbers and underscore allowed";
       } elseif (strlen($username) < 5 || strlen($username) > 15) {
           $usernameErr =
               "Username must be between 5 and 15 characters";
       } elseif (!preg_match("/^[a-zA-Z]/", $username)) {
           $usernameErr =
               "Username must start with a letter";
       }
   }

   // --- Validate Email ---
   if (empty($_POST["email"])) {
       $emailErr = "Email is required";
   } else {
       $email = $_POST["email"];
       // Check email format
       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $emailErr = "Invalid email format";
       } elseif (!preg_match("/\.(com|org|edu)$/i", $email)) {
           $emailErr =
               "Email must end with .com, .org or .edu";
       }
   }

   // --- Validate Phone ---
   if (empty($_POST["phone"])) {
       $phoneErr = "Phone Number is required";
   } else {
       $phone = $_POST["phone"];
       // Only digits
       if (!preg_match("/^[0-9]+$/", $phone)) {
           $phoneErr = "Phone Number must contain digits only";
       } elseif (strlen($phone) != 11) {
           $phoneErr = "Phone Number must contain exactly 11 digits";
       } elseif (substr($phone, 0, 2) != "01") {
           $phoneErr = "Phone Number must start with 01";
       }
   }

   // --- Validate Age ---
   if (empty($_POST["age"])) {
       $ageErr = "Age is required";
   } else {
       $age = $_POST["age"];
       // First check numeric
       if (!is_numeric($age)) {
           $ageErr = "Age must contain a numeric value";
       } elseif ($age < 18 || $age > 30) {
           $ageErr = "Age must be between 18 and 30";
       }
   }

   // --- Validate Password ---
   if (empty($_POST["password"])) {
       $passwordErr = "Password is required";
   } else {
       $password = $_POST["password"];
       if (strlen($password) < 8) {
           $passwordErr =
               "Password must contain at least 8 characters";
       } elseif (!preg_match("/[A-Z]/", $password)) {
           $passwordErr =
               "Password must contain at least one uppercase letter";
       } elseif (!preg_match("/[0-9]/", $password)) {
           $passwordErr =
               "Password must contain at least one number";
       } elseif (!preg_match("/[@#$%]/", $password)) {
           $passwordErr =
               "Password must contain at least one of @, #, $, %";
       }
   }

   // --- Validate Confirm Password ---
   if (empty($_POST["confirmPassword"])) {
       $confirmPasswordErr =
           "Confirm Password is required";
   } else {
       $confirmPassword = $_POST["confirmPassword"];
       if ($confirmPassword != $password) {
           $confirmPasswordErr =
               "Passwords do not match";
       }
   }

   // --- Validate Student ID ---
   if (empty($_POST["studentID"])) {
       $studentIDErr = "Student ID is required";
   } else {
       $studentID = $_POST["studentID"];
       // Format XX-XXXXX-X
       if (!preg_match("/^[0-9]{2}-[0-9]{5}-[0-9]$/", $studentID)) {
           $studentIDErr =
               "Student ID must follow XX-XXXXX-X format";
       }
   }

   // --- Validate Personal Website ---
   if (empty($_POST["website"])) {
       $websiteErr = "Personal Website is required";
   } else {
       $website = $_POST["website"];
       if (!filter_var($website, FILTER_VALIDATE_URL)) {
           $websiteErr = "Invalid website URL";
       } elseif (
           strpos($website, "http://") !== 0 &&
           strpos($website, "https://") !== 0
       ) {
           $websiteErr =
               "Website must begin with http:// or https://";
       }
   }

   // --- Validate Date of Birth ---
   if (empty($_POST["dob"])) {
       $dobErr = "Date of Birth is required";
   } else {
       $dob = $_POST["dob"];
   }

   // Check if everything is valid
   if (
       empty($nameErr) &&
       empty($usernameErr) &&
       empty($emailErr) &&
       empty($phoneErr) &&
       empty($ageErr) &&
       empty($passwordErr) &&
       empty($confirmPasswordErr) &&
       empty($studentIDErr) &&
       empty($websiteErr) &&
       empty($dobErr)
   ) {
       $success = true;
   }
}
?>

<form method="post" action="">
   Full Name:
<input type="text"
          name="studentName"
          value="<?php echo htmlspecialchars($studentName); ?>">
<span style="color:red">
       * <?php echo $nameErr; ?>
</span>
<br><br>

   Username:
<input type="text"
          name="username"
          value="<?php echo htmlspecialchars($username); ?>">
<span style="color:red">
       * <?php echo $usernameErr; ?>
</span>
<br><br>

   Email Address:
<input type="text"
          name="email"
          value="<?php echo htmlspecialchars($email); ?>">
<span style="color:red">
       * <?php echo $emailErr; ?>
</span>
<br><br>

   Phone Number:
<input type="text"
          name="phone"
          value="<?php echo htmlspecialchars($phone); ?>">
<span style="color:red">
       * <?php echo $phoneErr; ?>
</span>
<br><br>

   Age:
<input type="text"
          name="age"
          value="<?php echo htmlspecialchars($age); ?>">
<span style="color:red">
       * <?php echo $ageErr; ?>
</span>
<br><br>

   Password:
<input type="password"
          name="password">
<span style="color:red">
       * <?php echo $passwordErr; ?>
</span>
<br><br>

   Confirm Password:
<input type="password"
          name="confirmPassword">
<span style="color:red">
       * <?php echo $confirmPasswordErr; ?>
</span>
<br><br>

   Student ID:
<input type="text"
          name="studentID"
          value="<?php echo htmlspecialchars($studentID); ?>">
<span style="color:red">
       * <?php echo $studentIDErr; ?>
</span>
<br><br>

   Personal Website:
<input type="text"
          name="website"
          value="<?php echo htmlspecialchars($website); ?>">
<span style="color:red">
       * <?php echo $websiteErr; ?>
</span>
<br><br>

   Date of Birth:
<input type="date"
          name="dob"
          value="<?php echo htmlspecialchars($dob); ?>">
<span style="color:red">
       * <?php echo $dobErr; ?>
</span>
<br><br>

<input type="submit" name="submit" value="Register">
</form>

<?php
// SUCCESS MESSAGE
if ($_SERVER["REQUEST_METHOD"] == "POST" && $success) {
   echo "<h3>Registration Successful!</h3>";
   echo "Full Name: " . htmlspecialchars($studentName) . "<br>";
   echo "Username: " . htmlspecialchars($username) . "<br>";
   echo "Student ID: " . htmlspecialchars($studentID) . "<br>";
   echo "Email Address: " . htmlspecialchars($email) . "<br>";
}
?>

<!--
htmlspecialchars() is used to safely display submitted user data.
Server-side validation is necessary because HTML validation can be bypassed.
Age numeric validation must happen before checking the age range.
Password validation checks the required length and characters before accepting it.
PHP validation makes sure submitted data is checked on the server.
-->
</body>
</html>
