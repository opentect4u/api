<?php
    ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	require ("db_connect.php");
    require("session.php");

    require("nav.php");

    
    
    
?>

<html>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <body>
        
        <div class="container">
            <h2>Get InWard List On : </h2>
            <hr>
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >

                <div class="form-group">
                    <label class="control-label col-sm-2" for="date">Date:</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" id="date" placeholder="Enter user id" name="date">
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
                    <th>Date</th>
                    <th>Society Code</th>
                    <th>Society Name</th>
                    <th>CBSAcNo</th>
                    <th>SocAcNo</th>
                    <th>AcHolderName</th>
                    <th>SocDesCA</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                
                    <?php
                        
                        if ($_SERVER["REQUEST_METHOD"]=="POST")
                        {

                            $listDate = $_POST['date'];
                            //echo $listDate; die;
                            $sql = "SELECT a.society_cd, a.entry_dt, b.CBSAcNo, b.SocAcNo, b.AcHolderName, b.SocDesCA, b.SocName, b.Amount, b.Remarks FROM 
                                    td_response a, td_rep_detailes b WHERE a.response_cd = b.response_cd AND a.entry_dt = '$listDate' ";
                            //echo $sql; die;
                            $result = mysqli_query($db_connect,$sql);
                            //var_dump($result); die;
                            while($listData=mysqli_fetch_assoc($result))
                            { ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $listData['entry_dt']; ?></td>
                                    <td style="text-align: center;"><?php echo $listData['society_cd']; ?></td>
                                    <td style="text-align: center;"><?php echo $listData['SocName']; ?></td>
                                    <td style="text-align: center;"><?php echo $listData['CBSAcNo']; ?></td>
                                    <td style="text-align: center;"><?php echo $listData['SocAcNo']; ?></td>
                                    <td style="text-align: center;"><?php echo $listData['AcHolderName']; ?></td>
                                    <td style="text-align: center;"><?php echo $listData['SocDesCA']; ?></td>
                                    <td style="text-align: center;"><?php echo $listData['Amount']; ?></td>
                                    <td style="text-align: center;"><?php echo $listData['Remarks']; ?></td>
                                </tr>
                            <?php }
                        
                        }
                    ?>
                
                </tbody>
            
            </table>

        </div>

    </body>

</html>

