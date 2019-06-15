<?php

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require ("db_connect.php");
    require("session.php");

    require("nav.php");

    if ($_SERVER["REQUEST_METHOD"]=="GET")
    {
        $sl_no = $_GET['sl_no'];
        //echo $sl_no; die;

        $edit_sql = "SELECT * FROM md_society_cd WHERE sl_no = $sl_no";
        $editResult = mysqli_query($db_connect,$edit_sql);
        $editData = mysqli_fetch_assoc($editResult);

        $slNo = $editData['sl_no'];
        //echo $slNo; die;
        $society_name = $editData['society_name'];
        $society_cd = $editData['society_cd'];
    
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {

        $society_cd = $_POST['society_cd'];
        $society_name = $_POST['society_name'];
        $sl_no = $_POST['sl_no'];
        $modified_by = $_SESSION['user_id'];
        $modified_dt = date('Y-m-d h:i:s');
         
        $update_sql = " UPDATE md_society_cd SET society_cd = '$society_cd', society_name = '$society_name', modified_by = '$modified_by', modified_dt = '$modified_dt'
                        WHERE sl_no = $sl_no ";
        //echo $update_sql; die;
        $editResult = mysqli_query($db_connect,$update_sql);

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
            <h2>Edit Society Details : </h2>
            <hr>
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >

                <div class="form-group">
                    <label class="control-label col-sm-2" for="society">Society Code:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="society_cd" value= "<?php echo $society_cd; ?>" placeholder="Enter Society Code" name="society_cd">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="society_name">Society Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="society_name" value= "<?php echo $society_name; ?>" placeholder="Enter Society Name" name="society_name">
                    </div>
                </div>

                <input type="hidden" class="form-control" id="sl_no" value= "<?php echo $slNo; ?>" placeholder="Enter Society Name" name="sl_no">
                
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