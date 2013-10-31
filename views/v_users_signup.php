<link rel="stylesheet" type="text/css" href="/css/blubber_form.css">

<h1>Sign Up</h1>

<form class='blubberForm' id='signupForm' method='POST' action='/users/p_signup' autocomplete='off'>
    <fieldset>
        <label for="first_name">First Name</label>
        <input id='first_name' type='text' name='first_name'>

        <label for="last_name">Last Name</label>
        <input id='last_name' type='text' name='last_name'>

        <label for="email">Email</label>
        <input id='email' type='text' name='email' value=''>

        <label for="password">Password</label>
        <input id='password' type='password' name='password' value=''>

        <label for="confirm_password">Confirm Password</label>
        <input id='confirm_password' type='password' name='confirm_password' value=''>
        <br><br>
    
        <input type='submit' value='Sign Up'>
    </fieldset>
</form>