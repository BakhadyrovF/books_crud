<div>
  <header class="header">
    <div class='header_container'>
      <h1>Books List</h1>
      <form action="/?search=">
      <input name="search" value="<?php echo $search ?>" placeholder="Search..." />
      </form>
      <a href="/create" class="header_create-btn">
        <button>Create Product</button>
      </a>
    </div>
  </header>
  <div class="main">
    <table>
      <thead>
        <tr>
          <th>№</th>
          <th>Название</th>
          <th>Автор</th>
          <th>Цена</th>
          <th>Редактирование</th>
          <th>Удаление</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($model->books as $index => $values): ?>
          <tr class="main_card">
            <td>
              <p><?php echo $index + 1 ?>.</p>
            </td>
            <td>
              <h4><?php echo $values["title"] ?></h4>
            </td>
            <td>
              <p><?php echo $values["author"] ?></p>
            </td>
            <td>
              <span>$<?php echo $values["price"] ?></span>
            </td>
            <td>
              <a class="edit-btn" href="/update?id=<?php echo $values["id"] ?>">Редактировать</a>
            </td>
            <td>
              <form action="/delete" method="post">
                <input type="hidden" name="id" value="<?php echo $values["id"] ?>">
                <button type="submit" class="delete-btn">Удалить</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  
</div>

