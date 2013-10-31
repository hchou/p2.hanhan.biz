<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1>
<h3>+1 Features</h3>
<ul>
	
    <li><h4>User Profile Update</h4></li>
    <dd>Verify 'current password' is correct before proceeding</dd>
    <dd>Verify 'new email' isn't already in DB</dd>
    <dd>Update only modified user information</dd>
	
    <li><h4>User Delete</h4></li>
    <dd>Admin/Superuser are allowed to delete other users</dd>
    <dd>User cannot her/himself</dd>

    <li><h4>Delete Posts</h4></li>
    <dd>Admin/Superuser are allowed to delete posts</dd>   
    
</ul>
