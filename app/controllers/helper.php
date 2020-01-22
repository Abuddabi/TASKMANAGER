<?php
namespace App\Controllers;

class Helper
{
  function redirect($where){
    header("location: $where");
    exit;
  }

  function pvar($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
  }

  function pprint($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    exit;
  }


}

?>