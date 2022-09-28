@include('login.layout.header')

<style>
    body {
        font-family: 'Mitr', sans-serif;
    }

    .navbar {
        padding-top: 20px;
        padding-bottom: 20px;
        color: azure;
        background-color: rgb(114, 89, 225);
    }

    .container {
        margin-top: 20px;
    }

    .card-login,
    .card-register {
        width: 40rem;
    }

    .card-login-header {
        padding-top: 20px;
        padding-bottom: 20px;
        color: azure;
        background-color: rgb(125, 93, 166);
        font-size: 18px;
    }

    .btn-main-login {
        background-color: rgb(125, 93, 166);
        border: none;
        color: white;
        padding: 4px 4px;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .btn-login {
        background-color: rgb(255, 255, 255);
        color: black;
        border: 1.8px solid rgb(125, 93, 166);
    }

    .btn-login:hover {
        background-color: rgb(125, 93, 166);
        color: white;
    }
</style>

@include('login.layout.navbar')

<div class="container" id="login-vue">
    <div class="d-flex justify-content-center">
        <div class="card card-login shadow rounded">
            <div class="card-header card-login-header">
                ล็อคอิน
            </div>
            <div class="card-body">
                <form method="post" id="form-login">
                    {{ csrf_field() }}
                    @method('POST')

                    <div class="input-group mb-3">
                        <span class="input-group-text">ชื่อผู้ใช้</span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username" maxlength="10">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">รหัสผ่าน</span>
                        <input type="text" class="form-control" id="password" name="password" placeholder="password" maxlength="10">
                    </div>

                    <button type="submit" class="btn-main-login btn-login btn-sm w-100">เข้าสู่ระบบ</button>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <div class="card card-register shadow rounded">
            <div class="card-body">
                ยังไม่ได้เป็นสมาชิกหรือไม่ <a href="{{ url('/register/pages/userRegister') }}" class="text-decoration-none">ละทะเบียน</a>
            </div>
        </div>
    </div>

</div>

@include('login.layout.footer')

<script>
    $(document).ready(function() {
        $('#form-login').submit(function(e) {
            e.preventDefault();

            let username = $('#username').val();
            let password = $('#password').val();

            if (username !== '' && password !== '') {

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('/') }}",
                    data: {
                        _token: $("input[name='_token']").val(),
                        username: username,
                        password: password
                    },
                    success: function(response) {
                        if (response.status == 200) {

                            Swal.fire(
                                'สำเร็จ',
                                'เข้าสู่ระบบสำเร็จ',
                                'success'
                            ).then((result) => {
                                console.log(response);
                            });

                        } else {

                            Swal.fire(
                                'ผิดพลาด',
                                'เข้าสู่ระบบไม่สำเร็จ',
                                'error'
                            ).then((result) => {
                                $(this)[0].reset();
                                $('#username').focus();
                            });

                        }
                    }
                });

            } else {

                Swal.fire(
                    'เเจ้งเตือน',
                    'กรุณากรอกข้อมูลให้ครบ',
                    'warning'
                ).then((result) => {
                    $(this)[0].reset();
                    $('#username').focus();
                });

            }
        });
    });
</script>
