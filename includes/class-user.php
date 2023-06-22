<?php

class User
{

    public static function getUsers()
    {
        $database = new DB();
        return $database->fetchAll(
            "SELECT * FROM users");
      
    }


    public static function getUserByID( $user_id )
    {
     if ( isset( $_GET['id'] ) ) {
        $database = new DB();
  
        return $database->fetch(
        "SELECT * FROM users WHERE id = :id",
          [
            'id' => $_GET['id']
          ]
          );
  
        if ( !Auth::isUserLoggedIn() ) {
          header("Location: /manage-users");
          exit;
        }
  
      } else {
        header("Location: /manage-users");
        exit;
      }
    }

    public static function add()
    {

       $db = new DB();

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $role = $_POST["role"];
            
       $user = $db->fetch(
            "SELECT * FROM users WHERE email = :email",
        
            [
                'email'=>$email
            ]
        
        );

       
        if ( empty( $name ) || empty($email) || empty($password) || empty($confirm_password) || empty($role)  ) {
            $error = 'All fields are required';
        } else if ( $password !== $confirm_password ) {
            $error = 'The password is not match.';
        } else if ( strlen( $password ) < 8 ) {
            $error = "Your password must be at least 8 characters";
        } else if ( $user ) {
            $error = "The email you inserted has already been used by another user. Please insert another email.";
        }


        if( isset ($error)){
            $_SESSION['error'] = $error;
            header("Location: /manage-users-add");    
            exit;
        } 
            
        $sql = "INSERT INTO users (`name`, `email`, `password`,`role` )
        VALUES(:name, :email, :password, :role)";
        $db->insert($sql , [
            'name' => $name,
            'email' => $email,
            'password' => password_hash( $password, PASSWORD_DEFAULT),
            'role' => $role
        ]);

            $_SESSION["success"] = "New user has been created.";
            $_SESSION['new_user_email'] = $email;
            header("Location: /manage-users");
            exit;
    }

    public static function edit()
    {
        $db = new DB();

        $role = $_POST['role'];
        $id = $_POST['id'];

        if(empty($role) || empty($id)){
            $error = "Please enter fields";
        }
        if(isset($error)){
            $_SESSION['error'] = $error;
            header("Location: /manage-users-edit?id=$id");
            exit;
        }

        $sql = "UPDATE users set role = :role WHERE id = :id";
        $db->update(
            $sql,
            [
                'role' => $role,
                'id' => $id
            ]);
        header("Location: /manage-users");
        exit;
    }


    public static function delete()
    {
        $db = new DB();

        $id = $_POST["id"];

        if (empty($id)){
            $error = "Error!";
        }
    
        if ( isset( $error ) ) {
            $_SESSION['error'] = $error;
            header("Location: /manage-users");
            exit;
        }
    
        $db->delete(
            "DELETE FROM users WHERE id = :id",
            [
                'id' => $id
            ]
            );
            
        $_SESSION["success"] = "user has been deleted.";
    
        header("Location: /manage-users");
        exit;
    }

    public static function actAsUser()
    {
        $db = new DB();

        // get the user id that we want to act as
        $id = $_POST['id'];

        $act_as_user = $db->fetch(
            "SELECT * FROM users where id = :id",
            [
                'id' => $id
            ]
        );

        // store the current logged in user in another session
        $_SESSION['original_user'] = $_SESSION["user"];

        // replace the current user session with the act as user
        $_SESSION["user"] = $act_as_user;

        // redirect back to home page
        header("Location: /dashboard");
        exit;
    }

    public static function stopActing()
    {
        // replace the origina user session with the current user session
        $_SESSION["user"] = $_SESSION['original_user'];
        // once we overwrite, then we unset the original user session
        unset( $_SESSION['original_user'] );
         // redirect back to home page
         header("Location: /manage-users");
         exit;  
    }
}
