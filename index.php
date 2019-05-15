<?php
require_once('connect.php');

if(isset($_GET['user'])){
    if(isset($_GET['create'])){
        $name=$_GET['name'];
        $email=$_GET['email'];
        $password=$_GET['password'];
        $sql ='insert into users(name,email,password)
        values('.$name.','.$email.','.$password.')';
        if (mysqli_query($conn, $sql)) {
            echo "{success:1}";
        } else {
            echo "Error creating database: " . mysqli_error($conn);
        }
    }elseif(isset($_GET['retrieve'])){
        $email=$_GET['email'];
        $password=$_GET['password'];
        $sql = 'select * from users where email='.$email.' and password='.$password.';';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo '{success:1,id:'.$row["id"].',name:'.$row["name"].'}';
        } else {
            echo "{success:0}";
        }
    }
}elseif(isset($_GET['channel'])){
    if(isset($_GET['create'])){
        $name=$_GET['name'];
        $userid=$_GET['userid'];
        $sql ='insert into channels(userid,name)
        values('.$userid.','.$name.')';
        if (mysqli_query($conn, $sql)) {
            echo "{success:1}";
        } else {
            echo "Error creating database: " . mysqli_error($conn);
        }
    }elseif(isset($_GET['retrieve'])){
        $userid=$_GET['userid'];
        $sql = 'select * from channels where userid='.$userid.';';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '[';
            while($row = mysqli_fetch_assoc($result)){
                echo '{success:1,id:'.$row["id"].',name:'.$row["name"].'},';
            }
            echo ']';
        } else {
            echo "{success:0}";
        }
    }elseif(isset($_GET['retrieve'])){
        $channelid = $_GET['channelid'];
        $sql1 = "DELETE FROM channels WHERE id=".$channelid;
        if (mysqli_query($conn, $sql1)) {
            echo "{success:1}";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        $sql = "DELETE FROM participants WHERE channelid=".$channelid;
        if (mysqli_query($conn, $sql)) {
            echo "{success:1}";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
}elseif(isset($_GET['channel'])){
    if(isset($_GET['create'])){
        $email=$_GET['email'];
        $name=$_GET['name'];
        $channelid=$_GET['channelid'];
        $sql ='insert into participants(channelid,name,email,scanned)
        values('.$channelid.','.$name.','.$email.',"false")';
        if (mysqli_query($conn, $sql)) {
            echo "{success:1}";
        } else {
            echo "Error creating database: " . mysqli_error($conn);
        }
    }elseif(isset($_GET['retrieve'])){
        $channelid=$_GET['channelid'];
        $sql = 'select * from participants where channelid='.$channelid.';';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '[';
            while($row = mysqli_fetch_assoc($result)){
                echo '{success:1,id:'.$row["id"].',name:'.$row["name"].',email:'.$row["email"].',scanned:'.$row["scanned"].'},';
            }
            echo ']';
        } else {
            echo "{success:0}";
        }
    }elseif(isset($_GET['update'])){
        $sql = "UPDATE participants SET scanned='true' WHERE id=".$_GET['id'];
        if (mysqli_query($conn, $sql)) {
            echo "{success:1}";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}