<html>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <span class="contact1-form-title">
            Give Details
        </span>
        <hr><br>

        <div>
            <label for="SocietyCode">SocietyCode</label>
            <input type="text" value= "" name= "SocietyCode" id= "SocietyCode" >
        </div>
        <br>
        <div>
            <label for="Entrydate">Entrydate</label>        
            <input type="date" value= "" name= "Entrydate" id= "Entrydate" >
        </div>
        <br>
        <button>Submit</button>
    </form>
    <hr>

</html>




<?php

    $servername = "localhost";
    $username   = "root";
    $password   = "teachers";
    $dbname	    = "api";

	$db_connect = mysqli_connect($servername,$username,$password,$dbname);

	if(!$db_connect) {

		die("Database Connection Failed ".mysqli_connect_error());

	}

	ini_set('session.gc_maxlifetime', 28800);
	ini_set("display_errors","1");
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {

        $SocietyCode	=	$_POST["SocietyCode"];
        $Entrydate      =   $_POST["Entrydate"];
        //echo $Entrydate; die;
        
        $validationSql = " SELECT * FROM td_response WHERE society_cd = '$SocietyCode' AND entry_dt = '$Entrydate' ";
        //echo $validationSql; die;
        $validationResult =  mysqli_query($db_connect, $validationSql);
        //echo (mysqli_num_rows($validationResult)); die;

        if (mysqli_num_rows($validationResult) > 0)
        {
            header('Location: api.php');
            exit();
        }
        else
        {

            $file = "https://mdccb.org/API/getInWardListData.php?SocietyCode=".$SocietyCode."&Entrydate=".$Entrydate;
            
            $data = file_get_contents($file);
        
            $data = mb_substr($data, strpos($data, '{'));
            //$data = mb_substr($data, 0, -1);
            $result = json_decode($data, true);

            $code = $result['code'];
            $message = $result['msg'];
            $array  =   $result['result'];
            
            if($code == 200)
            {

                echo "<table>";
                    echo "<thead>";
                        echo "<th> CBSAcNo </th> " ;
                        echo "<th> SocAcNo </th> " ;
                        echo "<th> AcHolderName </th> " ;
                        echo "<th> SocDesCA </th> " ;
                        echo "<th> SocName </th> " ;
                        echo "<th> Amount </th> " ;
                        echo "<th> Remarks </th> " ;
                    echo "</thead>";
                    
                    echo "<tbody>";
                        foreach($array as $key=>$row) {
                            echo "<tr>";
                            foreach($row as $key2=>$row2){
                                //echo $row->AcHolderName; die;
                                echo "<td>" . $row2 . "</td>"; 
                            }
                            echo "</tr>";
                        }
                    echo "</tbody>";

                echo "</table>";
            
                echo "<br><br>";


                $sql = "SELECT MAX(response_cd) AS response_cd FROM td_response ";
                $responseResult     =   mysqli_query($db_connect,$sql);
                $responseCode = mysqli_fetch_assoc($responseResult);
                //echo ($responseCode['response_cd'] + 1); die;
                $response_cd = $responseCode['response_cd'] + 1;
            
                $sql1 = "insert into td_response (response_cd, response, society_cd, entry_dt) 
                        values ('$response_cd', '$data', '$SocietyCode', '$Entrydate') ";
                
                foreach($array as $key=>$row) {

                    $sql2 = "INSERT INTO td_rep_detailes (response_cd, CBSAcNo, SocAcNo, AcHolderName, SocDesCA, SocName, Amount, Remarks)
                    VALUES (".$response_cd.", " ;
                    foreach($row as $key2=>$row2){

                        $sql2 .=  "'".$row2."'".' ,' ;

                    }
                    $query = substr_replace($sql2 ,"",-1);
                    $query .= ")";

                    $result2     =   mysqli_query($db_connect,$query);
                    // echo $query;
                    // echo "<br>";

                }
                
            
                $result1     =   mysqli_query($db_connect,$sql1);
                //$result2     =   mysqli_query($db_connect,$query);
                
                if($result1)
                {
                    echo "Saved Successfully!";

                }
                else
                {
                    echo "Sorry!";
                }

            }
            else
            {
                echo "No Data Found.";
            }

        }


    }

?>