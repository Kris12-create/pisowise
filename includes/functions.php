<?php

// Safely prints user-supplied text into HTML
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Digits with up to 2 decimals, and small enough to fit DECIMAL(10,2)
function isValidAmount(string $value): bool {
    return preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $value) === 1
        && (float)$value <= 99999999.99;
}

function emailExists(PDO $pdo, string $email): bool {
    $stmt = $pdo->prepare('SELECT 1 FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    return $stmt->fetchColumn() !== false;
}

function validateRegistrationForm(
    string $name,
    string $email,
    string $password,
    string $confirmPassword,
    string $monthly,
    string $weekly,
    string $daily
): array {
    $errors = [];

    // NAME
    if ($name === '') {
        $errors['name'] = 'Name is required';
    } elseif (mb_strlen($name) > 100) {
        $errors['name'] = 'Name is too long';
    } elseif (preg_match('/[<>{}|@#$%^&*"]/', $name)) {
        $errors['name'] = 'Name contains characters that are not allowed';
    }

    // EMAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) {
        $errors['email'] = 'Enter a valid email';
    }

    // PASSWORD (a symbol = anything that isn't a letter, number, or space)
    if (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    } elseif (strlen($password) > 72) {
        $errors['password'] = 'Password must be 72 characters or fewer';
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $errors['password'] = 'Password must contain an uppercase letter';
    } elseif (!preg_match('/[a-z]/', $password)) {
        $errors['password'] = 'Password must contain a lowercase letter';
    } elseif (!preg_match('/[0-9]/', $password)) {
        $errors['password'] = 'Password must contain a number';
    } elseif (!preg_match('/[^A-Za-z0-9\s]/', $password)) {
        $errors['password'] = 'Password must contain a symbol';
    }

    // CONFIRM PASSWORD
    if ($password !== $confirmPassword) {
        $errors['confirmPassword'] = 'Passwords do not match';
    }

    // BUDGETS
    if (!isValidAmount($monthly)) {
        $errors['monthly'] = 'Enter a valid monthly budget (max 2 decimal places)';
    }
    if (!isValidAmount($weekly)) {
        $errors['weekly'] = 'Enter a valid weekly budget (max 2 decimal places)';
    }
    if (!isValidAmount($daily)) {
        $errors['daily'] = 'Enter a valid daily budget (max 2 decimal places)';
    }

    return $errors;
}