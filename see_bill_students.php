<?php
include 'inc/header.php';
include 'modules/db_connect.php';
if (!isset($_SESSION['reg_no'])) {
    header("Location:index_student.php");
}

$bill_collections = array();
$_SESSION['bill_collections'] = [];

$_SESSION['stu_reg_no'] = '';

if (isset($_POST['see_bill_btn'])) {
    $stu_id = mysqli_real_escape_string($conn, $_POST['select_stu_see_bill']);

    $_SESSION['stu_reg_no'] = $stu_id;

    $sql = "SELECT id FROM students WHERE reg_no = '$stu_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            $stu_id = $data['id'];
            $_SESSION['student_id'] = $stu_id;
        }

        $sql = "SELECT O.id AS orders_id,O.quantity,O.has_paid,O.created_at, S.id, S.name, F.food_name, F.price
            FROM orders O 
            JOIN students S ON S.id = O.ordered_by
            JOIN foods F ON O.ordered_item = F.id
            WHERE S.id = '$stu_id'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $bill_collections[] = $data;
                $_SESSION['bill_collections'][] = $data;
            }
        } else {
            $_SESSION['message'] = "Sorry! No bills to show.";
        }
    } else {
        $_SESSION['message'] = "Sorry! No students found.";
    }
}
?>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 5px;
        text-align: left;
    }
</style>

<body style="background-color: #f7f9fc;">

    <ul class="topnav">
        <li class="left"><a href="javascript:void(0)" title="Canteen Management" style="font-size: 18px;font-weight: bold;">Canteen Management</a></li>
        <li class="right"><a href="index_student.php" title="Logout"> <i class="fa fa-sign-out"></i> Logout</a></li>
        <li class="right"><a href="feedback.php" title="Go to feedback"><i class="fa fa-star"></i>feedback</a></li>
        <li class="right"><a href="menu1.php" title=" Menu"><i class="fa fa-home"></i>Menu</a></li>
</ul>    

    <div style="padding:0 16px;margin: 10px;">
        <?php
        echo "<div class='cont' style='margin-top:40px;'>
            <div class='row'>
                <div class='col-md-7 col-md-offset-2'>
                    <div class='card' style='background:white';>
                        <center><img src='images/see bill.jpg' style='width:20%;margin-top:0px;' alt='See Bill'></center>
                        <h2>See Bill</h2>
                        <form id='see_bill_form' name='see_bill_form' method='POST' autocomplete='off'>
                            <input type='text' name='select_stu_see_bill' id='select_stu_see_bill' placeholder='Enter Students Regd. No.' value='" . $_SESSION['reg_no'] . "' required/>
                            <button type='submit' class='button' name='see_bill_btn' style='margin-top:20px;'><i class='fa fa-eye'></i> See Bill</button>
                        </form>
                    </div><!--close card-->";

        if (count($bill_collections) > 0) {
            $stu_name = $bill_collections[1]['name'];

            $total = 0;
            $paid = 0;

            echo "<div id='student_bill_card' class='card' style='margin-top:20px;'>
                <h2>" . $stu_name . "'s Bill</h2><hr>
                <table style='width:100%;font-size:16px;'>
                    <tr style='font-size:20px;'>
                        <th>S.N</th>
                        <th>Food Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Ordered At</th>
                        <th>Payment</th>
                    </tr>";

            for ($i = 0; $i < count($bill_collections); $i++) {
                if ($bill_collections[$i]['has_paid']) {
                    $paid += ($bill_collections[$i]['price']) * ($bill_collections[$i]['quantity']);
                }

                $total += ($bill_collections[$i]['price']) * ($bill_collections[$i]['quantity']);
                echo "<tr>
                        <td>" . (($i) + 1) . "</td>
                        <td>" . $bill_collections[$i]['food_name'] . "</td>
                        <td>" . $bill_collections[$i]['price'] . "</td>
                        <td>" . $bill_collections[$i]['quantity'] . "</td>
                        <td>Rs. " . ($bill_collections[$i]['price']) * ($bill_collections[$i]['quantity']) . "</td>
                        <td>" . $bill_collections[$i]['created_at'] . "</td>
                        <td>";

                        if ($bill_collections[$i]['has_paid']) {
                            echo "<i class='fa fa-check'></i> Paid";
                        } else {
                            $paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';
                            if (isset($_POST['pay_btn']) && $_POST['orders_id'] === $bill_collections[$i]['orders_id'] && $paymentMethod === 'UPI') {
                                echo "<i class='fa fa-check'></i> Paid";
                            } else {
                                echo "<form method='POST' action='upi.php' data-id='" . $bill_collections[$i]['orders_id'] . "'>
                                          <button type='submit' id='pay_btn" . $bill_collections[$i]['orders_id'] . "' name='pay_btn' class='button' style='height:20px;width:50px;padding:2px;margin-left:10px;font-size:15px;' title='Pay " . $bill_collections[$i]['food_name'] . "'>
                                              Pay
                                          </button>
                                          <span id='result" . $bill_collections[$i]['orders_id'] . "'></span>
                                          <input type='hidden' name='orders_id' value='" . $bill_collections[$i]['orders_id'] . "'>
                                          <input type='hidden' name='paymentMethod' value='UPI'>
                                      </form>";
                            }
                        }
                        
                        
                    
                        echo "</td></tr>";
                    }
            echo "<tr>
                    <td colspan='7'>
                        <center>
                            <b>
                                Total = Rs. <span id='total'>" . $total . "</span>
                                <span id='paid' style='margin-left:20px;margin-right:20px;'>Paid = Rs." . $paid . "</span>
                                Remaining = Rs.<span id='remaining'>" . ($total - $paid) . "</span>
                            </b>
                        </center>
                    </td>
                </tr>
            </table>
        </div><!--close card-->";
        }
        echo "</div><!--close col-->
        </div><!--close row -->
    </div><!--close cont-->";
        ?>
    </div>
    <script type="text/javascript" src="js/Pay.js"></script>
    <?php include 'inc/footer.php'; ?>
    