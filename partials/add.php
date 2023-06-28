<?php
$json = file_get_contents('..\dataset\users.json');
$data = json_decode($json, true);

foreach ($data as $user) {
    $id=$user['id']+1;
}
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $name = $_GET['name'];
        $username = $_GET['username'];
        $email = $_GET['email'];
        $street = $_GET['street'];
        $zipcode = $_GET['zipcode'];
        $city = $_GET['city'];
        $phone = $_GET['phone'];
        $companyName = $_GET['company'];
    
        $data = array(
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'street' => $street,
            'zipcode' => $zipcode,
            'city' => $city,
            'phone' => $phone,
            'company' => $companyName
        );
    }
    $newUser = array(
        'id' => $id,
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'address' => array(
            'street' => $street,
            'suite' => null,
            'city' => $city,
            'zipcode' => $zipcode
        ),
        'phone' => $phone,
        'website' => null,
        'company' => array(
            'name' => $companyName,
            'catchPhrase' => null,
            'bs' => null
        )
    );
    
    $usersData = file_get_contents('..\dataset\users.json');
    $users = json_decode($usersData, true);

    $users[] = $newUser;
    $json = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents('..\dataset\users.json', $json);
    echo "<script>window.location.href = '..\index.php';</script>";
    
?>