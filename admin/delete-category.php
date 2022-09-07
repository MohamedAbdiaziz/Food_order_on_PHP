<?php 
	include '../config/configration.php';

	if (isset($_GET['id']) & isset($_GET['image'])) {
		// code...
		$id = $_GET['id'];
		$image = $_GET['image'];

		$sql = "delete from tbl_category where id = $id";
		$res = mysqli_query($conn, $sql);
		if ($res == true) {
			unlink("../images/category/".$image);
			$_SESSION['delete-category'] = "<div class='success'>success</div>";
			header("location:".SITEURL."admin/manage_category.php");
		}
		else{
			$_SESSION['queryfailed'] = "<div class='error'>this query isn't avialable to delete this moment.</div>";
			header("location:".SITEURL."admin/manage_category.php");
		}
	}
	else{
		$_SESSION['noget'] = "<div class='error'>sorry, Click the category's delete button that you want to delete</div>";
		header("location:".SITEURL."admin/manage_category.php");
	}
	







?>