@csrf
<div class="form-group">
    <input type="text" class="form-control" name="title" placeholder="Заголовок" required value="{{ old('title') ?? $task->title ?? '' }}">
</div>
<div class="form-group">
@if (isset($task))
    <select name="status" class="mt-2">
        <?php foreach ($statuses as $key => $value) { ?>
            <option <?= ( $task->status == $key) ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
        <?php } ?>
    </select>
@else
    <select name="status" class="mt-2">
        <?php foreach ($statuses as $key => $value) { ?>
            <option value="<?= $key ?>"><?= $value ?></option>
        <?php } ?>
    </select>
@endif
</div>
<div class="form-group">
    <textarea name="body" class="mt-2 form-control" placeholder="Текст задачи" rows="7" required>{{ old('body') ?? $task->body ?? '' }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="mt-2 btn btn-info">Сохранить</button>
</div>
