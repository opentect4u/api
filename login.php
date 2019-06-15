<?php 

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    $errmsg=$err=$usererr=$passerr='';
    $log_id=$log_pass='';

    require("db_connect.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {

        if (empty($_POST["user_id"]))
        {
            $usererr = "Please Supply User ID";
        }
        else
        {
            $log_id    = $_POST["user_id"];
        }
        if (empty($_POST["password"]))
        {
            $passerr = "Please Valid Supply Password";
        }
        else
        {
            $log_pass  = $_POST["password"];
        }

        $sql = "select * from md_login_user where user_id='$log_id'";
        $result = mysqli_query($db_connect,$sql);
        
        if($result)
        {
            if (mysqli_num_rows($result) > 0) 
            {
                
                $login_data = mysqli_fetch_assoc($result);
                $loginPassword   = $login_data['password'];
                
                if($loginPassword == $log_pass)
                {
                    $pwd = 1 ;
                }
                else
                {
                    $pwd = 0;
                }

                if($pwd == 1)
                {
                    $_SESSION['user_id']   = $login_data['user_id'];
                    //$_SESSION['user_type'] = $login_data['user_type'];

                    header("Location:dashboard.php");

                }

            }
            else
            {
                $errmsg = "Invalid User ID or Password";
            }

        }
        else
        {
            $err = "Failed To Login";
        }

    }
    else
    {
        $err = "Failed To Login";
    }

?>




<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>   
    <body>

        <div class="container">
            <h2>LogIn To InWard API Portal</h2>
            <hr>
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >

                <div class="form-group">
                    <label class="control-label col-sm-2" for="user_id">User Id:</label>
                    <div class="col-sm-10">
                        <input type="user_id" class="form-control" id="user_id" placeholder="Enter user id" name="user_id">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Password:</label>
                    <div class="col-sm-10">          
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                    </div>
                </div>
                
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>

            </form>
            <hr>
            <div class="posted-by">Developed By: <a href="http://www.Synergicsoftek.in" target=_blank>Synergic Softek Solutions Pvt.Ltd.</a></div>

        </div>
        
    </body>
        
</html>