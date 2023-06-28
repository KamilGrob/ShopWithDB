<!DOCTYPE html>
<html>
<head>
    <title>Generowanie tabeli z danymi</title>
</head>
<body>
    <table id="users-table">
        <thead>
            <tr>
                
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Company Name</th>
                <th> </th>

            </tr>
        </thead>
        <tbody>
            <?php
                $json = file_get_contents('dataset\users.json');
                $data = json_decode($json, true);

                foreach ($data as $user) {
                    echo "<tr>";
                    echo "<td>{$user['name']}</td>";
                    echo "<td>{$user['username']}</td>";
                    echo "<td>{$user['email']}</td>";
                    echo "<td>{$user['address']['street']}, {$user['address']['zipcode']} {$user['address']['city']}</td>";
                    echo "<td>{$user['phone']}</td>";
                    echo "<td>{$user['company']['name']}</td>";
                    echo "<form action='/partials/remove.php' method='GET' id='remove_form'> ";
                    echo "<td><button id='{$user['id']}' name='remove' value='{$user['id']}' >Remove</button></td>";
                    echo "</form>";
                    echo "</tr>";
                }
            ?>
            <tr>
            <form action="" method="GET" id="user-form"> 
        <td><input type="text" placeholder="Name" id="name" name="name"></td>
        <td><input type="text" placeholder="Username" id="username" name="username"></td>
        <td><input type="email" placeholder="Email" id="email" name="email"></td>
        <td><input type="text" placeholder="Address" id="address" name="address"></td>
        <td><input type="text" placeholder="Phone" id="phone" name="phone"></td>
        <td><input type="text" placeholder="Company" id="company" name="company"></td>
        <td><button type="submit" name="add">Submit</button></td>
        </form>
        </tbody>
    </table>   
    
    <?php
    if (isset($_GET['add'])) {
        validation();
        
    }

    function validation()
    {
        $errors = [];
        $name = $_GET['name'];
        $username = $_GET['username'];
        $email = $_GET['email'];
        $address = $_GET['address'];
        $phone = $_GET['phone'];
        $companyName = $_GET['company'];

        function isValidFullName($name)
        {
            $nameParts = explode(' ', $name);
            return count($nameParts) >= 2;
        }

        function isValidAddressFormat($address) {
            $addressParts = explode(',', $address);
            if(count($addressParts) === 2){
                $addressSpace = explode(' ', $addressParts[1]);;
                return (count($addressParts) === 2 && count($addressSpace) >= 2);
            }
            
            
        }

        if (!isValidAddressFormat($address)) {
            $errors[] = "Please provide the address in the format: Street, Zipcode City";
        }

        if (!isValidFullName($name)) {
            $errors[] = "Please enter both name and surname.";
        }

        if (empty($name) || empty($address) || empty($username) || empty($email) || empty($phone) || empty($companyName)) {
            $errors[] = "Please fill in all the fields.";
        }

        if (!empty($errors)) {
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>" . $error . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        submitForm('$name', '$username', '$email', '$address', '$phone', '$companyName');
                    });
                    
                  </script>";
                  
        }
        
    }
    
    ?>
    
    <script src="../assets/js/script.js"></script>
</body>
</html>