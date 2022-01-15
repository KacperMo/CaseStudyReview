<!DOCTYPE html>
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<?php
require_once "inc/connect.php";
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == true)) {
  header('Location: index.php');
  exit();
}
// Include config file
$_SESSION["error_message"] = "";
$error_message = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $first_name = strip_tags(trim($_POST["first_name"]));
  $last_name = strip_tags(trim($_POST["last_name"]));
  $user_email = strip_tags(trim($_POST["user_email"]));
  $user_college = strip_tags(trim($_POST["user_college"]));
  $password = strip_tags($_POST["password"]);

  $required = array(
    'first_name', 'last_name', 'user_email',
    'user_college', 'password'
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

    if ($mysqli_connection->connect_errno != 0) {
      $error_message = $error_message . "Blad polaczenia z baza danych" . $mysqli_connection->connect_errno . " opis " . $mysqli_connection->connect_error;
    } else {
      $sql_check_if_exist = "SELECT name FROM `logindata` where user_email=:user_email";
      $check_if_user_email_exists = $pdo->prepare($sql_check_if_exist);
      $check_if_user_email_exists->bindValue('user_email', $user_email, PDO::PARAM_STR);
      $execute_user_email_check_query = $check_if_user_email_exists->execute();

      $count_found_user_email = $check_if_user_email_exists->rowCount();
      //echo $execute_user_email_check_query;

      $date = date("Y-d-m");
      if ($count_found_user_email == 0 && $execute_user_email_check_query == 1) {
        $todayDate = date("Y.m.d");
        echo "<br> nie istnieje jeszcze taki mail";

        $sql_insert_login_data = "INSERT INTO `logindata`( `name`, `password`,`registration_date`,`user_email`) VALUES (:first_name, :password, :Date, :user_email)";
        $insert_login_data = $pdo->prepare($sql_insert_login_data);
        $insert_login_data->bindValue('first_name', $first_name, PDO::PARAM_STR);
        $insert_login_data->bindValue('password', $password, PDO::PARAM_STR);
        $insert_login_data->bindValue('Date', $date, PDO::PARAM_STR);
        $insert_login_data->bindValue('user_email', $user_email, PDO::PARAM_STR);
        $is_login_data_inserted = $insert_login_data->execute();


        //$last_id = $pdo->lastInsertId();

        $sql_if_no_user = "SELECT user_id FROM `logindata` where user_email=:user_email";
        $check_user_id = $pdo1->prepare($sql_if_no_user);
        $check_user_id->bindValue('user_email', $user_email, PDO::PARAM_STR);
        $check_user_id->execute();
        $user_id = $check_user_id->fetch()['user_id'];


        $last_id = $pdo->lastInsertId();

        $slq_insert_user_info = "INSERT INTO `users` (`user_id`, `name`, `surname`, `user_college`,`avatar`, `descriptions`, `registration_date`) VALUES (:user_id, :UserName, :surname, :user_college, :avatar, :descriptions, :registration_date)";
        $insert_user_info = $pdo2->prepare($slq_insert_user_info);
        $insert_user_info->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $insert_user_info->bindValue('UserName', $first_name, PDO::PARAM_STR);
        $insert_user_info->bindValue('surname', $last_name, PDO::PARAM_STR);
        $insert_user_info->bindValue('user_college', $user_college, PDO::PARAM_STR);
        $insert_user_info->bindValue('avatar', 'images/usr_avatar.png', PDO::PARAM_STR);
        $insert_user_info->bindValue('descriptions', '', PDO::PARAM_STR);
        $insert_user_info->bindValue('registration_date', $todayDate, PDO::PARAM_STR);
        $is_user_info_inserted = $insert_user_info->execute();

        foreach ($required as $field) {

          if (empty($field)) {
            $error = true;
            //echo "<br>brakuje -> ".$_POST[$field]."albo".$field." <-<br>";
          } else {
            //echo "Jest -".$field." - ".$_POST[$field]."<br>";
          }
        }
        if ($is_login_data_inserted && $is_user_info_inserted) {

          create_user_folder($user_id);

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
  mysqli_close($mysqli_connection);
  $pdo = null;
  header('Location: login.php');
}
function check_is_not_empty($name)
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
                    <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="Imie">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="last_name" id="last_name" placeholder="Nazwisko">
                  </div>
                </div>
                <div class="form-group">
                  <input type="user_email" class="form-control form-control-user" id="user_email" name="user_email" placeholder="user_email">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Hasło">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="Checkpassword" id="Checkpassword" placeholder="Powtórz hasło">
                  </div>

                </div>

                <div class="form-group row">
                  <input type="text" class="form-control form-control-user" id="user_college" name="user_college" placeholder="Uczelnia">
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