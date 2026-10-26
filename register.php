<?php

include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $gender = $_POST["gender"];
    $age = intval($_POST["age"]);
    $city = $_POST["city"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {

        $message = "Passwords do not match.";

    } elseif (strlen($password) < 6) {

        $message = "Password must contain at least 6 characters.";

    } else {

        $check = $conn->prepare(
            "SELECT id FROM members WHERE email = ?"
        );

        $check->bind_param("s", $email);
        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $message = "An account with this email already exists.";

        } else {

            // Secure password hashing
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt = $conn->prepare(
                "INSERT INTO members
                (first_name, last_name, email, phone, gender, age, city, password)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "sssssiss",
                $first_name,
                $last_name,
                $email,
                $phone,
                $gender,
                $age,
                $city,
                $hashed_password
            );

            if ($stmt->execute()) {

                header("Location: login.php?registered=1");
                exit();

            } else {

                $message = "Registration failed. Please try again.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Register | ClimateGuard</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="form-page">

<div class="form-container">

    <div class="form-header">

        <div class="small-logo">
            🌍 ClimateGuard
        </div>

        <h1>Climate Research Registration</h1>

        <p>
            Become part of our climate research community.
        </p>

    </div>


    <?php if ($message != ""): ?>

        <div class="error">
            <?php echo htmlspecialchars($message); ?>
        </div>

    <?php endif; ?>


    <form method="POST" action="register.php">

        <div class="form-grid">

            <div class="input-group">

                <label>First Name</label>

                <input
                    type="text"
                    name="first_name"
                    placeholder="Enter first name"
                    required
                >

            </div>


            <div class="input-group">

                <label>Last Name</label>

                <input
                    type="text"
                    name="last_name"
                    placeholder="Enter last name"
                    required
                >

            </div>


            <div class="input-group">

                <label>Email Address</label>

                <input
                    type="email"
                    name="email"
                    placeholder="example@email.com"
                    required
                >

            </div>


            <div class="input-group">

                <label>Phone Number</label>

                <input
                    type="tel"
                    name="phone"
                    placeholder="07XXXXXXXX"
                    required
                >

            </div>


            <div class="input-group">

                <label>Age</label>

                <input
                    type="number"
                    name="age"
                    min="10"
                    max="100"
                    placeholder="Enter age"
                    required
                >

            </div>


            <div class="input-group">

                <label>Residential City</label>

                <select name="city" required>

                    <option value="">
                        Select your city
                    </option>

                    <option value="Nairobi">
                        Nairobi
                    </option>

                    <option value="Mombasa">
                        Mombasa
                    </option>

                    <option value="Kisumu">
                        Kisumu
                    </option>

                    <option value="Nakuru">
                        Nakuru
                    </option>

                    <option value="Eldoret">
                        Eldoret
                    </option>

                </select>

            </div>

        </div>


        <div class="gender-section">

            <label>Gender</label>

            <div class="radio-options">

                <label>
                    <input
                        type="radio"
                        name="gender"
                        value="Male"
                        required
                    >
                    Male
                </label>

                <label>
                    <input
                        type="radio"
                        name="gender"
                        value="Female"
                    >
                    Female
                </label>

                <label>
                    <input
                        type="radio"
                        name="gender"
                        value="Other"
                    >
                    Other
                </label>

            </div>

        </div>


        <div class="form-grid">

            <div class="input-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Create password"
                    minlength="6"
                    required
                >

            </div>


            <div class="input-group">

                <label>Confirm Password</label>

                <input
                    type="password"
                    name="confirm_password"
                    placeholder="Confirm password"
                    minlength="6"
                    required
                >

            </div>

        </div>


        <button type="submit" class="submit-btn">
            Create Research Account →
        </button>

    </form>


    <p class="bottom-text">
        Already registered?
        <a href="login.php">Login here</a>
    </p>

</div>

</body>
</html>