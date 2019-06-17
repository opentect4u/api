<?php

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require ("db_connect.php");
    require("session.php");

    require("nav.php");

    $getDateSql = "SELECT date_range FROM td_date_range ";
    $dateResult = mysqli_query($db_connect,$getDateSql);
    $dateRange = mysqli_fetch_assoc($dateResult);
    
    //echo $dateRange['date_range']; die;



    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $currentDate = $_POST['currentDate'];
        $date_range = $_POST['newDate'];
        $date = date('Y-m-d');
        $modified_by = $_SESSION['user_id'];
        $modified_dt = date('Y-m-d h:i:s');
 
        $add_sql = " UPDATE td_date_range SET date = '$date', date_range = '$date_range', last_modified_by = '$modified_by', last_modified_dt = '$modified_dt'
                    WHERE date_range = $currentDate ";
        //echo $add_sql; die;
        $addResult = mysqli_query($db_connect,$add_sql);

        header('location: setDate.php');

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
            <h2>Set Date Range : </h2>
            <hr>

            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >

                <div class="form-group">
                    <label class="control-label col-sm-2" for="currentDate">Current Date Range:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" value= "<?php echo $dateRange['date_range']; ?>" id="currentDate" placeholder="Current Date Range" name="currentDate" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="newDate">New Date Range:</label>
                    <div class="col-sm-6">
                        <select class= "form-control" name="newDate" id="newDate">
                            <option value="">Select Date Range</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>

            </form>
            <hr>

        </div>

    </body>

</html>