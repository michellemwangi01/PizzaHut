<?php

include('Config/db_connect.php');

//retrieve the data from the database
$sqlquery = 'SELECT ID, PIZZATITLE, INGREDIENTS FROM PIZZAS';

//make query & get result
$result = mysqli_query($conn, $sqlquery);

//convert result into an associative array because it doesnt come that way by default
 $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

//explode(',', $pizzas[0]['ingredients']) //explode function converts string delimited text into array!!
//:...endforeach are better sysntax coz they allow you to have cleaner code instead of looking for the closing bracket

//PRINT_R( $pizzas);//print out our result
 //mysqli_free_result($result); //free result from memory
 //mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>Document</title>

<style>

    .pizzaImg{
        width: 30%;
        margin: 40px auto -30px;
        display: block;
        position: absolute;
        top: -110px;
    }
    .bodyContainer{
        background-color: black ;
        margin: 0;
    }

    .pizzaListContainer{
        width: 90%;
        margin:auto;
        margin-bottom: 20px;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;  
    }
    .pizzaElementContainer{
        position: relative;
        display: flex;        
        flex-direction: column;
        justify-content: top;
        align-items: center;
        text-align: center;
        background-color: rgb(33, 31, 31);
        color: whitesmoke;
        padding-top:15px;
        border-radius: 10px;
        height: 400px;
        margin: 50px 2%;

    }
    .pizzaElementContainer:hover {
        box-shadow: 0 0 7px #e18936; 
    }s
    #PizzaHutPizzas{
        text-align: center;
        color: #e49b56;
    }
    #titleContainer{
        padding: 10px;
        margin: 5px;
        text-align: center;
        color: #e49b56;
    }
    ul{
        margin-top: 10px;
    }
    li{
        list-style-type: none;
        text-align: left;
        padding-top: 5px;
    }
    .buttonDiv{
        position: absolute;
        bottom: 10px;
        right: auto;
        color:#e49b56;
        border: none;
        background-color: transparent;
        padding-top: 10px;
        color: whitesmoke;

    }
    .mycheckclass{
        color: #e49b56;
    }
    .IngredientslistDiv{
        display: flex;
        flex-direction: column;
        justify-content: left;
    }
    .textContent{
        position: absolute;
        top: 80px;
    }
    hr{
        color: #e49b56;
        height: 2px;
        width: 100%;
    }
    

</style>

</head>
<body>
<?php include('Templates/Header.php'); ?>
    

<div class="bodyContainer">
    <div id="titleContainer">
        <h1 id="PizzaHutPizzas">Pizza Hut Pizzas</h1>
    </div>
    <div class=" pizzaListContainer">
        
        <?php 
        foreach($pizzas as $pizzaElement) :  ?>
            <div class="pizzaElementContainer">
            <img class="pizzaImg" src="Images/pizzaImage2.png" alt="">
                <div class="textContent">
                <h3> <?php echo htmlspecialchars($pizzaElement['PIZZATITLE']); ?></h3>
                <div class="IngredientslistDiv">
                    <ul>
                    <?php foreach(explode(',', $pizzaElement['INGREDIENTS']) as $ingredient): ?>
                    <li><i class="mycheckclass bi bi-check-circle-fill"></i>  <?php echo htmlspecialchars($ingredient) ; ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                </div>
                <div class="buttonDiv">
                    <hr  >
                <a href = "details.php?id=<?php echo htmlspecialchars($pizzaElement['ID'])?>" class=""> MORE INFO</a>
                        <hr>
            </div>
                
                
            </div>
            
        <?php endforeach ?> 
        
        

    </div>
</div>

<?php include('Templates/Footer.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>