<?php
include('Config/db_connect.php');

//check GET request parameter
if(isset($_POST['delete'])){
   $id_to_delete = mysqli_real_escape_string($conn, $_POST['idToDelete']);
    //echo $_POST['idToDelete'];
    $sqldeleteQuery = "DELETE FROM pizzas WHERE ID = '{$id_to_delete}' ";

    if(mysqli_query($conn, $sqldeleteQuery)){
        echo '<script>alert("Your pizza is deleted")</script>';
        header ("Location: index.php");
        echo '<script>alert("Your pizza is deleted")</script>';
        
    }else{
        echo 'Database Delete Error'. mysqli_error($conn);
    }
   
}

if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    //echo $id;

    //define sql query to use
    $sqlquery = "SELECT * FROM pizzas WHERE ID = $id";

    //get query result
    $result = mysqli_query($conn, $sqlquery);

    //save the one pizza result in an associative array
    $pizza = mysqli_fetch_assoc($result);

   
   
     

    //free result and close connection - simply good practice
    mysqli_free_result($result);
    mysqli_close($conn);

    //echo pizza details
    //print_r($pizza);
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
    <title>Details</title>
    <style>
        body{
            background-color: black;
        }
        .pizzaDetailsContainer{
            display: flex;
            flex-direction: column;
            align-items: center;
            margin:10px auto;
            padding: 20px;
            width: 50%;
            background-color: whitesmoke;
            border: 1px solid #e49b56;
            border-radius: 12px;
            
        }
        p{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include('Templates/Header.php') ?>


    <?php
   // foreach($pizza as $pizzaDetail){ ?>
   <?php if($pizza): ?>
        <div class="pizzaDetailsContainer">
        <h3>  <?php  echo $pizza['PizzaTitle']." Pizza"; ?> </h3>
        <p>  <?php  echo "Created by: " . $pizza['ClientName']; ?> </p>
        <p> <?php  echo "Email: " . $pizza['ClientEmail']; ?> </p>
        <p> <?php  echo "Mobile: " . $pizza['phoneNumber']; ?> </p>
        <p> <?php  echo "Ingredients: <br>"  .$pizza['Ingredients']; ?> </p>
        <p> <?php  echo "Date Created: " . $pizza['Created_at']; ?> </p>

        <form action="details.php" method="POST">
        <input
            
            type="hidden" 
            name="idToDelete" 
            value="<?php echo $pizza['ID']?>"
        />
        <input
            class="btn" 
            value= "Delete"
            type="submit" 
            name="delete"
        />
        <input type="image" src="trash.svg" alt="Submit" width="48" height="48"></i></input>
        
      
        </form>
    
    
    
    <?php  else : ?>
        <h5> No such pizza yet</h5>
 
    <?php endif ?>
    </div>

    <?php include('Templates/Footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>