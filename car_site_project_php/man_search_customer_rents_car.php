
<?php


//the function that does the query
function query_customer_rents_car(){
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "rental_cars";

    if (isset($_POST["date-out"]) || isset($_POST["date-in"]) || isset($_POST["incident"]) ||
        isset($_POST["license-plate"]) || isset($_POST["customer-id"])) {


        if ($_POST["date-out"] == ""){
            $date_out = "%";
        }else{
            $date_out = $_POST["date-out"];
        }

        if ($_POST["date-in"] == ""){
            $date_in = '%';
        }else{
            $date_in= $_POST["date-in"];
        }

        if ($_POST["incident"] == ""){
            $incident = '%';
        }else{
            $incident = $_POST["incident"];
        }

        if ($_POST["license-plate"] == ""){
            $license_plate = '%';
        }else{
            $license_plate = $_POST["license-plate"];
        }

        if ($_POST["customer-id"] == ""){
            $customer_id = '%';
        }else{
            $customer_id = $_POST["customer-id"];
        }

         // Create connection
        $conn = new mysqli($server, $user, $password, $db);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT date_out, date_in, incident, license_plate, customer_id 
                FROM customer_rents_car 
                WHERE date_out LIKE ? 
                AND date_in LIKE ?
                AND incident LIKE ?
                AND license_plate LIKE ?
                AND customer_id LIKE ?";
                
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $date_out, $date_in, $incident, $license_plate, $customer_id);
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
 <title> Manager Search Customer Rents Car </title>
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
            <form method="post" name="form" action="man_search_customer_rents_car.php">

                <div class="input-container">
                    <input type="text" name="date-out" id="date-out"><br>
                    <label for="date-out">Date Out </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="date-in" id="date-in"><br> 
                    <label for="date-in">Date In </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="incident" id="incident"><br>
                    <label for="incident">Incident </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="license-plate" id="license-plate"><br>   
                    <label for="license-plate">License Plate </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="customer-id" id="customer-id"><br>
                    <label for="customer-id">Customer ID </label>
                    
                </div>



                <input type="submit" class="submit-button">

            </form>
        </div>

        <table>
                <tbody>
                    <tr>
                        <th>Date Out</th>
                        <th>Date In</th>
                        <th>Incident</th>
                        <th>License Plate</th>
                        <th>Customer ID</th>
                    </tr>

                    <?php
                    //printing out the result once a value has been set
                        if (isset($_POST["date-out"])) {
                            $result = query_customer_rents_car();

                            if ($result != null) {
                                while($row = $result ->fetch_assoc()) {
                
                                    echo('<tr> <td>' . $row['date_out'] . '</td>
                                        <td>' . $row['date_in'] . '</td>
                                        <td>' . $row['incident'] . '</td>
                                        <td>' . $row['license_plate'] . '</td>
                                        <td>' . $row['customer_id'] . '</td>
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

    .login:hover, .search:hover, .edit:hover, .add:hover{
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