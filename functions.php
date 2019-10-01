<?php

include_once('config.php');
include "src/SitemapGenerator.php";

session_start();
/**
* 
*/
class DB 
{
	private $mysqli;
	
	function __construct($server, $db, $user, $pass)
	{
		$this->mysqli = new mysqli($server, $user, $pass, $db);

		$this->mysqli->set_charset("utf8");

		if ($this->mysqli->connect_errno) 
		{
		   
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

	public function getValue($q)
	{
		$result = $this->query($q);

		return $result->fetch_array(MYSQLI_NUM)[0];
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
		    echo "<hr><p>Error: Our query failed to execute and here is why: \n</p>";
		    echo "Query: <code>" . $q . "</code>\n";
		    echo "<p>Err No: " . $this->mysqli->errno . "\n</p>";
		    echo "<p>Error: " . $this->mysqli->error . "\n</p><hr>";
		    // exit;

		}

		return $result;
	}

	public function mysqli()
	{
		return $this->mysqli;
	}
}

/**
* 
*/
class Article
{
	private $data;
	private $db;
	private $config;
	
	public $date_utc;
	public $title;
	public $content;

	// public $article = { return $this->data; };

	function __construct($id = 0)
	{
		GLOBAL $config;
		$this->config = $config;

		$this->db = new DB($config['dbServer'], $config['db'], $config['dbUser'], $config['dbPass']);

		if($id > 0)
		{
			$this->data = $this->db->getRow("SELECT * FROM articles WHERE id = $id");
			$this->data['body'] = stripslashes($this->data['body']);
			$this->data['title'] = stripslashes($this->data['title']);
			$this->data['metaTitle'] = stripslashes($this->data['metaTitle']);
			$this->data['metaDesc'] = stripslashes($this->data['metaDesc']);

			$this->title = $this->data['title'];
			$this->content = $this->data['body'];
			$this->meta_description = $this->data['metaDesc'];
			$this->date_utc = (new DateTime($this->data['created_date']))->getTimestamp();
		}

		if(!count($this->db->getAll("SHOW TABLES LIKE 'articles'")))
		{
			$this->boot();
		}
	}

	function __get($property)
	{
		return $this->data[$property];
	}
	function __set($property, $value)
	{
		$this->data[$property] = $value;
	}


	function getAll()
	{
		return $this->db->getAll("SELECT * FROM articles");
	}

	function article()
	{
		return $this->data;
	}

	function set($key, $val)
	{
		$this->data[$key] = $val;
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
			if($key == 'body' || $key == 'title')
				$val = mysqli_real_escape_string($this->db->mysqli(), $val);

			$a .= " `$key` = '$val' ";
		}
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
			if($key == 'body' || $key == 'title' || $key == 'metaTitle' || $key == 'metaDesc')
				$val = mysqli_real_escape_string($this->db->mysqli(), stripslashes($val));

			$fields .= " `$key`";
			$vals .= " '$val' ";
		}
		$this->db->query("INSERT INTO articles ($fields) VALUES ($vals)");

		return new Article($this->db->mysqli()->insert_id);
	}

	public function addCat($name)
	{
		$this->db->query("INSERT INTO categories (`name`) VALUES ('$name')");

	}

	public function updateCat($id, $name)
	{
		$this->db->query("UPDATE categories SET `name` = '$name' WHERE `id` = $id");

	}

	public function getAllCats()
	{
		return $this->db->getAll("SELECT * FROM categories");
	}

	public function categoryName($id)
	{
		return $this->db->getRow("SELECT * FROM categories WHERE id = $id")['name'];
	}

	public function sortByCat($data)
	{
		$out = [];
		foreach($data as $val)
		{
			$out[$val->category][] = $val;
		}

		return $out;
	}

	public function getRandom($num, $data)
	{
		foreach(array_rand($data, $num) as $k)
		{
			$out[] = $data[$k];
		}
		return $out;

	}


//Reader Functions
	public function getPosts($type, $range)
	{
	    $add = '';
		if($type != 'all')
			$add = " WHERE `type` = '$type' ";

			 // WHERE `id` >= {$range[0]} 
        $q = "
			SELECT * 
			  FROM articles 
			   	   $add
		  ORDER BY created_date DESC
			 LIMIT {$range[0]}, {$range[1]}
		";
		$p = $this->db->getAll($q);
		
		$out = [];
		foreach($p as $post)
		{
		    $t = new Article($post['id']);
		    $t->set('body', stripslashes($t->article()['body']));
		    $t->set('title', stripslashes($t->article()['title']));
		    if($t->data['pubDate'])
		    {
			    // $t->data['pubDate'] = date_create_from_format('Y-m-d', $t->data['pubDate']);
	            $t->set('pubDate', (new DateTime($t->data['pubDate']))->format('F d Y'));//date_format($t->data['pubDate'], 'F d Y');
		    }


			$out[] = $t;
			
		}
        
		return $out;
	}

	public function getPostCount($filter = 'article')
	{
		return $this->db->getValue("SELECT count(*) FROM articles WHERE `type` = '$filter' ");
	}

    function getURL($prefix = 'events-')
	{		
		return $prefix . urlencode(trim(str_replace('#', '', $this->data['title']))) . '-' . $this->data['id'];
	}
	
	function getImage(&$start = null, &$length = null)
	{
		$text = $this->data['body'];
		if(($imageStart = strpos($text, '<img')) !== false)
		{
			$start = $imageStart;
			$imageSourceStart = strpos($text, 'src=', $imageStart) + 5;
			$imageSourceLength = strcspn($text, "\"'", $imageSourceStart);
			$imageAltStart = strpos($text, 'alt=', $imageStart) + 5;
			if($imageAltStart)
			{
				$imageAltLength = strcspn($text, "\"'", $imageAltStart);
			}

			$imageEnd = strpos($text, '>', $imageStart) + 1;
			while(0 === strpos(substr($text, $imageEnd), '<br>'))
			{
				$imageEnd += 4;
			}

			$length = $imageEnd - $imageStart;
			return 
			[
				'src' => substr($text, $imageSourceStart, $imageSourceLength),
				'alt' => substr($text, $imageAltStart, $imageAltLength)
			];
		}
		else
		{
			return false;
		}
	}
	function extractImage()
	{
		$start = 0;
		$length = 0;
		$image = $this->getImage($start, $length);
		$this->data['body'] = $this->content = substr_replace($this->data['body'], '', $start, $length);
		return $image;
	}
	function getSummary($chars = 100)
	{
		$text = $this->data['body'];
		// Change to the number of characters you want to display   
		$orig = strip_tags($text);  
		$text = $orig . " ";
		$text = substr($text, 0, $chars);
		$text = substr($text, 0, strrpos($text,' '));
	
		// Add ... if the text actually needs shortening
		if (strlen($orig) > $chars) {
				$text = $text."...";
		}
		return $text;
	}
//Booting!!!!

	private function boot()
	{
		
		dump('Booting!');

		$this->db->query("CREATE TABLE `articles` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `title` varchar(245) COLLATE utf8mb4_general_ci NOT NULL,
		  `body` longtext COLLATE utf8mb4_general_ci NOT NULL,
		  `metaTitle` varchar(245) COLLATE utf8mb4_general_ci DEFAULT NULL,
		  `metaDesc` varchar(245) COLLATE utf8mb4_general_ci DEFAULT NULL,
		  `category` varchar(145) COLLATE utf8mb4_general_ci DEFAULT '0',
		  `type` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
		  `pubDate` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
		  `created_date` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
		  `active` varchar(45) COLLATE utf8mb4_general_ci DEFAULT '1',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

		$this->db->query("
			CREATE TABLE `categories` (
			  `id` INT NOT NULL AUTO_INCREMENT,
			  `name` VARCHAR(145) NOT NULL,
			  PRIMARY KEY (`id`));
		");

		if($this->config['importOnLaunch'])
		{
			dump('Importing...');

			$newData = [];

			$remote = new DB('firecrosser.com', 'develope_editor', 'develope_reader', '%b5tF[r(8-4U');

			$sites = $remote->getAll("SELECT * FROM `sites` WHERE `client_id` = {$this->config['client']}");

			foreach ($sites as $site) 
			{
				$posts = $remote->getAll("SELECT * FROM `posts` WHERE `site_id` = {$site['id']}");
				foreach($posts as $post)
				{
					$data = [
						'title' => mysqli_real_escape_string($remote->mysqli(), $post['title']),
						'body' => mysqli_real_escape_string($remote->mysqli(), $post['content']),
						'active' => $post['status'],
						'created_date' => $post['date_created'],
						'type' => $post['type'] == 0 ? 'FAQ' : 'article'
					];

					$new = (new Article())->add($data);
					$newData[$post['id']] = $new;
				}


				$news = $remote->getAll("SELECT * FROM `news` WHERE `site_id` = {$site['id']}");
				foreach($news as $post)
				{
					$data = [
						'title' => mysqli_real_escape_string($remote->mysqli(), $post['title']),
						'body' => stripslashes($post['content']),
						'metaTitle' => $post['meta_title'],
						'metaDesc' => $post['meta_description'],
						'active' => $post['status'],
						'pubDate' => $post['date_display'],
						'created_date' => $post['date_created'],
						'type' => 'news'
					];

					$new = (new Article())->add($data);
					$newData[$post['id']] = $new;
				}

				$faq = $remote->getAll("SELECT * FROM `faq` WHERE `site_id` = {$site['id']}");
				foreach($faq as $post)
				{
					$data = [
						'title' => mysqli_real_escape_string($remote->mysqli(), $post['question']),
						'body' => mysqli_real_escape_string($remote->mysqli(), $post['answer']),
						'category' => $post['category'],
						'active' => $post['status'],
						'pubDate' => $post['date_display'],
						'created_date' => $post['date_created'],
						'type' => 'FAQ'
					];

					$new = (new Article())->add($data);
					$newData[$post['id']] = $new;
				}

			}
		}

		if(file_exists($this->config['sitemap']))
		{
			dump('Sitemap Found!');

			$xml = simplexml_load_file($this->config['sitemap']);

			$urls = $xml->url;

			foreach($xml->url as $url)
			{
				if(!strpos($url->loc, $this->config['articlePrefix']))
					continue;

				if(strpos($url->loc, $this->config['articlePrefix'].'page'))
					continue;

				$start = strpos($url->loc, $this->config['articlePrefix'])+strlen($this->config['articlePrefix']);
				$end = strpos($url->loc, '-', $start);

				$title = urldecode(substr($url->loc, $start, ($end-$start)));
				$id = urldecode(substr($url->loc, $end+1, 7));
				// $newURL = $newData[$id]->getURL($this->config['articlePrefix']);

				dump($id);
				dump($title);
				dump($url);
				// dump($newURL);
			}



dd($newData);

		}


		dump('Done Booting, refresh...');
	}

	function reset()
	{
		$this->db->query("DROP TABLE `articles`, `categories`");
		$this->boot();
	}
}

function dump($d)
{
	echo "<pre>";
	print_r($d);
	echo "</pre>";
}
function dd($d)
{
	echo "<pre>";
	print_r($d);
	echo "</pre>";
	die();
}

?>
