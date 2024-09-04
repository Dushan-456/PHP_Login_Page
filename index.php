<?php
// include("./includes/connect.php");

if(isset($_POST['login'])){
   $NIC_num = $_POST['NIC_num'];
   $password = $_POST['password'];

   $login_query ="SELECT * FROM `employees` WHERE NIC_num = '$NIC_num' OR email_official ='$NIC_num'";
   $login_result = mysqli_query($conn, $login_query);
   if(mysqli_num_rows($login_result) > 0){
     $login_result = mysqli_fetch_assoc($login_result);
     $hashed_pwd = $login_result["password"];
     $check_pwd = password_verify($password, $hashed_pwd);
        if($check_pwd == false ){
           echo "<script>window.location.href = './login.php?error=wrongpwd';</script>";
           exit();
        }else if($check_pwd == true){

            session_start();
           $_SESSION["NIC_num"] = $login_result['NIC_num'];
        

         //   echo'<script>alert("user logged in    ")</script>';
           echo "<script>window.location.href = './index.php?home';</script>";


           exit();
        }
   }else{
     echo "<script>window.location.href = './login.php?error=usernotreg';</script>";
     exit();

   }
}



?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Management System</title>
            <link rel="icon" type="image/x-icon" href="./assest/img/favicon.ico">


      <link
         href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
         rel="stylesheet"
         integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
         crossorigin="anonymous" />
      <link rel="stylesheet" href="./style.css" />
      <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
         integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
         crossorigin="anonymous"
         referrerpolicy="no-referrer" />
   </head>
   <body data-bs-theme="light" class="">
    <div class="loginbody">
    <?php
            if(isset($_GET["error"])){
               if($_GET["error"] == "usernotreg"){
                  echo "             <div class='alert alert-danger'>
  <strong>Sorry!</strong> User Not Register in System.
</div>";
               }
               if($_GET["error"] == "wrongpwd"){
                  echo "              <div class='alert alert-danger'>
  <strong>Sorry!</strong>  Wrong Password.please Try again.
</div>";
               }
              

            }
            ?>
  
            <div class="myform form ">
                <div class="logo mb-3">
                    <div class="col-md-12 text-center">
                        <img class="loginimg" src="./assest/img/logo.png" alt="">
                    </div>
               </div>
              <form action="" method="post" >
                <div class="form-floating">
                    <input type="text" name="NIC_num" class="form-control" id="floatingPassword" placeholder="User Name">
                    <label for="floatingPassword">User NIC Number or Official Email</label>
                  </div>
                  <div class="form-floating mt-3 mb-3">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword"> Password</label>
                  </div>
                  <div class="d-grid mt-5 gap-2">
                       <button name="login" class="btn btn-primary" type="submit">Login</button>
                     </div>
                    
                      <div class="col-md-12 ">
                         <div class="login-or">
                            <hr class="hr-or">
                            <span class="span-or">or</span>
                         </div>
                      </div>
                      <div class="col-md-12 mb-3">
                         <p class="text-center">
                            <a href="" class="google btn mybtn"><i class="fa-brands fa-google "></i> &nbsp; Inform Admin to Signup 
                            </a>
                         </p>
                      </div>
                      <div class="form-group">
                         <p class="text-center">Don't have account? <a href="" id="signup">Sign up here</a></p>
                      </div>
                   </form>
        </div>
          <div class="pt-3" style="display: flex;flex-direction: column;align-items: center;justify-content: center;color: red;font-weight: bold;">
         <p>Sample login details :
         
         </p>
         <p> Department Head Login ( Email - dephead@gmail.com / 
            PWD - 123456789 )</p>
            <p>Employee 01 Login (Email - emp01@gmail.com / PWD - 12345)</p>
            <p>Employee 02 Login (Email - emp02@gmail.com / PWD - 12345)</p>
        </div>
    
      

      <script src="./script.js"></script>
      <script
         src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
         crossorigin="anonymous"></script>
   </body>
</html>
