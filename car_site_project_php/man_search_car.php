<?php


//the function that does the query
function query_car(){
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "rental_cars";

    if (isset($_POST["license-plate"]) || isset($_POST["make"]) || isset($_POST["model"]) ||
        isset($_POST["year"]) || isset($_POST["color"])) {


        if ($_POST["license-plate"] == ""){
            $license_plate = "%";
        }else{
            $license_plate = $_POST["license-plate"];
        }

        if ($_POST["make"] == ""){
            $make = '%';
        }else{
            $make= $_POST["make"];
        }

        if ($_POST["model"] == ""){
            $model = '%';
        }else{
            $model = $_POST["model"];
        }

        if ($_POST["year"] == ""){
            $year = '%';
        }else{
            $year = $_POST["year"];
        }

        if ($_POST["color"] == ""){
            $color = '%';
        }else{
            $color = $_POST["color"];
        }

         // Create connection
        $conn = new mysqli($server, $user, $password, $db);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT license_plate, make, model, year, color 
                FROM car 
                WHERE license_plate LIKE ? 
                AND make LIKE ?
                AND model LIKE ?
                AND year LIKE ?
                AND color LIKE ?";
                
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $license_plate, $make, $model, $year, $color);
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
 <title> Manager Search Car </title>
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
            <form method="post" name="form" action="man_search_car.php">

                <div class="input-container">
                    <input type="text" name="license-plate" id="license-plate"><br>
                    <label for="license-plate">License Plate </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="make" id="make"><br> 
                    <label for="make">Make </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="model" id="model"><br>
                    <label for="model">Model </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="year" id="year"><br>   
                    <label for="year">Year </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="color" id="color"><br>
                    <label for="color">Color </label>
                    
                </div>



                <input type="submit" class="submit-button">

            </form>
        </div>

        <table>
                <tbody>
                    <tr>
                        <th>License Plate</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Color</th>
                    </tr>

                    <?php
                    //printing out the result once a value has been set
                        if (isset($_POST["license-plate"])) {
                            $result = query_car();

                            if ($result != null) {
                                while($row = $result ->fetch_assoc()) {
                
                                    echo('<tr> <td>' . $row['license_plate'] . '</td>
                                        <td>' . $row['make'] . '</td>
                                        <td>' . $row['model'] . '</td>
                                        <td>' . $row['year'] . '</td>
                                        <td>' . $row['color'] . '</td>
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
    
    table, th, td {
        border: 1px solid;
    }
    
    table {
        border-collapse: collapse;
        width: 100%
    }
    
    

</style>