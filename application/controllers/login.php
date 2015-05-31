<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */  
    function index()
    {
        
        if($this->session->userdata('is_logged_in'))
        {
            redirect('student');
        }else{
            $this->load->view('login/header');
            $this->load->view('login/content'); 
        }
    }

    /**
    * encript the password 
    * @return mixed
    */  
    function __encrip_password($password) {
        return md5($password);
        
    }   

    /**
    * check the username and the password with the database
    * @return void
    */
    
    function validate()
    {   
        $this->load->model('login/login_model');
        $username = $this->input->post('username');
        $password = $this->__encrip_password($this->input->post('password'));
        $is_valid = $this->login_model->validate($username, $password);
        
        if($is_valid)/*If valid username and password set */
        {
            $get_id = $this->login_model->get_id($username, $password);
					
            foreach($get_id as $val)
                { 
                     $mobileno = $val->mobileno;
                     $fname = $val->firstname;
                     $lname = $val->lastname;
                     $state = $val->state;
                     $email=$val->email;
                     $city = $val->city;
                     $username=$val->username;
                     $adminid=$val->admin_id;
                    
            }
           $data = array(
                'mobileno'=>$mobileno,
                'firstname'=>$fname,
                'lastname'=>$lname,
                'email'=>$email,
                'state'=>$state,
                'city'=>$city,
                'admin_id' => $adminid,
                'username' => $username,
                'is_logged_in' => true
            );
		//	print_r($data);
            $this->session->set_userdata($data); /*Here you can set the values in session */
            redirect('student');
        }
        else // incorrect username or password
        {
            $this->session->set_flashdata('msg', 'Username or Password Incorrect');
            redirect('login');
        }
   
    }

    /**
        * Destroy the session, and logout the user.
        * @return void
    */      
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
    
}    
  