<?php

class Database {
  private static $instance = null;
  private $pdo;

  private $db_name = 'teste_l5';
  private $db_host = '127.0.0.1';
  private $db_user = 'root';
  private $db_pass = 'root';
  private $db_port = '3306';

  private function __construct() {
    try {
      $this->pdo = new PDO("mysql:dbname={$this->db_name};host={$this->db_host};port={$this->db_port}", $this->db_user, $this->db_pass);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
  }

  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public function getConnection() {
    return $this->pdo;
  }
}


