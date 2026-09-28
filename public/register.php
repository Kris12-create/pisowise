<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$errors = [];
$name = $email = $monthly = $weekly = $daily = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $password    = $_POST['password'] ?? '';
    $confirmPass = $_POST['confirmPassword'] ?? '';
    $monthly     = trim($_POST['monthlyBudget'] ?? '');
    $weekly      = trim($_POST['weeklyBudget'] ?? '');
    $daily       = trim($_POST['dailyBudget'] ?? '');

    // empty weekly/daily = "don't track this period", stored as 0
    if ($weekly === '') { $weekly = '0'; }
    if ($daily === '')  { $daily = '0'; }

    $errors = validateRegistrationForm($name, $email, $password, $confirmPass, $monthly, $weekly, $daily);

    if (empty($errors) && emailExists($pdo, $email)) {
        $errors['email'] = 'That email is already registered';
    }

    if (empty($errors)) {
        try {
            $pdo->beginTransaction();

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)');
            $stmt->execute([$name, $email, $hash]);
            $userId = (int)$pdo->lastInsertId();

            $stmt = $pdo->prepare('INSERT INTO budgets (user_id, monthly_budget, weekly_budget, daily_budget) VALUES (?, ?, ?, ?)');
            $stmt->execute([$userId, $monthly, $weekly, $daily]);

            $pdo->commit();

            session_regenerate_id(true);
            $_SESSION['user_id'] = $userId;
            header('Location: dashboard.php');
            exit;
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) { $pdo->rollBack(); }
            if ((int)($e->errorInfo[1] ?? 0) === 1062) {
                $errors['email'] = 'That email is already registered';
            } else {
                error_log($e->getMessage());
                $errors['form'] = 'Something went wrong. Please try again.';
            }
        }
    }
}

// After a failed submit, show Step 2 only if every error belongs to Step 2
$step1Keys     = ['name', 'email', 'password', 'confirmPassword'];
$hasStep1Error = count(array_intersect_key($errors, array_flip($step1Keys))) > 0;
$showStep2     = !empty($errors) && !$hasStep1Error;
?>
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
            <p aria-hidden="true" id="stepsOne" class="active">1</p>
            <div id="line_in_step"></div>
            <p aria-hidden="true" id="stepsTwo" class="<?php echo $showStep2 ? 'active' : ''; ?>">2</p>
        </div>

        <form action="" method="post">
            <?php if (isset($errors['form'])): ?>
                <p class="error"><?php echo e($errors['form']); ?></p>
            <?php endif; ?>

            <div id="step1"<?php echo $showStep2 ? ' style="display: none;"' : ''; ?>>
                <div class="createAccount-wrapper">
                    <h1>Create account</h1>
                    <p>Start tracking your expenses for free.</p>
                </div>

                <label for="name">FULL NAME</label>
                <input type="text" id="name" name="name" placeholder="Maria Santos"
                    value="<?php echo e($name); ?>" required/>
                <?php if (isset($errors['name'])): ?>
                    <span class="error"><?php echo e($errors['name']); ?></span>
                <?php endif; ?>

                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" placeholder="maria.santos@gmail.com"
                    value="<?php echo e($email); ?>" required/>
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?php echo e($errors['email']); ?></span>
                <?php endif; ?>

                <label for="password">PASSWORD</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" minlength="8" placeholder="Min. length of 8" required/>
                    <button type="button" id="togglePassword" class="toggle-password">Show</button>
                </div>
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?php echo e($errors['password']); ?></span>
                <?php endif; ?>

                <ul id="password-requirements">
                    <li id="reqLength">At least 8 characters</li>
                    <li id="reqUppercase">At least 1 uppercase letter</li>
                    <li id="reqLowercase">At least 1 lowercase letter</li>
                    <li id="reqNumber">At least 1 number</li>
                    <li id="reqSymbol">At least 1 symbol</li>
                </ul>

                <label for="confirmPassword">CONFIRM PASSWORD</label>
                <div class="confirmPass-wrapper">
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter password" required/>
                    <button type="button" id="toggleConfirmPassword" class="toggle-password">Show</button>
                </div>
                <span id="confirmSamePass" class="error"><?php echo e($errors['confirmPassword'] ?? ''); ?></span>

                <button type="button" id="nextBtn">Next</button>
            </div>

            <div id="step2" style="display: <?php echo $showStep2 ? 'flex' : 'none'; ?>;">
                <div class="createAccount-wrapper">
                    <h1>Set your budgets</h1>
                    <p>Set your spending limits — leave a field at ₱0 if you don't want to track that period. You can adjust these anytime later.</p>
                </div>

                <div class="budget">
                    <label for="monthlyBudget">Monthly Budget</label>
                    <p>How much per month?</p>
                    <div class="input-currency-wrapper">
                        <span class="currency-symbol">₱</span>
                        <input type="number" id="monthlyBudget" name="monthlyBudget" placeholder="5000"
                            min="0" step="0.01" value="<?php echo e($monthly); ?>" required/>
                    </div>
                    <?php if (isset($errors['monthly'])): ?>
                        <span class="error"><?php echo e($errors['monthly']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="budget">
                    <label for="weeklyBudget">Weekly Budget</label>
                    <p>How much per week? (auto-suggested, editable)</p>
                    <div class="input-currency-wrapper">
                        <span class="currency-symbol">₱</span>
                        <input type="number" id="weeklyBudget" name="weeklyBudget" placeholder="1200"
                            min="0" step="0.01" value="<?php echo e($weekly); ?>"/>
                    </div>
                    <?php if (isset($errors['weekly'])): ?>
                        <span class="error"><?php echo e($errors['weekly']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="budget">
                    <label for="dailyBudget">Daily Budget</label>
                    <p>How much per day? (auto-suggested, editable)</p>
                    <div class="input-currency-wrapper">
                        <span class="currency-symbol">₱</span>
                        <input type="number" id="dailyBudget" name="dailyBudget" placeholder="200"
                            min="0" step="0.01" value="<?php echo e($daily); ?>"/>
                    </div>
                    <?php if (isset($errors['daily'])): ?>
                        <span class="error"><?php echo e($errors['daily']); ?></span>
                    <?php endif; ?>
                </div>

                <div id="btn_container">
                    <button type="button" id="backBtn">Back</button>
                    <button type="submit" id="submitBtn">Create Account</button>
                </div>
            </div>
        </form>

        <p id="haveAcc">Already have an account? <a href="login.php">Sign in</a></p>
    </main>
    <script src="./js/register.js"></script>
</body>
</html>