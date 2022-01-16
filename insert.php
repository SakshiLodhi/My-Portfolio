<?php
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$project = $_POST['project'];
//$message = $_POST['message'];

if (!empty($username)) || !empty($email)) ||  !empty($phone)) ||  !empty($project)) ||  !empty($message)) {
    $host = "localhost";
    $dbUsername = "student";
    $dbemail = "";
    $dbname = "youtube";

    //create conncetion 
    $conn = new mysqli('localhost','root','','test1');
   // $conn = new mysqli($host, $dbUsername, $dbemail, $dbname);

    if  (mysqli_conncet_error()){
        die('Connect Error('. mysqli_conncet_error().')'. mysqli_connect_error());
    } else{
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register (username, email, phone, project,) values(?, ?, ?, ?, ?,)";

        //prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->is_execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0){
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssii", $useranem, $email, $phone, $project, $message);
            $stmt->execute();
            echo "New record inserted successfully";
        }else
        {
            echo "Someone already register using this email";
        }$stmt->close();
        $conn->close();
    }
} else{
    echo "All field are required";
    die();
}
?>
