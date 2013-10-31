
$().ready(function() {

    $("#signupForm").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 1,
            },
            last_name: {
                required: true,
                minlength: 2,
            },
            password: {
                required: true,
                minlength: 5,
            },
            confirm_password: {
                equalTo: "#password",
                required: true,
                minlength: 5,
            },
            email: {
                required: true,
                email: true,
            },
        },
        messages: {
            first_name: {
                required: "Please enter your first name",
                minlength: "Your username must consist of at least 1 characters",
            },
            last_name: {
                required: "Please enter your last name",
                minlength: "Your username must consist of at least 2 characters",
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
            },
            confirm_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above",
            },
            email: "Please enter a valid email address",
        }
    });
    
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: "Please enter your e-mail address",
            password: {
                required: "Please enter your password",
            },
        }
    });
    
});
