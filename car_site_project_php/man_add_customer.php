<?php
    

    //function we use to add our values
    function add() {
        //this if statement helps prevent erronious warning messages
        if (isset($_POST["customer-id"]) && isset($_POST["first-name"]) && isset($_POST["last-name"]) && 
            isset($_POST["age"]) && isset($_POST["gender"])){

        
            
            $customer_id= $_POST['customer-id'];
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];

            if ($customer_id == "") {
                echo("<p style=color:red;>Customer ID cannot be null!");
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

            $sql_insert = "INSERT INTO customer VALUES ('$customer_id', '$first_name', '$last_name', '$age', '$gender')";

            try {
                if ($conn->query($sql_insert) == TRUE) {
                    //giving a statement to tell the user the value was added succesfully
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
    <title>Manager Add Customer</title>
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

            <form class="customer-add" method="post" name="form" action="man_add_customer.php">
                <div class="input-container">
                    <input type="text" name="customer-id" id="customer-id"><br>
                    <label for="customer-id">Customer ID</label>
                    
                </div>
                
                <div class="input-container">
                    <input type="text" name="first-name" id="first-name"><br>
                    <label for="first-name">First Name</label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="last-name" id="last-name"><br>
                    <label for="last-name">Last Name</label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="age" id="age"><br>
                    <label for="age">Age</label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="gender" id="gender"><br>
                    <label for="gender">Gender</label>
                    
                </div>

            

                <input type="submit" class="submit-button">

                <?php

                    //calling our add function
                    if (isset($_POST["customer-id"]) && isset($_POST["first-name"]) && isset($_POST["last-name"]) && 
                        isset($_POST["age"]) && isset($_POST["gender"])){
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

    .customer-add{
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
