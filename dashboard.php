<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();

}

$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Research Hub | ClimateGuard</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<header class="navbar">

    <div class="logo">
        🌍 Climate<span>Guard</span>
    </div>

    <div class="member-area">

        <span>
            👋 <?php echo htmlspecialchars($first_name); ?>
        </span>

        <a href="logout.php" class="logout-btn">
            Logout
        </a>

    </div>

</header>


<section class="dashboard">

    <div class="welcome-card">

        <div>

            <span class="badge">
                MEMBER DASHBOARD
            </span>

            <h1>
                Welcome,
                <?php echo htmlspecialchars($first_name); ?>!
            </h1>

            <p>
                Thank you for joining ClimateGuard Research Hub.
                Your participation contributes to understanding
                climate change in Kenya.
            </p>

        </div>

        <div class="welcome-earth">
            🌍
        </div>

    </div>


    <h2>Our Research Focus</h2>


    <div class="research-grid">

        <div class="research-card">

            <div class="research-icon">
                🌡️
            </div>

            <h3>Climate Change</h3>

            <p>
                Investigating changes in temperature,
                rainfall and other climate patterns.
            </p>

        </div>


        <div class="research-card">

            <div class="research-icon">
                🌳
            </div>

            <h3>Environmental Impact</h3>

            <p>
                Studying how climate change affects
                ecosystems and communities.
            </p>

        </div>


        <div class="research-card">

            <div class="research-icon">
                💧
            </div>

            <h3>Water & Agriculture</h3>

            <p>
                Examining how changing climate patterns
                affect water resources and food production.
            </p>

        </div>

    </div>


    <div class="project-section">

        <h2>About The Project</h2>

        <p>
            ClimateGuard Research Hub is a research initiative
            focused on identifying possible causes and effects
            of climate change in Kenya. Registered members
            contribute information that can support environmental
            awareness and evidence-based research.
        </p>

    </div>


    <div class="member-card">

        <h2>Your Membership</h2>

        <p>
            <strong>Name:</strong>
            <?php
            echo htmlspecialchars($first_name . " " . $last_name);
            ?>
        </p>

        <p>
            <strong>Status:</strong>
            <span class="active">
                ● Active Research Member
            </span>
        </p>

    </div>

</section>


<footer>

    <p>
        ClimateGuard Research Hub © 2026
    </p>

</footer>

</body>
</html>