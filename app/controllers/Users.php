<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    
    public function register() {
        //check for the POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
           
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //init data
             $data = [
              'name' => trim($_POST['name']),  
              'name_err' => '',  
              'email' => trim($_POST['email']),  
              'email_err' => '',  
              'password' => trim($_POST['password']),  
              'password_err' => '',  
              'confirm_password' => trim($_POST['confirm_password']),  
              'confirm_password_err' => ''  
            ];
            
            //validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                //check email
                $this->userModel->findUserbyEmail($data['email']) ? $data['email_err'] = 'Email is already taken' : '';
            }
            
            //validate name
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }
            
             //validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Please enter more than 6 characters for the password';
            }
            
            //validate confirm confirm_password
            if(empty($data['confirm_password'])) {
                
                $data['confirm_password_err'] = 'Please enter password';
            } else {
               if($data['password'] != $data['confirm_password']) {
                   
                   $data['confirm_password_err'] = 'The passwords downt match';
               }
            }
            
            //make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //validated
                
                //hash the password
                
                
            } else {
                //Load view with errors
                $this->view('users/register', $data);
            }
            
            
        } else {
            // Init data
            $data = [
              'name' => '',  
              'name_err' => '',  
              'email' => '',  
              'email_err' => '',  
              'password' => '',  
              'password_err' => '',  
              'confirm_password' => '',  
              'confirm_password_err' => ''  
            ];
            
            //Load view
            $this->view('users/register', $data);
        }
    } 
    
    public function login() {
        //check for the POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
             //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
             $data = [
              'email' => trim($_POST['email']),  
              'email_err' => '',  
              'password' => trim($_POST['password']),  
              'password_err' => '',  
            ];
             //validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } 
             //validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            
            //make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])) {
                //validated
                die('SUCCESS');
            } else {
                //Load view with errors
                $this->view('users/login', $data);
            }
            
            
        } else {
            // Init data
            $data = [
              'email' => '',  
              'email_err' => '',  
              'password' => '',  
              'password_err' => ''
            ];
            
            //Load view
            $this->view('users/login', $data);
        }
    } 
}