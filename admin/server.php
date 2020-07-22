
    <?php
   


    $var_rand=123;

   
    if(!isset($_SESSION))
    {
        session_start();
    }

    $db= mysqli_connect("localhost", "root","","flight");

    if(isset($_POST['register'])){
        $username = $db -> real_escape_string($_POST['username']);
        $email = $db -> real_escape_string($_POST['email']);
        $password_1 = $db -> real_escape_string($_POST['pass']);
        $password_2 = $db -> real_escape_string($_POST['pass2']);
        $password= md5($password_1);
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password') ";
        mysqli_query($db,$sql);
        header('location: index2.php');
        
        
    }
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: index2.php');
    }
    if(isset($_POST['login_button'])){
        $username = $db -> real_escape_string($_POST['username']);
        $password_1 = $db -> real_escape_string($_POST['pass']);
        $password= md5($password_1);
        $query="SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($db,$query);
        if(mysqli_num_rows($result)==1){
            $_SESSION['username']=$username;
            header('location: home2.php');
        }
        else{
            echo "Nhi hua bro";
        }
    
    
    }
//        if(isset($_POST['show_flights'])){
//            $source= $db -> real_escape_string($_POST['source']);
//            $dest = $db -> real_escape_string($_POST['dest']);
//
//
//            $search="SELECT * FROM flights WHERE from_location='$source' AND to_location='$dest'";
//            $result_search = mysqli_query($db,$search);
//            if ($result_search->num_rows > 0) {
//
//                while($row = $result_search->fetch_assoc()) {
//                    echo "Flight Number: " . $row["flno"];
////                    echo "Flight Number: " . $row["flno"]. " - Duration: " . $row["time"]. "Departure Time:" . $row["departs"]."Departure Time:" . $row["departs"]."Arrival Time:" . $row["arrives"]. "<br>";
//                }
//            } else {
//                echo "0 results";
//            }
//
//
//        }
  


?>