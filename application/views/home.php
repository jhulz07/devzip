<!DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
</head>
<body>    
    <?php
        echo "<h3>". str_replace('\\', ' > ', str_replace('c:\xampp\htdocs', 'web_root', $this->session->userdata('current_path'))) . "</h3>";
        if ($this->session->userdata('path_is_root')==FALSE) {
        ?><a href="<?php echo base_url(); ?>">.\ web_root</a><br><a href="<?php echo base_url(); ?>ctrl/up">.. up one level</a><br><br><?php
        } 
        $dir_x=-1;
        foreach ($selected_dir as $dir => $dir_node) {
            $dir_x++;
            if(gettype($dir_node)=='array') {
            ?><a href="<?php echo base_url() . "ctrl/enter/" . $dir_x; ?>"><?php echo $dir; ?></a><br><?php   
            } else {
                ?><a href="<?php echo base_url() . "ctrl/enter/" . $dir_x; ?>"><?php echo $dir_node; ?></a><br><?php   
            }
        }        
    ?>
    <hr>
    <a href="<?php echo base_url(); ?>ctrl/compress">Compress</a>
</body>
</html>