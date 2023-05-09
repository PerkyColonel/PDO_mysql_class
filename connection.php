<?php
class Connection
{
    private $host = "localhost";
    private $db_name = "ajax_demo";
    private $username = "85736";
    private $password = "r8zHJaB#2o";
    private $conn;

    public function __construct()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }

    public function get($table)
    {
        $prepare = $this->conn->prepare("SELECT * FROM " . $table . "");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        return json_encode($result);
    }

    public function add($data)
    {
        $prepare = $this->conn->prepare("INSERT INTO personen (voornaam, achternaam, postcode, wachtwoord) VALUES (:voornaam, :achternaam, :postcode, :wachtwoord)");
        $prepare->execute([
            'voornaam' => $data[0],
            'achternaam' => $data[1],
            'postcode' => $data[2],
            'wachtwoord' => $data[3]
        ]);
    }

    public function update($data)
    {
        $stmt = $this->conn->prepare("UPDATE personen SET voornaam=:voornaam, achternaam=:achternaam, postcode=:postcode, wachtwoord=:wachtwoord WHERE id=:id");
        $stmt->execute([
            'id' => $data['id'],
            'voornaam' => $data['voornaam'],
            'achternaam' => $data['achternaam'],
            'postcode' => $data['postcode'],
            'wachtwoord' => $data['wachtwoord']
        ]);
    }

    public function del($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM personen WHERE id=:id");
        $stmt->execute(['id' => $id]);
    }
}
