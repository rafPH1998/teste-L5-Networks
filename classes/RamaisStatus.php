<?php
header("Content-type: application/json; charset=utf-8");

class RamaisStatus {
    private $ramais;
    private $filas;
    private $status_ramais;
    private $info_ramais;

    public function __construct() {
      $this->ramais = file('../lib/ramais');
      $this->filas = file('../lib/filas');
      $this->status_ramais = array();
      $this->info_ramais = array();
    }

    public function getStatus() {
      $this->parseFilas();
      $this->parseRamais();
      return json_encode($this->info_ramais);
    }

    private function parseFilas() {
      foreach($this->filas as $linha) {
        if(strstr($linha, 'SIP/')) {
          if(strstr($linha, '(Ring)')) {
            $this->parseRamalStatus($linha, 'chamando');
          }
          if(strstr($linha, '(In use)')) {
            $this->parseRamalStatus($linha, 'ocupado');
          }
          if(strstr($linha, '(Not in use)')) {
            $this->parseRamalStatus($linha, 'disponivel');
          }
          if(strstr($linha, '(paused)')) {
            $this->parseRamalStatus($linha, 'pausado');
          }
        }
      }
    }

    private function parseRamalStatus($linha, $status) {
      $linha = explode(' ', trim($linha));
      list($tech, $ramal) = explode('/', $linha[0]);
      $this->status_ramais[$ramal] = array('status' => $status);
    }

    private function parseRamais() {
      foreach($this->ramais as $linha) {
        $arr = array_values(array_filter(explode(' ', $linha)));
        if(trim($arr[1]) == '(Unspecified)' && trim($arr[4]) == 'UNKNOWN') {
          $this->parseInfoRamal($arr[0], false);
        }
        if(trim($arr[5]) == "OK") {
          $this->parseInfoRamal($arr[0], true);
        }
      }
    }

    private function parseInfoRamal($nomeRamal, $online) {
      list($name, $username) = explode('/', $nomeRamal);
      $status = isset($this->status_ramais[$name]) ? $this->status_ramais[$name]['status'] : '';
      $this->info_ramais[$name] = array(
        'nome' => $name,
        'ramal' => $username,
        'online' => $online,
        'status' => $status
      );
    }
}

$ramaisStatus = new RamaisStatus();
$infoRamais = $ramaisStatus->getStatus();
echo $infoRamais;
