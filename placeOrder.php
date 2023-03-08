<?php
include('Config/db_connect.php');
$errors = array("fullName" => '', "phoneNumber" => '', "email" => '', "pizzaName" => '', "ingredients" => '' );
$fullNames = $phoneNumber = $email = $pizzaName = $ingredients = '';
//--------------------------FORM VALIDATION-------------------
if(isset($_POST['submit'])){
         //Test Cross site scripting (XSS) using JSCode '<script>window.location = "https://www.jw.org"</script>' 
        echo $_POST['fullNames'];

        //check names
        $fullNames = $_POST['fullNames'];
        if(empty($fullNames)){
            $errors['fullName'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $fullNames )){
                $errors['fullName'] = '*Name not valid';
            }
                
        }
        //check phone Number
        $phoneNumber = $_POST['phoneNumber'];
        if(empty($phoneNumber)){
            $errors['phoneNumber'] = '*Required';
        }
        else{
            if(!preg_match('/^[0-9]+$/',$phoneNumber)){
                $errors['phoneNumber'] = '*Phone number not valid';
            }
            
        }
        //check email
        $email = $_POST['email'];
        if(empty($email)){
            $errors['email'] = '*Required';
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = '*Email not valid';
            }
        }
        
        //check pizzaName
        $pizzaName = $_POST['pizzaName'];
        if(empty($pizzaName)){
            $errors['pizzaName'] = "*Required" ;
        } else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $pizzaName )){
                $errors['pizzaName'] = '*Pizza name not valid';
            }
                
        }

        //check Ingredients
        $ingredients = $_POST['ingredients'];
        if(empty($ingredients)){
            $errors['ingredients'] = '*Required';
        }
        else{
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients )){
                $errors['ingredients'] = '*Must be comma separated';
            }
        }
    if (array_filter($errors))
    {
        //if there are errors, they will be handled as defined below
        //If you don't pass a callback function to array_filter(), the function will remove all the elements from the input array that have a "falsey" value. The falsey values in PHP are false, 0, empty strings '', NULL, empty arrays [], and the string "0".
        //print_r($errors);
    }
    else{
        $fullNames = mysqli_real_escape_string($conn, $_POST['fullNames']);
        $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pizzaName = mysqli_real_escape_string($conn, $_POST['pizzaName']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']); 


        //write sql query to insert values into sql table
        $sqlquery = "INSERT INTO PIZZAS (ClientName, ClientEmail, phoneNumber, PizzaTitle,Ingredients) VALUES ('$fullNames', '$email',  '$phoneNumber', '$pizzaName',  '$ingredients' ); ";
        
        
        //save to db and check that it works
        if(mysqli_query($conn, $sqlquery)){
            //success - data inserted into db
            echo '<script>alert("Your pizza order is received")</script>';
            header('location: pizzas.php');
        }else{
            echo 'SQL query error: ' .mysqli_error($conn);
        }
        $fullNames = '';
        $phoneNumber = '';
        $email = '';
        $pizzaName = '';
        $ingredients = '';

    }
} //End of POST check


    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
    .formContainer{
        width: 60%;
        margin: 20px auto;
        padding: 20px;
        border: 2px solid #FBAA60;
        box-shadow: 10px;
        border-radius: 12px;
        text-align: center;
    }
    button{
        color: white;
        border-radius: 20px;
        border: 2px solid #FBAA60;
        background-color: #FBAA60;
        padding: 5PX 10px;
    }
    .errorMessages{
        color: red;
        margin-left: 5px;
    }
</style>

</head>
<body>
<?php include('Templates/Header.php'); ?>

<section class="formContainer">
    <h4>Customize Your Pizza</h4>
    <form class="pizzaOrderForm" action="placeOrder.php" method="POST">
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Full Names</span>
        <input value = '<?php echo htmlspecialchars($fullNames) ?>' type="text" name="fullNames"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
    </div>
    
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Phone Number</span>
        <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
        <input value = '<?php echo htmlspecialchars($email) ?>' type="text" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['email'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Pizza Name</span>
        <input value = '<?php echo htmlspecialchars($pizzaName) ?>' type="text" name="pizzaName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['pizzaName'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Ingredients <br> (comma Separated)</span>
        <input value = '<?php echo htmlspecialchars($ingredients) ?>' type="text" name="ingredients" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['ingredients'] ?></p></span>
    </div>
    <div>
        <button type="Submit" name="submit" value="submit">SUBMIT</button>
    </div>
    </form>

</section>

<?php include('Templates/Footer.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>