
<?php


//the function that does the query
function query_customer(){
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "rental_cars";

    if (isset($_POST["customer-id"]) || isset($_POST["first-name"]) || isset($_POST["last-name"]) ||
        isset($_POST["age"]) || isset($_POST["gender"])) {


        if ($_POST["customer-id"] == ""){
            $customer_id = "%";
        }else{
            $customer_id = $_POST["customer-id"];
        }

        if ($_POST["first-name"] == ""){
            $first_name = '%';
        }else{
            $first_name = $_POST["first-name"];
        }

        if ($_POST["last-name"] == ""){
            $last_name = '%';
        }else{
            $last_name = $_POST["last-name"];
        }

        if ($_POST["age"] == ""){
            $age = '%';
        }else{
            $age = $_POST["age"];
        }

        if ($_POST["gender"] == ""){
            $gender = '%';
        }else{
            $gender = $_POST["gender"];
        }

         // Create connection
        $conn = new mysqli($server, $user, $password, $db);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT customer_id, first_name, last_name, age, gender 
                FROM customer 
                WHERE customer_id LIKE ? 
                AND first_name LIKE ?
                AND last_name LIKE ?
                AND age LIKE ?
                AND gender LIKE ?";
                
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $customer_id, $first_name, $last_name, $age, $gender);
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
 <title> Employee Search Customer </title>
</head>

<body>

    <div class="container">
        <div class = "company-name">
            Generic Rental Car Company
        </div>

        <div class = "nav-bar">
            <button class = "login" onclick="goToLogin()"> Login </button>
            <button class = "search" onclick="goToEmpSearch()"> Search </button>
        
        </div>

        <script>
            function goToLogin() {
                window.location = "login.php";
            }
        </script>

        <script>
                function goToEmpSearch() {
                  window.location = "emp_search.php";
                }
        </script>
            
        
        <div class = "search-box">

            <!-- the form we will use to collect data -->
            <form method="post" name="form" action="emp_search_customer.php">

                <div class="input-container">
                    <input type="text" name="customer-id" id="customer-id"><br>
                    <label for="customer-id">Customer ID </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="first-name" id="first-name"><br> 
                    <label for="first-name">First Name </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="last-name" id="last-name"><br>
                    <label for="last-name">Last Name </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="age" id="age"><br>   
                    <label for="age">Age </label>
                    
                </div>

                <div class="input-container">
                    <input type="text" name="gender" id="gender"><br>
                    <label for="gender">Gender </label>
                    
                </div>



                <input type="submit" class="submit-button">

            </form>
        </div>

        <table>
                <tbody>
                    <tr>
                        <th>Customer ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                    </tr>

                    <?php
                    //printing out the result once a value has been set
                        if (isset($_POST["customer-id"])) {
                            $result = query_customer();

                            if ($result != null) {
                                while($row = $result ->fetch_assoc()) {
                
                                    echo('<tr> <td>' . $row['customer_id'] . '</td>
                                        <td>' . $row['first_name'] . '</td>
                                        <td>' . $row['last_name'] . '</td>
                                        <td>' . $row['age'] . '</td>
                                        <td>' . $row['gender'] . '</td>
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

    .login:hover, .search:hover{
        background-color: rgb(146, 146, 190);
    }

    .login, .search{
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