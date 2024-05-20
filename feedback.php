<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url('images/feedbackbg1.jpg'); /* Replace 'images/feedbackbg.jpg' with the actual path to your image */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .container {
      max-width: 600px;
      padding: 20px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .rating {
      display: flex;
      justify-content: center;
      position: relative;
      height: 40px;
      margin-bottom: 20px;
    }

    .rating input {
      display: none;
    }

    .rating label {
      display: inline-block;
      font-size: 40px;
      color: #ccc;
      cursor: pointer;
      margin-right: 23px; /* Added space between star labels */
    }

    .rating label:before {
      content: "\2605";
      position: absolute;
    }

    .rating label:hover,
    .rating label:hover ~ label,
    .rating input:checked ~ label {
      color: #FFD700;
    }

    .rating input:checked ~ label:before {
      color: #FFD700;
    }

    /* Styling for the submit button */
    button[type="submit"] {
      margin-top: 10px; /* Add margin-top for spacing */
      padding: 10px 20px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 4px;
    }

    button[type="submit"]:hover {
      background-color: #45a049;
    }

    /* Custom font for the heading */
    p.heading {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px; /* Added margin-bottom for spacing */
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['rating'])) {
        $rating = $_POST['rating'];
        // Perform necessary processing with the rating value
        // For this example, we will just display the selected rating

        echo "Thank you for your feedback! You rated it as: " . $rating . " stars";
      } else {
        echo "Rating not selected.";
      }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      <p class="heading">Please rate your feedback:</p>
      <div class="rating">
        <input type="radio" id="star5" name="rating" value="5">
        <label for="star5"></label>
        <input type="radio" id="star4" name="rating" value="4">
        <label for="star4"></label>
        <input type="radio" id="star3" name="rating" value="3">
        <label for="star3"></label>
        <input type="radio" id="star2" name="rating" value="2">
        <label for="star2"></label>
        <input type="radio" id="star1" name="rating" value="1">
        <label for="star1"></label>
      </div>
      <div style="display: flex; justify-content: center;"> <!-- Added inline style for centering -->
        <button type="submit">Submit Feedback</button>
      </div>
    </form>
  </div>
</body>
</html>
