<?php
    $username = $_POST['username']
    $password = $_POST['password']
    $studID = $_POST['studID']
    $fname = $_POST['fname'];
    $lname = $POST['lname'];
    $section = $POST['section'];
    $strand = $POST['strand'];
    $address = $POST['address'];
    $telnum = $POST['telnum'];
    $bday = $POST['bday'];

    //Database connection

    $conn = new mysqli('localhost','root','','workimmersionplacementplatform');
    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into registration(username, password, studID, fname, lname, section, strand, address, telnum, bday)
        values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")
        $stmt->bind_param("ssssssssis",$username, $password, $studID, $fname, $lname, $section, $strand, $address, $telnum, $bday);
        $stmt->execute();
        echo "registration successfully...";
        $stmt->close();
        $conn->close();
    }

?>