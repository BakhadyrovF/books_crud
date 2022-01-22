<div class="modal_overlay">
  <div class="modal">
    <h1>Редактирование книги</h1>
    <?php
    use app\core\Application;
    ?>
    <?php $form = Application::$app->form->begin("", "post") ?>
    <?php $form->field("title", $model) ?>
    <?php $form->field("author", $model) ?>
    <?php $form->field("price", $model) ?>
    <div class="buttons">
      <a href="/"><button type="button" class="btn">Отмена</button></a>
      <button type="submit" class="btn create">Сохранить</button>
    </div>
    <?php $form->end(); ?>
  </div>
</div>
