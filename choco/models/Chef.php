<?php 


class Chef
{

	public $id;
	public $src;
	public $name;
	public $job;
	public $description;
	public $local;
	public $link;
	
	function __construct($id = null, $local = null)
	{
		// Récupérer le slide $id avec sa traduction $locale en base de données
		$result = $this->queryChef($id, $local);
		$this->id = $result['id'];
		$this->src = $result['src'];
		$this->name = $result['name'];
		$this->job = $result['job'];
		$this->description = $result['description'];
		$this->local = $result['local'];
		$this->link = $result['link'];
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
		
		$query = $pdo->prepare('SELECT * FROM team JOIN team_translations ON team.id = team_translations.team_id AND team_translations.local = ? JOIN team_links_translation ON team_links_translation.team_id = team.id WHERE team.id = ?;');
		$query->execute([$local, $id]);

		//retourner le resultat
		return $query->fetch();
	}
}

