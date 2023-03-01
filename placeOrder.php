<?php
if(isset($_POST['submit'])){
         //Test Cross site scripting (XSS) using JSCode '<script>window.location = "https://www.jw.org"</script>' 
    

        //check names
        if(empty($_POST['fullNames'])){
            echo 'Full Names are required'; 
        }
            else{
            echo htmlspecialchars ($_POST['fullNames']);
        }
        //check phone Number
        if(empty($_POST['phoneNumber'])){
            echo 'Phone Number is required';
        }
            else{
            echo htmlspecialchars ($_POST['phoneNumber']);
        }
        //check email
        $email = $_POST['email'];
        if(empty($email)){
            echo 'email is required';
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo 'Please enter a valid Email';
            }
        }
        
        //check pizzaName
        if(empty($_POST['pizzaName'])){
             echo'<script>alert("Pizza Name is required")</script>' ;
        }
            else{
            echo htmlspecialchars ($_POST['pizzaName']);
        }
        //check Ingredients
        if(empty($_POST['ingredients'])){
            echo 'Ingredients are required';
        }
            else{
            echo htmlspecialchars ($_POST['ingredients']);
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
    .formContainer{
        
    }
</style>

</head>
<body>
<?php include('Templates/Header.php'); ?>

<section class="formContainer">
    <h4>Place your Pizza Order</h4>
    <form class="pizzaOrderForm" action="placeOrder.php" method="POST">
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Full Names</span>
        <input type="text" name="fullNames"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Phone Number</span>
        <input type="text" name="phoneNumber" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
        <input type="text" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Pizza Name</span>
        <input type="text" name="pizzaName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Ingredients <br> (comma Separated)</span>
        <input type="text" name="ingredients" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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