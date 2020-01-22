<?php
  
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

?>