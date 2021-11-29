<!DOCTYPE html>
<html lang="pl">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<?php

session_start();
if (isset($_SESSION['blad']))
  echo $_SESSION['blad'];
if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
  header('Location: index.php');
  exit();
}


// Include config file
require_once "connect.php";
$_SESSION["error_message"] = "";


    

// Define variables and initialize with empty values
$userEmail = $password = "";
$userEmail_err = $password_err = "";

    
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $error_message = "";
    
    
  // Check if userEmail is empty
  if (empty(trim($_POST["userEmail"]))) {
    $error_message =$error_message. "Please enter username.";
  } else {
    $userEmail = trim($_POST["userEmail"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password"]))) {
    $password_err = $error_message."Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Jeśli nie ma pustych pól to...
  if (empty($userEmail_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT `IdOfUser`,`name`,`email`,`password` FROM logindata where email = ?";

    if ($stmt = mysqli_prepare($polaczenie, $sql) or die(mysqli_error($polaczenie))) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_userEmail);
        echo $userEmail;
      // Set parameters
      $param_userEmail = $userEmail;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
          echo"<br>execute";
        // Store result
        mysqli_stmt_store_result($stmt);
          echo "<br>select  where email like email ->". mysqli_stmt_store_result($stmt)." <-";

        // Check if userEmail exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $idOfUser, $userName, $userEmail, $hashed_password);
            
          echo "znaleziono ".$id;
          if (mysqli_stmt_fetch($stmt)) {
            if ($password == $hashed_password) {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["idOfUser"] = $idOfUser;
              $_SESSION["name"] = $userName;
              $_SESSION["userEmail"] = $userEmail;
              // new session vars
              $_SESSION['userID'] = $idOfUser;
              

              // Redirect user to welcome page
              header("location: index.php");
            } else {
              // Display an error message if password is not valid
               echo $password,"->",$hashed_password;
              if($password==$hashed_password){echo "<br>takie same";}
              else{echo "<br>różne";}
              $error_message = $error_message."The password you entered was not valid.";
            }
          }
        } else {
          // Display an error message if userEmail doesn't exist
          $error_message = $error_message."No account found with that username.";
        }
      } else {
        $error_message = $error_message."Oops! Something went wrong. Please try again later.";
      }
    }
      $_SESSION["error_message"] = $error_message;
    // Close statement
    mysqli_stmt_close($stmt);
  }

  // Close connection
  mysqli_close($polaczenie);
    $pdo=null;
    $_POST = array();
}




?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
                <!-- <img src="images/elements/Books.jpg"/> -->
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Witaj ponownie!</h1>
                  </div>




                  <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="on">


                    <div class="form-group">
                      <input type="login" class="form-control form-control-user" placeholder="Adres email" name="userEmail">
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" placeholder="Hasło" name="password" autocomplete="off">
                    </div>
                    <!--      
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck"></label>
                      </div>
                    </div>-->

                    <input type=submit href="index.php" class="btn btn-primary btn-user btn-block" value="Zaloguj">

                    <hr>
                    <a href="register.php" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Zarejestruj
                    </a>
                    <a href="remind.php" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Zapomniałeś hasła?
                    </a>
                  </form>




                  <hr>
                  <!-- <div class="text-center">
                    <a class="small" href="forgot-password.php">Zapomniałeś hasła?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php">Załóż konto!</a>
                  </div>-->
                  <!-- <p> <a href="index.php">Strona główna </a> </p> -->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendors/jquery/jquery.min.js"></script>
  <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendors/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>


</body>

</html>