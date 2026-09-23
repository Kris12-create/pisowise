<?php

function validateRegistrationForm(
    $name,
    $email,
    $password,
    $confirmPassword,
    $monthly,
    $weekly,
    $daily
) {

    $errors = [];

    $symbols = "/[<>{}|@#$%^&*\"]/";
    $decimalNumber = "/^[0-9]+(\.[0-9]{1,2})?$/";

    // NAME
    if ($name === "") {
        $errors['name'] = "Name should be non-empty";
    } elseif (preg_match($symbols, $name)) {
        $errors['name'] = "Name should not contain symbols";
    }

    // EMAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Enter a valid email";
    }

    // PASSWORD
    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $errors['password'] = "Password must contain an uppercase letter";
    } elseif (!preg_match("/[a-z]/", $password)) {
        $errors['password'] = "Password must contain a lowercase letter";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $errors['password'] = "Password must contain a number";
    } elseif (!preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
        $errors['password'] = "Password must contain a symbol";
    }

    // CONFIRM PASSWORD
    if ($password !== $confirmPassword) {
        $errors['confirmPassword'] = "Passwords do not match";
    }

    // MONTHLY
    if (!preg_match($decimalNumber, $monthly)) {
        $errors['monthly'] = "Monthly budget should be a valid number";
    }

    // WEEKLY
    if (!preg_match($decimalNumber, $weekly)) {
        $errors['weekly'] = "Weekly budget should be a valid number";
    }

    // DAILY
    if (!preg_match($decimalNumber, $daily)) {
        $errors['daily'] = "Daily budget should be a valid number";
    }

    return $errors;
}
?>