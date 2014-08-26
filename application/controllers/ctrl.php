<?php 

class Ctrl extends CI_Controller {
    
    function Ctrl() {
        parent::__construct();
        $this->load->helper("directory");
        $this->load->helper("url");
        $this->load->library("session");
        $this->root_folder = 'c:' . DIRECTORY_SEPARATOR . 'xampp' . DIRECTORY_SEPARATOR . 'htdocs';
        $this->foldersTreatedAs = 2; // 1 for no; 2 for yes; this allows us to detect whether an item is a file or a folder with sub-items
        
    }

    private function dir_map_sort($array)
    {
        $dirs = array();
        $files = array();

        foreach ($array as $key => $val)
        {
            if (is_array($val))
            {
                $dirs[$key] = (!empty($array)) ? $this->dir_map_sort($val) : $val;
            }
            else
            {
                $files[$key] = $val;
            }
        }

        ksort($dirs);
        asort($files);

        return array_merge($dirs, $files); 
    }
    
    function Index() {
        $this->session->set_userdata('current_path', $this->root_folder);
        $data['selected_dir'] = directory_map($this->session->userdata('current_path'), $this->foldersTreatedAs); 
        $this->session->set_userdata('path_is_root', TRUE);
        $this->load->view('home', $data);   
    }
    
    function enter($msg) {
        $dir_array = directory_map($this->session->userdata('current_path'), 1);
        $this->session->set_userdata('current_path', $this->session->userdata('current_path') . DIRECTORY_SEPARATOR . $dir_array[$msg]);
        $data['selected_dir'] = directory_map($this->session->userdata('current_path'), $this->foldersTreatedAs); 
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
        
        $data['selected_dir'] = directory_map($this->session->userdata('current_path'), $this->foldersTreatedAs); 
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