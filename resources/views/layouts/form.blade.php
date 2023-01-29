<?php
$statuses = [
    "pending"       => "В ожидании",
    "in_developing" => "В разработке",
    "on_testing"    => "На тестировании",
    "on_checking"   => "На проверке",
    "done"          => "Выполнено",
];
?>
@csrf
<div class="form-group">
    <input type="text" class="form-control" name="title" placeholder="Заголовок" required value="{{ old('title') ?? $post->title ?? '' }}">
</div>
@if (isset($task))
<select name="status" class="float-md-end" id="select">
    <?php foreach ($statuses as $key => $value) { ?>
        <option <?= ( $task->status == $key) ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
    <?php } ?>
</select>
@else
<div class="form-group">
    <select name="status" class="mt-2">
        <?php foreach ($statuses as $key => $value) { ?>
            <option value="<?= $key ?>"><?= $value ?></option>
        <?php } ?>
    </select>
</div>
@endif
<div class="form-group">
    <textarea name="body" class="mt-2 form-control" placeholder="Текст задачи" rows="7" required>{{ old('body') ?? $post->body ?? '' }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="mt-2 btn btn-info">Сохранить</button>
</div>
