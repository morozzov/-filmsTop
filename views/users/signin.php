<head>
    <link href="/public/vendors/bootstrap502/css/signin.css" rel="stylesheet">
</head>

<script>
    $(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();
            if ($("#login").val() != "" && $("#password").val() != "") {
                $.ajax({
                    type: 'post',
                    url: '/users/auth',
                    data: $('form').serialize()
                    ,
                    success: function (data) {
                        if (data == 'success') {
                            window.location = '/films/getall'
                        } else {
                            alert("Login or password not right")
                        }
                    }
                });
            } else {
                alert("Enter login and password")
            }
        });

    });
</script>
<form id="form" method="post" action="/users/auth">
    <h1 class="h3 mb-3 fw-normal">Sign in</h1>

    <div class="form-floating">
        <input name="login" id="login" type="email" class="form-control" placeholder="login">
        <label name="login" for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-0">
        <input name="password" id="password" type="password" class="form-control" placeholder="Password">
        <label name="password" for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary mb-2" type="submit">Sign in</button>

    <p class="small text-center text-gray-soft">Don't have an account yet? <a href="/users/signup">Sign up</a></p>
</form>
