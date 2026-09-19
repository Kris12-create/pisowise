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
            <div aria-hidden="true" class="header-text">
                <p id="title">PisoWise</p>
                <p id="subTitle">Student Expense Tracker</p>
            </div>
        </div>

        <div class="steps">
            <p aria-hidden="true" id="stepsOne">1</p>
            <div id="line_in_step"></div>
            <p aria-hidden="true" id="stepsTwo">2</p>
        </div>

        <div class="createAccount-wrapper">
            <h1>Create account</h1>
            <p>Start tracking your expenses for free.</p>
        </div>

        <form action="" method="post">

            <div id="step1">
                <label for="name">FULL NAME</label>
                <input type="text" id="name" name="name" placeholder="Maria Santos" required/>

                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" placeholder="maria.santos@gmail.com" required/>

                <label for="password">PASSWORD</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" minlength="8" placeholder="Min. length of 8" required/>
                    <button type="button" id="togglePassword" class="toggle-password">Show</button>
                </div>

                <label for="confirmPassword">CONFIRM PASSWORD</label>
                <div class="confirmPass-wrapper">
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter password" required/>
                    <button type="button" id="toggleConfirmPassword" class="toggle-password">Show</button>
                </div>

                <button type="button" id="nextBtn">Next</button>
            </div>

            <div id="step2" style="display: none;">
                <p>Set your spending limits. Leave a field at ₱0 if you don't want to track that period.</p>

                <div class="budget">
                    <label for="monthlyBudget">Monthly Budget</label>
                    <p>How much per month?</p>
                    <input type="number" id="monthlyBudget" name="monthlyBudget" placeholder="5000" min="0" required/>
                </div>

                <div class="budget">
                    <label for="weeklyBudget">Weekly Budget</label>
                    <p>How much per week? (auto-suggested, editable)</p>
                    <input type="number" id="weeklyBudget" name="weeklyBudget" placeholder="1200" min="0"/>
                </div>

                <div class="budget">
                    <label for="dailyBudget">Daily Budget</label>
                    <p>How much per day? (auto-suggested, editable)</p>
                    <input type="number" id="dailyBudget" name="dailyBudget" placeholder="200" min="0"/>
                </div>

                <button type="button" id="backBtn">Back</button>
                <button type="submit" id="submitBtn">Create Account</button>
            </div>

        </form>

        <p id="haveAcc">Already have an account? <a href="login.php">Sign in</a></p>
    </main>
    <script src="./js/register.js"></script>
</body>


</html>