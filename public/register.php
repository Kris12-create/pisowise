<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PisoWise</title>
</head>
<body>
    <main class="container">
        <div class="header">
            <img class="logo" src="" alt="PisoWise logo"/>
            <p>PisoWise</p>
            <p>Student Expense Tracker</p>
        </div>

        <div class="steps">
            <p aria-hidden="true">1</p>
            <div id="line_in_step"></div>
            <p aria-hidden="true">2</p>
        </div>

        <form action="" method="post">

            <div id="step1">
                <label for="name">FULL NAME</label>
                <input type="text" id="name" name="name" placeholder="Maria Santos" required/>

                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" placeholder="maria.santos@gmail.com" required/>

                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password" minlength="8" placeholder="Min. length of 8" required/>
                <div id="password-error"></div>

                <label for="confirmPassword">CONFIRM PASSWORD</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter password" required/>

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
                    <p>How much per week?</p>
                    <input type="number" id="weeklyBudget" name="weeklyBudget" placeholder="1200" min="0" required/>
                </div>

                <div class="budget">
                    <label for="dailyBudget">Daily Budget</label>
                    <p>How much per day?</p>
                    <input type="number" id="dailyBudget" name="dailyBudget" placeholder="200" min="0" required/>
                </div>

                <button type="button" id="backBtn">Back</button>
                <button type="submit">Create Account</button>
            </div>

        </form>

        <p>Already have an account? <a href="login.php">Sign in</a></p>
    </main>
</body>
</html>