<?php
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>console.log('loaded');</script>
</head>
<body>
	<form action="<?php gen_hash(); ?>" method="post" enctype="multipart/form-data">
		Pass to hash: <input type="text" name="new">
		<button type="submit">Gen</button>
	</form>
</body>
</html>