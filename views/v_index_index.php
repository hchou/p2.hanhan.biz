<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1>
<h3>+1 Features</h3>
<ul>
	
    <li><h4>User Profile Update</h4></li>
    <ul>
         <li>Verify 'current password' is correct before proceeding</li>
        <li>Verify 'new email' isn't already in DB</li>
        <li>Update only modified user information</li>
    </ul>
    
    <li><h4>User Delete</h4></li>
    <ul>
        <li>Admin/Superuser are allowed to delete other users</li>
        <li>User cannot her/himself</li>
    </ul>

    <li><h4>Delete Posts</h4></li>
    <ul>
        <li>Admin/Superuser are allowed to delete posts</li>   
    </ul>
    
</ul>
