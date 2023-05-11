<?php


//the function that does the query
function query_insurance(){
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "rental_cars";

    if (isset($_POST["policy-id"]) || isset($_POST["monthly-cost"]) || isset($_POST["deductible"]) ||
        isset($_POST["license-plate"])) {


        if ($_POST["policy-id"] == ""){
            $policy_id = "%";
        }else{
            $policy_id = $_POST["policy-id"];
        }

        if ($_POST["monthly-cost"] == ""){
            $monthly_cost = '%';
        }else{
            $monthly_cost= $_POST["monthly-cost"];
        }

        if ($_POST["deductible"] == ""){
            $deductible = '%';
        }else{
            $deductible = $_POST["deductible"];
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

        $sql = "SELECT policy_id, monthly_cost, deductible, license_plate 
                FROM insurance_policy
                WHERE policy_id LIKE ? 
                AND monthly_cost LIKE ?
                AND deductible LIKE ?
                AND license_plate LIKE ?";
                
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $policy_id, $monthly_cost, $deductible, $license_plate);
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
 <title> Manager Search Insurance </title>
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
            <form method="post" name="form" action="man_search_insurance.php">

                <div class="input-container">
                    <input type="text" name="policy-id" id="policy-id"><br>
                    <label for="policy-id">Policy ID </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="monthly-cost" id="monthly-cost"><br> 
                    <label for="monthly-cost">Monthly Cost </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="deductible" id="deductible"><br>
                    <label for="deductible">Deductible </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="license-plate" id="license-plate"><br>   
                    <label for="license-plate">License Plate </label>
                    
                </div>

                <input type="submit" class="submit-button">

            </form>
        </div>

        <table>
                <tbody>
                    <tr>
                        <th>Policy ID</th>
                        <th>Monthly Cost</th>
                        <th>Deductible</th>
                        <th>License Plate</th>
                    </tr>

                    <?php
                    //printing out the result once a value has been set
                        if (isset($_POST["policy-id"])) {
                            $result = query_insurance();

                            if ($result != null) {
                                while($row = $result ->fetch_assoc()) {
                
                                    echo('<tr> <td>' . $row['policy_id'] . '</td>
                                        <td>' . $row['monthly_cost'] . '</td>
                                        <td>' . $row['deductible'] . '</td>
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