<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PisoWise</title>
</head>
<body>
    <!-- since we are sending new data -->
    <main class="container">
        <div id="step1">
            <div class="header">
                <img class="logo"/>
                <p>PisoWise</p>
                <p>Student Expense Tracker</p>
            </div>

            <div class="steps">
                <p aria-hidden="true">1</p>
                <div id="line_in_step"></div>
                <p aria-hidden="true">2</p>
            </div>

            <form action="" method="post">
                <label for="name">FULL NAME</label>
                <input type="text" id="name" name="name" placeholder="Maria Santos" required/>
                
                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email"  placeholder="maria.santos@gmail.com" required/>

                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password"  minlength="8" placeholder="Min. length of 8" required/>
                <div id="error_table"></div>    <!--createElement() then appendChild() here in js-->

                <label for="confirmPassword">CONFIRM PASSWORD</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Re-enter password"/>

                <button type="submit">Go to Page 2</button>
            </form>
            <p>Already have an account? <a href="">Sign in</a></p>
        </div>

        <div id="step2">
            <div class="header">
                <img class="logo"/>
                <p>PisoWise</p>
                <p>Student Expense Tracker</p>
            </div>

            <div class="steps">
                <p aria-hidden="true">1</p>
                <div id="line_in_step"></div>
                <p aria-hidden="true">2</p>
            </div>

            <p>Set your spending limits. Leave a field ₱0 If you don't want to track that period</p>

            <form action="" method="post">
                <div class="budget">
                    <label for="monthlyBudget">Monthly Budget</label>
                    <p>How much per month?</p>
                    <input type="number" id="dailyBudget" name="dailyBudget" placeholder="Maria Santos" required/>
                </div>

                <div class="budget">
                    <label for="dailyBudget">Daily Budget</label>
                    <p>How much per day?</p>
                    <input type="number" id="dailyBudget" name="dailyBudget" placeholder="200" required/>
                </div>

                <div class="budget">
                    <label for="weeklyBudget">Weekly Budget</label>
                    <p>How much per week?</p>
                    <input type="number" id="weeklyBudget" name="weeklyBudget" placeholder="12" required/>
                </div>

                <button type="submit">Back</button>
                <button type="submit">Create Account</button>
            </form>
            <p>Already have an account? <a href="">Sign in</a></p>
        </div>
    </main>
</body>
</html>