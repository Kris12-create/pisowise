<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PisoWise</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/register.css"/>
</head>
<body>
     <main class="container">
        <div class="header">
            <img class="logo" src="" alt="PisoWise logo"/>
            <div aria-hidden="true" class="heading-logIn">
                <p id="title">PisoWise</p>
                <p id="subTitle">Student Expense Tracker</p>
            </div>
        </div>

        <form action="" method="post">
            <div class="createAccount-wrapper">
                <h1>Welcome back!</h1>
                <p>Log in to your PisoWise account</p>
            </div>

            <label for="email">EMAIL</label>
            <input type="email" name="email" id="email" placeholder="maria.santos@gmail.com">

            <label for="email">PASSWORD</label>

            <div class="password-wrapper">
                <input type="password" id="password" name="password" minlength="8" placeholder="Min. length of 8" required/>
                <button type="button" id="togglePassword" class="toggle-password">Show</button>
            </div>

            <button type="submit" id="submitBtn" style="width: 100%;">Sign in</button>
            <p id="haveAcc">Don't have an account? <a href="register.php">Sign up</a></p>
        </form>
    </main>
</body>
</html>