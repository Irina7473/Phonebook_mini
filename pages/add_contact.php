<?php
include_once('classes.php');
?>
<!-- Форма добавления контакта -->
<div class="container-fluid">
    <form method="post">
        <div class="form-group">
            <div class="form-group">
                <label for="name">Имя <span class="warningtext">*</span></label>
                <input name="name" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Телефонный номер <span class="warningtext">*</span></label>
                <input name="phone" type="tel" class="form-control" placeholder="+7 (900) 123-45-67"
                       pattern="^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$">
            </div>
            <div class="form-group">
                <label for="comment">Комментарий</label>
                <input name="comment" type="text" class="form-control">
            </div>
            <p><span class="warningtext">*</span> Поля, обязательные для заполнения</p>
            <button name="addbtn" type="submit" class="btn btn-primary">Добавить</button>
        </div>
    </form>
</div>

<hr>

<?php
//Добавление контакта
if (isset($_POST['addbtn'])) {
    if (Contact::addContact($_POST['name'], $_POST['phone'], $_POST['comment'])) {
        echo '<h3><span class="successtext"> Контакт добавлен </h3>';
        header("/index.php?page=2");
    }
}
?>