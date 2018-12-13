<?php 


class Meal
{

	public $id;
	public $src;
	public $price;
	public $name;
	public $description;
	public $alt;
	public $local;
	
	function __construct($id = null, $local = null)
	{
		// Récupérer le slide $id avec sa traduction $locale en base de données
		$result = $this->queryChef($id, $local);
		$this->id = $result['id'];
		$this->src = $result['src'];
		$this->price = $result['price'];
		$this->name = $result['name'];
		$this->description = $result['descritpion'];
		$this->alt = $result['alt'];
		$this->local = $result['local'];
	}

	public function queryChef($id, $local)
	{
		//configurer PDO
		$host = '127.0.0.1';
		$db   = 'chocolat';
		$user = 'root';
		$pass = '';
		$charset = 'utf8mb4';

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$options = [
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::ATTR_EMULATE_PREPARES   => false,
		];
		try {
		     $pdo = new PDO($dsn, $user, $pass, $options);
		} catch (\PDOException $e) {
		     throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}


		//Préparer la requete
		
		$query = $pdo->prepare('SELECT * FROM menu JOIN menu_translations ON menu.id = menu_translations.menu_id WHERE menu_translations.local = ? AND menu.id = ?;');
		$query->execute([$local, $id]);

		//retourner le resultat
		return $query->fetch();
	}
}

