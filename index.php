<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Traffic Violation Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body {
      background-image: linear-gradient(to bottom, #7F7FD5, #86A8E7, #91EAE4);
      background-size: cover;
    }
    .upload-form {
      background-color:  #ffffff;
      border-radius: 10px;
      padding: 20px;
      margin-top: 50px;
    }
    .btn {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #3e8e41;
    }
    
    
  </style>
 </head>
  <body>

  <?php

    include 'connection.php';

    if(isset($_POST['submit'])){
        $vehiclenum = $_POST['vehiclenum'];
        $violationtype = $_POST['violationtype'];
        $date = $_POST['date'];
        $file = $_FILES['file'];

        $filename = $file['name'];
        $filepath = $file['tmp_name'];
        $fileerror = $file['error'];

        if($fileerror == 0){
            $destfile = 'upload/'.$filename;

            move_uploaded_file($filepath,$destfile);

            $insertquery = "insert into violation(vehiclenum,violationtype,date,img) values('$vehiclenum','$violationtype','$date','$destfile')";

            $query = mysqli_query($con,$insertquery);

            if($query){
                echo "inserted";
                header('location:index.php');
            }else{
                echo "not inserted";
            }
        }
    }

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">Traffic Violation</h1>
            <img src="https://raw.githubusercontent.com/anmspro/Traffic-Signal-Violation-Detection-System/master/Images/Violation_Detection_Frame_Red.jpg" alt="Traffic Violation" class="img-fluid mx-auto d-block mb-4" style="max-height: 500px;">
            
        </div>
    </div>
    <div class="upload-form">
  <form action="<?php  echo htmlentities($_SERVER['PHP_SELF']);  ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <h3>Vehicle Number</h3>
      <input type="text" class="form-control" name="vehiclenum" placeholder="Vehicle Number">
    </div>
    <div class="mb-3">
      <h3>Violation Type</h3>
      <select class="form-select" aria-label="Default select example" name="violationtype">
        <option value="Speed">Speed</option>
        <option value="No helmet">No helmet</option>
        <option value="Running a red light">Running a red light</option>
        <option value="Distracted driving">Distracted driving</option>
        <option value="Driving under influence">Driving under influence</option>
        <option value="Illegal parking">Illegal parking</option>
      </select>
    </div>
    <div class="mb-3">
      <h3>Date</h3>
      <input type="date" name="date">
    </div>
    <div class="mb-3">
      <h3>Upload File</h3>
      <input type="file" class="form-control" name="file">
    </div>
    <center>
      <button type="submit" name="submit" class="btn">Submit</button>
    </center>
  </form>
</div>

   

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>