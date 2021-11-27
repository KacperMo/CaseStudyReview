<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Study Review - setup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <style>
        html, body{
            overflow-y:hidden;
            overflow-x:auto;
        }
        div.container{
            min-height:100vh;
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items:center;
            text-align:center;  
            margin: 0 4rem;
        }

        form label{
            text-align:left;
        }

        input.input{
            width:300px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="is-size-1 has-text-weight-bold">MYSQL Setup</h1>
        <form action="" method="post">
            <div class="field">
            <label class="label">IP address</label>
            <div class="control">
                <input name="ip" class="input" type="text" placeholder="IP address">
            </div>
            </div>
            <div class="field">
            <label class="label">Username</label>
            <div class="control">
                <input name="username" class="input" type="text" placeholder="Username">
            </div>
            </div>
            <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input name="password" class="input" type="password" placeholder="Password">
            </div>
            </div>
            <div class="field">
            <label class="label">Port</label>
            <div class="control">
                <input name="port" class="input" type="text" placeholder="Port (leave blank for 3306)">
            </div>
            </div>
            <div class="field">
            <input name='submit' type="submit" class="button is-success" value="Send">
    </div>  
        </form>
    <?php 
        error_reporting(0);
        include_once("../config/mysql.php");

        if(!$mysqlHasConfigured){
            if(isset($_POST['submit'])){
                $mysqlPort = (!isset($_POST['port'])) ? 3306 : $_POST['port'];

                $configFile = fopen("../config/mysql.php", "w") or die ("You have no permissions.");
                $configContent = "<?php\n\$mysqlIPAddress = \"{$_POST['ip']}\";\n\$mysqlUsername = \"{$_POST['username']}\";\n\$mysqlPassword = \"{$_POST['password']}\";\n\$mysqlPort = \"{$mysqlPort}\";\n\$mysqlHasConfigured = true;\n?>";
                fwrite($configFile, $configContent);
                fclose($configFile);

                header("Refresh: 0");
            }
        }
        
        else {
            $connection = new mysqli($mysqlIPAddress, $mysqlUsername, $mysqlPassword, "csr", intval($mysqlPort));

            if ($connection -> connect_error){
                echo "<article class='message ".((mysqli_connect_errno()==1049)? "is-link" : 'is-danger')."' style='margin-top:1rem;'>
                        <div class='message-header'>
                            <p>".((mysqli_connect_errno()==1049)? "Loading..." : 'Error!')."</p>
                        </div>
                        <div class='message-body'>".((mysqli_connect_errno()==1049)? "Setting up the database..." : "There seems to be an error with your mysql configuration. Complete the form once again to fix it. ");
                        
                switch(mysqli_connect_errno()){
                    case 2002:
                        echo "(IP address error).";
                        break;
                    case 1045:
                        echo "(Authorization error).";
                        break;
                    case 1049:
                        $connection = new mysqli($mysqlIPAddress, $mysqlUsername, $mysqlPassword, null, intval($mysqlPort));
                        $query = file_get_contents('../sql/main.sql');
                        $connection -> multi_query($query);
                        header('Refresh: 0');
                        break;
                    default:
                        echo "(Undefined error).";
                        break;
                }
                echo"</div>
                </article>";
            }
            
            else{
                header('Location: ../index.php');
            }

            if (isset($_POST['submit'])){
                $mysqlPort = (!isset($_POST['port'])) ? 3306 : $_POST['port'];

                $configFile = fopen("../config/mysql.php", "w") or die ("You have no permissions.");
                $configContent = "<?php\n\$mysqlIPAddress = \"{$_POST['ip']}\";\n\$mysqlUsername = \"{$_POST['username']}\";\n\$mysqlPassword = \"{$_POST['password']}\";\n\$mysqlPort = \"{$mysqlPort}\";\n\$mysqlHasConfigured = true;\n?>";
                fwrite($configFile, $configContent);
                fclose($configFile);
            }
        }
        echo "</div>";
    ?>
</body>
</html>