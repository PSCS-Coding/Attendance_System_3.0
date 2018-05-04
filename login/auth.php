<?php
    require_once '../external/google-api-php-client/vendor/autoload.php';
    require_once '../backend/connection.php';

    if(!empty($_GET['out']) && $_GET['out'] == 'true') {
        setcookie("user", 'test', time() - 3600, "/");
        setcookie("login", 'test', time() - 3600, "/");
        die();
    }

    // Get $id_token via HTTPS POST.
    $id_token = $_GET['id_token'];

    $client = new Google_Client(['client_id' => '1049698629280-prai66q0v2fba7d4vp701jo6d4mb9kct.apps.googleusercontent.com']);
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
$client->setHttpClient($guzzleClient);
    $payload = $client->verifyIdToken($id_token);
    if ($payload) {
      $userid = $payload['sub'];
      if($_GET['ver'] == date('i') || $_GET['ver'] == (date('i') - 1)) {
        if(!empty($_GET["name"]) && !empty($_GET["imgurl"]) && !empty($_GET["email"])){
            //student table
            if(isset($_COOKIE['login'])) {
              setcookie("login", $_GET['imgurl'], time() - 3600, "/");
            }
            $studentQuery = $db->prepare("SELECT email from student_data");
            $studentQuery->execute();
            $name = explode(' ', $_GET['name']);
            $first = $name[0];
            $last = $name[1];
            $email = $_GET['email'];
            $result = Array();
            foreach ($studentQuery->get_result() as $row)
            {
              array_push($result, $row['email']);
            }
            //admin table
            $adminQuery = $db->prepare("SELECT email from admins");
            $adminQuery->execute();
            $adminResult = Array();
            foreach ($adminQuery->get_result() as $row)
            {
              array_push($adminResult, $row['email']);
            }
            if(in_array($email, $result)) {
              $imgurl = $_GET['imgurl'];
              $updateImage = $db->query("UPDATE student_data SET imgurl = '$imgurl' WHERE first_name = '$first' AND last_name = '$last'");
              $updateIdToken = $db->query("UPDATE student_data SET id_token = '$id_token' WHERE first_name = '$first' AND last_name = '$last'");

              $studentPriv = $db->query("SELECT priv FROM student_data WHERE first_name = '$first' AND last_name = '$last'");
              setcookie("user", $id_token, time() + (86400 * 5), "/");
              setcookie("imgurl", $imgurl, time() + (86400 * 5), "/");
              echo $studentPriv->fetch_array()[0];

            } elseif(in_array($email, $adminResult)) {
              $imgurl = $_GET['imgurl'];
              $updateImage = $db->query("UPDATE admins SET imgurl = '$imgurl' WHERE first_name = '$first' AND last_name = '$last'");
              $updateIdToken = $db->query("UPDATE admins SET id_token = '$id_token' WHERE first_name = '$first' AND last_name = '$last'");

              $adminPriv = $db->query("SELECT priv FROM admins WHERE first_name = '$first' AND last_name = '$last'");
              setcookie("user", $id_token, time() + (86400 * 5), "/");
              setcookie("imgurl", $imgurl, time() + (86400 * 5), "/");
              echo '3';
            } else {
              echo $adminPriv->fetch_array()[0];
            }
        }
      } else {
        setcookie("user", 'test', time() - 3600, "/");
        setcookie("login", 'test', time() - 3600, "/");
        echo 'bad verification';
      }
    } else {
      // Invalid ID token
      echo 'bad id token';
    }
?>