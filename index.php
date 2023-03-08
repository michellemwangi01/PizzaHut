<?php


$fullNames = '';

if (isset($_POST['submit'])){
    session_start();
    $_SESSION['name'] = $_POST['nameInput'];
    header ("Location: pizzas.php");
}


?> 

<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>SignIn</title>
    <style>
        body{
            background-color: black;
        }
        .UserNameContainer{
            background-color: black;
            width: 100%;
            border: 1px solid #e49b56;
            padding: 20px;
            text-align: center;
            color: whitesmoke;  
        }
        #SubmitName{
            margin: 20px auto;
        }
    </style>
</head>
    <body>
        <?php include('Templates/Header.php'); ?>
        <div class="UserNameContainer">
        <form action="index.php" method="POST">
            <label for="Name">Name</label>
            <input value='<?php echo ($fullNames) ?>' type="text" name="nameInput">
            <br>
            <div>
        <button id="SubmitName" type="Submit" name="submit" value="submit">SUBMIT</button>
    </div>
            
        </form>
        </div>
        

         <?php include('Templates/Footer.php'); ?>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
