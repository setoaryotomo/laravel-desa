<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .dynamic-field {
            display: none;
        }
        
        /* Password input group styling */
        .password-input-group {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
        }
        .password-toggle:hover {
            color: #495057;
        }
        .form-control-user {
            padding-right: 45px !important;
        }
    </style>
</head>

<body class="">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}}
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrasi</h1>
                                    </div>
                                    <form class="user" action="/register" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="inputName" name="name"
                                                placeholder="Full Name...">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="inputEmail" name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <div class="password-input-group">
                                                <input type="password" name="password" class="form-control form-control-user"
                                                    id="inputPassword" placeholder="Password">
                                                <button type="button" class="password-toggle" data-target="inputPassword">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Role Selection -->
                                        <div class="form-group">
                                            <label for="role_id">Pilih Role:</label>
                                            <select class="form-control" id="role_id" name="role_id" required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="3">RW</option>
                                                <option value="4">RT</option>
                                            </select>
                                        </div>
                                        
                                        <!-- RW Field (shown for both roles) -->
                                        <div class="form-group dynamic-field" id="rw-field">
                                            <label for="rw">RW:</label>
                                            <select class="form-control" id="rw" name="rw">
                                                <option value="">-- Pilih RW --</option>
                                                <?php for($i=1; $i<=10; $i++): ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        
                                        <!-- RT Field (shown only for RT role) -->
                                        <div class="form-group dynamic-field" id="rt-field">
                                            <label for="rt">RT:</label>
                                            <select class="form-control" id="rt" name="rt">
                                                <option value="">-- Pilih RT --</option>
                                                <?php for($i=1; $i<=10; $i++): ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Simpan
                                        </button>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/">Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Handle role selection change
            $('#role_id').change(function() {
                const roleId = $(this).val();
                
                // Hide all dynamic fields first
                $('.dynamic-field').hide();
                $('.dynamic-field select').prop('required', false);
                
                // Show fields based on selected role
                if (roleId === '3') { // RW
                    $('#rw-field').show();
                    $('#rw').prop('required', true);
                } else if (roleId === '4') { // RT
                    $('#rw-field').show();
                    $('#rt-field').show();
                    $('#rw').prop('required', true);
                    $('#rt').prop('required', true);
                }
            });

            // Toggle password visibility
            $('.password-toggle').click(function() {
                const targetId = $(this).data('target');
                const passwordInput = $('#' + targetId);
                const icon = $(this).find('i');
                
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        });
    </script>
</body>
</html>