<?php



    //the function that deletes the record
    function delete_record(){
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "rental_cars";

        if (isset($_POST["policy-id"])){

            $policy_id = $_POST["policy-id"];

            if($policy_id == ""){
                echo("<p style=color:red;>Please enter a policy id.<p>");
                return -1;
            }

            // Create connection
            $conn = new mysqli($server, $user, $password, $db);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql_delete = "DELETE FROM insurance_policy WHERE policy_id = ?";
                    
            $stmt = $conn->prepare($sql_delete);
            $stmt->bind_param("s", $policy_id);
            

            try {
                if ($stmt->execute() == TRUE) {

                    if ( $stmt->affected_rows == 0) {
                        echo("<p style=color:red;>No rows were affected. Check to make sure you 
                        entered the correct policy id.<p>");
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

        if(isset(($_POST["new-policy-id"])) && (isset($_POST["new-monthly-cost"])) && (isset($_POST["new-deductible"])) && 
            (isset($_POST["new-license-plate"]))){

            $new_policy_id = $_POST["new-policy-id"];
            $new_monthly_cost = $_POST["new-monthly-cost"];
            $new_deductible= $_POST["new-deductible"];
            $new_license_plate = $_POST["new-license-plate"];
            $policy_id = $_POST["policy-id"];

            if($policy_id == ""){
                echo("<p style=color:red;>Please enter the current policy id.<p>");
                return -1;
            }

            // Create connection
            $conn = new mysqli($server, $user, $password, $db);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }



            //doing the query
            $sql_update = "UPDATE insurance_policy SET policy_id = ?, monthly_cost = ?, deductible = ?, license_plate = ? WHERE policy_id = ?";
                    
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("siiss", $new_policy_id, $new_monthly_cost, $new_deductible, $new_license_plate, $policy_id);
            

            try {
                if ($stmt->execute() == TRUE) {
                    if ( $stmt->affected_rows == 0) {
                        echo("<p style=color:red;>No rows were affected. Check to make sure you 
                        entered the correct policy id.<p>");
                    }else{
                        //statement was succesfful
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
    <title> Manager Edit Insurance </title>
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
                
            <p style="font-style:italic; margin-top: 20px;">Type in the policy id associated with the record you want to update.
                                                            Then, scroll down to either edit or delete the record.</p>

            <div class = "search-box">

                
                <!-- the form we will use to see which record we need to delete or update -->
                <form method="post" class = "update-form" name="update-form" action="man_edit_insurance.php">

                    <div class="input-container">
                        <input type="text" name="policy-id" id="policy-id" style="margin-left:150px;"><br>
                        <label for="policy-id"> Current Policy ID </label>
                        
                    </div>

                
                    <div class = "edit-delete-box">

                        <div class="edit-box">
                            <p>Type in the updated record: </p>


                                <div class="input-container">
                                    <input type="text" name="new-policy-id" id="new-policy-id"><br>
                                    <label for="new-policy-id">New Policy ID </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-monthly-cost" id="new-monthly-cost"><br> 
                                    <label for="new-monthly-cost">New Monthly Cost </label>
                                    
                                </div>

                                <div class="input-container">
                                    <input type="text" name="new-deductible" id="new-deductible"><br>
                                    <label for="new-deductible">New Deductible </label>
                                    
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
                        if (isset($_POST["policy-id"])){
                            delete_record();
                        }
                
                    }

                    //calling our update function if udate is clicked
                    if(isset($_POST["update-value"]) && $_POST["update-value"] == "Update"){

                        if(($_POST["new-policy-id"] != "") && ($_POST["new-monthly-cost"] != "") && ($_POST["new-deductible"] != "") && 
                           ($_POST["new-license-plate"] != "")){
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