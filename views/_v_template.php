<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Blubber Website Icon -->
	<link rel="shortcut icon" href="/images/blubber.ico">
	
	<!-- Blubber CSS File -->
	<link rel="stylesheet" type="text/css" href="/css/blubber.css">
		
	<!-- jquery -->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
	<!-- jquery.validate -->
	<script type="text/javascript" src="/js/jquery.validate.min.js"></script>

	<!-- jquery.validate.params -->
	<script type="text/javascript" src="/js/jquery.validate.params.js"></script>
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>  

    <div id='menu_left'>

    <img src="/images/blubber.png" alt="Pulpit rock" width="40" height="20">
    
        <a href='/'>Home</a>

        <!-- Menu for users who are logged in -->
        <?php if ($user): ?>
            <a href='/users/profile'>My Profile</a>
	    <a href='/posts'>Read</a>
	    <a href='/posts/add'>Add</a>
	    <a href='/posts/users'>Users</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>
            <a href='/users/signup'>Sign up</a>
            <a href='/users/login'>Log in</a>
        <?php endif; ?>

    </div>

    <div id='menu_right'>

        <?php if ($user): ?>
	    Hello, <a href='/users/profile'><span id='username'><?php echo "$user->first_name $user->last_name" ?></span></a>!
	    <a href='/users/logout'>Logout</a>
	<?php endif; ?>

    </div>

    <br>

    <?php if(isset($content)) echo $content; ?>

</body>

</html>
