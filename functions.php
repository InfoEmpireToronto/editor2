<?php

include_once('config.php');

/**
* 
*/
class DB 
{
	private $mysqli;
	
	function __construct($server, $db, $user, $pass)
	{
		$this->mysqli = new mysqli($server, $user, $pass, $db);

		if ($this->mysqli->connect_errno) 
		{
		    // The connection failed. What do you want to do? 
		    // You could contact yourself (email?), log the error, show a nice page, etc.
		    // You do not want to reveal sensitive information

		    // Let's try this:
		    echo "Sorry, this website is experiencing problems.";

		    // Something you should not do on a public site, but this example will show you
		    // anyways, is print out MySQL error related information -- you might log this
		    echo "Error: Failed to make a MySQL connection, here is why: \n";
		    echo "Errno: " . $this->mysqli->connect_errno . "\n";
		    echo "Error: " . $this->mysqli->connect_error . "\n";
		    
		    // You might want to show them something nice, but we will simply exit
		    exit;
		}

	}

	public function getRow($q)
	{
		$result = $this->query($q);

		return $result->fetch_assoc();
	}

	public function getAll($q)
	{
		$result = $this->query($q);
		$out = [];

		while ($row = $result->fetch_assoc()) 
		{
			$out[] = $row;
		}

		return $out;

	}

	public function query($q)
	{
		if (!$result = $this->mysqli->query($q)) 
		{
		    // Oh no! The query failed. 
		    echo "Sorry, the website is experiencing problems.";

		    // Again, do not do this on a public site, but we'll show you how
		    // to get the error information
		    echo "Error: Our query failed to execute and here is why: \n";
		    echo "Query: " . $q . "\n";
		    echo "Errno: " . $this->mysqli->errno . "\n";
		    echo "Error: " . $this->mysqli->error . "\n";
		    exit;
		}

		return $result;
	}
}

/**
* 
*/
class Article
{
	private $data;
	private $db;

	// public $article = { return $this->data; };

	function __construct($id = 0)
	{
		GLOBAL $config;
		$this->db = new DB($config['dbServer'], $config['db'], $config['dbUser'], $config['dbPass']);

		if($id > 0)
			$this->data = $this->db->getRow("SELECT * FROM articles WHERE id = $id");
	}

	function getAll()
	{
		return $this->db->getAll("SELECT * FROM articles");
	}

	function article()
	{
		return $this->data;
	}

	function update($d)
	{
		$a = '';
		foreach($d as $key => $val)
		{
			if($a !== '')
			{
				$a .= ', ';
			}
			$a .= " `$key` = '$val' ";
		}
		// $a = implode(', ', $d);
		$this->db->query("UPDATE articles SET $a WHERE `id` = {$this->data['id']}");
	}

	public function add($d)
	{
		$fields = '';
		$vals = '';
		foreach($d as $key => $val)
		{
			if($fields !== '')
			{
				$fields .= ', ';
				$vals .= ', ';
			}
			$fields .= " `$key`";
			$vals .= " '$val' ";
		}
		// $a = implode(', ', $d);
		$this->db->query("INSERT INTO articles ($fields) VALUES ($vals)");
	}

}

function dd($d)
{
	echo "<pre>";
	print_r($d);
	echo "</pre>";
	die();
}

?>
