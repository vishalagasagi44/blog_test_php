<?php require_once "views/layouts/header_dash.php"; ?>
<style>
    /* Adjust column widths */
    #DataTables_Table_0 th:nth-child(1),
    #DataTables_Table_0 td:nth-child(1) {
        width: 10%;
    }

    #DataTables_Table_0 th:nth-child(2),
    #DataTables_Table_0 td:nth-child(2) {
        width: 5%;
    }

    #DataTables_Table_0 th:nth-child(3),
    #DataTables_Table_0 td:nth-child(3) {
        width: 10%;
    }

    #DataTables_Table_0 th:nth-child(4),
    #DataTables_Table_0 td:nth-child(4) {
        width: 5%;
    }

    #DataTables_Table_0 th:nth-child(5),
    #DataTables_Table_0 td:nth-child(5) {
        width: 50%;
    }
    #DataTables_Table_0 th:nth-child(6),
    #DataTables_Table_0 td:nth-child(6) {
        width: 10%;
    }
    #DataTables_Table_0 th:nth-child(7),
    #DataTables_Table_0 td:nth-child(7) {
        width: 10%;
    }
</style>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php require_once "views/layouts/sidebar.php"; ?>
            <div class="layout-page">
                <?php require_once "views/layouts/navbar.php"; ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                   <div class="modal fade" id="addAuthorModal" tabindex="-1" aria-labelledby="addAuthorModal" aria-hidden="true">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addAuthorModal">Add Author</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
        
                                    <div class="modal-body">
                                        <form id="addAuthorForm">
                                            <div class="form-group mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" class="form-control" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" class="form-control" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="content">Content</label>
                                                <textarea id="content" class="form-control" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Add Author</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
                                    <div class="col-md-3 product_stock">
                                    <button class="btn btn-primary" id="addAuthorBtn">Add Author</button>

                                    </div>
                                </div>
                            </div>
                            <div class="card-datatable">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                     <table id="authorsTable" class="datatables-products table dataTable no-footer dtr-column collapsed">
                                    <thead>
                                    <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Content</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be populated here via AJAX -->
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
  
    <?php require_once "views/layouts/admin_footer.php"; ?>
    <script>
    $(document).ready(function () {
    // Initialize DataTable
    var table = $('#authorsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": `${BASE_DIR}/getAuthors`,
            "method": "GET",
            "dataSrc": function (json) {
                // Process the fetched data and return it in the required format for DataTable
                return json.map(function (author) {
                    return {
                        id: author.id,
                        name: author.name,
                        email: author.email,
                        content: author.content,  // Include content
                        actions: `
                            <button class="btn btn-warning deactivate-btn" data-id="${author.id}">Deactivate</button>
                            <button class="btn btn-danger delete-btn" data-id="${author.id}">Delete</button>
                        `
                    };
                });
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "content" },  // Display content in a separate column
            { "data": "actions" }
        ],
        paging: false
    });

    // Add new author
    $('#addAuthorForm').submit(function (e) {
        e.preventDefault();
        let name = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let content = $('#content').val();
        $.ajax({
            url: `${BASE_DIR}/addAuthor`,
            method: 'POST',
            data: {
                name: name,
                email: email,
                password: password,
                content: content // Send content to the server
            },
            success: function (data) {
                let result = JSON.parse(data);
                if (result.success) {
            // Success message
            Swal.fire({
                title: "Author Added Successfully",
                icon: "success",
                timer: 1000,
                showConfirmButton: false,
            });
            $('#addAuthorModal').modal('hide');
            table.ajax.reload();
            $('#authorForm')[0].reset(); 
            
        } else {
            $('#addAuthorModal').modal('hide');
            Swal.fire({
                title: "Email Already Exists",
                icon: "error",
                timer: 1000,
                showConfirmButton: false,
            });
            $('#addAuthorModal').modal('show');
        }
            }
        });
    });

    // Deactivate user
    $(document).on('click', '.deactivate-btn', function () {
        let userId = $(this).data('id');
        $.ajax({
            url: `${BASE_DIR}/deactivateUser/${userId}`,
            method: 'POST',
            success: function () {
                table.ajax.reload();  // Reload the DataTable
            }
        });
    });

    // Delete user
    $(document).on('click', '.delete-btn', function () {
        let userId = $(this).data('id');
        $.ajax({
            url: `${BASE_DIR}/deleteUser/${userId}`,
            method: 'POST',
            success: function () {
                table.ajax.reload();  // Reload the DataTable
            }
        });
    });

    // Show add author modal
    $('#addAuthorBtn').click(function () {
        $('#addAuthorModal').modal('show');
    });
});


    </script>
</body>
</html>
