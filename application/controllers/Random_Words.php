<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Random_Words extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	        

		$this->load->view('random/index');
	}

    public function generateRandomString($length = 14) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

	public function process_form(){
		$attempt = $this->input->post("attempt");
        
        if($this->input->post("generate")){
            $session_data = array(
                "attempt" => $attempt = $attempt + 1,
                "random" => $this->generateRandomString()
            );
        }else if($this->input->post("restart")){
            $session_data = array(
                "attempt" => 0,
                "random" => ""
            );
        }

        $this->session->set_userdata($session_data);

        // $array_items = array('username', 'email');
        // $this->session->unset_userdata($array_items);
        redirect(base_url());
		
	}

    


}
