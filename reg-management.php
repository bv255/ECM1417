<?php
    function isValidInput($input) {
        $pattern = '/[!@#%&*()+=^{}[\]—;:“’<>?\/"]/';
        return !preg_match($pattern, $input);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["username"])) {
            $username = $_POST["username"];
            if(isValidInput($username)) {
                
                setcookie('username', $username, time() + 60*60*24, '/');
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Invalid username";
                header("Location: registration.php?error=" . urlencode($error_message));
                exit();
            }
        }
    }
?>