<!DOCTYPE html>
<html>

<head>

    <title>BDMS</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../icofont/icofont.min.css">

</head>

<body>
<div id="wrapper">

    <?php include 'includes/nav.php' ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Donors Detail</h1>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="row">
                <div class="col-lg-12">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by donor name"
                           onkeyup="searchDonor()" />
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Records of available donors
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <?php
                                    include "dbconnect.php";

                                    $qry = "SELECT * FROM donor";
                                    $result = mysqli_query($conn, $qry);

                                    if (!$result) {
                                        die("Query Failed: " . mysqli_error($conn));
                                    }

                                    echo "
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Guardian's Name</th>
                                            <th>Gender</th>
                                            <th>D.O.B</th>
                                            <th>Weight</th>
                                            <th>Blood Group</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                        </tr>
                                        </thead>";

                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tbody>
                                            <tr>
                                                <td>" . htmlspecialchars($row['name']) . "</td>
                                                <td>" . htmlspecialchars($row['username']) . "</td>
                                                <td>" . htmlspecialchars($row['guardiansname']) . "</td>
                                                <td>" . htmlspecialchars($row['gender']) . "</td>
                                                <td>" . htmlspecialchars($row['dob']) . "</td>
                                                <td>" . htmlspecialchars($row['weight']) . "</td>
                                                <td>" . htmlspecialchars($row['bloodgroup']) . "</td>
                                                <td>" . htmlspecialchars($row['email']) . "</td>
                                                <td>" . htmlspecialchars($row['address']) . "</td>
                                                <td>" . htmlspecialchars($row['contact']) . "</td>
                                            </tr>
                                            </tbody>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

<script>
    function searchDonor() {
        // Get search input
        const input = document.getElementById('searchInput').value.toLowerCase();
        const table = document.getElementById('dataTables-example');
        const rows = table.getElementsByTagName('tr');
        let found = false;

        // Loop through table rows (skip header)
        for (let i = 1; i < rows.length; i++) {
            const nameCell = rows[i].getElementsByTagName('td')[0]; // Name is in the first column
            if (nameCell) {
                const name = nameCell.textContent || nameCell.innerText;
                if (name.toLowerCase().includes(input)) {
                    rows[i].style.backgroundColor = 'darkred'; // Highlight matching row in dark red
                    rows[i].style.color = 'white'; // Change text color for better visibility
                    found = true;
                } else {
                    rows[i].style.backgroundColor = ''; // Reset non-matching row
                    rows[i].style.color = ''; // Reset text color
                }
            }
        }

        if (!found && input !== "") {
            alert("No donor found with the name: " + input);
        }
    }
</script>

</body>

</html>
