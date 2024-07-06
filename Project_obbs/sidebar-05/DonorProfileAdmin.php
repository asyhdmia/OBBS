<?php
// Database configuration
$dbHost = 'localhost'; // Replace with your database host
$dbUsername = 'root'; // Replace with your database username
$dbPassword = ''; // Replace with your database password
$dbName = 'bloodbank'; // Replace with your database name

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from database
$sql = "SELECT * FROM donors"; // Replace 'donors' with your table name
$result = $conn->query($sql);

// Check if query successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donors Data</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;        
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
        }
        .table-title h2 {
            margin: 8px 0 0;
            font-size: 22px;
        }
        .search-box {
            position: relative;        
            float: right;
        }
        .search-box input {
            height: 34px;
            border-radius: 20px;
            padding-left: 35px;
            border-color: #ddd;
            box-shadow: none;
        }
        .search-box input:focus {
            border-color: #3FBAE4;
        }
        .search-box i {
            color: #a0a5b1;
            position: absolute;
            font-size: 19px;
            top: 8px;
            left: 10px;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table td:last-child {
            width: 130px;
        }
        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }
        table.table td a.view {
            color: #03A9F4;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #E34724;
        }
        table.table td i {
            font-size: 19px;
        }    
        .pagination {
            float: right;
            margin: 0 0 5px;
        }
        .pagination li a {
            border: none;
            font-size: 95%;
            width: 30px;
            height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 30px !important;
            text-align: center;
            padding: 0;
        }
        .pagination li a:hover {
            color: #666;
        }    
        .pagination li.active a {
            background: #03A9F4;
        }
        .pagination li.active a:hover {        
            background: #0397d6;
        }
        .pagination li.disabled i {
            color: #ccc;
        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px;
        }
        .hint-text {
            float: left;
            margin-top: 6px;
            font-size: 95%;
        }    
        .edit-mode td input {
            width: 100%;
            height: 34px;
            padding: 0 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Donors <b>Data</b></h2></div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input id="searchInput" type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <table id="donorsTable" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name <i class="fa fa-sort"></i></th>
                            <th>IC No</th>
                            <th>Phone</th>    
                            <th>Address</th>
                            <th>Marital Status</th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through each row fetched from the database
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>"; // Replace 'name' with your column names
                            echo "<td>" . htmlspecialchars($row['ic_no']) . "</td>"; // Replace 'ic_no' with your column names
                            echo "<td>" . htmlspecialchars($row['phone']) . "</td>"; // Replace 'phone' with your column names
                            echo "<td>" . htmlspecialchars($row['address']) . "</td>"; // Replace 'address' with your column names
                            echo "<td>" . htmlspecialchars($row['marital_status']) . "</td>"; // Replace 'marital_status' with your column names
                            echo '<td class="actions">
                                      <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                      <a href="#" class="save" title="Save" data-toggle="tooltip" style="display:none;"><i class="material-icons">&#xE161;</i></a>
                                      <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                                  </td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <ul id="pagination" class="pagination">
                        <!-- Pagination links will be dynamically generated here -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to show entries based on page number
            function showPage(pageNum) {
                var rows = $('#donorsTable tbody tr');
                var rowsPerPage = 5;
                var start = (pageNum - 1) * rowsPerPage;
                var end = start + rowsPerPage;

                // Hide all rows and show only the ones in the current page range
                rows.hide().slice(start, end).show();
            }

            // Initial setup: Show first page
            showPage(1);

            // Event handler for pagination clicks
            $('#pagination li').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);

                if ($this.data('page') === 'prev') {
                    var prev = $('.pagination li.active').prev('li.page-item');
                    if (prev.length > 0) {
                        prev.find('a.page-link').trigger('click');
                    }
                } else if ($this.data('page') === 'next') {
                    var next = $('.pagination li.active').next('li.page-item');
                    if (next.length > 0) {
                        next.find('a.page-link').trigger('click');
                    }
                } else {
                    // Activate clicked page and show corresponding entries
                    $('#pagination li').removeClass('active');
                    $this.addClass('active');
                    var pageNum = $this.text();
                    showPage(pageNum);
                }
            });

            // Enable tooltip
            $('[data-toggle="tooltip"]').tooltip();
            
            // Event handler for edit button
            $('#donorsTable').on('click', '.edit', function() {
                var row = $(this).closest('tr');
                row.find('td:not(.actions)').each(function() {
                    var td = $(this);
                    var value = td.text();
                    td.html('<input type="text" class="form-control" value="' + value + '">');
                });
                row.addClass('edit-mode');
                row.find('.edit').hide();
                row.find('.save').show();
            });

            // Event handler for save button
            $('#donorsTable').on('click', '.save', function() {
                var row = $(this).closest('tr');
                var rowData = {
                    name: row.find('td:nth-child(1) input').val(),
                    ic_no: row.find('td:nth-child(2) input').val(),
                    phone: row.find('td:nth-child(3) input').val(),
                    address: row.find('td:nth-child(4) input').val(),
                    marital_status: row.find('td:nth-child(5) input').val()
                };

                // Perform AJAX update or form submission to update database here
                // For demonstration, we'll just update the row visually
                row.find('td:not(.actions)').each(function(index) {
                    var td = $(this);
                    td.text(rowData[Object.keys(rowData)[index]]);
                });

                row.removeClass('edit-mode');
                row.find('.save').hide();
                row.find('.edit').show();
            });

            // Event handler for delete button
            $('#donorsTable').on('click', '.delete', function() {
                var row = $(this).closest('tr');
                var name = row.find('td:first').text(); // Assuming the name is in the first column
                if (confirm('Are you sure you want to delete ' + name + '?')) {
                    // Perform AJAX delete or form submission to delete record from database here
                    row.remove();
                }
            });

            // Search functionality
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#donorsTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</body>
</html>
