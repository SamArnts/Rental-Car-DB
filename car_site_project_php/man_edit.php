<!DOCTYPE html>
<head>
    <title> Manager Edit</title>
</head>

<body>
    <div class="container">
        <div class = "company-name">
            Generic Rental Car Company
        </div>

        <div class = "nav-bar">
            <button class = "login" onclick="goToLogin()"> Login </button>
            <button class = "search"  onclick="goToManagerSearch()"> Search </button>
            <button class = "edit"> Edit </button>
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
                function goToManagerAdd() {
                  window.location = "man_add.php";
                }
            </script>
        </div>

        <div class = "search-box">

            <div class = "show">

                <label class = "box-label"> What table would you like to edit?</label> <br>

                <div class = "radio-box">
                    <div class = "car-box">
                        <input type="radio" name="select" id="car"> 
                        <label for="car"> Car </label>
                    </div>
                    
                    <div class = "cust-box">
                        <input type="radio" name="select" id="customer">
                        <label for="customer"> Customer </label>
                    </div>


                    <div class = "ins-box">
                        <input type="radio" name="select" id="insurance">
                        <label for="insurance"> Insurance_policy </label>
                    </div>

                    <div class = "incident-box">
                        <input type="radio" name="select" id="incident">
                        <label for="incident"> Incident</label>
                    </div>

                    <div class = "rental-box">
                        <input type="radio" name="select" id="rental">
                        <label for="incident"> Cusomters_rents_car </label>
                    </div>
                    
                </div>
            </div>

            <button class="submit-button" onclick="submit()"> Submit </button>

            <!-- script changes the page depending on what is selected -->
            <script> 

                function submit() {
                    if (document.getElementById("car").checked) {
                        window.location = "man_edit_car.php";
                    }
                    if(document.getElementById("customer").checked){
                        window.location = "man_edit_customer.php";
                    }
                    if(document.getElementById("insurance").checked){
                        window.location = "man_edit_insurance.php"
                    }
                    if(document.getElementById("incident").checked){
                        window.location = "man_edit_incident.php";
                    }
                    if(document.getElementById("rental").checked){
                        window.location = "man_edit_customer_rents_car.php"
                    }
                }
            </script>

        </div>
        

    <div>



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

    .edit{
        width: 130px;
        height: 50px;
        border-radius: 5px;
        border-width: 0px;
        background-color: rgb(207, 206, 206);
        margin: 5px;
    }

    .login, .add, .search{
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
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }

    .show{
        display: flex;
        flex-direction: column;
        border: 2px solid rgb(110, 110, 229);
        border-radius: 2px;
        background-color: white;
        padding: 20px;
        height: 175px;
    }



    .submit-button{
        margin-top: 30px;
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

    .search:hover{
        background-color: rgb(146, 146, 190);
    }

    .add:hover{
        background-color: rgb(146, 146, 190);
    }

    .login:hover{
        background-color: rgb(146, 146, 190);
    }

</style>