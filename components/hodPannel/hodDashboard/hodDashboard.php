<?php
    session_start();
    include('../../../databaseconnection.php');
    $str="";
    $dept = $_SESSION["dept"];
    $authemail = $_SESSION['authemailHod'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }

?>
<?php
include '../navbar/navbar.php';
?>
<style>
    <?php
    include 'hod.css';
    ?>
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
    if(isset($_POST['but_update'])){
        if(isset($_POST['update'])){
            foreach($_POST['update'] as $updateid){
                $updateUser = "UPDATE stdforms SET 
                formstatus='Approved'
                WHERE id=".$updateid;
                mysqli_query($con,$updateUser);
                 
            }
             
        }
        
    }
    
?> 

<div class="table">
        <div class="table_header">
            <p>Approve Forms</p>
            <div class="search">
                <form method = "post">
                    <input class="input" type="text" name="search" placeholder="Search">
                    <input class="searchbtn" type="submit" name="submit">
                </form>
                <form method='post' action=''>
                <p><input type='submit' value='  Approve Forms  ' class="approvebtn" name='but_update'></p>    
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th><input type='checkbox'  id='checkAll' ></th>
                        <th>Sr No</th>
                        <th>Name of examination</th>
                        <th>Programme</th>                   
                        <th>Semister</th>     
                        <th>USN Number</th>     
                        <th>Name</th>       
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_POST["submit"])){
                $str = $_POST["search"];}
                  if($str == null){
                    $query = "SELECT * FROM `stdforms` where dept='$dept' and  formstatus=' ' order by id desc;";
                    $result = $con->query($query);
                            if ($result->num_rows > 0) 
                            {
                                $cnt=1;
                                while($row=$result->fetch_object()) {
                                        ?>
                                <?php
                                    echo  "       
                                        <tr>
                                            <td><input  type='checkbox' name='update[]' value='$row->id' ></td>
                                            <td>$cnt</td>
                                            <td>$row->name_of_exam</td>
                                            <td>$row->programme</td>
                                            <td>$row->sem</td>
                                            <td>$row->usn_number</td>
                                            <td>$row->name</td>
                                        </tr>";    
                                    ?>
                                <?php
                                $cnt=$cnt+1;
                                } 
                            }
                        }
                        else{
                            $query = "SELECT * FROM `stdforms` where dept='$dept' formstatus=' ' and usn_number like '%$str%' order by id desc;";
                            $result = $con->query($query);
                                    if ($result->num_rows > 0) 
                                    {
                                        $cnt=1;
                                        while($row=$result->fetch_object()) {
                                                ?>
                                        <?php
                                            echo  "       
                                                <tr>
                                                    <td><input  type='checkbox' name='update[]' value='$row->id' ></td>
                                                    <td>$cnt</td>
                                                    <td>$row->name_of_exam</td>
                                                    <td>$row->programme</td>
                                                    <td>$row->sem</td>
                                                    <td>$row->usn_number</td>
                                                    <td>$row->name</td>
                                                </tr>";    
                                            ?>
                                        <?php
                                        $cnt=$cnt+1;
                                        } 
                                    }
                        }
                ?>
                </tbody>
            </table>
        </div>
    </div>


     <script type="text/javascript">
            $(document).ready(function(){
                $('#checkAll').change(function(){
                    if($(this).is(':checked')){
                        $('input[name="update[]"]').prop('checked',true);
                    }else{
                        $('input[name="update[]"]').each(function(){
                            $(this).prop('checked',false);
                        }); 
                    }
                });
                $('input[name="update[]"]').click(function(){
                    var total_checkboxes = $('input[name="update[]"]').length;
                    var total_checkboxes_checked = $('input[name="update[]"]:checked').length;
 
                    if(total_checkboxes_checked == total_checkboxes){
                        $('#checkAll').prop('checked',true);
                    }else{
                        $('#checkAll').prop('checked',false);
                    }
                });
            });
        </script> 