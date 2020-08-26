<?php if(!empty($_POST)){
	echo "<pre>";print_r($_POST);
	
}?>

<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name="files" required>
<input type="submit" value="Import">	
</form>