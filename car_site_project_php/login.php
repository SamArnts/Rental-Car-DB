<!DOCTYPE html>

<html>
    <head>
        <title>Log In</title>
    </head>
    
    <body> 
        <div class="container">
            <div class = "company-name">
                Generic Rental Car Company
            </div>

            <div class="login-box">
                <div class = "login"> Login </div>
                
                
                <div class = "radio-box">
                    <div class = "emp-box">
                        <input type="radio" name="login" id="employee"> 
                        <label for="employee"> Employee </label>
                    </div>
                    
                    <div class = "man-box">
                        <input type="radio" name="login" id="manager">
                        <label for="manager"> Manager </label>
                    </div>
                    
                    
                </div>
                
                <button class="login-button" onclick=navigate()>Login</button>

                <!-- Navigating to correct page based on login credentials -->
                <script>
                    function navigate(){
                        if (document.getElementById('employee').checked) {
                            window.location = "emp_search.php";
                        }else if (document.getElementById('manager').checked){
                            window.location = "man_search.php";
                        }else{
                            return;
                        }
                    }
                </script>

            </div>
            
        </div>
        
    </body>

</html>

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

    .login-box{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        outline: 2px solid rgb(207, 206, 206);
        background-color: white;
        border-radius: 1.5px;
        margin-top: 30px;
        padding: 10px;

    }

    .radio-box{
        display: flex;
        flex-direction: column;
        justify-content: left;
    }

    .company-name{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 65px;
        text-align: center;
        margin-top: 2%;
        white-space: nowrap;
        color: rgb(84, 84, 151);
    }

    .login{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 40px;
        text-align: center;
        margin-top: 10px;
        margin-bottom: 3px;
        color: rgb(84, 84, 151);
        font-style: italic;
    }

    .login-button{
        margin-top: 10px;
        width: 175px;
        height: 30px;
        border-radius: 5px;
        border-width: 0px;
        background-color: rgb(110, 110, 229);
        color: white;
        transition-duration: 0.2s;

    }

    .login-button:hover{
        background-color: rgb(146, 146, 190);
    }  
</style>