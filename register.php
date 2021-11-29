<!DOCTYPE html>
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<?php
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
  header('Location: index.php');
  exit();
}
// Include config file
require_once "connect.php";
$_SESSION["error_message"] = "";
$error_message = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $FirstName = strip_tags(trim($_POST["FirstName"]));
  $LastName = strip_tags(trim($_POST["LastName"]));
  $Email = strip_tags(trim($_POST["Email"]));
  $college = strip_tags(trim($_POST["college"]));
  $Password = strip_tags($_POST["Password"]);

  $required = array(
    'FirstName', 'LastName', 'Email',
    'college', 'Password'
  );

  // Loop over field names, make sure each one exists and is not empty
  $error = false;
  foreach ($required as $field) {
    if (empty($field)) {
      $error = true;
      $error_message = $error_message . "Uzupełnij " . $field;
      //echo "<br>brakuje -> ".$_POST[$field]."albo".$field." <-<br>";
    }
  }



  // Jeśli nie ma pustych pól to...
  if (!$error) {

    if ($polaczenie->connect_errno != 0) {
      $error_message = $error_message . "Blad polaczenia z baza danych" . $polaczenie->connect_errno . " opis " . $polaczenie->connect_error;
    } else {
      $sqlCheckIsExist = "SELECT name FROM `logindata` where email=:email";
      $CheckIsExistEmail = $pdo->prepare($sqlCheckIsExist);
      $CheckIsExistEmail->bindValue('email', $Email, PDO::PARAM_STR);
      $ExecuteEmailCheckQuery = $CheckIsExistEmail->execute();

      $countFoundedEmail = $CheckIsExistEmail->rowCount();
      //echo $ExecuteEmailCheckQuery;

      $date = date("Y-d-m");
      if ($countFoundedEmail == 0 && $ExecuteEmailCheckQuery == 1) {
        $todayDate = date("Y.m.d");
        echo "<br> nie istnieje jeszcze taki mail";

        $sqlInsertLoginData = "INSERT INTO `logindata`( `name`, `password`,`dateOfRegistration`,`email`) VALUES (:FirstName, :Password, :Date, :Email)";
        $InsertLoginData = $pdo->prepare($sqlInsertLoginData);
        $InsertLoginData->bindValue('FirstName', $FirstName, PDO::PARAM_STR);
        $InsertLoginData->bindValue('Password', $Password, PDO::PARAM_STR);
        $InsertLoginData->bindValue('Date', $date, PDO::PARAM_STR);
        $InsertLoginData->bindValue('Email', $Email, PDO::PARAM_STR);
        $isLoginDataInserd = $InsertLoginData->execute();


        //$lastId = $pdo->lastInsertId();

        $sqlIfNoUser = "SELECT IdOfUser FROM `logindata` where email=:email";
        $CheckUserID = $pdo1->prepare($sqlIfNoUser);
        $CheckUserID->bindValue('email', $Email, PDO::PARAM_STR);
        $CheckUserID->execute();
        $UserID = $CheckUserID->fetch()['IdOfUser'];


        $lastId = $pdo->lastInsertId();

        $sqlInsertUserInfo = "INSERT INTO `users` (`UserID`, `name`, `surname`, `college`,`avatar`, `descriptions`, `dateOfRegistration`) VALUES (:UserID, :UserName, :surname, :college, :avatar, :descriptions, :dateOfRegistration)";
        $InsertUserInfo = $pdo2->prepare($sqlInsertUserInfo);
        $InsertUserInfo->bindValue('UserID', $UserID, PDO::PARAM_INT);
        $InsertUserInfo->bindValue('UserName', $FirstName, PDO::PARAM_STR);
        $InsertUserInfo->bindValue('surname', $LastName, PDO::PARAM_STR);
        $InsertUserInfo->bindValue('college', $college, PDO::PARAM_STR);
        $InsertUserInfo->bindValue('avatar', 'images/usr_avatar.png', PDO::PARAM_STR);
        $InsertUserInfo->bindValue('descriptions', 'Cześć, jestem tu nowy :)', PDO::PARAM_STR);
        $InsertUserInfo->bindValue('dateOfRegistration', $todayDate, PDO::PARAM_STR);
        $isInserdUserInfo = $InsertUserInfo->execute();

        foreach ($required as $field) {

          if (empty($field)) {
            $error = true;
            //echo "<br>brakuje -> ".$_POST[$field]."albo".$field." <-<br>";
          } else {
            //echo "Jest -".$field." - ".$_POST[$field]."<br>";
          }
        }
        if ($isLoginDataInserd && $isInserdUserInfo) {
          mkdir("UsersFoldres/$Email");
          mkdir("UsersFoldres/$Email/Publications");
          
          mkdir("user_data/$userID");
          mkdir("user_data/$userID/images");

          header("Location: login.php");
          exit();
        } else {
          $error_message = $error_message . "<br>nie udało się dodać do bazy";
        }
      } else {
        $error_message = $error_message . "osoba juz istnieje ";
      }
    }
  } else {
    $error_message = $error_message . "Uzupełnij puste pola";
    //echo "<style>.card-body{border: 5px solid red; border-radius:0%;}</style>";
  }

  // Close connection
  $_SESSION["error_message"] = $error_message;
  mysqli_close($polaczenie);
  $pdo = null;
  header('Location: login.php');
}
function CheckIsNotEmpty($name)
{
  if (empty(trim($_POST[$name]))) {
    $checked = False;
  } else {
    $checked = True;
  }
  //zwrate boolen(true/false)
  return $checked;
}
$_POST = array();
?>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Chwal się wiedzą!</h1>
                <?php
                if (!empty($_SESSION['error_message']))
                  echo "  
                    <div class='col-md-12 col-sm-12 col-12'>
                        <div class='info-box'>                        
                    <span class='info-box-icon bg-warning'><i class='	fas fa-exclamation'></i></span>
                        <div class='info-box-content'><span class='info-box-text'>Wystąpił błąd podczas logowania</span>                  
                    <span class='info-box-number'> $_SESSION[error_message] </span>
                </div>
              <!-- /.info-box-content -->   
            </div>
            <!-- /.info-box -->
          </div>";
                ?>
              </div>
              <!--registration form    -->
              <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="FirstName" name="FirstName" placeholder="Imie">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="LastName" id="LastName" placeholder="Nazwisko">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="Email" name="Email" placeholder="Email">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="Password" id="Password" placeholder="Hasło">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="CheckPassword" id="CheckPassword" placeholder="Powtórz hasło">
                  </div>

                </div>

                <div class="form-group row">
                  <input type="text" class="form-control form-control-user" id="college" name="college" placeholder="Uczelnia">
                </div>
                <hr>
                <input type="submit" value="Rejestruj konto" class="btn btn-primary btn-user btn-block" />


                <!--
                    <a href="index.php" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Register with Google
                    </a>
                    <a href="index.php" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                    </a>
              </form> -->
                <!-- END OF registration form    -->
                <hr>
                <div class="text-center">
                  <!-- <a class="small" href="forgot-password.php">Zapomniałeś hasła?</a> -->
                </div>
                <div class="text-center">
                  <a class="small" href="login.php">Posiadasz już konto? Zaloguj się!</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>