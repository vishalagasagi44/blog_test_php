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
    <?php  $user_id?>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php require_once "views/layouts/sidebar.php"; ?>
            <div class="layout-page">
                <?php require_once "views/layouts/navbar.php"; ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addBlogModalLabel">Add Blog</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addBlogForm">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="content" class="form-label">Content</label>
                                                <textarea class="form-control" id="content" name="content" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="author_id" class="form-label">Author ID</label>
                                                <input type="number" class="form-control" id="author_id" name="author_id" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category</label>
                                                <input type="text" class="form-control" id="category" name="category" required>
                                            </div>
                                                                                    <div class="mb-3">
                                            <label for="image" class="form-label">Upload Image</label>
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                        </div>
                                            <button type="submit" class="btn btn-primary">Add Blog</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="commentModalLabel">Comments</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="commentTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Commenter</th>
                                                    <th>Comment</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Comments will be loaded here dynamically -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Edit Blog Modal -->
                        <div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form id="editBlogForm">
    <input type="hidden" id="editBlogId" name="id">
    
    <div class="row">
        <!-- First Column -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="editTitle" class="form-label">Title</label>
                <input type="text" class="form-control" id="editTitle" name="title" required>
            </div>

            <div class="mb-3">
                <label for="editDescription" class="form-label">Description</label>
                <textarea class="form-control" id="editDescription" name="description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="editCategory" class="form-label">Category</label>
                <input type="text" class="form-control" id="editCategory" name="category" required>
            </div>
        </div>
        
        <!-- Second Column -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="editContent" class="form-label">Content</label>
                <textarea class="form-control" id="editContent" name="content" required></textarea>
            </div>

            <div class="mb-3">
                <label for="editImagePath" class="form-label">Image Path</label>
                <input type="file" class="form-control" id="editImagePath" name="image_path" accept="image/*">
            </div>

            <div id="imagePreview" style="display: none;">
                <label for="previewImage" class="form-label">Current Image:</label>
                <img id="previewImage" src="#" alt="Image Preview" class="img-thumbnail" style="max-width: 200px;">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
                                    <div class="col-md-3 product_stock">
                                        <button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                            <span><i class="bx bx-plus me-0 me-sm-1 bx-xs"></i><span class="d-none d-sm-inline-block">Add New Blog</span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-datatable">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="datatables-products table dataTable no-footer dtr-column collapsed" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                                        <thead class="border-top">
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Category</th>

                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Status</th>
                                                <th>Comments</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
     
    $(".add-new").on("click", function () {
        $("#addBlogModal").modal("show");
    });

   

    var table = $("#DataTables_Table_0").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${BASE_DIR}/blog/fetch`,
            type: "GET",
        },
        columns: [
            { data: "id" },
            { data: "title" },
            { data: "category" },
            { data: "created_at" },
            { data: "updated_at" },
            { 
            data: "is_published",
            render: function(data, type, row) {
                return data == 1 ? "Active" : "Inactive"; // Display "Active" or "Inactive"
            }
        },
            {
            data: null,
                render: function (data, type, row) {
                    return `
                      <button class="btn btn-info comment-btn"  data-postId="${data.id}">
                        <i class="fas fa-comments"></i> 
                        <span class="unapproved-count">0</span>
                    </button>
                    `;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                             <button class="btn btn-warning edit-btn" data-id="${data.id}"><i class='bx bxs-edit-alt' style='color:#ffffff'  ></i></button>
                          `;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                               <button class="btn btn-danger delete-btn" data-id="${data.id}"><i class='bx bx-trash' style='color:#ffffff' ></i></button>
                         `;
                },
            },
           
        ],
        paging: false,
        lengthChange: true,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, "All"],
        ],
    });

    table.on('draw', function () {
        $('.comment-btn').each(function() {
            var postId = $(this).data('postid');
            fetchUnapprovedComments(postId);  // Fetch count of unapproved comments for each post
        });
    });

    // When the comment button is clicked, show the comment modal with comments
    $("#DataTables_Table_0").on("click", ".comment-btn", function () {
        var postId = $(this).data('postid');
        loadComments(postId);  // Load comments for this post
        $('#commentModal').data('postid', postId);
         $('#commentModal').modal('show');
    });
    $("#editBlogForm").on("submit", function (event) {
        event.preventDefault();
        let formData = new FormData(this); // This will capture all the form fields, including the file input
        $.ajax({
            url: `${BASE_DIR}/blog/edit`, // URL for editing the blog
            method: "POST",
            data: formData,
            processData: false, // Important for file upload
            contentType: false,
            success: function (response) {
                $("#editBlogForm")[0].reset();
                $("#editBlogModal").modal("hide");
                Swal.fire({
                    title: "Blog Updated!",
                    icon: "success",
                    timer: 1000,
                    showConfirmButton: false,
                });
                table.ajax.reload();
            },
            error: function () {
                alert("Error updating blog");
            },
        });
    });

    $("#addBlogForm").on("submit", function (event) {
        event.preventDefault();

        // Create a FormData object from the form
        var formData = new FormData(this);

        $.ajax({
            url: `${BASE_DIR}/blog/create`, // Update the URL based on your route
            method: "POST",
            data: formData,
            processData: false, // Important for file upload
            contentType: false, // Important for file upload
            success: function (response) {
                $("#addBlogForm")[0].reset();
                $("#addBlogModal").modal("hide");
                Swal.fire({
                    title: "Blog Added!",
                    icon: "success",
                    timer: 1000,
                    showConfirmButton: false,
                });
                table.ajax.reload(); // Reload the table if you're using DataTables
            },
            error: function () {
                alert("Error adding blog");
            },
        });
    });

    $("#DataTables_Table_0").on("click", ".delete-btn", function () {
        const uid = $(this).data("id");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `${BASE_DIR}/blog/delete`,
                    method: "POST",
                    data: { id: uid },
                    success: function (response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Blog has been deleted.",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false,
                        });
                        table.ajax.reload();
                    },

                    error: function () {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong.",
                            icon: "error",
                        });
                    },
                });
            }
        });
    });

  

    function fetchUnapprovedComments(postId) {
    $.ajax({
        url: `${BASE_DIR}/getUnapprovedCommentCount/${postId}`,
        method: 'GET',
        success: function(response) {
            var data = JSON.parse(response);
                var count = data.unapproved_count;
                var $button = $(`.comment-btn[data-postId="${postId}"]`);
                
                // Update the count and conditionally show/hide the red circle
                if (count > 0) {
                    $button.find('.unapproved-count').text(count).show();  // Show count if > 0
                } else {
                    $button.find('.unapproved-count').hide();  // Hide the count if 0
                }
        }
    });
} 
function loadComments(postId) {
    $.ajax({
        url: `${BASE_DIR}/getComments/${postId}`,
        method: 'GET',
        dataType: "json", 
        success: function(response) {
            var comments = response;
            var commentTable = $('#commentTable tbody');
            commentTable.empty();  
            comments.forEach(function(comment) {
                var approveButton = comment.is_approved == 1
                    ? '<button class="btn btn-warning deactivate-btn" data-commentid="' + comment.id + '">Deactivate</button>'
                    : '<button class="btn btn-success activate-btn" data-commentid="' + comment.id + '">Activate</button>';

                var row = '<tr>' +
                    '<td>' + comment.commenter_name + '</td>' +
                    '<td>' + comment.comment + '</td>' +
                    '<td>' + approveButton + '</td>' +
                    '</tr>';
                commentTable.append(row);
            });

            // Handle activate/deactivate button click
            $('.activate-btn').click(function() {
                var commentId = $(this).data('commentid');
                updateCommentStatus(commentId, 1);  // Approve the comment
            });

            $('.deactivate-btn').click(function() {
                var commentId = $(this).data('commentid');
                updateCommentStatus(commentId, 0);  // Disapprove the comment
            });
        }
    });
}

// Function to update comment approval status (Activate/Deactivate)
function updateCommentStatus(commentId, status) {
    $.ajax({
        url: `${BASE_DIR}/updateCommentApproval/${commentId}/${status}`,
                method: 'POST',
        success: function(response) {
            loadComments($('#commentModal').data('postid'));  // Reload the comments in the modal
        },
        error: function() {
            alert('Error updating comment status.');
        }
    });
}

    $("#DataTables_Table_0").on("click", ".edit-btn", function () {
        const uid = $(this).data("id");
        $("#editBlogModal").modal("show");
        $.ajax({
            url: `${BASE_DIR}/blog/fetchById/${uid}`,
            method: "GET",
            dataType: "json", // Use dataType to tell jQuery to expect JSON
            success: function (response) {
                $("#editBlogId").val(response.id);
                $("#editTitle").val(response.title);
                $("#editDescription").val(response.description);
                $("#editContent").val(response.content);
                $("#editAuthorId").val(response.author_id);
                $("#editCategory").val(response.category);
                $("#editIsPublished").prop("checked", response.is_published == 1);
                console.log(response.image_path);
                if (response.image_path) {
                    var imageUrl = `${BASE_DIR}/public/uploads/${response.image_path}`;
                    $("#previewImage").attr("src", imageUrl); // Set the preview image
                    $("#imagePreview").show(); // Show the preview container
                    config.log(imageUrl);
                } else {
                    $("#imagePreview").hide(); // Hide the preview if no image is found
                }
            },

            error: function () {
                alert("Error fetching blog data for edit");
            },
        });
    });
});

    </script>
</body>
</html>
