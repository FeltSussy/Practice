<?php

namespace Felt\Practice;

$host= 'localhost';
$db = 'hexlet';
$user = 'felt';
$password = '';

try {
	$dsn = "pgsql:dbname=$db;";
	$pdo = new \PDO($dsn, $user, null, [\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC]);

	if ($pdo) {
		echo "Connected to the $db database successfully!";
	}
} catch (\PDOException $e) {
	die($e->getMessage());
}

class User {

    private ?int $id = NULL;
    private string $username;
    private string $phone;

    public function __construct(string $username, string $phone)
    {
        $this->username = $username;
        $this->phone = $phone;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}

class userDAO {
    private \PDO $pdo;
    
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function save(User $user): void
    {
        if (is_null($user->getId())) {
            $sql = "INSERT INTO users (username, phone) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $username = $user->getUsername();
            $phone = $user->getPhone();
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $phone);
            $stmt->execute();
            $id = (int) $this->pdo->lastInsertId();
            $user->setId($id);
        } else {
            $userId = $user->getId();
            $sql = "UPDATE users SET username = ?, phone = ? WHERE id = {$userId}";
            $stmt = $this->pdo->prepare($sql);
            $username = $user->getUsername();
            $phone = $user->getPhone();
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $phone);
            $stmt->execute();
        }
    }
}

//вызов

$user = new User("pavel", "12345");
$userDAO = new userDAO($pdo);

$userDAO->save($user);