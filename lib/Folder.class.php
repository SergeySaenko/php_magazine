<?php

class Folder
{
  public static function Delete($dir) { 
    $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? Delete("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
  }
}
?>