@csrf
<div class="form-group">
    <input type="text" class="form-control" name="title" placeholder="Заголовок" required value="{{ $task->title ?? '' }}">
</div>
<div class="form-group">
    <input type="checkbox" name="done" class="mt-2 form-check-input" id="flexCheckDefault" value="success" {{ (isset($task->done) && $task->done) ? 'checked' : '' }}>
</div>
<div class="form-group">
    <textarea name="body" class="mt-2 form-control" placeholder="Текст поста" rows="7" required>{{ $task->body ?? '' }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="mt-2 btn btn-info">Сохранить</button>
</div>
