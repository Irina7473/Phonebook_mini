<?php

class Contact
{
    public string $name, $phone, $comment;
    public static $count;
    private static $filename = "phonebook.json";

    function __construct($name, $phone, $comment = "")
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->comment = $comment;
    }

    //Получение списка контактов из файла
    static function getContactList()
    {
        try {
            $json = file_get_contents(self::$filename);
            $contacts = json_decode($json, true);
            //Получаю количество контактов
            self::$count = count($contacts);
            return $contacts;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    //Перезапись всего списка контактов в файл
    static function writeContactList($contacts)
    {
        try {
            $json = json_encode($contacts, JSON_FORCE_OBJECT);
            file_put_contents(self::$filename, $json, LOCK_EX);
            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    //Добавление нового контакта
    static function addContact($name, $phone, $comment)
    {
        $name = trim(htmlspecialchars($name));
        $phone = trim(htmlspecialchars($phone));
        $comment = trim(htmlspecialchars($comment));

        if ($name == '' || $phone == '') {
            echo '<h3><span class="warningtext">Заполните все обязательные поля!</h3>';
        } else {
            try {
                // Получаю существующие контакты
                $contacts = self::getContactList();
                //Добавляю к списку новый контакт
                $contacts[] = new Contact($name, $phone, $comment);
                //Перезаписываю файл со списком контактов
                if (self::writeContactList($contacts)) return true;
                else return false;
            } catch (Exception $exc) {
                return $exc->getMessage();
            }
        }
    }

    //Удаление контакта по ключу в массиве
    static function delContact($key)
    {
        // Получаю существующие контакты
        $contacts = self::getContactList();
        //Удаляю контакт из списка
        unset($contacts[$key]);
        //Перезаписываю только значения, чтобы обновить ключи
        self::writeContactList(array_values($contacts));
        return true;
    }

}

