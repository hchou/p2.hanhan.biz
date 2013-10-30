//First Name<br>
//<input type='text' name='first_name'>
//<br><br>
//
//Last Name<br>
//<input type='text' name='last_name'>
//<br><br>
//
//Email<br>
//<input type='text' name='email' value=''>
//<br><br>
//
//Password<br>
//<input type='password' name='password' value=''>

$.validator.setDefaults({
    submitHandler: function() {
        alert("submitted!");
    }
});

$().ready(function() {

    // validate signup form on keyup and submit
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
            //topic: {
            //	required: "#newsletter:checked",
            //	minlength: 2
            //},
            //agree: "required"
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
            //agree: "Please accept our policy"
        }
    });

    // propose username by combining first- and lastname
    $("#username").focus(function() {
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        if (firstname && lastname && !this.value) {
            this.value = firstname + "." + lastname;
        }
    });

    //code to hide topic selection, disable for demo
    var newsletter = $("#newsletter");
    // newsletter topics are optional, hide at first
    var inital = newsletter.is(":checked");
    var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
    var topicInputs = topics.find("input").attr("disabled", !inital);
    // show when newsletter is checked
    newsletter.click(function() {
        topics[this.checked ? "removeClass" : "addClass"]("gray");
        topicInputs.attr("disabled", !this.checked);
    });
});
