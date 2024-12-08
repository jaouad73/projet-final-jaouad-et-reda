<?php  
require_once 'models/UserModel.php';

class RegisterController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['passworde'];
            $confirmPassword = $_POST['confirm_password'];
    
            if ($password === $confirmPassword) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $userModel = new UserModel($this->db);
    
                if ($userModel->userExists($username, $email)) {
                    $error_message = "Le nom d'utilisateur ou l'adresse e-mail est déjà utilisé.";
                } else {
                    if ($userModel->createUser($username, $email, $hashedPassword, 'client')) {
                        header('Location: index.php?action=login');
                        exit();
                    } else {
                        $error_message = "Erreur lors de l'inscription.";
                    }
                }
            } else {
                $error_message = "Les mots de passe ne correspondent pas.";
            }
        }
        include 'views/account/register.php';
    }
}
?>
