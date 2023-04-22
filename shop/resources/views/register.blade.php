<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<section class="vh-100 bg-image"
         style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                            <form action="{{ route('registerUser')}}" method="post">
                                @csrf

                                <div class="form-outline mb-4">
                                    <input type="text" id="form3Example1cg" name = "name" placeholder="Tên của bạn" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" id="form3Example3cg" name = "email" placeholder="Tài khoản email" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4cg" name = "password" placeholder="Mật khẩu" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4cdg" name = "confirm-password" placeholder="Nhập lại mật khẩu" class="form-control form-control-lg" />
                                </div>

                                <div class="form-check d-flex justify-content-center mb-5">
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" onclick ="if (alert('Đăng kí thành công')) { location.href='users/login' }"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{route('loginIndex')}}"
                                                                                                        class="fw-bold text-body"><u>Login here</u></a></p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
