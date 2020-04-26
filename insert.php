<?php
//insert.php

if(isset($_POST["name"]))
{
    $connect = new PDO("mysql:host=localhost;dbname=blogi", "root", "");
    $query = "INSERT INTO connecttagpost(name, tag_name) VALUES(:name, :tag_name)";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':name'  => $_POST["name"],
            ':tag_name' => $_POST["tag_name"]
        )
    );
    $result = $statement->fetchAll();
    $output = '';
    if(isset($result))
    {
        $output = '
  <div class="alert alert-success">
   Postitusele on lisatud tag
  </div>
  ';
    }
    echo $output;
}

?>
