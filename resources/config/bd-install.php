

<?php

$sqlFileToExecute = 'database.sql';
$hostname = $_POST["database-host"];
$db_user = $_POST["database-user"];
$db_password = $_POST["database-password"];

$link = mysql_connect($hostname, $db_user, $db_password);
if (!$link) {
	die ("MySQL Connection error");
}
$sqlErrorCode = "";

// read the sql file
$f = fopen($sqlFileToExecute,"r+");
$sqlFile = fread($f, filesize($sqlFileToExecute));
$sqlArray = explode(';',$sqlFile);
foreach ($sqlArray as $stmt) {
	if (strlen($stmt)>3 && substr(ltrim($stmt),0,2)!='/*') {
		$result = mysql_query($stmt);
		if (!$result) {
			$sqlErrorCode = mysql_errno();
			$sqlErrorText = mysql_error();
			$sqlStmt = $stmt;
			break;
		}
	}
}
if ($sqlErrorCode == 0) {
	echo "Script is executed succesfully!";

	mysql_select_db("G23");
	mysql_query("INSERT INTO administrador (idemail, nombre, contrasena, rutaavatar) VALUES ('".$_POST["admin-idemail"]."', 'Administrador', '".$_POST["admin-password"]."', 'images/avatars/default.jpg')");
	mysql_query("INSERT INTO concurso (descripcion, fecha, rutaportada, titulo, estado, facebook, twitter, googleplus) VALUES ('".$_POST["pw-desc"]."', '".date('Y-m-d')."', '".$_POST["pw-title-image"]."', '".$_POST["pw-name"]."', '0', '".$_POST["pw-facebook"]."', '".$_POST["pw-twitter"]."', '".$_POST["pw-google-plus"]."')");
	
	mysql_query("DROP USER 'g23_abp_user'@'%'");
	mysql_query("CREATE USER 'g23_abp_user'@'%' IDENTIFIED BY 'abc123.'");
	mysql_query("REVOKE ALL PRIVILEGES ON  G23.* FROM  'g23_abp_user'@'%'");
	mysql_query("GRANT ALL PRIVILEGES ON  G23.* TO  'g23_abp_user'@'%'");

	header("Location: ./add-sample-data.php");
} else {
	echo "An error occured during installation!<br/>";
	echo "Error code: $sqlErrorCode<br/>";
	echo "Error text: $sqlErrorText<br/>";
	echo "Statement:<br/> $sqlStmt<br/>";
}

?>