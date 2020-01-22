<?php
  namespace App\Models;
  require '../conf.php';

  use Aura\SqlQuery\QueryFactory;
  use PDO;

  class Task_Handler
  {
    public $queryFactory;
    public $pdo;

    public function __construct(QueryFactory $queryFactory, PDO $pdo)
    {
      $this->queryFactory = $queryFactory;
      $this->pdo = $pdo;
    }

    public function insertTask($data)
    {
      $insert = $this->queryFactory->newInsert();

      $insert
      ->into('tasks')                   // INTO this table
      ->cols([                        // bind values as "(col) VALUES (:col)"
          'title',
          'content'
      ])
      ->bindValues([                  // bind these values
          'title' => $data['title'],
          'content' => $data['content']
      ]);

      // prepare the statement
      $sth = $this->pdo->prepare($insert->getStatement());

      // execute with bound values
      $result = $sth->execute($insert->getBindValues());

      return $result;
    }

    public function updateTask($task)
    {
      $update = $this->queryFactory->newUpdate();
      $update
      ->table('tasks')        // update this table
      ->cols([                // update these columns and bind these values
        'title',
        'content'
      ])
      ->where('id = :id')         // AND WHERE these conditions
      ->bindValues([              // bind these values to the query
        'title' => $task['title'],
        'content' => $task['content'],
        'id' => $task['id']
      ]);

      $statement = $this->pdo->prepare($update->getStatement());
      $result = $statement->execute($update->getBindValues());
      return $result;
    }

    public function deleteTask($id)
    {
      $delete = $this->queryFactory->newDelete();
      $delete
      ->from('tasks')        //table
      ->where('id = :id')    // AND WHERE these conditions
      ->bindValues(['id' => $id]);

      $statement = $this->pdo->prepare($delete->getStatement());
      $result = $statement->execute($delete->getBindValues());
      return $result;
    }

  }

?>