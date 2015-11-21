<?php
	
	$conn = mysqli_connect($_POST["host"], $_POST["user"], $_POST["pass"]);
	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	} 

	$sql = "CREATE DATABASE G23"; 
	//"CREATE TABLE MyGuests (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL,lastname VARCHAR(30) NOT NULL,email VARCHAR(50),reg_date TIMESTAMP);";
	if (mysqli_query($conn, $sql)) {
    	echo "Database created successfully";
	} else {
    	echo "Error creating database: " . mysqli_error($conn);
	}

	$conn = mysqli_connect($_POST["host"], $_POST["user"], $_POST["pass"], 'G23');
	

	$sql= "SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;";
	if (mysqli_query($conn, $sql)) {
    	echo "<br>first SET created successfully.  <br>";
	} else {
    	echo "<br>Error creating first SET: " . mysqli_error($conn);
	}

	$sql= "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;";
	if (mysqli_query($conn, $sql)) {
    	echo "second SET created successfully.  <br>";
	} else {
    	echo "<br>Error creating second SET: " . mysqli_error($conn);
	}

	$sql= "SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES'";
	if (mysqli_query($conn, $sql)) {
    	echo "third SET created successfully.  <br>";
	} else {
    	echo "<br>Error creating third SET: " . mysqli_error($conn);
	}
	//TABLES
	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`administrador` (
  			`idemail` VARCHAR(40) NOT NULL,
  			`nombre` VARCHAR(45) NULL DEFAULT NULL,
  			`contrasena` VARCHAR(32) NULL DEFAULT NULL,
  			`rutaavatar` TEXT NULL DEFAULT NULL,
  			PRIMARY KEY (`idemail`))
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table administrador created successfully.  <br>";
	} else {
    	echo "<br>Error creating table administrador: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`juradoprofesional` (
  			`curriculum` TEXT NOT NULL,
  			`idemail` VARCHAR(40) NOT NULL,
  			`nombre` VARCHAR(45) NULL DEFAULT NULL,
  			`contrasena` VARCHAR(32) NULL DEFAULT NULL,
  			`rutaavatar` TEXT NULL DEFAULT NULL,
  			`baneado` TINYINT(1) NOT NULL DEFAULT '0',
  			PRIMARY KEY (`idemail`))
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table juradoprofesional created successfully.  <br>";
	} else {
    	echo "<br>Error creating table juradoprofesional: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`establecimiento` (
  			`idemail` VARCHAR(40) NOT NULL,
  			`nombre` VARCHAR(45) NULL DEFAULT NULL,
  			`contrasena` VARCHAR(32) NULL DEFAULT NULL,
  			`rutaavatar` TEXT NULL DEFAULT NULL,
  			`direccion` VARCHAR(45) NULL DEFAULT NULL,
  			`web` VARCHAR(45) NULL DEFAULT NULL,
  			`horario` VARCHAR(45) NULL DEFAULT NULL,
  			`rutaimagen` VARCHAR(40) NULL DEFAULT NULL,
  			`geoloc` VARCHAR(45) NULL DEFAULT NULL,
  			`baneado` TINYINT(1) NOT NULL DEFAULT '0',
  			PRIMARY KEY (`idemail`))
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table establecimiento created successfully.  <br>";
	} else {
    	echo "<br>Error creating table establecimiento: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`pincho` (
			`idnombre` VARCHAR(40) NOT NULL,
	  		`descripcion` TEXT NULL DEFAULT NULL,
	  		`precio` DOUBLE NULL DEFAULT NULL,
	  		`ingredientes` TEXT NULL DEFAULT NULL,
  			`ganadorPopular` TINYINT(1) NULL DEFAULT NULL,
  			`estadoPropuesta` INT(1) NULL DEFAULT NULL,
  			`establecimiento_idemail` VARCHAR(40) NOT NULL,
  			`rutaimagen` TEXT NULL DEFAULT NULL,
  			PRIMARY KEY (`idnombre`),
 			UNIQUE INDEX `establecimiento_idemail_UNIQUE` (`establecimiento_idemail` ASC),
  			INDEX `fk_pincho_establecimiento1_idx` (`establecimiento_idemail` ASC),
  			CONSTRAINT `fk_pincho_establecimiento1`
    		FOREIGN KEY (`establecimiento_idemail`)
    		REFERENCES `G23`.`establecimiento` (`idemail`)
   	 		ON DELETE NO ACTION
    		ON UPDATE NO ACTION)
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table pincho created successfully.  <br>";
	} else {
    	echo "<br>Error creating table pincho: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`asignado` (
  			`juradoprofesional_idemail` VARCHAR(40) NOT NULL,
  			`pincho_idnombre` VARCHAR(40) NOT NULL,
  			PRIMARY KEY (`juradoprofesional_idemail`, `pincho_idnombre`),
  			INDEX `fk_juradoprofesional_has_Pincho1_Pincho1_idx` (`pincho_idnombre` ASC),
  			INDEX `fk_juradoprofesional_has_Pincho1_juradoprofesional1_idx` (`juradoprofesional_idemail` ASC),
 	 		CONSTRAINT `fk_juradoprofesional_has_Pincho1_juradoprofesional1`
    		FOREIGN KEY (`juradoprofesional_idemail`)
    		REFERENCES `G23`.`juradoprofesional` (`idemail`)
    		ON DELETE NO ACTION
    		ON UPDATE NO ACTION,
  			CONSTRAINT `fk_juradoprofesional_has_Pincho1_Pincho1`
    		FOREIGN KEY (`pincho_idnombre`)
    		REFERENCES `G23`.`pincho` (`idnombre`)
    		ON DELETE NO ACTION
   	 		ON UPDATE NO ACTION)
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table asignado created successfully.  <br>";
	} else {
    	echo "<br>Error creating table asignado: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`codigo` (
  			`pincho_idnombre` VARCHAR(40) NOT NULL,
  			`idcodigo` VARCHAR(45) NOT NULL,
  			PRIMARY KEY (`idcodigo`),
  			INDEX `fk_Codigo_Pincho1_idx` (`pincho_idnombre` ASC),
  			CONSTRAINT `fk_Codigo_Pincho1`
    		FOREIGN KEY (`pincho_idnombre`)
    		REFERENCES `G23`.`pincho` (`idnombre`)
    		ON DELETE NO ACTION
    		ON UPDATE NO ACTION)
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table codigo created successfully.  <br>";
	} else {
    	echo "<br>Error creating table codigo: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`juradopopular` (
  			`idemail` VARCHAR(40) NOT NULL,
  			`nombre` VARCHAR(45) NULL DEFAULT NULL,
  			`contrasena` VARCHAR(32) NULL DEFAULT NULL,
  			`rutaavatar` TEXT NULL DEFAULT NULL,
  			`baneado` TINYINT(1) NOT NULL DEFAULT '0',
  			PRIMARY KEY (`idemail`))
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table juradopopular created successfully.  <br>";
	} else {
    	echo "<br>Error creating table juradopopular: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`canjea` (
  			`codigo_idcodigo` VARCHAR(45) NOT NULL,
  			`juradopopular_idemail` VARCHAR(40) NOT NULL,
  			`fecha` DATE NULL DEFAULT NULL,
  			PRIMARY KEY (`codigo_idcodigo`, `juradopopular_idemail`),
  			INDEX `fk_codigo_has_juradopopular_juradopopular1_idx` (`juradopopular_idemail` ASC),
  			INDEX `fk_codigo_has_juradopopular_codigo1_idx` (`codigo_idcodigo` ASC),
  			CONSTRAINT `fk_codigo_has_juradopopular_codigo1`
    		FOREIGN KEY (`codigo_idcodigo`)
    		REFERENCES `G23`.`codigo` (`idcodigo`)
    		ON DELETE NO ACTION
   			ON UPDATE NO ACTION,
  			CONSTRAINT `fk_codigo_has_juradopopular_juradopopular1`
    		FOREIGN KEY (`juradopopular_idemail`)
    		REFERENCES `G23`.`juradopopular` (`idemail`)
   			ON DELETE NO ACTION
   			ON UPDATE NO ACTION)
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table canjea created successfully.  <br>";
	} else {
    	echo "<br>Error creating table canjea: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`comentario` (
  			`idcomentario` INT(11) NOT NULL AUTO_INCREMENT,
  			`juradopopular_idemail` VARCHAR(40) NOT NULL,
  			`pincho_idnombre` VARCHAR(40) NOT NULL,
  			`contenido` TEXT NULL DEFAULT NULL,
  			`fecha` DATETIME NULL DEFAULT NULL,
  			PRIMARY KEY (`idcomentario`),
  			INDEX `fk_comentario_juradopopular1_idx` (`juradopopular_idemail` ASC),
  			INDEX `fk_comentario_pincho1_idx` (`pincho_idnombre` ASC),
  			CONSTRAINT `fk_comentario_juradopopular1`
  			  FOREIGN KEY (`juradopopular_idemail`)
  			  REFERENCES `G23`.`juradopopular` (`idemail`)
  			  ON DELETE NO ACTION
  			  ON UPDATE NO ACTION,
  			CONSTRAINT `fk_comentario_pincho1`
  			  FOREIGN KEY (`pincho_idnombre`)
  			  REFERENCES `G23`.`pincho` (`idnombre`)
  			  ON DELETE NO ACTION
  			  ON UPDATE NO ACTION)
			ENGINE = InnoDB
			AUTO_INCREMENT = 60
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table comentario created successfully.  <br>";
	} else {
    	echo "<br>Error creating table comentario: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`concurso` (
  			`idconcurso` INT(2) NOT NULL,
  			`descripcion` TEXT NULL DEFAULT NULL,
  			`fecha` DATE NULL DEFAULT NULL,
  			`rutaportada` TEXT NULL DEFAULT NULL,
  			`titulo` TEXT NULL DEFAULT NULL,
  			PRIMARY KEY (`idconcurso`))
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table concurso created successfully.  <br>";
	} else {
    	echo "<br>Error creating table concurso: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`finalista` (
  			`juradoprofesional_idemail` VARCHAR(40) NOT NULL,
  			`pincho_idnombre` VARCHAR(40) NOT NULL,
  			`ganadorFinalista` TINYINT(1) NULL DEFAULT NULL,
  			`voto` INT(11) NULL DEFAULT NULL,
  			PRIMARY KEY (`juradoprofesional_idemail`, `pincho_idnombre`),
  			INDEX `fk_juradoprofesional_has_pincho_pincho1_idx` (`pincho_idnombre` ASC),
  			INDEX `fk_juradoprofesional_has_pincho_juradoprofesional1_idx` (`juradoprofesional_idemail` ASC),
  			CONSTRAINT `fk_juradoprofesional_has_pincho_juradoprofesional2`
    			FOREIGN KEY (`juradoprofesional_idemail`)
    			REFERENCES `G23`.`juradoprofesional` (`idemail`)
    			ON DELETE NO ACTION
    			ON UPDATE NO ACTION,
  			CONSTRAINT `fk_juradoprofesional_has_pincho_pincho2`
    			FOREIGN KEY (`pincho_idnombre`)
    			REFERENCES `G23`.`pincho` (`idnombre`)
    			ON DELETE NO ACTION
    			ON UPDATE NO ACTION)
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table finalista created successfully.  <br>";
	} else {
    	echo "<br>Error creating table finalista: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`probado` (
  			`pincho_idnombre` VARCHAR(40) NOT NULL,
  			`juradopopular_idemail` VARCHAR(40) NOT NULL,
  			PRIMARY KEY (`pincho_idnombre`, `juradopopular_idemail`),
  			INDEX `fk_pincho_has_juradopopular_juradopopular2_idx` (`juradopopular_idemail` ASC),
  			INDEX `fk_pincho_has_juradopopular_pincho2_idx` (`pincho_idnombre` ASC),
  			CONSTRAINT `fk_pincho_has_juradopopular_pincho2`
    			FOREIGN KEY (`pincho_idnombre`)
    			REFERENCES `G23`.`pincho` (`idnombre`)
    			ON DELETE NO ACTION
    			ON UPDATE NO ACTION,
  			CONSTRAINT `fk_pincho_has_juradopopular_juradopopular2`
    			FOREIGN KEY (`juradopopular_idemail`)
    			REFERENCES `G23`.`juradopopular` (`idemail`)
    			ON DELETE NO ACTION
    			ON UPDATE NO ACTION)
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table probado created successfully.  <br>";
	} else {
    	echo "<br>Error creating table probado: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`promociona` (
  			`juradoprofesional_idemail` VARCHAR(40) NOT NULL,
  			`pincho_idnombre` VARCHAR(40) NOT NULL,
  			`voto` INT(11) NULL DEFAULT NULL,
  			PRIMARY KEY (`juradoprofesional_idemail`, `pincho_idnombre`),
  			INDEX `fk_juradoprofesional_has_Pincho_Pincho1_idx` (`pincho_idnombre` ASC),
  			INDEX `fk_juradoprofesional_has_Pincho_juradoprofesional1_idx` (`juradoprofesional_idemail` ASC),
  			CONSTRAINT `fk_juradoprofesional_has_Pincho_juradoprofesional1`
  			  FOREIGN KEY (`juradoprofesional_idemail`)
  			  REFERENCES `G23`.`juradoprofesional` (`idemail`)
  			  ON DELETE NO ACTION
  			  ON UPDATE NO ACTION,
  			CONSTRAINT `fk_juradoprofesional_has_Pincho_Pincho1`
  			  FOREIGN KEY (`pincho_idnombre`)
  			  REFERENCES `G23`.`pincho` (`idnombre`)
  			  ON DELETE NO ACTION
  			  ON UPDATE NO ACTION)
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table promociona created successfully.  <br>";
	} else {
    	echo "<br>Error creating table promociona: " . mysqli_error($conn);
	}

	$sql= "CREATE TABLE IF NOT EXISTS `G23`.`vota` (
			  `id` INT(11) NOT NULL AUTO_INCREMENT,
			  `pincho_idnombre` VARCHAR(40) NOT NULL,
			  `juradopopular_idemail` VARCHAR(40) NOT NULL,
			  PRIMARY KEY (`id`, `pincho_idnombre`, `juradopopular_idemail`),
			  INDEX `fk_pincho_has_juradopopular_juradopopular1_idx` (`juradopopular_idemail` ASC),
			  INDEX `fk_pincho_has_juradopopular_pincho1_idx` (`pincho_idnombre` ASC),
			  CONSTRAINT `fk_pincho_has_juradopopular_juradopopular1`
			    FOREIGN KEY (`juradopopular_idemail`)
			    REFERENCES `G23`.`juradopopular` (`idemail`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_pincho_has_juradopopular_pincho1`
			    FOREIGN KEY (`pincho_idnombre`)
			    REFERENCES `G23`.`pincho` (`idnombre`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB
			AUTO_INCREMENT = 6
			DEFAULT CHARACTER SET = utf8;";
	if (mysqli_query($conn, $sql)) {
    	echo "table vota created successfully.  <br>";
	} else {
    	echo "<br>Error creating table vota: " . mysqli_error($conn);
	}

	$sql= "SET SQL_MODE=@OLD_SQL_MODE;";
	if (mysqli_query($conn, $sql)) {
    	echo "fourth SET created successfully.  <br>";
	} else {
    	echo "<br>Error creating fourth SET: " . mysqli_error($conn);
	}

	$sql= "SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;";
	if (mysqli_query($conn, $sql)) {
    	echo "fifth SET created successfully.  <br>";
	} else {
    	echo "<br>Error creating fifth SET: " . mysqli_error($conn);
	}

	$sql= "SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;";
	if (mysqli_query($conn, $sql)) {
    	echo "sixth SET created successfully.  <br>";
	} else {
    	echo "<br>Error creating sixth SET: " . mysqli_error($conn);
	}

	mysqli_close($conn);





	/*

mysqli_close($conn);
header('Location: ../view/list.php');*/

?>