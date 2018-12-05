<?php
header('Content-Type: application/json');
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if($_FILES['file']['error'] > 0){
    echo json_encode(array('status'=>404,'message'=>'error:'.$_FILES['file']['error']));
} else {
    move_uploaded_file($_FILES['file']['tmp_name'], 'public/videos/'.$_FILES['file']['name']);
    $id = generateRandomString(25);
    $name = $_FILES['file']['name'];
    shell_exec('python3 ./procesador/subproceso.py "'.$name.'" "'.$id.'" > /dev/null 2>&1 &');
    echo json_encode(array('status'=>200,'message'=> 'Su video se ha procesado','id'=>$id, 'url'=>'/public/videos/'.$id.'.mp4'));
}
?> 