
<?php

    require("db_connect.php");  // Getting DB Configuration --> 

        // Getting society_cd from master table --> 

        $tot_society_noSql = " SELECT MAX(sl_no) AS sl_no FROM md_society_cd "; 
        $tot_society_noResult = mysqli_query($db_connect, $tot_society_noSql);
        $maxSocietyNo = mysqli_fetch_assoc($tot_society_noResult);

        $lastSocietyNo = $maxSocietyNo['sl_no']; 
        //echo $lastSocietyNo; die;
        
        $getDateRangeSql = " SELECT date_range FROM td_date_range ";
        $dateRangeResult = mysqli_query($db_connect, $getDateRangeSql);
        $dateRange = mysqli_fetch_assoc($dateRangeResult);
        //echo $dateRange['date_range']; die;

        $currentDate = date('Y-m-d'); // Entry Datefor url

        //$Entrydate = "2019-06-07";  
        $Entrydate = date('Y-m-d', strtotime($currentDate. ' - '.$dateRange['date_range'].' days')); 

        //echo $Entrydate; die; 
        
        $fired_at = date('Y-m-d h:i:s');

        for($i= 1; $i<= $lastSocietyNo; $i++)
        {

            $getSocietyCodeSql = " SELECT society_cd FROM md_society_cd WHERE sl_no = $i "; 
            $getSocietyCodeResult = mysqli_query($db_connect, $getSocietyCodeSql);
            $getSocietyCode = mysqli_fetch_assoc($getSocietyCodeResult);
            $SocietyCode = $getSocietyCode['society_cd']; 
            //echo $SocietyCode; die;

            // Getting response from URL with the each societyCode and EntryDate(today) --> 

            $file = "https://mdccb.org/API/getInWardListData.php?SocietyCode=".$SocietyCode."&Entrydate=".$Entrydate;
            //echo $file; die;
            $data = file_get_contents($file);
        
            $data = mb_substr($data, strpos($data, '{'));
            //$data = mb_substr($data, 0, -1);
            $result = json_decode($data, true);

            $code = $result['code'];
            $message = $result['msg'];
            $array  =   $result['result'];
            
            if($code == 200)
            {

                // echo "<table>";
                //     echo "<thead>";
                //         echo "<th> CBSAcNo </th> " ;
                //         echo "<th> SocAcNo </th> " ;
                //         echo "<th> AcHolderName </th> " ;
                //         echo "<th> SocDesCA </th> " ;
                //         echo "<th> SocName </th> " ;
                //         echo "<th> Amount </th> " ;
                //         echo "<th> Remarks </th> " ;
                //     echo "</thead>";
                    
                //     echo "<tbody>";
                //         foreach($array as $key=>$row) {
                //             echo "<tr>";
                //             foreach($row as $key2=>$row2){
                //                 //echo $row->AcHolderName; die;
                //                 echo "<td>" . $row2 . "</td>"; 
                //             }
                //             echo "</tr>";
                //         }
                //     echo "</tbody>";

                // echo "</table>";
            
                // echo "<br><br>";



                //////////////////////////////////////////////////////////////////////////////
                        // Inserting Data in Tables as per response_cd (max+1) --> 
                //////////////////////////////////////////////////////////////////////////////
            

                $sql = "SELECT MAX(response_cd) AS response_cd FROM td_response ";
                $responseResult     =   mysqli_query($db_connect,$sql);
                $responseCode = mysqli_fetch_assoc($responseResult);
                //echo ($responseCode['response_cd'] + 1); die;
                $response_cd = $responseCode['response_cd'] + 1;
            
                $sql1 = "insert into td_response (response_cd, response, society_cd, entry_dt, fired_at) 
                        values ('$response_cd', '$data', '$SocietyCode', '$Entrydate', '$fired_at') ";
                
                $result1     =   mysqli_query($db_connect,$sql1);
                //echo $sql1; die;
                foreach($array as $key=>$row) 
                {

                    $sql2 = "INSERT INTO td_rep_detailes (response_cd, CBSAcNo, SocAcNo, AcHolderName, SocDesCA, SocName, Amount, Remarks)
                    VALUES (".$response_cd.", " ;
                    foreach($row as $key2=>$row2)
                    {
                        $sql2 .=  "'".$row2."'".' ,' ;
                    }
                    $sql2 = substr_replace($sql2 ,"",-1);
                    $sql2 .= ")";

                    $result2     =   mysqli_query($db_connect,$sql2);
                    //echo $sql2; die;
                }
                
               
            }

            
        }
        
        
        //////////////////////////////////////////////////////
                //Generating XML File
        /////////////////////////////////////////////////////

            $xmlResultQuery = " SELECT a.society_cd, a.entry_dt, b.CBSAcNo, b.SocAcNo, b.AcHolderName, b.SocDesCA, b.SocName, b.Amount, b.Remarks
                                FROM  td_response a, td_rep_detailes b WHERE a.response_cd = b.response_cd AND a.entry_dt = '$Entrydate' ";

            //echo $xmlResultQuery; die;
            $xmlResult = mysqli_query($db_connect, $xmlResultQuery); // Taking New Records From Table to generate xml
            

            // DOM Configuration Start--> 

            $xml = new DOMDocument("1.0");
            $xml->formatOutput = true;
            $response = $xml->createElement("response");
            $xml->appendChild($response); // Creating <response /> Tab

            // Fetching data from result and creating dom --> 

            while($row= mysqli_fetch_array($xmlResult))
            {

                $record = $xml->createElement("record");
                $response->appendChild($record); // Creating <record /> Tabs

                $society_cd = $xml->createElement("society_cd", $row['society_cd']);
                $record->appendChild($society_cd); // Creating <society_cd /> Tabs

                $entry_dt = $xml->createElement("entry_dt", $row['entry_dt']);
                $record->appendChild($entry_dt); // Creating <entry_dt /> Tabs
                
                $CBSAcNo = $xml->createElement("CBSAcNo", $row['CBSAcNo']);
                $record->appendChild($CBSAcNo); // Creating <CBSAcNo /> Tabs

                $SocAcNo = $xml->createElement("SocAcNo", $row['SocAcNo']);
                $record->appendChild($SocAcNo); // Creating <SocAcNo /> Tabs

                $AcHolderName = $xml->createElement("AcHolderName", $row['AcHolderName']);
                $record->appendChild($AcHolderName); // Creating <AcHolderName /> Tabs

                $SocDesCA = $xml->createElement("SocDesCA", $row['SocDesCA']);
                $record->appendChild($SocDesCA); // Creating <SocDesCA /> Tabs

                $SocName = $xml->createElement("SocName", $row['SocName']);
                $record->appendChild($SocName); // Creating <SocName /> Tabs

                $Amount = $xml->createElement("Amount", $row['Amount']);
                $record->appendChild($Amount); // Creating <Amount /> Tabs

                $Remarks = $xml->createElement("Remarks", $row['Remarks']);
                $record->appendChild($Remarks); // Creating <Remarks /> Tabs

            }

            echo "<xmp>".$xml->saveXML()."</xmp>";
            $xml->save("report.xml"); // Creating new nodes in existing xml or to create new file as- "report.xml

            //file_put_contents('report.xml', $xml); // Overwritting the existing xml file  
            
        // Dom Configuration End -->
        


        //////////////////////////////////////////
                    //xml file end 
        /////////////////////////////////////////


            // Sending $xml to a url with CURL -->
        //////////// Start ///////////////////


        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        // curl_setopt($ch, CURLOPT_URL, "http://websiteURL");
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=".$xmlcontent."&password=".$password."&etc=etc");
        // $content=curl_exec($ch);
        

        ///////////// end /////////////////        
                
            







?>