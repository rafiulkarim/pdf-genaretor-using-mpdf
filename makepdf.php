<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once("connection.php");
//grab variables
$name = $_POST['name'];
$roll = $_POST['roll'];
$email = $_POST['email'];
$phone = $_POST['phone'];
if(empty($name) || empty($email) || empty($phone)){
    $msg = "<p style='color: red;'>You left one or more of the required fields.</p>";
    $msgEncoded = base64_encode($msg);
    header("location:index.php?msg=".$msgEncoded);
}else{
    $query = "SELECT * FROM student WHERE roll='$roll' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        //create PDF instance
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('A4');
        //create your pdf
        $data .='';

        //Add data
        $data .=
        '<div style="padding: 10px;">
            <div width="20%" style="float: left">
                <img src="upload/logo.jpg" style="width:150px; height: 150px; margin: 0;" />
            </div>
            <div width="80%" style="float: right; text-align: center;">
                <h1>GREEN UNIVERSITY OF BANGLADESH</h1>
                <h2>Admit Card</h2>
            </div>
        </div>
        <div width="100%" style="padding: 10px;">
            <div width="80%" style="float: left;">
                <table>
                    <tr style="font-size: 30px">
                        <td><h3>Program</h3></td>
                        <td><h3>:</h3></td>
                        <td><h3>'.$user['program'].'</h3></td>
                    </tr>
                    <tr>
                        <td><h3>ID</h3></td>
                        <td><h3>:</h3></td>
                        <td><strong><h3>'.$user['roll'].'</h3></strong></td>
                    </tr>
                    <tr>
                        <td><h3>Name</h3></td>
                        <td><h3>:</h3></td>
                        <td><h3>'.$user['name'].'</h3></td>
                    </tr>
                </table>
            </div>
            <div width="20%" style="float: right">
                <img src=upload/'.$user["image"].' style="width:150px; height: 150px; margin: 0; border: 2px solid black";float: right; />
            </div>
        </div>';

        $data .='
        <table style="width:100%;border: 1px solid black; border-collapse: collapse;">
            <tr>
                <th style="border: 1px solid black; border-collapse: collapse;">Course Code</th>
                <th style="border: 1px solid black; border-collapse: collapse;">Course Title </th> 
                <th style="border: 1px solid black; border-collapse: collapse;">Inv. Signature</th>
            </tr>';
            $query = "SELECT * FROM course Where stu_id='$roll'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                    $data.='
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;">'.$row['Course Code'].'</td>
                        <td style="border: 1px solid black; border-collapse: collapse;">'.$row['Course Title'].'</td>
                        <td style="border: 1px solid black; border-collapse: collapse;">'.$row['Inv. Signature '].'</td>
                    </tr>';
                }
            }else{
                $data.='
                <tr>
                    <td colspan="3">Data not found</td>
                    
                </tr>';
            }
        $data .='
            </table>
        ';
        
        //write pdf
        $mpdf->WriteHTML($data);

        //output to browser
        $mpdf->Output($roll.'.pdf','I');
    }else{
        $msg = "<p style='color: red;'>Invaild</p>";
        $msgEncoded = base64_encode($msg);
        header("location:index.php?msg=".$msgEncoded);
    }
    

}

