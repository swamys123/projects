<?php
session_start();
if(isset($_POST['submit'])){


    //collect form data
    $connect=mysqli_connect('localhost','root','','vipanchika') or die("Could not connect to db");
    $name=isset($_POST['name']) ? $_POST['name'] :'';
    $sem=isset($_POST['sem']) ? $_POST['sem'] :'';
    $team=isset($_POST['team']) ? $_POST['team'] :'';
    $grade=isset($_POST['grade']) ? $_POST['grade'] :'';
    $event=isset($_POST['event']) ? $_POST['event'] :'';
    $output='';
    $sql="INSERT INTO `student` VALUES ('$name','$sem','$team','$grade','$event')";
    $query=mysqli_query($connect,$sql);
    //check name is set
    if($name ==''){
        $error[] = 'Name is required';
    }
    //check for a valid email address

    //if no errors carry on
    if(!isset($error)){
        //create html of the data
        ob_start();
        ?>
        <p style="margin-left: 5cm;padding-top: 13.2cm;font-weight: bold"><?php echo"$name"; ?></p>
        <p style="margin-left: 9cm;font-weight: bold"><?php echo "$sem";?></p>
        <p style="margin-left: 8cm;font-weight: bold"><?php echo "$team";?></p>
        <p style="margin-left: 7cm;font-weight: bold"><?php echo "$grade ";?></p>
        <p style="margin-left: 4cm;font-weight: bold"><?php echo "$event ";?></p>
        <?php
        $body = ob_get_clean();
        $body = iconv("UTF-8","UTF-8//IGNORE",$body);
        include("mpdf/mpdf.php");
        $mpdf=new \mPDF('c','A4','12','' ,0, 0,0, 0, 0, 0);//<left padding>
        //write html to PDF
        $mpdf->WriteHTML($body);
        //output pdf
        $mpdf->Output('data.pdf','D');
        //save to server
        //$mpdf->Output("mydata.pdf",'F');
    }
}
//if their are errors display them
if(isset($error)){
    foreach($error as $error){
        echo "<p style='color:#ff0000'>$error</p>";
    }
}
session_destroy();
?>

