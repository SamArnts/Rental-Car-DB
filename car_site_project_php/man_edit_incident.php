<?php



    //the function that deletes the record
    function delete_record(){
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "rental_cars";

        if (isset($_POST["incident-id"]) ) {

            $incident_id = $_POST["incident-id"];

            if($incident_id == ""){
                echo("<p style=color:red;>Please enter an incident id.<p>");
                return -1;
            }

            // Create connection
            $conn = new mysqli($server, $user, $password, $db);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql_delete = "DELETE FROM incident WHERE incident_id = ?";
                    
            $stmt = $conn->prepare($sql_delete);
            $stmt->bind_param("s", $incident_id);
            

            try {
                if ($stmt->execute() == TRUE) {
                    
                    if ( $stmt->affected_rows == 0) {
                        //going to a site that says success
                        echo("<p style=color:red;>No rows were affected. Check to make sure you 
                        entered the correct incident id.<p>");
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

        if(isset($_POST["new-incident-id"]) && isset($_POST["new-incident-description"]) && isset($_POST["new-resolved"]) && 
           isset($_POST["new-cost"]) && isset($_POST["new-reinstated"]) && isset($_POST["new-license-plate"])){

            
            $new_incident_id = $_POST["new-incident-id"];
            $new_incident_description = $_POST["new-incident-description"];
            $new_resolved = $_POST["new-resolved"];
            $new_cost = $_POST["new-cost"];
            $new_reinstated = $_POST["new-reinstated"];
            $new_license_plate = $_POST["new-license-plate"];
            $incident_id = $_POST["incident-id"];

            if($incident_id == ""){
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
            $sql_update = "UPDATE incident SET incident_id = ?, incident_description = ?, resolved = ?, cost = ?, reinstated = ?, license_plate = ? WHERE incident_id = ?";
                    
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("ssiiiss", $new_incident_id, $new_incident_description, $new_resolved, $new_cost, $new_reinstated, $new_license_plate, $incident_id);
            

            try {
                if ($stmt->execute() == TRUE) {
                    //going to a site that says success
                    if ($stmt->affected_rows == 0) {
                        echo("<p style=color:red;>No rows were affected. Check to make sure you 
                        entered the correct incident id.<p>");
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
    <title> Manager Edit Incident </title>
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
                
            <p style="font-style:italic; margin-top: 20px;">Type in the incident id associated with the record you want to update.
                                                            Then, scroll down to either edit or delete the record.</p>

            <div class = "search-box">

                
                <!-- the form we will use to see which record we need to delete or update -->
                <form method="post" class = "update-form" name="update-form" action="man_edit_incident.php">

                    <div class="input-container">
                        <input type="text" name="incident-id" id="incident-id" style="margin-left:150px;"><br>
                        <label for="incident-id"> Current Incident ID </label>
                        
                    </div>

                
                    <div class = "edit-delete-box">

                        <div class="edit-box">
                            <p>Type in the updated record: </p>


                                <div class="input-container">
                                    <input type="text" name="new-incident-id" id="new-incident-id"><br>
                                    <label for="new-incident-id">New Incident ID </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-incident-description" id="new-incident-description"><br> 
                                    <label for="new-incident-description">New Incident Description </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-resolved" id="new-resolved"><br>
                                    <label for="new-resolved">New Resolved </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-cost" id="new-cost"><br>   
                                    <label for="new-cost">New Cost </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-reinstated" id="new-reinstated"><br>
                                    <label for="new-reinstated">New Reinstated </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-license-plate" id="new-license-plate"><br>
                                    <label for="new-license-plate">New License Plate </label>
                                    
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
                        if (isset($_POST["incident-id"])){
                            delete_record();
                        }
                
                    }

                    //calling our update function if udate is clicked
                    if(isset($_POST["update-value"]) && $_POST["update-value"] == "Update"){

                        if(($_POST["new-incident-id"] != "") && ($_POST["new-incident-description"] != "") && ($_POST["new-resolved"] != "") && 
                           ($_POST["new-cost"] != "") && ($_POST["new-reinstated"] != "") && ($_POST["new-license-plate"] != "")){
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