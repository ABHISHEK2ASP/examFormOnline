<?php
    session_start();
    include('../../../databaseconnection.php');
    $authemail = $_SESSION['authemailexam'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }
    $str = "";
?>


<?php
include '../navbar/navbar.php';
?>
<style>
    <?php
    include 'examDetails.css';
    ?>
</style>


<div class="conatinerbox">
    <label for="images" class="drop-container">
            <span class="drop-title">Upload Students Previous Sem Marks [In given Format]</span>
            <form class="" action="import.php" method="post" enctype="multipart/form-data">
                <select class="input-choice" name="sem" id="sem" required >
                             <option value="">Select Semester</a>
                             <option value="1">1</a>
                             <option value="2">2</a>
                             <option value="3">3</a>
                             <option value="4">4</a>
                             <option value="5">5</a>
                             <option value="6">6</a>
                             <option value="7">7</a>
                             <option value="8">8</a>
                </select>
                <input type="file" name="excel_file" accept=".csv" required>
                <button class="uploadbtn" type="submit" name="import" value="Import">Import</button>
            </form>	
    </label>
</div>



<div class="table">
        <div class="table_header">
            <p>Students Details</p>
            <div class="search">
                <form method = "post">
                    <input class="input" type="text" name="search" placeholder="Search">
                    <input class="searchbtn" type="submit" name="submit">
                </form>  
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>USN Number</th>
                        <th>Name</th>                   
                        <th>Email Id</th>     
                        <th>ABC Id</th>     
                        <th>University Enno</th>       
                        <th>Action</th>       
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_POST["submit"])){
                $str = $_POST["search"];}
                  if($str == null){
                    $query = "SELECT * FROM `stddetails` order by id desc;";
                    $result = $con->query($query);
                            if ($result->num_rows > 0) 
                            {
                                $cnt=1;
                                while($row=$result->fetch_object()) {
                                        ?>
                                <?php
                                    echo  "       
                                        <tr>
                                            <td>$cnt</td>
                                            <td>$row->usn_number</td>
                                            <td>$row->name</td>
                                            <td>$row->emailid</td>
                                            <td>$row->abc_id</td>
                                            <td>$row->unversity_enno</td>
                                            <td><button class='viewbtn'><a href='../viewForms/viewForms.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-eye-50.png' alt='deletelogo'></a></button>
                                                <button class='deletebtn'><a href='deleteUsercon.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-delete-48.png' alt='deletelogo'></a></button></td>
                                        </tr>";    
                                    ?>
                                <?php
                                $cnt=$cnt+1;
                                } 
                            }
                        }
                        else{
                            $query = "SELECT * FROM `stddetails` where  usn_number like '%$str%' or name like '%$str%' order by id desc;";
                            $result = $con->query($query);
                                    if ($result->num_rows > 0) 
                                    {
                                        $cnt=1;
                                        while($row=$result->fetch_object()) {
                                                ?>
                                        <?php
                                            echo  "       
                                                <tr>
                                                    <td>$cnt</td>
                                                    <td>$row->usn_number</td>
                                                    <td>$row->name</td>
                                                    <td>$row->emailid</td>
                                                    <td>$row->abc_id</td>
                                                    <td>$row->unversity_enno</td>
                                                    <td><button class='viewbtn'><a href='../viewForms/viewForms.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-eye-50.png' alt='deletelogo'></a></button>
                                                        <button class='deletebtn'><a href='deleteUsercon.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-delete-48.png' alt='deletelogo'></a></button></td>
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


    