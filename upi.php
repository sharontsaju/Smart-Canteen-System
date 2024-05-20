<?php
include 'inc/header.php';
include 'modules/db_connect.php';

if (!isset($_SESSION['reg_no'])) {
    header("Location: index_student.php");
}

$orders_id = isset($_POST['pay_btn']) ? $_POST['pay_btn'] : null;

if ($orders_id) {
    // Process the payment logic here
    // ...

    // Show success message
    echo "<div class='container' style='background:white; width:350px ;height:400px ;margin: 0 auto;border:2px solid black;padding:5em'>
        <center>
            <img src='images/upi1.png'>
            <h2>Payment Details</h2>
            <p>Payment Successful! .</p>
            
            <p><a href='see_bill_students.php'>Go back to the bill page</a></p>
        </center>
    </div>";
}

?>

<body>
    <center>
        <div class="container" style='background:white; width:350px ;height:400px ;margin: 0 auto;border:2px solid black;padding:5em'>
            <center>
                <img src='images/upi1.png'>
                <h2>Payment Details</h2>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="amount">Amount:</label>
                    <input type="number" name="amount" id="amount" required><br><br>
                    <label for="upi_id">UPI ID:</label>
                    <input type="text" name="upi_id" id="upi_id" required><br><br>
                    <input type="submit" name="pay_btn" value="Make Payment">
                </form>
            </center>
        </div>
    </center>
    <?php include 'inc/footer.php'; ?>
</body>
</html>
