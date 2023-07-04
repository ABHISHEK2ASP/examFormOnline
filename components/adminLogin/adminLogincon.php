<?php
 include('../../databaseConnection.php');  
 session_start();

 $email = $_POST['email']; 
 $_SESSION['email']=$email;
 $password = $_POST['password'];

 if($con->connect_error){
  die('Connection Failed : '.$con->connect_error);
}
else{
    $email = stripcslashes($email);  
    $password = stripcslashes($password);
    $email = mysqli_real_escape_string($con, $email);  
    $password = mysqli_real_escape_string($con, $password);
    $sql = "select * from adminlogin where email = '$email' and password = '$password'";  
    $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);
        if($count == 1){  
            $query = "SELECT * FROM `adminlogin` where email = '$email' and password = '$password'";
            $result1 = $con->query($query);
            $row=$result1->fetch_object();
            $role = $row->role;
            $dept = $row->dept;
            $id = $row->id;
            if($role == 'ADMIN'){
                $authemail = $row->email;
                $_SESSION['authemailadmin'] = "$authemail";
                header('Location: ../adminDashboard/dashboardPannel/dashboardPannel.php');
            }
            elseif($role == 'HOD'){
                $authemail = $row->email;
                $_SESSION['authemailHod'] = "$authemail";
                $_SESSION["dept"] = "$dept";
                $_SESSION["id"] = "$id";
                echo '<script>window.localStorage.setItem("lastname", "<?php echo $id?>");</script>';            
                header('Location: ../hodPannel/hodDashboard/hodDashboard.php');
            }
            elseif($role == 'EXAMDEPT'){
                $authemail = $row->email;
                $_SESSION['authemailexam'] = "$authemail";
                $_SESSION["idexam"] = "$id";
                header('Location: ../examinationDept/uploadExamDetails/uplaodExamDetails.php');
            }
        }  
        else{
            echo '<script>alert("Wrong Email Id OR Password ! [use sbjain offical id]")</script>';
            header('Refresh: 0.125; URL=adminLogin.php');    }
}
 ?>

