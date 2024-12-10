<?php include 'views/layouts/admin_header.php'; ?>
    <body>
        <div class="overlay" id="overlay">
            <div class="loader" id="loader"></div>
        </div>

        <div class="container-xxl">
            <div class="toast">
                <div class="toast-content">
                    <i class="fas fa-solid fa-check check"></i>
                    <div class="message">
                        <span class="text text-1">Success</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress active"></div>
            </div>
            <div class="modal fade" id="forgotPasswordLink" tabindex="-1" aria-labelledby="forgotPasswordLink" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="forgotPasswordLink">Forget password</h5>
                             
                        </div>
                        <div class="modal-body">
                            <form id="forgotPasswordForm">
                                <div class="form-group">
                                    <label for="forgotEmail">Enter Your Email:</label>
                                    <input type="email" id="forgotEmail" name="forgotEmail" class="input" required />
                                </div>
                                <button type="submit" class="buttoncusbut"  id="sendOtpBtn">Send OTP</button>
                                
                                <!-- OTP Input Section (hidden initially) -->
                                <div id="otpSection" class="hidden">
                                    <label for="otp">Enter OTP:</label>
                                    <input type="text" id="otp" name="otp" class="input" required />
                                    <button type="button" id="verifyOtpBtn" class="buttoncusbut">Verify OTP</button>
                                </div>

                                <!-- Password Change Section (hidden initially) -->
                                <div id="passwordChangeSection" class="hidden">
                                    <label for="newPassword">Enter New Password:</label>
                                    <input type="password" id="newPassword" name="newPassword" class="input" required />
                                    <label for="confirmPassword">Confirm Password:</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword" class="input" required />
                                    <button type="button" class="buttoncusbut" id="resetPasswordBtn">Update Password</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner">
                    <!-- Register -->
                    <div class="card px-sm-6 px-0">
                        <div class="card-body">
                            <h4 class="mb-1">Welcome back! 👋</h4>
                            <p class="mb-6">Sign in to access your dashboard</p>

                            <form id="formAuthentication" class="mb-6 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" novalidate="novalidate">
                                <div class="mb-6 fv-plugins-icon-container">
                                    <div class="form has-validation">
                                        <input class="input" id="email" name="username" placeholder="Username" required="" type="text" autofocus="" />
                                        <span class="input-border"></span>
                                    </div>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="mb-6 form-password-toggle fv-plugins-icon-container">
                                    <div class="form has-validation">
                                        <input class="input" type="password" id="password" name="password" placeholder="Password" required="" autofocus="" />
                                        <span class="input-border"></span>
                                    </div>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="mb-8"></div>
                                <div class="mb-6">
                                    <button class="buttoncus d-grid" type="submit">Login</button>
                                    <p class="text-center mt-3">
                                        <a href="#" class="forgetpass" id="forgotPasswordLink">Forgot Password?</a>
                                    </p>
                                </div>
                                <input type="hidden" />
                            </form>
                        </div>
                    </div>
                    <!-- /Register -->
                </div>
            </div>
        </div>
        <?php include 'views/layouts/admin_footer.php'; ?>
        <script>
        $(document).ready(function () {

        $(".forgetpass").on("click", function () {
            $("#forgotPasswordLink").modal("show");
        });
        const button = $(".buttoncus");
        const forgetbutton = $(".buttoncusbut");
        const spinner = '<span class="spinner"></span>';
        const sendOtpButton = $("#sendOtpBtn");
        const verifyOtpButton = $("#verifyOtpBtn");
        const resetPasswordButton = $("#resetPasswordBtn");

    // Send OTP
    sendOtpButton.on("click", function () {
        const email = $("#forgotEmail").val().trim();
        
        if (!email) {
            showToast("warning", "Please enter a valid email.");
            return;
        }

        sendOtpButton.html('<span class="spinner"></span>').addClass("loading");

        $.ajax({
            url: `${BASE_DIR}/forgot-password`, // PHP route for sending OTP
            type: "POST",
            data: { email: email },
            dataType: "json",
        })
        .done(function (response) {
            if (response.success) {
                showToast("success", "OTP sent to your email.");
                $("#otpSection").removeClass("hidden"); 
                $("#forgotEmail").parent().hide(); 
                sendOtpButton.hide(); 
            } else {
                showToast("warning", response.message || "Email not found.");
                sendOtpButton.removeClass("loading").html("Send OTP");
            }
        })
        .fail(function () {
            showToast("error", "An error occurred while sending the OTP.");
            sendOtpButton.removeClass("loading").html("Send OTP");
        });
    });

    // Verify OTP
    verifyOtpButton.on("click", function () {
        const otp = $("#otp").val().trim();
        const email = $("#forgotEmail").val().trim();  // Use the email field value for OTP verification
        
        if (!otp) {
            showToast("warning", "Please enter the OTP.");
            return;
        }

        verifyOtpButton.prop('disabled', true);  // Disable the button to prevent multiple clicks
        verifyOtpButton.html('<span class="spinner"></span>').addClass("loading");

        $.ajax({
            url: `${BASE_DIR}/forgot-password/verify-otp`, // PHP route for verifying OTP
            type: "POST",
            data: { otp: otp, email: email },
            dataType: "json",
        })
        .done(function (response) {
            if (response.success) {
                showToast("success", "OTP verified.");
                $("#otpSection").hide(); // Hide OTP input section
                $("#passwordChangeSection").show(); 

            } else {
                showToast("warning", response.message || "Invalid OTP.");
            }
        })
        .fail(function () {
            showToast("error", "An error occurred while verifying the OTP.");
        })
        .always(function () {
            verifyOtpButton.prop('disabled', false);  // Re-enable the button after AJAX call
            verifyOtpButton.removeClass("loading").html("Verify OTP");
        });
    });

    // Reset Password
    resetPasswordButton.on("click", function () {
        const newPassword = $("#newPassword").val().trim();
        const confirmPassword = $("#confirmPassword").val().trim();

        if (newPassword !== confirmPassword) {
            showToast("warning", "Passwords do not match.");
            return;
        }

        resetPasswordButton.html('<span class="spinner"></span>').addClass("loading");
        $.ajax({
            url: `${BASE_DIR}/forgot-password/reset`,
            type: "POST",
            data: { email: $("#forgotEmail").val(), newPassword: newPassword },
            dataType: "json",
        })
        .done(function (response) {
            if (response.success) {
                showToast("success", "Password updated successfully.");
                $("#forgotPasswordLink").modal("hide");
            } else {
                showToast("warning", response.message || "Failed to update password.");
            }
            resetPasswordButton.removeClass("loading").html("Reset Password");
        })
        .fail(function () {
            showToast("error", "An error occurred while updating the password.");
            resetPasswordButton.removeClass("loading").html("Reset Password");
        });
    });
    

    $("#formAuthentication").on("submit", function (event) {
        event.preventDefault();
        const formData = {
            username: $("#email").val().trim(),
            password: $("#password").val().trim(),
        };

        if (!formData.username || !formData.password) {
            showToast("warning", "Username and Password are required.");
            return;
        }

        button.html(spinner).addClass("loading");

        $.ajax({
            url: `${BASE_DIR}/login`, // Your PHP route for login
            type: "POST",
            data: formData,
            dataType: "json",
        })
            .done(function (response) {
                if (response.success) {
                    const encryptedUsername = btoa(formData.username); // Encrypt username (Base64 encoding)
                    showLoaderAndRedirect(encryptedUsername); // Show loader and redirect
                } else {
                    showToast("warning", response.message || "Invalid credentials.");
                    button.removeClass("loading").html("Login");
                }
            })
            .fail(function () {
                showToast("error", "An error occurred while processing the request.");
                button.removeClass("loading").html("Login");
            });
    });

    function showLoaderAndRedirect(encryptedUsername) {
        $("#overlay").show();
        setTimeout(function () {
            window.location.href = `dash?auth=${encryptedUsername}`;
        }, 1500);
    }

    function showToast(type, message) {
        const toast = $(".toast");
        const toastTitle = $(".text-1");
        const progress = $(".progress");
        const icon = $(".check");

        // Reset toast classes
        progress.removeClass("success warning error");
        icon.removeClass("success warning error");

        // Set the icon and progress bar based on the type
        if (type === "warning") {
            icon.addClass("warning fa-solid fa-exclamation");
            progress.addClass("warning");
        } else if (type === "error") {
            icon.addClass("error fa-solid fa-times");
            progress.addClass("error");
        } else {
            icon.addClass("success fa-solid fa-check");
            progress.addClass("success");
        }

        // Set the message
        toastTitle.text(message);
        toast.addClass("active");
        progress.addClass("active");

        // Hide the toast after 5 seconds
        setTimeout(() => {
            toast.removeClass("active");
            progress.removeClass("active");
        }, 5000);
    }
});

      </script>