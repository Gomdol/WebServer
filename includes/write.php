<!-- write.php -->

<section id="write">
    <form action="/write_proc.php" method="post">
        <div class="form-group">
            <label for="title">제목</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">내용</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-secondary" type="button">작성</button>
        </div>
    </form>
</section>