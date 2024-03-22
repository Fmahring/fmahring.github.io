<?php

use JetBrains\PhpStorm\NoReturn;

function check_login($conn)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users_new where user_id = '$id' limit 1";

        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            return mysqli_fetch_assoc($result);
        }
    }

    //redirect to login
    header("Location: user-management/login_new.php");
    die;
}

function check_login_toolmanager($conn, $out)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users_new where user_id = '$id' limit 1";

        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            return mysqli_fetch_assoc($result);
        }
    }

    //redirect to login
    header("Location: $out user-management/login_new.php");
    die;
}

function random_num($length)
{
    $text = "";
    if ($length < 10) {
        $length = 10;
    }
    $chars = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9), ['#']);
    $max = count($chars) - 1;
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++) {
        $text .= $chars[rand(0, $max)];
    }
    return $text;
}


function login($mail, $password, $remember)
{
    global $conn;

    if(!empty($mail) && !empty($password) && !is_numeric($mail))
    {
        // read from database
        $query = "select * from users_new where primary_email LIKE '$mail' limit 1";
        $result = mysqli_query($conn, $query);

        if($result)
        {
            if(mysqli_num_rows($result) > 0)
            {
                if ($remember)
                {
                    setcookie('remember_mail', $mail, time() + 60*60*24);
                    setcookie('remember_password', $password, time() + 60*60*24);
                }
                else
                {
                    setcookie('remember_mail', $mail, false);
                    setcookie('remember_password', $password, false);
                }
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password_hash'] === $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    return true;
                }
            }
        }
    }

    return false;
}

#[NoReturn]
function alert($message)
{
    echo '<div id="custom-alert" class="custom-alert">';
    echo "<p>$message</p>";
    echo '</div>';
    echo '<style>
            .custom-alert {
                position: fixed;
                top: 25%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #fff;
                border: 2px solid #333;
                border-radius: 5px;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                z-index: 9999;
                cursor: pointer; /* Add cursor pointer to indicate its clickable */
            }
.custom-alert p {
    font-size: 18px;
                color: #333;
                margin: 0;
            }
          </style>';
    echo '<script>
document.getElementById("custom-alert").addEventListener("click", function() {
    this.style.display = "none";
});
            setTimeout(function(){
                document.querySelector(".custom-alert").style.display = "none";
            }, 2000); // Adjust the delay (in milliseconds) as per your preference
          </script>';
    die;
}




function reload_user_site()
{
    header("Location: user-site.php?tool_name=Dashboard");
    die;
}