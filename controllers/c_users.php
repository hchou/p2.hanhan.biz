<?php

class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function signup() {

        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";

        # Render template
            echo $this->template;

    }
    
    public function p_signup() {

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
        
        $emailQuery = "SELECT COUNT(email)
                       FROM users
                       WHERE email = '".$_POST['email']."'";
                       
        $emailFound = DB::instance(DB_NAME)->select_field($emailQuery);
    
        # Verify that user does not already exist, if exists assume user already signed up
        # redirect to login screen
        if ($emailFound > 0) {
            $error = "User already exists, please login";
            Router::redirect("/users/login/$error");
        }
    
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();
        unset($_POST['confirm_password']);
        # Encrypt the password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        
        # Create an encrypted token via their email address and a random string
        $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
        
        # Dump out the results of POST to see what the form submitted
        #echo '<pre>';
        #print_r($_POST);
        #echo '</pre>';
        
        $user_id = DB::instance(DB_NAME)->insert('users', $_POST);
        $error = "You're signed up. Please login";
        Router::redirect("/users/login/$error");
    }
    
    # Default $error to be NULL so no warnings if $error is blank (no errors)
    public function login($error = NULL) {

        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        # Pass (error) data to the view
        $this->template->content->error = $error;        
        
        # Render template/view
        echo $this->template;

    }
    
    public function p_login() {

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the DB for matching email
        $emailQuery = "SELECT user_id
                       FROM users
                       WHERE email = '".$_POST['email']."'";
                       
        $matched_user_id = DB::instance(DB_NAME)->select_field($emailQuery);
        
        if (!$matched_user_id) {
            $error = 'Login Failed: Invalid Email';
            Router::redirect("/users/login/$error");
        }
        
        # Search the DB for this email and password
        # Retrieve the token if it's available
        $q = "SELECT token 
              FROM users 
              WHERE email = '".$_POST['email']."' 
              AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        # If we didn't find a matching token in the database, it means login failed
        if (!$token) {
            # Send them back to the login page
            #Router::redirect("/users/login/");
            # But if we did, login succeeded!
            # Note the addition of the PARAMETER "error"
            $error = 'Login Failed: Invalid Password';
            Router::redirect("/users/login/$error");             
        }
        else {
            /* 
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
            setcookie("token", $token, strtotime('+1 year'), '/');

            # User successfully authenticated, update last_login time.
            $last_login = Time::now();
            $data = Array("last_login" => $last_login);
                        
            # Do the Database update
            DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '" . $matched_user_id ."'");
            
            # Send them to the main page - or whever you want them to go
            Router::redirect("/");
        }
    }

    public function logout() {

        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the Database update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/");

    }
    
    public function profile() {

        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) {
            Router::redirect('/users/login');
        }

        # If they weren't redirected away, continue:

        # Setup view
        $this->template->content = View::instance('v_users_profile');
        $this->template->title   = "Profile of " . $this->user->first_name;

        # Render template
        echo $this->template;
    }
    
    public function p_profile_update() {
        
        /* Compare parameters in $_POST to that of DB
         *     A. Proceed current password is correct
         *     B. Update only fields that have changed
         */
        # Dump out the results of POST to see what the form submitted
        
        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
        
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        
        #echo "user_id: " . $this->user->user_id  . "<br>";
        #echo "email:   " . $this->user->email  . "<br>";

        # If the user email was updated, make sure it doesn't already exist in DB
        if ($this->user->email != $_POST['email']) {
        
            # Search the DB for matching email
            $emailQuery = "SELECT user_id
                           FROM users
                           WHERE email = '" . $_POST['email'] . "'";
                           
            $matched_user_id = DB::instance(DB_NAME)->select_field($emailQuery);
            
            if ($matched_user_id) {
                $error = 'Error, email already exists';
                #echo "$error<br>";
                Router::redirect("/users/profile");
            }
            
        }
        
        # Search the DB for this email and password
        # Retrieve the token if it's available
        $q = "SELECT * 
              FROM users 
              WHERE email = '" . $this->user->email . "' 
              AND password = '" . $_POST['password'] . "'";

        $user_info = DB::instance(DB_NAME)->select_array($q, 'user_id');
        #$connect = DB::instance(DB_NAME)->select_array($q, 'user_info');

        # If $user_info doesn't exist: authentication failed
        if (!$user_info) {
            # Send user back to My Profile page, skip updates 
            $error = 'Incorrect Current Password';
            Router::redirect("/users/profile");
        }

        # Build update array
        # Has email changed?
        if ($_POST['email'] != $user_info[$this->user->user_id]['email']) {
            #echo "email changed! <br>";
            $data['email'] = $_POST['email'];
        }
        # Has first_name changed?
        if ($_POST['first_name'] != $user_info[$this->user->user_id]['first_name']) {
            #echo "first_name changed! <br>";
            $data['first_name'] = $_POST['first_name'];
        }
        # Has last_name changed?
        if ($_POST['last_name'] != $user_info[$this->user->user_id]['last_name']) {
            #echo "last_name changed! <br>";
            $data['last_name'] = $_POST['last_name'];
        }
        
        # If the $data array exists then update DB
        if ($data) {
            # Do the Database update
            DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '" . $this->user->user_id ."'");
        }
        
        Router::redirect("/users/profile");
    
    }
    
    public function delete($user_id_followed) {
    
        #echo $user_id_followed;
    
        # Delete this user
        $where_condition = 'WHERE user_id = '.$user_id_followed;
        DB::instance(DB_NAME)->delete('users', $where_condition);
    
        # Send them back
        Router::redirect("/posts/users");
    
    } 
    
    
} # eoc (End of Class)

?>