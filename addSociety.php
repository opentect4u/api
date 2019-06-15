<?php

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require ("db_connect.php");
    require("session.php");

    require("nav.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $society_cd = $_POST['society_cd'];
        $society_name = $_POST['society_name'];
        //$sl_no = $_POST['sl_no'];
        $created_by = $_SESSION['user_id'];
        $created_dt = date('Y-m-d h:i:s');

        $slSql = " SELECT MAX(sl_no) AS maxSlNo FROM md_society_cd ";
        $getSlNo = mysqli_query($db_connect,$slSql);
        $slData = mysqli_fetch_assoc($getSlNo);
        //echo $slData['maxSlNo']; die;
        $newSlNo = $slData['maxSlNo']+1;
         
        $add_sql = " INSERT INTO md_society_cd (sl_no, society_cd, society_name, created_by, created_dt) 
                    VALUES ($newSlNo, '$society_cd', '$society_name', '$created_by', '$created_dt') ";
        //echo $add_sql; die;
        $addResult = mysqli_query($db_connect,$add_sql);

        header('location: addSociety.php');

    }

?>


<html>

    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <body>
        
        <div class="container">
            <h2>Add New Society : </h2>
            <hr>
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >

                <div class="form-group">
                    <label class="control-label col-sm-2" for="society">Society Code:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="society_cd" placeholder="Enter Society Code" name="society_cd">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="society_name">Society Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="society_name" placeholder="Enter Society Name" name="society_name">
                    </div>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>

            </form>
            <hr>

            <table class="table table-hover">
                <thead style="background-color: #4CAF50; color: black;">
                    <th style="text-align: center;">Sl No</th>
                    <th style="text-align: center;">Society Code</th>
                    <th style="text-align: center;">Society Name</th>
                    <th style="text-align: center;">Option</th>
                </thead>
                <tbody>

                    <?php
                        $sql = " SELECT * FROM md_society_cd ORDER BY sl_no ";
                        $result =  mysqli_query($db_connect,$sql);

                        while($listData=mysqli_fetch_assoc($result))
                        { ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $listData['sl_no']; ?></td>
                                <td style="text-align: center;"><?php echo $listData['society_cd']; ?></td>
                                <td style="text-align: center;"><?php echo $listData['society_name']; ?></td>
                                <td style="text-align: center;"><a href="editSociety.php?sl_no=<?php echo $listData['sl_no']; ?>" >
                                                    <i class="fa fa-edit fa-2x" style="color: #006eff"></i></a></td>
                            </tr>
                       <?php }
                    ?>

                </tbody>
            </table>


        </div>

    </body>


</html>