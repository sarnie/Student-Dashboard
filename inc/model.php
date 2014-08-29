<?php

class DBConnection extends PDO {

	
	private $user = 'as563';
	private $password = 'newpassword';

	public function __construct (){

		parent::__construct('mysql:host=mysql.cms.gre.ac.uk;dbname=mdb_as563',$this->user,$this->password);
		//parent::__construct('mysql:host=localhost;dbname=flush',$this->user,$this->password);

		$this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// always disable emulated prepared statement when using the MySQL driver

        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			

	}

}



?>



