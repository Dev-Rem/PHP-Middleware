
<?php
            include("db_connection.php");
            session_start();
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                header("location: protected.php");
                exit;
            }
            $email = $password = "";
            $emailErr = $passwordErr = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if(empty(trim($_POST["email"]))){
                    $emailErr = "Please enter the email address you used to sign up.";
                } else{
                    $email = trim($_POST["email"]);
                }

                // Check if password is empty
                if(empty(trim($_POST["password"]))){
                    $passwordErr = "Please enter your password.";
                } else{
                    $password = trim($_POST["password"]);
                }
                if(empty($emailErr) && empty($passwordErr)){
                    // Prepare a select statement
                    $sql = "SELECT email, password FROM users WHERE email='$email';";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $email = $row['email'];
                    $count = mysqli_num_rows($result);
                    if($count == 1) {
                        if(password_verify($password, $row['password'])){
                            // Password is correct and valid, create new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["email"] = $email;                          
                            
                            // Redirect user to protected page
                            header("location: protected.php");
                            exit();
                        } else{
                            $passwordErr = "The password you entered was not valid.";
                        }
                    }else {
                        $error = "Your Login Name or Password is invalid";
                    }
                }   
            // Close connection
            mysqli_close($conn);              
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
                <form action"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
                <fieldset>
                    <legend>Log In</legend>
                    <div class="form-group <?php echo (!empty($emailErr)) ? 'has-error' : ''; ?>">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <span class="help-block"><?php echo $emailErr; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($passwordErr)) ? 'has-error' : ''; ?>">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                        <span class="help-block"><?php echo $passwordErr; ?></span>
                    </div>
                </fieldset>
                <input type="submit" value="Log In">
                <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
            </form>
            </div> 
        </div>    
    </body>
</html>


