<!DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
</head>
<body>    
    <?php
        echo "<h3>". str_replace('\\', ' > ', str_replace('c:\xampp\htdocs', 'web_root', $this->session->userdata('current_path'))) . "</h3>";
       // print_r($selected_dir);

        //TODO: if the item is a folder then load another folder, if it's a file, allow the user to select it but display options for the file
        if ($this->session->userdata('path_is_root')==FALSE) {
        ?><a href="<?php echo base_url(); ?>">.\ web_root</a><br><a href="<?php echo base_url(); ?>ctrl/up">.. up one level</a><br><br><?php
        } 
        $dir_x = -1;
        foreach ($selected_dir as $dir_node) {
            if(1==1) { // TODO: add detection of folder here, we may don't like to display files.
            $dir_x++;
            ?><a href="<?php echo base_url() . "ctrl/enter/" . $dir_x; ?>"><?php echo $dir_node; ?></a><br><?php   
            }
        }        
    ?>
    
    <hr>
    <a href="<?php echo base_url(); ?>ctrl/compress">Compress</a>
</body>
</html>