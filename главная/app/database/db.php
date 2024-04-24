<?

session_start();
require 'connect.php';

$errMsg_search = '';

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '<pre>';
    exit();
}
function tte($value){
    echo '<pre>';
    print_r($value);
    echo '<pre>';
}


//Проверка выполнения запроса к БД
function dbCheckError($query){
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
    return true;
}
//Запрос на получение данных c одной таблицы
function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
   
    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
    $date = $query->fetchAll();
    return $date;
}


//Запрос на получение одной строки с выбранной таблицы
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
    // $sql = $sql . " LIMIT 1";
   
    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
    $date = $query->fetch();
    return $date;
}


//Запись в таблицу БД
function insert($table, $params){
    global $pdo;
    //INSERT INTO `users` (admin, username, email, password) VALUES ('1', 'Egor', 'egor@mail.ru', '4444');
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else{
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckError($query);
    return $pdo->lastInsertId();
}

//Обновление строки в таблице БД
function update($table, $id, $params){
    global $pdo;
    $i = 0;
    $str= '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        } else{
            $str = $str . ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id";

    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckError($query);
}


//Удаление строки в таблице БД
function delete($table, $id){
    global $pdo;
    $sql = "DELETE FROM $table WHERE id =" . $id;

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}


// Выборка записей с автором
function selectAllFromPostsWithUsers($table1, $table2){
    global $pdo;

    $sql = "SELECT t1.id, t1.title, t1.img, t1.content, t1.status, t1.id_topic, t1.created_date, t2.username 
    FROM $table1 AS t1 
    JOIN $table2 AS t2 ON t1.id_user = t2.id";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Выборка записей с автором user
function selectAllFromPostsWithUsers_2($table1, $id_user){
    global $pdo;

    $sql = "SELECT id, title, img, content, status, id_topic, created_date
    FROM $table1
    WHERE id_user = $id_user";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

//Выборка записей с автором на category
function selectAllFromPostsWithUsersOnCategory($table1, $table2, $id){
    global $pdo;

    $sql = "SELECT p.*, u.username
    FROM $table1 AS p 
    JOIN $table2 AS u ON p.id_user = u.id
    WHERE p.status = 1 AND p.id_topic = $id
    ORDER BY p.id DESC";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Выборка записей с автором на главную
function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset){
    global $pdo;

    $sql = "SELECT p.*, u.username
    FROM $table1 AS p 
    JOIN $table2 AS u ON p.id_user = u.id
    WHERE p.status = 1
    ORDER BY p.id DESC
    LIMIT $limit OFFSET $offset";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}



// Поиск поо заголовкам и содержимому (простой)
function searchInTitleAndContent($text, $table1, $table2){
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT p.*, u.username
    FROM $table1 AS p 
    JOIN $table2 AS u ON p.id_user = u.id
    WHERE p.status = 1 AND (p.title LIKE '%$text%' OR p.content LIKE '%$text%')";


    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}


// Выборка записи на single
function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id){
    global $pdo;

    $sql = "SELECT p.*, u.username
    FROM $table1 AS p 
    JOIN $table2 AS u ON p.id_user = u.id
    WHERE p.id = $id";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}


// Выборка записи на single
function countRow($table){
    global $pdo;

    $sql = "SELECT COUNT(*)
    FROM $table
    WHERE status = 1";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchColumn();
}

// Вывод комментариев на single
function selectCommentsOrderByDesc($table1, $page){
    global $pdo;

    $sql = "SELECT *
    FROM $table1
    WHERE page = $page
    ORDER BY id DESC";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Вывод сообщений
function selectMessage($table1, $table2, $user1, $user2){
    global $pdo;

    $sql = "SELECT m.*, u.username
    FROM $table1 AS m
    JOIN $table2 AS u ON m.id_user_1 = u.id
    WHERE (m.id_user_2 = '$user2' AND m.id_user_1 = '$user1') OR (m.id_user_2 = '$user1' AND m.id_user_1 = '$user2')";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

function selectMessageNoEmpty($table1, $table2, $user1){
    global $pdo;

    $sql = "SELECT DISTINCT u.username, u.id
    FROM $table1 AS u
    JOIN $table2 AS m ON m.id_user_2 = u.id
    WHERE u.id != $user1 AND (m.id_user_1 = $user1 OR m.id_user_2 = $user1)
    ";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

function lastMessage($table1, $id1, $id2){
    global $pdo;

    $sql = "SELECT m.message, m.created_data
    FROM $table1 AS m
    WHERE (m.id_user_2 = '$id1' OR m.id_user_2 = '$id2') AND (m.id_user_1 = '$id1' OR m.id_user_1 = '$id2')
    ORDER BY m.created_data DESC
    LIMIT 1";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

//Колличество комментариев к посту
function countComments($table1, $id){
    global $pdo;

    $sql = "SELECT COUNT(id) AS count
    FROM $table1
    WHERE $table1.page = $id";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

// Поиск людей оо заголовкам и содержимому (простой)
// function searchInTitleAndContent($text, $table1, $table2){
//     $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
//     global $pdo;
//     $sql = "SELECT p.*, u.username
//     FROM $table1 AS p 
//     JOIN $table2 AS u ON p.id_user = u.id
//     WHERE p.status = 1 AND (p.title LIKE '%$text%' OR p.content LIKE '%$text%')";


//     $query = $pdo->prepare($sql);
//     $query->execute();
//     dbCheckError($query);
//     return $query->fetchAll();
// }