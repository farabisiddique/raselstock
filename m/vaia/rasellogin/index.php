

<body>

<div style="background-image: linear-gradient(to right, rgb(127, 0, 255), rgb(225, 0, 255));" class="container-fluid ">
    <div  class="container main-cont mt-3">
        <div class="row">
            <div  class="col-sm-12 col-md-6 col-lg-6 ml-3 back d-flex justify-content-center align-items-center">
                <img class="png" src="images-removebg-preview.png" alt="">
            </div>
    
            <div class="col-sm-12 col-md-6 col-lg-6 ">
                <h3 class="text-center text-white admin">Admin Login</h3>
                <div class="formDiv d-flex justify-content-center">
                    <form action="./index.php" method="post">
                        
                        <?php echo $message; ?>

                        <p class="formBorder"><b>Email</b><br> <input type="email" name="email" required="1" id="email"></p>
                        <p class="formBorder"><b>Passworld</b> <br> <input type="password" name="pass" required="1" id=""></p>

                        <button type="submit" name="login" class="btn btn-success mb-1"><b>Login Now</b></button>
                    </form>
                  </div>
            </div>
        </div>
    </div>    
    

</div>



















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>