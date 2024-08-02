<?php
include("dbConnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export To Excel</title>
    <!-- Bootstrap CSS v5.2.1 & Other CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">  
    <link rel="stylesheet" href="assets/css/style.css">  
</head>
<body>
   
    <!-- Bootstrap Grid System -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="jumbotron text-center text-white bg-dark py-5">EXPORT USER RECORDS AS PDF</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Buttons -->
                <button type="button" class="btn btn-primary mb-2 float-end" 
                data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-plus"></i> Add User</button>
                <button id="exportPdf" class="btn btn-danger mb-2 me-1 float-end"><i class="fas fa-file-pdf"></i> Export</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Users Table -->
                <table class="table table-bordered table-hover table-striped text-center" style="width:100%;" id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Create User</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add User Form -->
                    <form action="" method="POST" id="addUserForm">
                        <input type="text" id="name" placeholder="Enter Full Name" class="form-control mb-2">
                        <input type="number" id="age" placeholder="Enter Age" class="form-control">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="addUser">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>    

    <!-- JQuery CDN, Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>  
    <script src="assets/js/toaster.js"></script>
    <script>

        // Fetch users
        function fetchUsers()
        {
            $("#usersTable").DataTable({
                "processing":true,
                "serverSide":true,
                "ajax":
                {
                    "url": "ajax/fetch/users.php",
                    "type": "POST",
                },
                "columns": 
            [
                { data: 'sr_no' },
                { data: 'name' },
                { data: 'age' },
                { data: 'created_at' },
            ],
            pageLength: 10,
            searching: true,
            });
        }
        
        // Load records on page initialization
        $(document).ready(function () {
            fetchUsers();
        });

        // Add User
        $("#addUser").click(function(){
            let name = $("#name").val();
            let age = $("#age").val();
                if(name==="")
            {
                toaster("Name is required",5);
            }
            else
            {
                if(age==="")
                {
                    toaster("Age is required",5);
                }
                else
                {
                    $.ajax({
                        type: "POST",
                        url: "ajax/add/users.php",
                        data: {name:name, age:age},
                        success: function (response) 
                        {
                            if(response==="User has been added successfully")
                            {
                                let currentPage = $("#usersTable").DataTable().page();
                                $("#usersTable").DataTable().destroy();
                                fetchUsers();
                                toaster(response,5);
                                $("#addUserForm input").val("");
                                $("#addUserModal").modal("hide");

                                // Set the current page after reinitializing DataTable
                                $("#usersTable").DataTable().one('draw', function () {
                                    $("#usersTable").DataTable().page(currentPage).draw('page');
                                }); 
                            }
                            else if(response==="User has not added")
                            {
                                toaster(response,5);
                            }
                            else
                            {
                                toaster("An unknown error has been occured!",5);
                            }
                        }
                    });
                }
            }
        });

        // Export as PDF
        $('#exportPdf').click(function() {
            let rd = "rd";
            $.ajax({
                url: 'export.php',
                method: 'POST',
                data:{rd:rd},
                success: function(response) 
                {
                    window.location.href=response;
                }
            });
        });
    </script>
</body>
</html>