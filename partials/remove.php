<?php
$idToDelete = $_GET['remove'];

$json = file_get_contents('..\dataset\users.json');
$data = json_decode($json, true);
$recordIndex = -1;
foreach ($data as $index => $user) {
    if ($user['id'] == $idToDelete) {
        $recordIndex = $index;
        break;
    }
}

if ($recordIndex !== -1) {
    array_splice($data, $recordIndex, 1);

    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('..\dataset\users.json', $json);

    header('Location: ..\index.php');
    exit;
}
    ?>