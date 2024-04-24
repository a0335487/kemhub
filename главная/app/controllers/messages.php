<?

$user = $_GET['user'];
$user1 = $_SESSION['id'];

$page = $user . "-" . $user1;

$users = explode("-", $page);
$user2 = $users[0];

$email = '';
$message = '';
$errMsg = '';
$messages = [];


//Код формы создания message
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goMessage'])){
        // $email =  trim($_POST['email']);
        $message =  trim($_POST['message']);
        if($message === ''){
            header('location: ', BASE_URL);
        }else
        {
            $message = [
                'id_user_2' => $user2,
                'id_user_1' => $user1,
                'message' => $message          
            ];       
            $message= insert('messages', $message);
            $messages = selectMessage('messages', 'users', $user2, $user1);  
               
        }
        header('location: ', BASE_URL . "index.php");  
}
else{
    $messages = selectMessage('messages', 'users', $user2, $user1);  
    header('location: ', BASE_URL . "index.php");    
}
