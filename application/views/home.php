<!DOCTYPE HTML>
<html>
<head>
   <link type="text/css" href="<?php echo base_url(); ?>/css/main.css" rel="stylesheet" media="screen" />
    <title>Home</title>
</head>
<body>
   
    <?php
        echo "<h3>". str_replace('\\', ' > ', str_replace('c:\xampp\htdocs', 'web_root', $this->session->userdata('current_path'))) . "</h3>";
    ?>
    <div class="itemsDisplay">
    <?php
        if ($this->session->userdata('path_is_root')==FALSE) {
        ?><a href="<?php echo base_url(); ?>">.\ web_root</a><br><a href="<?php echo base_url(); ?>ctrl/up">.. up one level</a><br><br><?php
        } 
        $dir_x=-1;
        foreach ($selected_dir as $dir => $dir_node) {
            $dir_x++;
            if(gettype($dir_node)=='array') {
            ?><div class="folder"><a href="<?php echo base_url() . "ctrl/enter/" . $dir_x; ?>"><?php echo $dir; ?></a></div><?php   
            } else {
                ?><div class="file"><a href="<?php echo base_url() . "ctrl/enter/" . $dir_x; ?>"><?php echo $dir_node; ?></a></div><?php   
            }
        }
    ?>
    </div>   
    <hr>
    <a href="<?php echo base_url(); ?>ctrl/compress">Compress</a>
</body>
</html>