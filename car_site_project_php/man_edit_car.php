<?php



    //the function that deletes the record
    function delete_record(){
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "rental_cars";

        if (isset($_POST["license-plate"]) ) {

            $license_plate = $_POST["license-plate"];

            if($license_plate == ""){
                echo("<p style=color:red;>Please enter a license plate.<p>");
                return -1;
            }

            // Create connection
            $conn = new mysqli($server, $user, $password, $db);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql_delete = "DELETE FROM CAR WHERE license_plate = ?";
                    
            $stmt = $conn->prepare($sql_delete);
            $stmt->bind_param("s", $license_plate);
            

            try {
                if ($stmt->execute() == TRUE) {
                    
                    if ( $stmt->affected_rows == 0) {
                        //going to a site that says success
                        echo("<p style=color:red;>No rows were affected. Check to make sure you 
                        entered the correct license plate.<p>");
                    }else{
                        //statement was succesfful
                        echo("<p style=color:green;> The value was successully deleted from the table! </p>");
                    }
                } else {
                    throw new Exception("Error deleting values: " . $conn->error);
                }
            } catch (Exception $e) {
                echo "<p style=color:red;>Error:</p>";
                echo "<p style=color:red;>" . $e->getMessage() . "</p>";
                return -1;
            }

            $conn->close();
        }
    
    }


    //the function that deletes the record
    function update_record(){
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "rental_cars";

        if(isset($_POST["new-license-plate"]) && isset($_POST["new-make"]) && isset($_POST["new-model"]) && 
           isset($_POST["new-year"]) && isset($_POST["new-color"])){

            $new_license_plate = $_POST["new-license-plate"];
            $new_make = $_POST["new-make"];
            $new_model = $_POST["new-model"];
            $new_year = $_POST["new-year"];
            $new_color = $_POST["new-color"];
            $license_plate = $_POST["license-plate"];

            if($license_plate == ""){
                echo("<p style=color:red;>Please enter the current license plate.<p>");
                return -1;
            }

            // Create connection
            $conn = new mysqli($server, $user, $password, $db);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }



            //doing the query
            $sql_update = "UPDATE CAR SET license_plate = ?, make = ?, model = ?, year = ?, color = ? WHERE license_plate = ?";
                    
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("ssssss", $new_license_plate, $new_make, $new_model, $new_year, $new_color, $license_plate);
            

            try {
                if ($stmt->execute() == TRUE) {
                    //going to a site that says success
                    if ($stmt->affected_rows == 0) {
                        echo("<p style=color:red;>No rows were affected. Check to make sure you 
                        entered the correct license plate.<p>");
                    }else{
                        //statement is successful
                        echo("<p style=color:green;> The value was successully updated in the table! </p>");
                    }
                } else {
                    throw new Exception("Error updating value: " . $conn->error);
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
    <title> Manager Edit Car </title>
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
                
            <p style="font-style:italic; margin-top: 20px;">Type in the license plate associated with the record you want to update.
                                                            Then, scroll down to either edit or delete the record.</p>

            <div class = "search-box">

                
                <!-- the form we will use to see which record we need to delete or update -->
                <form method="post" class = "update-form" name="update-form" action="man_edit_car.php">

                    <div class="input-container">
                        <input type="text" name="license-plate" id="license-plate" style="margin-left:150px;"><br>
                        <label for="license-plate"> Current License Plate </label>
                        
                    </div>

                
                    <div class = "edit-delete-box">

                        <div class="edit-box">
                            <p>Type in the updated record: </p>


                                <div class="input-container">
                                    <input type="text" name="new-license-plate" id="new-license-plate"><br>
                                    <label for="new-license-plate">New License Plate </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-make" id="new-make"><br> 
                                    <label for="new-make">New Make </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-model" id="new-model"><br>
                                    <label for="new-model">New Model </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-year" id="new-year"><br>   
                                    <label for="new-year">New Year </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-color" id="new-color"><br>
                                    <label for="new-color">New Color </label>
                                    
                                </div>

                                <input type="submit" name="update-value" value="Update" class="update-button">



                        </div>

                        <div class = "delete-box">
                            <p> Or delete: </p>

                            <input type="submit" name="delete-value" value="Delete" class="delete-button" >

                        </div>
                    


                    </div>
                </form>

                <?php

                    //calling our delete function if delete is clicked
                    if(isset($_POST["delete-value"]) && $_POST["delete-value"] == "Delete"){
                        if (isset($_POST["license-plate"])){
                            delete_record();
                        }
                
                    }

                    //calling our update function if udate is clicked
                    if(isset($_POST["update-value"]) && $_POST["update-value"] == "Update"){

                        if(($_POST["new-license-plate"] != "") && ($_POST["new-make"] != "") && ($_POST["new-model"] != "") && 
                           ($_POST["new-year"] != "") && ($_POST["new-color"] != "")){
                            update_record();
                        }else{
                            echo("<p style=color:red;>Please fill out update form.<p>");
                        }
                        
                    }

                ?>



            </div>

            

        </div>                    

    </body>

<style>

    html * {
        font-family: Arial, Helvetica, sans-serif;
    }

    .body{
        background-color: rgb(250, 250, 250);
    }

    .container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .company-name{
        font-family: Arial, Helvetica, sans-serif;
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


    .login, .search, .add, .edit{
        width: 130px;
        height: 50px;
        border-radius: 5px;
        border-width: 0px;
        background-color: rgb(110, 110, 229);
        color: white;
        transition-duration: 0.2s;
        margin: 5px;
    }

    .search-box{
        border: 2px solid rgb(207, 206, 206);
        border-radius: 2px;
        background-color: white;
        margin-top: 30px;
        margin-bottom: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }

    .input-container{
        margin-top: 5px;
        margin-bottom: 5px;
        display: flex;
        flex-direction: row;
    }

    input{
        margin-right: 15px;
    }


    .search-button{
        margin-top: 30px;
        margin-left: 75px;
        width: 130px;
        height: 50px;
        border-radius: 5px;
        border-width: 0px;
        background-color: rgb(110, 110, 229);
        color: white;
        transition-duration: 0.2s;

    }

    .search-button:hover, .delete-button:hover, .update-button:hover{
        background-color: rgb(146, 146, 190);
    }

    .login:hover{
        background-color: rgb(146, 146, 190);
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
    

    .edit-delete-box{
        margin-top: 10px;
        margin-bottom: 10px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 30px;
        

    }

    .edit-box{
        display: flex;
        flex-direction: column;
        border: 2px solid rgb(110, 110, 229);
        border-radius: 2px;
        background-color: white;
        padding: 20px;
        height: 300px;
        
    }

    .delete-box{
        display: flex;
        flex-direction: column;
        border: 2px solid rgb(110, 110, 229);
        border-radius: 2px;
        background-color: white;
        padding: 20px;
        height: 300px;
        margin-left: 20px;
        justify-content: center;
        align-items: center;
    }

    .delete-button{
        margin-top: 15px;
        width: 130px;
        height: 50px;
        border-radius: 5px;
        border-width: 0px;
        background-color: rgb(110, 110, 229);
        color: white;
        transition-duration: 0.2s;

    }

    .update-button{
        margin-top: 15px;
        margin-left: 75px;
        width: 130px;
        height: 50px;
        border-radius: 5px;
        border-width: 0px;
        background-color: rgb(110, 110, 229);
        color: white;
        transition-duration: 0.2s;

    }

</style>