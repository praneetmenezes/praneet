<?php
class upload
{
public function upload($target)
{
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target.$_FILES['uploaded']['name'])) 
 {
 	return true;
 } 
}
}
?>
