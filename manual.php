<?php

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require ("db_connect.php");
    require("session.php");

    require("nav.php");


    $getDateRangeSql = " SELECT date_range FROM td_date_range ";
    $dateResult = mysqli_query($db_connect,$getDateRangeSql);
    $dateRange = mysqli_fetch_assoc($dateResult);

    $currentDate = date('Y-m-d');
    $Entrydate = date('Y-m-d', strtotime($currentDate. ' - '.$dateRange['date_range'].' days')) ;
    //echo $Entrydate; die;

    
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
            <div class="col-sm-6">
                <h2>Fire Manually : </h2>
                <hr>
                
                <label class="control-label col-sm-4" for="newDate">Dated On: <?php echo $Entrydate; ?></label>

                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-default" ><a href="api.php" target= "blank">Go</a></button>
                    </div>
                </div>

            </div>

            <div class="col-sm-6">
                <h2>Get XML Report : </h2>
                <hr>
                <label class="control-label col-sm-4" for="newDate">Dated On : <?php echo $Entrydate; ?> </label>
                        
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="report.xml" download="<?php echo $Entrydate.'.xml' ?>" >
                            <button class="btn">
                                <i class="fa fa-download"></i> Download
                            </button>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </body>

</html>