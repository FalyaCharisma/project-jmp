<?php
session_start();
$_SESSION['sesi'] = NULL;
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

include "connection.php";
    if( isset($_POST['submit']))
    {
        $username = isset($_POST['username']) ? $_POST['username'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";
        $qry = mysqli_query($db, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
        $sesi = mysqli_num_rows($qry);

        if ($sesi == 1){
            $data_admin = mysqli_fetch_array($qry);
            $_SESSION["loggedin"] = true;
            $_SESSION['id_admin'] = $data_admin['id_admin'];
            $_SESSION['sesi'] = $data_admin['nama_admin'];

            echo "<script>alert('anda berhasil log in'); </script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php?user=$sesi'>";
           
        }
        else{
            echo "<meta http-equiv= 'refresh' content='0'; url=login.php'>";
        }
    }
?>