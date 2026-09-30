<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | PisoWise</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/logIn.css"/>
</head>
<body>
    <main class="container">
        <header class="header">
            <div aria-hidden="true" class="header-text">
                <p id="title">PisoWise</p>
                <p id="subTitle">Student Expense Tracker</p>
            </div>
        </header>

        <form action="" method="post">
            <h1 class="header-logIn">Log in</h1>

            <label for="email">EMAIL</label>
            <input type="email" id="email" name="email" placeholder="maria.santos@gmail.com" required/>

            <label for="password">PASSWORD</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required/>

            <button type="submit" id="submitBtn">Sign in</button>
        </form>

        <p id="haveAcc">Don't have an account? <a href="register.php">Create one</a></p>
    </main>
</body>
</html>
