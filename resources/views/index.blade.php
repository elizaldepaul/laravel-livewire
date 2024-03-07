<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Login and Registration Form in HTML & CSS | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    select {
        height: 100%;
        width: 100%;
        outline: none;
        border: none;
        padding: 0 30px;
        font-size: 16px;
        font-weight: 500;
        border-bottom: 2px solid rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
</style>

<body>

    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="assets/img/frieren.jpg" alt="">
                <div class="text">
                    <span class="text-1">Every new friend is a <br> new adventure</span>
                    <span class="text-2">Let's get connected</span>
                </div>
            </div>
            <div class="back">
                <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
                <div class="text">
                    <span class="text-1">Complete miles of journey <br> with one step</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>
        <div class="forms">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Login</div>
                    {{-- Log in Form --}}
                    <form action='/login' method="POST">
                        @csrf
                        @method('post')
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="text"><a href="#">Forgot password?</a></div>
                            <div class="button input-box">
                                <input type="submit" value="Submit">
                            </div>
                            <div class="text sign-up-text">Don't have an account? <label for="flip">Sigup
                                    now</label></div>
                        </div>
                    </form>
                    {{-- End Log in Form --}}
                </div>
                <div class="signup-form">
                    <div class="title">Signup</div>
                    {{-- Register Form --}}
                    <form action="/create-user" method="POST">
                        @csrf
                        @method('POST')
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="first_name" placeholder="Enter your first name" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="last_name" placeholder="Enter your last name" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="ri-calendar-fill"></i>
                                <input type="date" id="birthday" name="birth_date">
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <select name="role" id="role" required>
                                    <option value="">Choose Your Role</option>
                                    <option value="1">1 as User</option>
                                    <option value="2">2 as Admin</option>
                                </select>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Submit">
                            </div>
                            <div class="text sign-up-text">Already have an account? <label for="flip">Login
                                    now</label></div>
                        </div>
                    </form>
                    {{-- End Register Form --}}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
