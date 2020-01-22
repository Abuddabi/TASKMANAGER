<?php $this->layout('layout') ?>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>All tasks</h1>
      <a href="create" class="btn btn-success">Add Task</a>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
        <?php foreach($tasks as $task): ?>
          <tr>
            <td><?= $task['id'] ?></td>
            <td><?= $task['title'] ?></td>
            <td>
              <a href="/tasks/<?=$task['id']; ?>" class="btn btn-info">Show</a>
              <a href="edit/<?= $task['id']; ?>" class="btn btn-warning">Edit</a>
              <a href="delete/<?= $task['id']; ?>" class="btn btn-danger" onclick="return confirm('are you sure?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
