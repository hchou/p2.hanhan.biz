<?php
class debug_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        echo "hello_controller construct called<br><br>";
    }
    
    public function whoami() {
        echo '<pre>';
        print_r($this->user);
        echo '</pre>';
    }
    
    public function mycookie() {
        echo '<pre>';
        print_r($_COOKIE);
        echo '</pre>';
    }

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
        echo "This is the signup page";
    }

    public function login() {
        echo "This is the login page";
    }

    public function logout() {
        echo "This is the logout page";
    }
    
    public function recover() {
        echo "This is the recover password page";
    }
    
    public function insert() {
        # Our SQL command
        $q = "INSERT INTO users SET 
        first_name = 'Sam', 
        last_name = 'Seaborn',
        email = 'seaborn@whitehouse.gov'";

        # Run the command
        echo DB::instance(DB_NAME)->query($q);
    }
    
    public function update() {
        # Our SQL command
        $q = "UPDATE users
        SET email = 'samseaborn@whitehouse.gov'
        WHERE email = 'seaborn@whitehouse.gov'";
        # Run the command
        echo DB::instance(DB_NAME)->query($q);
    }
    
    public function delete() {
        # Our SQL command
        $q = "DELETE FROM users
        WHERE email = 'samseaborn@whitehouse.gov'";

        # Run the command
        echo DB::instance(DB_NAME)->query($q);
    }
    
    
    public function profile($user_name = NULL) {

        if($user_name == NULL) {
            echo "No user specified";
        }
        else {
            echo "This is the profile for ".$user_name;
        }
    }

} # end of the class