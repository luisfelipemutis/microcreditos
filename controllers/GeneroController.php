<?php
  require_once 'models/genero.php';
  class GeneroController{
    
    public function getAll(){
      $genero = new Genero();
      $generos = $genero->getAll();
      return $generos;
    }
  }
?>