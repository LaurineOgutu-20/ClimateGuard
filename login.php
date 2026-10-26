<?php

session_start();

include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT id, first_name, last_name, email, password
         FROM members
         WHERE email = ?"
    );

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["first_name"] = $user["first_name"];
            $_SESSION["last_name"] = $user["last_name"];
            $_SESSION["email"] = $user["email"];

            header("Location: dashboard.php");
            exit();

        } else {

            $message = "Incorrect email or password.";

        }

    } else {

        $message = "Incorrect email or password.";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login | ClimateGuard</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="login-page">

<div class="login-box">

    <div class="login-icon">
        🌍
    </div>

    <h1>Welcome Back</h1>

    <p>
        Sign in to access the ClimateGuard Research Hub.
    </p>


    <?php if ($message != ""): ?>

        <div class="error">
            <?php echo htmlspecialchars($message); ?>
        </div>

    <?php endif; ?>


    <?php if (isset($_GET["registered"])): ?>

        <div class="success">
            Registration successful!
            You can now log in.
        </div>

    <?php endif; ?>


    <form method="POST">

        <div class="input-group">

            <label>Email Address</label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >

        </div>


        <div class="input-group">

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required
            >

        </div>


        <button class="submit-btn" type="submit">
            Login to Research Hub
        </button>

    </form>


    <p class="bottom-text">

        Don't have an account?

        <a href="register.php">
            Register
        </a>

    </p>

</div>

</body>
</html>