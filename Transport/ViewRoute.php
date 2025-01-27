<?php
session_start();
if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
    !empty($_SESSION['studentName']) &&
    !empty($_SESSION['studentId'])
) {
    $studentId = $_SESSION['studentId'];
    $stname = $_SESSION['studentName'];
} else {
?>
    <script>
        location.assign('../Login_Page/LoginForm.php')
    </script>
<?php
}
include_once "../Header/StudentHeader.php";
include("../Connection/dbconnection.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

        * {
            font-family: 'Poppins', sans-serif;
            
        }

        body {
            background: #eeeeee;
            color: #333;
        }
        .containerNo {
            
            max-width: 1100px;
            margin: 80px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .container11 {
    
            max-width: 1100px;
            margin: 90px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .head {
            text-align: center;
            margin-bottom: 5px;
        }
        h1{
           
            text-align: center;
        }

        h2 {
            color: black;
            font-size: 28px;
            font-weight: 600;
            padding: 0px;
            margin: 0px;
        }

        #booking-results {
           
            border-radius: 10px;
            
            padding: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #2c3e50;
            color: #ffffff;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }
        .table td.route-info {
            font-size: 14px;
            /* Smaller font size */
            word-wrap: break-word;
            /* Ensure text breaks into multiple lines */
            white-space: normal;
            /* Allow text to wrap */
            max-width: 300px;
            /* Set a max-width to prevent text from stretching too far */
        }

        .btn {
            background-color: #2c3e50;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-cancel {
            background-color: #e74c3c;
        }

        .btn-cancel:hover {
            background-color: #c0392b;
        }

        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none;
            z-index: 999;
        }

        .btn-cancel {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #e74c3c;
            color: #ffffff;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background-color: #c0392b;
        }

        @media (max-width: 768px) {
            .container11 {
                margin: 20px;
                padding: 10px;
            }

            .table th,
            .table td {
                font-size: 12px;
                padding: 10px;
            }

            h2 {
                font-size: 22px;
            }
        }

    </style>

</head>

<body>

    <?php
    $resultSql = "SELECT * FROM `routes` 
                    ORDER BY route_created ASC";

    $resultSqlResult = mysqli_query($conn, $resultSql);

    if (!mysqli_num_rows($resultSqlResult)) { ?>
        <div class="containerNo">
            <div id="noCustomers" class="alert alert-dark" role="alert">
                <h1 class="alert-heading">No Route Found!!</h1>
                <hr>
            </div>
        </div>
    <?php } else { ?>

        <div class="container11">
            <section id="booking">
                <div id="head" class="head">
                    <h2>Route Status</h2>
                </div>
                <div id="booking-results">

                    <table class="table table-hover table-bordered">
                        <thead>
                            <th>Route Id</th>
                            <th>Bus No.</th>
                            <th>Route Info</th>
                            <th>Start Time</th>
                            <th>Departure Time</th>
                        </thead>
                        <?php
                        while ($row = mysqli_fetch_assoc($resultSqlResult)) {
                            $id = $row["id"];
                            $route_id = $row["route_id"];
                            $bus_no = $row['bus_no'];
                            $route_info = $row["route_Info"];
                            $starting_time = $row["starting_time"];
                            $departure_time = $row["depurture_time"];
                            
                        ?>
                            <tr>
                                <td><?php echo $route_id; ?></td>
                                <td><?php echo $bus_no; ?></td>
                                <td class="route-info"><?php echo $route_info; ?></td>
                                <td><?php echo $starting_time; ?></td>
                                <td><?php echo $departure_time; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </section>
        </div>
    <?php } ?>

</body>
<?php include_once "../Header/Footer.php"; ?>
</html>
