<?php

$c = exec("ls uploads/totalfiles");
if($c == ""){
    echo("bos");
}else if(is_dir("uploads/totalfiles/".$c)){
    echo("dizin var");    
}else{
    echo("ok");
}

?>