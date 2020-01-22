<?php

namespace App\Controllers;

use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;
use PDO;
use App\Models\Task_Handler;

class HomeController
{
  protected $view;
  protected $queryFactory;
  protected $pdo;
  protected $task_handler;
  protected $helper;

  //CONSTRUCT
  public function __construct(
    Engine $view, 
    QueryFactory $queryFactory, 
    PDO $pdo, 
    Task_Handler $task_handler,
    Helper $helper)
  {
    $this->view = $view;
    $this->queryFactory = $queryFactory;
    $this->pdo = $pdo;
    $this->task_handler = $task_handler;
    $this->helper = $helper;
  }

  
  public function tasks()
  {
    // Aura/SqlQuery
    $select = $this->queryFactory->newSelect();
    $select->cols(["*"])->from('tasks');

    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    $myTasks = $sth->fetchAll(PDO::FETCH_ASSOC);

    // Render a template
    echo $this->view->render('tasks', ['tasks' => $myTasks]);
  }

  public function show($id)
  {
    // Aura/SqlQuery
    $select = $this->queryFactory->newSelect();
    $select->cols(["*"])->from('tasks')->where('id = :id')->bindValues(["id" => $id]);

    $statement = $this->pdo->prepare($select->getStatement());
    $statement->execute($select->getBindValues());
    $myTask = $statement->fetch(PDO::FETCH_ASSOC);

    // Render a template
    echo $this->view->render('show', ['task' => $myTask]);
  }

  public function create()
  {
    // Render a template
    echo $this->view->render('create');
  }

  public function createTask_h()
  {
    $this->task_handler->insertTask($_POST);
    $this->helper->redirect("/tasks");
  }

  public function edit($id)
  {
    $select = $this->queryFactory->newSelect();
    $select->cols(["*"])->from('tasks')->where('id = :id')->bindValues(["id" => $id]);

    $statement = $this->pdo->prepare($select->getStatement());
    $statement->execute($select->getBindValues());
    $myTask = $statement->fetch(PDO::FETCH_ASSOC);

    // Render a template
    echo $this->view->render('edit', ['task' => $myTask]);
  }

  public function editTask_h()
  {
    $this->task_handler->updateTask($_POST);
    $this->helper->redirect("/tasks");
  }

  public function deleteTask_h($id)
  {
    $this->task_handler->deleteTask($id);
    $this->helper->redirect("/tasks");
  }

  

}








?>