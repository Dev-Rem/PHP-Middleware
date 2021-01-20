<?php

    include("db_connection.php");
    $emailErr = $passwordErr = $password2Err = $firstErr = $lastErr = "";
    $email = $password = $password2 = $firstname = $lastname = "";

    // The preg_match() function searches a string for pattern, returning true if the pattern exists, and false otherwise.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Validates email
        if (empty($_POST["email"])) {
            $emailErr = "You Forgot to Enter Your Email!";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address syntax is valid
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
                $emailErr = "You Entered An Invalid Email Format"; 
            }
        }
        //Validates password & confirm passwords.
        if(!empty($_POST["password1"]) && ($_POST["password1"] == $_POST["password2"])) {
            $password1 = test_input($_POST["password1"]);
            $password2 = test_input($_POST["password2"]);
            if (strlen($_POST["password1"]) <= '8') {
                $passwordErr = "Your Password Must Contain At Least 8 Characters!";
            }
            elseif(!preg_match("#[0-9]+#",$password1)) {
                $passwordErr = "Your Password Must Contain At Least 1 Number!";
            }
            elseif(!preg_match("#[A-Z]+#",$password1)) {
                $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
            }
            elseif(!preg_match("#[a-z]+#",$password1)) {
                $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
            } else {
                $password2Err = "Please Check You've Entered Or Confirmed Your Password!";
            }
            $hash_password = password_hash($password1, PASSWORD_DEFAULT);
        }
        //Validates Firstname
        if (empty($_POST["firstName"])) {
            $firstErr = "You Forgot to Enter Your First Name!";
        } else {
            $firstName = test_input($_POST["firstName"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
                $firstErr = "Only letters and white space allowed"; 
            }
        }
        //Validates Lastname
        if (empty($_POST["lastName"])) {
                $lastErr = "You Forgot to Enter Your Last Name!";
            } else {
                $lastName = test_input($_POST["lastName"]);
                //Checks if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
                    $lastErr = "Only letters and white space allowed"; 
                }
            }
        
        // Prepare sql query
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName' , '$lastName', '$email', '$hash_password' );";
        
        // Execute query and redirect to protected.php
        if (mysqli_query($conn, $sql)) {
            header("Location: http://localhost:8000/login.php" );
            exit();
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        mysqli_close($conn);
    }
    // Check and clean variables
    function test_input($data) {
        $data = trim($data);
        return $data;
    }
?>

<!doctype html>
<html lang="en">
     <head>
        <title>

        </title>   
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </nav>
        
        <div class="flex-container">
            <div class="card-container">
                <form action"signup.php" method="POST" >
                <fieldset>
                    <legend>Sign Up</legend>
                     <div class="form-group">
                        <label for="firstName">First name</label>
                        <input type="text" id="firstName" class="form-control" name='firstName' placeholder="First name...">
                    </div>
                     <div class="form-group">
                        <label for="lastName">Last name</label>
                        <input type="text" id="lastName" class="form-control" name="lastName"  placeholder="Last name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password1" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" name="password2" id="exampleInputPassword1" placeholder="Confirm password">
                    </div>
                </fieldset>
                <input type="submit" value="SIgn Up">
                
            </form>
            </div> 
        </div>    
    </body>
</html>



