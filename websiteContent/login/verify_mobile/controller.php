<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE);
require ('textlocal.class.php');
include ('../../../passwords/db_access.php');

class Controller
{
    function __construct() {
        $this->processMobileVerification();
    }
    function processMobileVerification()
    {
        switch ($_POST["action"]) {
            case "send_otp":
                
                $mobile_number = $_POST['mobile_number'];
                
                $apiKey = urlencode('MqT9PkXuHHA-M1LZS6TJbHLaa8JZjjpmVYX7KGfFmW');
                $Textlocal = new Textlocal(false, false, $apiKey);
                
                $numbers = array(
                    $mobile_number
                );
                $sender = 'TXTLCL';
                $otp = rand(100000, 999999);
                $_SESSION['session_otp'] = $otp;
				$_SESSION['session_mobile_number'] = $mobile_number;
                $message = "Your One Time Password is " . $otp;
                
                try{
                    $response = $Textlocal->sendSms($numbers, $message, $sender);
                    require_once ("verification-form.php");
                    exit();
                }catch(Exception $e){
                    die('Error: '.$e->getMessage());
                }
                break;
                
            case "verify_otp":
                $otp = $_POST['otp'];              
                if ($otp == $_SESSION['session_otp']) {
					$mobile_number = $_SESSION['session_mobile_number'];
					$username = $_SESSION['username'];
								
					$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
					if (!$conn) {
					   die("Connection failed: " . mysqli_connect_error());
					}

					$query1 ="SELECT * FROM mobilenumber WHERE username='$username'";
					$result = mysqli_query($conn, $query1);
					if ($row = mysqli_fetch_assoc($result))
					{
						$db_status = $row['status'];
						if($db_status == 1){							
							$sql = "DELETE FROM mobilenumber WHERE username='$username'";
							mysqli_query($conn, $sql);						
						}					
					}		
					 $query = "INSERT INTO mobilenumber (username, mobnum, status) 
					 VALUES('$username', '$mobile_number', '1')";
					 mysqli_query($conn, $query);
	
                    unset($_SESSION['session_otp']);    
					echo json_encode(array("type"=>"success", "message"=>"Your mobile number is verified!"));
                } else {
                    echo json_encode(array("type"=>"error", "message"=>"Mobile number verification failed"));
                }
                break;
        }
    }
}
$controller = new Controller();
?>
