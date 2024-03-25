<?php 
    require_once('sql_handler.php');
    if(isset($_POST['ifs_data'])&&isset()){
        $sql=new SQLHandler();
        if(isset($_POST['author'])&&){
            $sql->execute('INSERT INTO ifs_directory (ifs_data, author) VALUES ()')
        }
        
    }
?>