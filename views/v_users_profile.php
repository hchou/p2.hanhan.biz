<link rel="stylesheet" type="text/css" href="/css/blubber_form.css">

<h1>My Profile</h1>

<form class='blubberForm' id='profileForm' method='POST' action='p_profile_update' autocomplete='off'>
    <fieldset>
        
        <label for="first_name">First Name</label>
        <input id='first_name' type='text' name='first_name' value='<?=$user->first_name ?>'>
        
        <label for="last_name">Last Name</label>
        <input id='last_name' type='text' name='last_name' value='<?=$user->last_name ?>'>
        
        <label for="email">Email</label>
        <input id='email' type='text' name='email' value='<?=$user->email ?>'>     
        
        <label for="new_password">New Password</label>
        <input id='new_password' type='password' name='new_password' value=''>

        <label for="confirm_password">Confirm Password</label>
        <input id='confirm_password' type='password' name='confirm_password' value=''>
            
        <label for="created">Member Since</label>
        <input id='created' name='created' value='<?=Time::display($user->created,'Y-m-d G:i')?>' disabled>
        
        <label for="last_login">Last Login</label>
        <input id='last_login' name='last_login' value='<?=Time::display($user->last_login,'Y-m-d G:i')?>' disabled>
        
        <br><br>

        <label for="password">Current Password</label>
        <input id='password' type='password' name='password' value=''>
        
        <br><br>

        <input type='submit' value='Update'>
        
    </fieldset>
</form>