<?php
    

    //function we use to add our values
    function add() {
        //this if statement helps prevent erronious warning messages
        if (isset($_POST["license-plate"]) && isset($_POST["make"]) && isset($_POST["model"]) && 
            isset($_POST["year"]) && isset($_POST["color"])){

        
            
            $license_plate= $_POST['license-plate'];
            $make = $_POST['make'];
            $model = $_POST['model'];
            $year = $_POST['year'];
            $color = $_POST['color'];

            if ($license_plate == "") {
                echo("<p style=color:red;>License plate cannot be null!");
                return -1;
            }


            $server = "localhost";
            $user = "root";
            $password = "";
            $db = "rental_cars";


            $conn = mysqli_connect($server, $user, $password, $db);


            if ($conn -> connect_error) {
                die("Connection failed ".$conn->connect_error);

            }

            $sql_insert = "INSERT INTO car VALUES ('$license_plate', '$make', '$model', '$year', '$color')";

            try {
                if ($conn->query($sql_insert) == TRUE) {
                    //going to a site that says success
                    echo("<p style=color:green;> The value was successully added to the table! </p>");
                } else {
                    throw new Exception("Error adding values: " . $conn->error);
                }
            } catch (Exception $e) {
                echo "<p style=color:red;>Error:</p>";
                echo "<p style=color:red;>" . $e->getMessage() . "</p>";
                return -1;
            }

            $conn->close();

        }


        }


    

?>


<!DOCTYPE html>

<head>
    <title>Manager Add Car</title>
</head>

<body>
    <div class="container">
            <div class = "company-name">
                Generic Rental Car Company
            </div>

            <div class = "nav-bar">
            <button class = "login" onclick="goToLogin()"> Login </button>
            <button class = "search" onclick="goToManagerSearch()"> Search </button>
            <button class = "edit" onclick="goToManagerEdit()"> Edit </button>
            <button class = "add" onclick="goToManagerAdd()"> Add </button>


            <script>
                function goToLogin() {
                  window.location = "login.php";
                }
            </script>

            <script>
                function goToManagerSearch() {
                  window.location = "man_search.php";
                }
            </script>

            <script>
                function goToManagerEdit() {
                  window.location = "man_edit.php";
                }
            </script>

            <script>
                function goToManagerAdd() {
                  window.location = "man_add.php";
                }
            </script>
        </div>
        

        <div class = "add-box">

            <form class="car-add" method="post" name="form" action="man_add_car.php">
                <div class="input-container">
                    <input type="text" name="license-plate" id="license-plate"><br>
                    <label for="license-plate">License_plate</label>
                    
                </div>
                
                <div class="input-container">
                    <input type="text" name="make" id="make"><br>
                    <label for="make">Make</label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="model" id="model"><br>
                    <label for="model">Model</label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="year" id="year"><br>
                    <label for="year">Year</label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="color" id="color"><br>
                    <label for="color">Color</label>
                    
                </div>

            

                <input type="submit" class="submit-button">

                <?php

                    //calling our add function
                    if (isset($_POST["license-plate"]) && isset($_POST["make"]) && isset($_POST["model"]) && 
                        isset($_POST["year"]) && isset($_POST["color"])){
                                $result = add();
                        }

                ?>
            </form>
        </div>
    </div>

</body>


<style>

    .body{
        background-color: rgb(250, 250, 250);
    }

    .container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: Arial, Helvetica, sans-serif;
        vertical-align: middle;
    }

    .company-name{
        font-size: 65px;
        text-align: center;
        margin-top: 2%;
        white-space: nowrap;
        color: rgb(84, 84, 151);
    }

    .nav-bar{
        display: flex;
        flex-direction: row;
        justify-content: center;
        margin-top: 20px;
        border: 2px solid rgb(207, 206, 206);
        background-color: white;
        border-radius: 2px;
    }

    .add-box{
        border: 2px solid rgb(207, 206, 206);
        border-radius: 2px;
        background-color: white;
        margin-top: 50px;
        margin-bottom: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }


    .search, .edit, .add, .login{
        width: 130px;
        height: 50px;
        border-radius: 5px;
        border-width: 0px;
        background-color: rgb(110, 110, 229);
        color: white;
        transition-duration: 0.2s;
        margin: 5px;
    }

    .search:hover{
        background-color: rgb(146, 146, 190);
    }

    .edit:hover{
        background-color: rgb(146, 146, 190);
    }

    .add:hover{
        background-color: rgb(146, 146, 190);
    }

    .login:hover{
        background-color: rgb(146, 146, 190);
    }

    .car-add{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: left;
    }

    .input-container{
        margin-top: 5px;
        margin-bottom: 5px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    input{
        width: 200px;


    }

    label{
        margin: 5px;
        margin-left: 20px;

    }

    .submit-button{
        margin-top: 30px;
        margin-left: 93px;
        width: 130px;
        height: 50px;
        border-radius: 5px;
        border-width: 0px;
        background-color: rgb(110, 110, 229);
        color: white;
        transition-duration: 0.2s;

    }



    .submit-button:hover{
        background-color: rgb(146, 146, 190);
    }

</style>
