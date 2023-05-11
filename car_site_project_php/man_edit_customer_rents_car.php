<?php



    //the function that deletes the record
    function delete_record(){
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "rental_cars";

        if (isset($_POST["date-out"]) && isset($_POST["license-plate"]) && isset($_POST["customer-id"])) {

            $date_out = $_POST["date-out"];
            $license_plate = $_POST["license-plate"];
            $customer_id = $_POST["customer-id"];

            if($date_out == "" || $license_plate == "" || $customer_id == ""){
                echo("<p style=color:red;>Please enter a date out, license plate, and customer id.<p>");
                return -1;
            }

            // Create connection
            $conn = new mysqli($server, $user, $password, $db);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql_delete = "DELETE FROM customer_rents_car 
                           WHERE date_out = ?
                           AND license_plate = ?
                           AND customer_id = ?";
                    
            $stmt = $conn->prepare($sql_delete);
            $stmt->bind_param("sss", $date_out, $license_plate, $customer_id);
            

            try {
                if ($stmt->execute() == TRUE) {
                    
                    if ( $stmt->affected_rows == 0) {
                        //going to a site that says success
                        echo("<p style=color:red;>No rows were affected. Check to make sure you 
                        entered the correct date out, license plate, and customer id.<p>");
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

        if(isset($_POST["new-date-out"]) && isset($_POST["new-date-in"]) && isset($_POST["new-incident"]) && 
           isset($_POST["new-license-plate"]) && isset($_POST["new-customer-id"])){

            
            $new_date_out = $_POST["new-date-out"];
            $new_date_in = $_POST["new-date-in"];
            $new_incident = $_POST["new-incident"];
            $new_license_plate = $_POST["new-license-plate"];
            $new_customer_id = $_POST["new-customer-id"];
            $date_out = $_POST["date-out"];
            $license_plate = $_POST["license-plate"];
            $customer_id = $_POST["customer-id"];
            

            if($date_out == "" || $license_plate == "" || $customer_id == ""){
                echo("<p style=color:red;>Please enter the current date out, license plate, and customer id.<p>");
                return -1;
            }

            // Create connection
            $conn = new mysqli($server, $user, $password, $db);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }



            //doing the query
            $sql_update = "UPDATE customer_rents_car
                          SET date_out = ?, date_in = ?, incident = ?, license_plate = ?, customer_id = ?
                          WHERE date_out = ?
                          AND license_plate = ?
                          AND customer_id = ?";
                    
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("ssisssss", $new_date_out, $new_date_in, $new_incident, $new_license_plate, $new_customer_id, $date_out, $license_plate, $customer_id);
            

            try {
                if ($stmt->execute() == TRUE) {
                    //going to a site that says success
                    if ($stmt->affected_rows == 0) {
                        echo("<p style=color:red;>No rows were affected. Check to make sure you 
                        entered the correct date out, license plate, and customer id.<p>");
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
    <title> Manager Edit Customer Rents Car </title>
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
                
            <p style="font-style:italic; margin-top: 20px;">Type in the date out, license plate, and customer id associated 
                                                            with the record you want to update. Then, scroll down to either 
                                                            edit or delete the record.</p>

            <div class = "search-box">

                
                <!-- the form we will use to see which record we need to delete or update -->
                <form method="post" class = "update-form" name="update-form" action="man_edit_customer_rents_car.php">

                    <div class="input-container">
                        <input type="text" name="date-out" id="date-out" style="margin-left:150px;"><br>
                        <label for="date-out"> Current Date Out </label>
                        
                    </div>

                    <div class="input-container">
                        <input type="text" name="license-plate" id="license-plate" style="margin-left:150px;"><br>
                        <label for="license-plate"> Current License Plate </label>
                        
                    </div>

                    <div class="input-container">
                        <input type="text" name="customer-id" id="customer-id" style="margin-left:150px;"><br>
                        <label for="customer-id"> Current Customer ID </label>
                        
                    </div>

                
                    <div class = "edit-delete-box">

                        <div class="edit-box">
                            <p>Type in the updated record: </p>


                                <div class="input-container">
                                    <input type="text" name="new-date-out" id="new-date-out"><br>
                                    <label for="new-date-out">New Date Out </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-date-in" id="new-date-in"><br> 
                                    <label for="new-date-in">New Date In </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-incident" id="new-incident"><br>
                                    <label for="new-incident">New Incident </label>
                                    
                                </div>


                                <div class="input-container">
                                    <input type="text" name="new-license-plate" id="new-license-plate"><br>
                                    <label for="new-license-plate">New License Plate </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-customer-id" id="new-customer-id"><br>   
                                    <label for="new-customer-id">New Customer ID</label>
                                    
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
                        if (isset($_POST["date-out"]) && isset($_POST["license-plate"]) && isset($_POST["customer-id"])){
                            delete_record();
                        }
                
                    }

                    //calling our update function if udate is clicked
                    if(isset($_POST["update-value"]) && $_POST["update-value"] == "Update"){

                        if(($_POST["new-date-out"] != "") && ($_POST["new-date-in"] != "") && ($_POST["new-incident"] != "") && 
                           ($_POST["new-license-plate"] != "") && ($_POST["new-customer-id"] != "")){
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