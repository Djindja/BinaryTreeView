<?php
 
abstract class abstractTreeView {
	protected $conn; 
		 
	public function __construct()
	{
		$servername = "mysql";
		$username = "root";
		$password = "root";
		$dbname = "test";
		
		$this->conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

	}

	abstract public function showCompleteTree($data, $currentParent); 
	abstract public function showAjaxTree(string $lang);
	abstract public function fetchAjaxTreeNode($entry_id);
}