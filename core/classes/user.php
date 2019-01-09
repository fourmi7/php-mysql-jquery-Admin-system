<?php 
    
    class User
    {
        protected $pdo;

        function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        //to check if he put some valid characters
        public function checkInput($var){
            $var = htmlspecialchars($var);
            $var = trim($var);
            $var = stripcslashes($var);
            return $var;
        }

        // this part is for the user login
        public function Login($email, $password)
        {
            $stmt = $this->pdo->prepare("SELECT user_id FROM users WHERE email =:email AND password =:password ");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindValue(":password", md5($password), PDO::PARAM_STR);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $count = $stmt->rowCount();

            if ($count > 0) {
                 return $_SESSION['user_id'] = $user->user_id;
                // header('Location:' .BASE_URL);
            }else{
                return false;
            }
        }

        // this part is for the user registration
        public function Register($idrole, $username, $email, $password){
            /*$result = null;*/
            $stmt = $this->pdo->prepare("INSERT INTO users ( idrole, username, email, password, condicion) VALUES(:idrole, :username, :email, :password , 1)" );  
            $stmt->bindParam(":idrole", $idrole, PDO::PARAM_INT);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // update information from the user
        public function updateUser($user_id, $idrole, $username, $email, $password ){
            $stmt = $this->pdo->prepare(
                "UPDATE users SET idrole = :idrole, username = :username, email = :email, password = :password WHERE user_id = :user_id ");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->bindParam(":idrole", $idrole, PDO::PARAM_INT);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // this part is to use all the data from the user
        public function userData($user_id){
            $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id ");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        // this is the logout function 
        public function logout(){
            $_SESSION = array();
            session_destroy();
            header('Location: '.BASE_URL);
        }

        // this function is to check if the email is already exist in the database
        public function checkEmail($email){
            $stmt = $this->pdo->prepare("SELECT `email` FROM `users` WHERE `email` = :email ");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();

            $count = $stmt->rowCount();
            if ($count > 0 ) {
                return true;
            }else{
                return false;
            }
        }

        // this part is to use all the data from the user
        public function ResetPassword($email, $password){
            $stmt = $this->pdo->prepare("UPDATE `users` SET `password` = :password WHERE `email` = :email ");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", md5($password), PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user;
        }

        // Show users info
        public function selectUsers(){
            $stmt = $this->pdo->prepare("SELECT * FROM `users` ");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $users;
        }

         // show Roles
        public function selectRoles(){
            $stmt = $this->pdo->prepare("SELECT * FROM `roles` ");
            $stmt->execute();
            $roles = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $roles;
        }


        // update information from the user
        public function update($table, $user_id, $fields = array()){
            $columns = '';
            $i       = 1;

            foreach ($fields as $name => $value) {
                $columns .= "`{$name}` = :{$name}";
                if ($i < count($fields)) {
                    $columns .= ', ';
                }
                $i++;
            }
            $sql = "UPDATE {$table} SET {$columns} WHERE `user_id` = {$user_id} ";
            if ($stmt = $this->pdo->prepare($sql)){
                foreach ($fields as $key => $value) {
                    $stmt->bindValue(':'.$key, $value);
                }
                /*$stmt->execute();*/
                if ($stmt->execute()) {
                    return "ok";
                }else{
                    return false;
                }
                /*var_dump($user_id);*/
            }
        }

        // to check if he already login
        public function loggedIn(){
            return (isset($_SESSION['user_id'])) ? true : false;
        }


        // this part is to use all the data from the user
        public function userIdByName($fname){
            $stmt = $this->pdo->prepare("SELECT `user_id` FROM `users` WHERE `fname` = :fname ");
            $stmt->bindParam(":fname", $fname, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user->user_id;
        }

        // this is to upload images
        public function uploadImage($file){
            $filename = basename($file['name']);
            $fileTmp  = $file['tmp_name'];
            $fileSize = $file['size'];
            $error    = $file['error'];

            $ext         = explode('.', $filename);
            $ext         = strtolower(end($ext));
            $allowed_ext = array('jpg', 'png', 'jpeg');

            if (in_array($ext, $allowed_ext) === true) {
                if ($error === 0) {
                    if ($fileSize <= 209272152) {
                       $fileRoot = BASE_URL.'assets/img/users/' . $filename;
                       move_uploaded_file($fileTmp, $fileRoot);
                       return $fileRoot;
                    }else{
                      $GLOBALS['imageError'] = "esta foto es demasiado grando ";
                    }
                }
            }else{
                $GLOBALS['imageError'] = "esta extension no esta permitida ";
            }
        }

        // delete user account
        public function deleteUser($user_id){
            $stmt = $this->pdo->prepare("DELETE FROM `users` WHERE `user_id` = :user_id ");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
            /*$stmt->execute();*/
            if ($stmt->execute()) {
                return "ok";
            }else{
                return false;
            }
        }
    }
?>