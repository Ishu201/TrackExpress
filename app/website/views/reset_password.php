<!DOCTYPE html>
<html lang="en">

<head>
    <title>Track Express</title>

    <?php include('links.php') ?>
    <style>
        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(161deg, #d960d1, #040c0f);
            opacity: 0.3;
        }

        .card {
    background: linear-gradient(45deg, white, #dd9a9a29);
    border: none;
    box-shadow: 0px 0px 9px 3px #a97b7b57;
}

img.img-fluid {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: initial;
}

.img-overlay {
    position: absolute;
    width: 92.5%;
    height: 100%;
    background: #5a444475;
    border-radius: 1rem 0 0 1rem;
}

img.logo-img {
    width: 80px;
    height: 80px;
    object-fit: contain;
    object-position: center;
}

h3.login-title {
    font-size: 33px;
    font-weight: 600;
}

label.form-label {
    color: white;
}
    </style>
</head>

<body>

    <?php //include('header.php') 
    ?>
    <!-- END nav -->

    <section class="vh-100" style="background-image:url(login/images/background-img.jpg) ;">
        <div class="overlay"></div>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <!-- <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <div class="img-overlay"></div>
                                <img src="login/images/ybg_1.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div> -->
                            <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form>

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img src="login/images/logo.png" alt="login form" class="logo-img" />
                                            <h3 class="login-title">Track <span style="color:#b30f00 !important">Express</span></h3>
                                        </div>

                                        <div class="form-outline mb-4">
                                        <label class="form-label text-dark" for="form2Example17">Enter your Email address</label>
                                            <input type="email" id="form2Example17" class="form-control form-control-lg" />
                                            
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-danger btn-lg btn-block" type="button">Reset Password</button>
                                        </div>

                                        <a class="small text-muted" href="login.php">Go back to Login</a><br>
                                        <hr>
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php //include('footer.php') 
    ?>

    <?php include('scripts.php') ?>
</body>

</html>