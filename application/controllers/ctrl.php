<?php 

class Ctrl extends CI_Controller {
    
    function Ctrl() {
        parent::__construct();
        $this->load->helper("directory");
        $this->load->helper("url");
        $this->load->library("session");
        $this->root_folder = 'c:' . DIRECTORY_SEPARATOR . 'xampp' . DIRECTORY_SEPARATOR . 'htdocs';
        
    }
    
    function Index() {
        $this->session->set_userdata('current_path', $this->root_folder);
        $data['selected_dir'] = directory_map($this->session->userdata('current_path'), 1); // 2 so that we can detect folders as arrays
        $this->session->set_userdata('path_is_root', TRUE);
        $this->load->view('home', $data);   
    }
    
    function enter($msg) {
        $dir_array = directory_map($this->session->userdata('current_path'), 1);
        $this->session->set_userdata('current_path', $this->session->userdata('current_path') . DIRECTORY_SEPARATOR . $dir_array[$msg]);
        $data['selected_dir'] = directory_map($this->session->userdata('current_path'), 1); // 2 so that we can detect folders as arrays
        $this->session->set_userdata('path_is_root', FALSE);
        $this->load->view('home', $data); 
    }
    
    
    function up() {
        if ($this->session->userdata('path_is_root')==TRUE) {
            $this->Index();
            return false;
        }
        $curr_path = $this->session->userdata('current_path');
        $last_character = "";
        while (!($last_character==DIRECTORY_SEPARATOR)) { 
            $last_character = $curr_path[strlen($curr_path)-1];
            $curr_path =  substr($curr_path, 0, -1);
        }
        
        $this->session->set_userdata('current_path', $curr_path);
        
        if ($this->session->userdata('current_path')==$this->root_folder) {
            $this->session->set_userdata('path_is_root', TRUE);
        }
        
        $data['selected_dir'] = directory_map($this->session->userdata('current_path'), 1); // 2 so that we can detect folders as arrays
        $this->load->view('home', $data); 
    }
    
    function compress() {
        $path = $this->session->userdata('current_path');
       // exec("zip.bat " . $path);
        echo $path;
    }
    
    function dess() {
     $this->session->sess_destroy();   
    }
    
}