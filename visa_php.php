<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'country' is set before accessing it
    if (isset($_POST['country'])) {
        $country = $_POST['country'];
        if (empty($country)) {
            $message = 'Invalid country selection.';
        } else {
            switch ($country) {
                case 'USA':
                    $message = 'Visa required for most applicants.';
                    break;
                case 'Canada':
                    $message = 'Visa required unless you have an eTA.';
                    break;
                case 'India':
                    $message = 'Visa required before travel.';
                    break;
                case 'UK':
                    $message = 'Visa depends on the duration of stay.';
                    break;
                case 'Australia':
                    $message = 'eVisa available for eligible travelers.';
                    break;
                default:
                    $message = 'Invalid country selection.';
                    break;
            }
        }
    } else {
        $message = 'Country not selected.';
    }

    // Apply for Visa Form Validation
    if (isset($_POST['apply_visa'])) {
        // Check if 'passport' and 'apply_country' are set before accessing them
        if (isset($_POST['passport']) && isset($_POST['apply_country'])) {
            $passport = $_POST['passport'];
            $apply_country = $_POST['apply_country'];

            if (empty($passport) || empty($apply_country)) {
                $apply_message = 'All fields are required!';
            } elseif (strlen($passport) < 8 || strlen($passport) > 10) {
                $apply_message = 'Invalid passport number!';
            } else {
                $apply_message = 'Visa application submitted successfully!';
            }
        } else {
            $apply_message = 'Passport and country must be selected.';
        }
    }
} else {
    $message = '';
    $apply_message = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indian Embassy Visa Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Flag_of_India.svg/1280px-Flag_of_India.svg.png');
            background-size: cover;
            background-position: center;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Dim the background */
            z-index: -1; /* Ensure the overlay stays behind content */
        }

        header {
            background-color: #ff9933;
            padding: 20px;
            text-align: center;
            border-bottom: 4px solid #fff;
        }

        header img {
            height: 50px;
            margin-right: 15px;
        }

        header h1 {
            display: inline;
            color: white;
            font-size: 28px;
            vertical-align: middle;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            flex: 1;
        }

        .container h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"], select {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color:rgb(51, 255, 61);
            color: black;
            padding: 10px 15px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #ff7518;
        }

        .message {
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        footer {
            background-color: #ff9933;
            text-align: center;
            padding: 10px;
            color: white;
            margin-top: 40px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="overlay"></div>

    <header>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Flag_of_India.svg/1280px-Flag_of_India.svg.png" alt="Indian Flag">
        <h1>Indian Embassy Visa Application</h1>
    </header>

    <div class="container">
        <h2>Visa Application Form</h2>

        <form action="visa_php.php" method="POST">
            <label for="country">Select Your Country: </label>
            <select name="country" id="country">
                <option value="">-- Select a country --</option>
                <option value="USA">USA</option>
                <option value="Canada">Canada</option>
                <option value="India">India</option>
                <option value="UK">UK</option>
                <option value="Australia">Australia</option>
            </select>
            <br><br>

            <input type="submit" value="Check Visa">
        </form>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo (strpos($message, 'Invalid') !== false) ? 'error' : 'success'; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <hr>

        <h2>Apply for Visa</h2>

        <form action="visa_php.php" method="POST">
            <label for="passport">Enter Passport Number: </label>
            <input type="text" name="passport" id="passport" maxlength="10" required>
            <br><br>

            <label for="apply_country">Select Your Country: </label>
            <select name="apply_country" id="apply_country" required>
                <option value="">-- Select a country --</option>
                <option value="USA">USA</option>
                <option value="Canada">Canada</option>
                <option value="India">India</option>
                <option value="UK">UK</option>
                <option value="Australia">Australia</option>
            </select>
            <br><br>

            <input type="submit" name="apply_visa" value="Apply for Visa">
        </form>

        <?php if (!empty($apply_message)): ?>
            <div class="message <?php echo (strpos($apply_message, 'All fields') !== false || strpos($apply_message, 'Invalid') !== false) ? 'error' : 'success'; ?>"><?php echo $apply_message; ?></div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 Indian Embassy. All rights reserved.</p>
    </footer>

</body>
</html>
