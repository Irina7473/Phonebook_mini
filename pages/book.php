<h3>Ваши контакты</h3>
<div class="container-fluid">
    <div class="row mb-5">

        <?php
        $part = isset($_GET['part']) ? (int)$_GET['part'] : 1;
        $perPart = isset($_GET['per-part']) && $_GET['per-part'] <= 50 ? (int)$_GET['per-part'] : 3;
        $start = ($part > 1) ? ($part * $perPart) - $perPart : 0;

        $contacts = (array_chunk(Contact::getContactList(), $perPart, true));
        $total = Contact::$count;

        if ($total > 0) {
            //Нахожу количество страниц
            $parts = ceil($total / $perPart);
            ?>

            <!--  Вывод данных справочника в таблицу -->
            <table class="table">
                <thead>
                <tr>
                    <th>№п/п</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Комментарий</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($contacts[$part - 1] as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['phone']; ?></td>
                        <td><?php echo $value['comment']; ?></td>
                        <td>
                            <form action="#" method="POST">
                                <button name="delbtn" type="submit" value="<?php echo $key ?>"
                                        class="d-inline text-danger">Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>

            <?php
            // Удаление контакта
            if (isset($_POST['delbtn'])) {
                if (Contact::delContact($_POST['delbtn'])) {
                    echo '<h3><span class="successtext"> Контакт удален </h3>';
                    header("Refresh: 0");
                }
            } ?>

            <hr>

            <!-- Постраничная навигация  -->
            <div class="col-md-12">
                <div class="well well-sm">
                    <h4>Страницы:</h4>
                    <div class="paginate">

                        <?php for ($x = 1; $x <= $parts; $x++): ?>

                            <ul class="pagination">
                                <li>
                                    <a type="submit"
                                       href="index.php?page=1&part=<?php echo $x; ?>&per-part=<?php echo $perPart; ?>">
                                        <?php echo $x; ?>
                                    </a>
                                </li>
                            </ul>

                        <?php endfor; ?>
                    </div>
                </div>
            </div>

        <?php } // Если справочник пуст
        else { ?>

            <div class="alert alert-info">
                <h3>Записей не найдено</h3>
            </div>

        <?php } ?>

    </div>