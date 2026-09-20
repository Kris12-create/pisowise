-- USERS
CREATE TABLE users (
    user_id       INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100) NOT NULL,
    email         VARCHAR(150) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- CATEGORIES
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50) UNIQUE NOT NULL
);

INSERT INTO categories (name) VALUES
    ('Food'),
    ('Transportation'),
    ('School'),
    ('Entertainment'),
    ('Utilities'),
    ('Personal'),
    ('Other');

-- EXPENSES
CREATE TABLE expenses (
    expense_id   INT AUTO_INCREMENT PRIMARY KEY,
    user_id      INT NOT NULL,
    category_id  INT NOT NULL,
    amount       DECIMAL(10,2) NOT NULL CHECK (amount > 0),
    expense_date DATE NOT NULL,
    description  VARCHAR(255),
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE RESTRICT
);

-- BUDGETS
CREATE TABLE budgets (
    budget_id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT UNIQUE NOT NULL,
    monthly_budget DECIMAL(10,2) NOT NULL DEFAULT 0,
    weekly_budget  DECIMAL(10,2) NOT NULL DEFAULT 0,
    daily_budget   DECIMAL(10,2) NOT NULL DEFAULT 0,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);