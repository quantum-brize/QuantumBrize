<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Sign In </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>public/assets_admin/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="<?= base_url() ?>public/assets_admin/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url() ?>public/assets_admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url() ?>public/assets_admin/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url() ?>public/assets_admin/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url() ?>public/assets_admin/css/custom.min.css" rel="stylesheet" type="text/css" />
    <style>
        #alert {
            position: fixed;
            top: 10px;
            z-index: 1000;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            left: 0px;
        }
    </style>
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <!-- <img src="<?= base_url() ?>public/assets_admin/images/logo-light.png" alt="" height="20"> -->
                                </a>
                            </div>
                            <!-- <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p> -->
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div id="alert">

                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to daltonusstore.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <div>
                                        <div class="mb-3">
                                            <label for="email_number" class="form-label">Email or Number</label>
                                            <input type="text" class="form-control" id="email_number"
                                                placeholder="Enter email or Number">
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="<?=base_url('forgot-password')?>" class="text-muted">Forgot
                                                    Password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    placeholder="Enter password" id="password-input">
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" id="sign-in-btn">Sign In</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Don't have an account ? <a href="<?= base_url() ?>sign-up"
                                    class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> daltonusstore. Crafted with <i
                                    class="mdi mdi-heart text-danger"></i> by daltonusstore
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?= base_url() ?>public/assets_admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>public/assets_admin/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>public/assets_admin/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url() ?>public/assets_admin/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url() ?>public/assets_admin/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= base_url() ?>public/assets_admin/js/plugins.js"></script>

    <!-- particles js -->
    <script src="<?= base_url() ?>public/assets_admin/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="<?= base_url() ?>public/assets_admin/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="<?= base_url() ?>public/assets_admin/js/pages/password-addon.init.js"></script>
    <script src="<?= base_url() ?>public/assets_admin/libs/prismjs/prism.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#password-addon').on('click', function () {
                if ($('#password-input').attr('type') == 'password') {
                    $('#password-input').attr('type', 'text')
                } else {
                    $('#password-input').attr('type', 'password')

                }
            })


            $('#sign-in-btn').on('click', function () {

                let email_number = $('#email_number').val();
                let password = $('#password-input').val();

                $.ajax({
                    url: "<?= base_url('login-action') ?>",
                    type: 'POST',
                    data: {
                        email_number: email_number,
                        password: password,
                    },
                    beforeSend: function () {
                        $('#sign-in-btn').html(`<div class="spinner-border text-light" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>`)
                        $('#sign-in-btn').attr('disabled', true);
                    },
                    success: function (resp) {
                        resp = JSON.parse(resp)
                        if (resp.status == true) {
                            $('#alert').html(`<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                        <i class="ri-checkbox-circle-fill label-icon"></i><strong>${resp.message}</strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`) 

                            var storedData = localStorage.getItem('cartData');
                            var retrievedData = JSON.parse(storedData);
                            if(retrievedData != ""){
                                $.ajax({
                                    url: "<?= base_url('/api/user/id') ?>",
                                    type: "GET",
                                    success: function (resp) {
                                        
                                        if (resp.status) {
                                            $.each(retrievedData, function(index, cart) {
                                                $.ajax({
                                                    url: "<?= base_url('/api/user/cart/add') ?>",
                                                    type: "POST",
                                                    data:{product_id:cart.product_id, 
                                                        user_id:resp.data,
                                                        variation_id:cart.variation_id,
                                                        qty:cart.qty,
                                                        },
                                                    success: function (resp) {
                                                        
                                                        if (resp.status) {
                                                            var updatedData = retrievedData.filter(function(item) {
                                                                item.product_id !== cart.product_id;
                                                            });
                                                            var updatedDataJSON = JSON.stringify(updatedData);
                                                            localStorage.setItem('cartData', updatedDataJSON);
                                                        } else {
                                                            console.log(resp)
                                                           
                                                        }
                                                        
                                                    },
                                                    error: function (err) {
                                                        console.log(err)
                                                    },
                                                })
                                            })
                                                
                                            
                                        } else {
                                            
                                        }
                                    },
                                    error: function (err) {
                                        console.log(err)
                                    },
                                })
                                
                            }

                            window.location.href = `<?= base_url()?>`;
                        } else {
                            $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                    <i class="ri-alert-line label-icon"></i><strong> ${resp.message}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>`)
                        }
                        $('#sign-in-btn').html(`Sign In`)
                        $('#sign-in-btn').attr('disabled', false);
                    },
                    complete: function () {
                        $('#sign-in-btn').html(`Sign In`)
                        $('#sign-in-btn').attr('disabled', false);
                    },
                    error: function () {
                        $('#sign-in-btn').html(`Sign In`)
                        $('#sign-in-btn').attr('disabled', false);
                        $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                    <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Internal Server Error
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>`)
                    }
                })

            })

        })


    </script>

</body>

</html>