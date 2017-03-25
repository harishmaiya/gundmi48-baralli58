<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Linkedin_login extends CI_Controller {
 
 function __construct(){
 
  parent::__construct();
   $this->load->helper('url'); 
               
 }
 
 function index(){
            
           
            
            
            echo '<p>-------------------------------------------------------------------------</p>';
            echo '<p>1) Make sure OAuth.php and linkedin.php files are in application/libraries folder</p>';
            echo '<p>2) If you don\'t have the files. Download from http://code.google.com/p/simple-linkedinphp/downloads/list</p>';
            echo '<p>3) Rename linkedin_3.2.0.class.php to linkedin.php if you prefer</p>';
            echo '<p>-------------------------------------------------------------------------</p>';
            
            echo '<form id="linkedin_connect_form" action="linkedin_signup/initiate" method="post">';
            echo '<input type="submit" value="Login with LinkedIn" />';
            echo '</form>';
  
        }
        
        function initiate(){
            
                // setup before redirecting to Linkedin for authentication.
                 $linkedin_config = array(
                     'appKey'       => '75wpz389ifrzbq',
                     'appSecret'    => 'ZYEG6gBlFhhUAkfR,
                     'callbackUrl'  => '<your URL here>/linkedin_signup/data/'
                 );
                
                $this->load->library('linkedin', $linkedin_config);
                $this->linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);
                $token = $this->linkedin->retrieveTokenRequest();
                
                $this->session->set_flashdata('oauth_request_token_secret',$token['linkedin']['oauth_token_secret']);
                $this->session->set_flashdata('oauth_request_token',$token['linkedin']['oauth_token']);
                
                $link = "https://api.linkedin.com/uas/oauth/authorize?oauth_token=". $token['linkedin']['oauth_token'];  
                redirect($link);
 }
        
        function cancel() {
            
            // See https://developer.linkedin.com/documents/authentication
            // You need to set the 'OAuth Cancel Redirect URL' parameter to <your URL>/linkedin_signup/cancel

            echo 'Linkedin user cancelled login';            
        }
        
        function logout() {
                session_unset();
                $_SESSION = array();
                echo "Logout successful";
        }
        
 function data(){
  
                 $linkedin_config = array(
                     'appKey'       => '<your app key here >',
                     'appSecret'    => '<your app secret here >',
                     'callbackUrl'  => '<your URL here>/linkedin_signup/data/'
                 );
                
                $this->load->library('linkedin', $linkedin_config);
                $this->linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);
                 
                $oauth_token = $this->session->flashdata('oauth_request_token');
                $oauth_token_secret = $this->session->flashdata('oauth_request_token_secret');
  
                $oauth_verifier = $this->input->get('oauth_verifier');
                $response = $this->linkedin->retrieveTokenAccess($oauth_token, $oauth_token_secret, $oauth_verifier);
                
                // ok if we are good then proceed to retrieve the data from Linkedin
                if($response['success'] === TRUE) {
                    
                // From this part onward it is up to you on how you want to store/manipulate the data 
                $oauth_expires_in = $response['linkedin']['oauth_expires_in'];
                $oauth_authorization_expires_in = $response['linkedin']['oauth_authorization_expires_in'];
                
                $response = $this->linkedin->setTokenAccess($response['linkedin']);
                $profile = $this->linkedin->profile('~:(id,first-name,last-name,picture-url)');
                $profile_connections = $this->linkedin->profile('~/connections:(id,first-name,last-name,picture-url,industry)');
                $user = json_decode($profile['linkedin']);
                $user_array = array('linkedin_id' => $user->id , 'second_name' => $user->lastName , 'profile_picture' => $user->pictureUrl , 'first_name' => $user->firstName);
                
                // For example, print out user data
                echo 'User data:';
                print '<pre>';
                print_r($user_array);
                print '</pre>';

                echo '<br><br>';
                    
                // Example of company data
                $company = $this->linkedin->company('1337:(id,name,ticker,description,logo-url,locations:(address,is-headquarters))');
                echo 'Company data:';
                print '<pre>';
                print_r($company);
                print '</pre>';
                
                echo '<br><br>';
                
                echo 'Logout';
                echo '<form id="linkedin_connect_form" action="../logout" method="post">';
                echo '<input type="submit" value="Logout from LinkedIn" />';
                echo '</form>';
                
                } else {
                  // bad token request, display diagnostic information
                  echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br />" . print_r($response, TRUE);
                }         
        } 