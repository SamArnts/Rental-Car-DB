<?php


//the function that does the query
function query_incident(){
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "rental_cars";

    if (isset($_POST["incident-id"]) || isset($_POST["incident-description"]) || isset($_POST["resolved"]) ||
        isset($_POST["cost"]) || isset($_POST["reinstated"]) || isset($_POST["license-plate"])) {


        if ($_POST["incident-id"] == ""){
            $incident_id = "%";
        }else{
            $incident_id = $_POST["incident-id"];
        }

        if ($_POST["incident-description"] == ""){
            $incident_description = '%';
        }else{
            $incident_description = $_POST["incident-description"];
        }

        if ($_POST["resolved"] == ""){
            $resolved = '%';
        }else{
            $resolved = $_POST["resolved"];
        }

        if ($_POST["cost"] == ""){
            $cost = '%';
        }else{
            $cost = $_POST["cost"];
        }

        if ($_POST["reinstated"] == ""){
            $reinstated = '%';
        }else{
            $reinstated = $_POST["reinstated"];
        }

        if ($_POST["license-plate"] == ""){
            $license_plate = '%';
        }else{
            $license_plate = $_POST["license-plate"];
        }

         // Create connection
        $conn = new mysqli($server, $user, $password, $db);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT incident_id, incident_description, resolved, cost, reinstated, license_plate 
                FROM incident 
                WHERE incident_id LIKE ? 
                AND incident_description LIKE ?
                AND resolved LIKE ?
                AND cost LIKE ?
                AND reinstated LIKE ?
                AND license_plate LIKE ?";
                
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $incident_id, $incident_description, $resolved, $cost, $reinstated, $license_plate);
        $stmt->execute();
        $result = $stmt->get_result();

    
        if ($result->num_rows > 0) {
            return $result;
        } else {
            echo("<p style=color:red>No results.</p>");
            return null;
            
        }
        $conn->close();
    }


   
}

?>

<!DOCTYPE html>

<head>
 <title> Manager Search Incident </title>
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
            
        
        <div class = "search-box">

            <!-- the form we will use to collect data -->
            <form method="post" name="form" action="man_search_incident.php">

                <div class="input-container">
                    <input type="text" name="incident-id" id="incident-id"><br>
                    <label for="incident-id">Incident ID </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="incident-description" id="incident-description"><br> 
                    <label for="incident-description">Incident Description </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="resolved" id="resolved"><br>
                    <label for="resolved">Resolved </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="cost" id="cost"><br>   
                    <label for="cost">Cost </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="reinstated" id="reinstated"><br>
                    <label for="reinstated">Reinstated </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="license-plate" id="license-plate"><br>
                    <label for="license-plate">License Plate</label>
                </div>

                <input type="submit" class="submit-button">

            </form>
        </div>

        <table>
                <tbody>
                    <tr>
                        <th>Incident ID</th>
                        <th>Incident Description</th>
                        <th>Resolved</th>
                        <th>Cost</th>
                        <th>Reinstated</th>
                        <th>License Plate</th>
                    </tr>

                    <?php
                    //printing out the result once a value has been set
                        if (isset($_POST["incident-id"])) {
                            $result = query_incident();

                            if ($result != null) {
                                while($row = $result ->fetch_assoc()) {
                
                                    echo('<tr> <td>' . $row['incident_id'] . '</td>
                                        <td>' . $row['incident_description'] . '</td>
                                        <td>' . $row['resolved'] . '</td>
                                        <td>' . $row['cost'] . '</td>
                                        <td>' . $row['reinstated'] . '</td>
                                        <td>' . $row['license_plate'] . '</td>
                                        </tr>');
        
                                }
                            }

                            
                        }
                            
                    
                    ?>
                </tbody>
        </table>


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

    .login:hover, .search:hover, .add:hover, .edit:hover{
        background-color: rgb(146, 146, 190);
    }

    .login, .search, .edit, .add{
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
        justify-content: space-between;
    }

    input{
        margin-right: 15px;
    }


    .submit-button{
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

    .submit-button:hover{
        background-color: rgb(146, 146, 190);
    }
    
    table, th, td {
        border: 1px solid;
    }
    
    table {
        border-collapse: collapse;
        width: 100%
    }
    
    

</style>