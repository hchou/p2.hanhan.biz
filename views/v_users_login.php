<link rel="stylesheet" type="text/css" href="/css/blubber_form.css">

<h1>Member Login</h1>

<form class='blubberForm' id='loginForm' method='POST' action='/users/p_login'>
    <fieldset>
    <label for='email'>Email</label>
    <input id='email' type='text' name='email' value=''>

    <label for="password">Password</label>
    <input id='password' type='password' name='password' value=''>

    <?php if(isset($error)): ?>
        <div class='error'>
            <?php echo $error ?>.
        </div>
    <?php endif; ?>
    <br><br>
    <input type='submit' value='Log in'>
    </fieldset>
</form>
