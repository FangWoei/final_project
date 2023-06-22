<?php

class Profile
{

    public static function getProfiles()
    {

        $database = new DB();
        return $database->fetch(
            "SELECT 
            users.*,
            profiles.age,
            profiles.from_where,
            profiles.study_at,
            profiles.hobi,
            profiles.background_image,
            profiles.introduce
            FROM users
            LEFT JOIN profiles
            ON profiles.user_id = users.id
            WHERE users.id = :id",
            [
                'id' => $_GET['id']
            ]
            );

    }
    public static function getProfileByID( $user_id )
    {
        if ( isset( $_GET['id'] ) ) {
            $database = new DB();

            return $database->fetch(
            "SELECT 
            profiles.*
            FROM users
            LEFT JOIN profiles
            ON profiles.user_id = users.id
            WHERE users.id = :id",
            [
             'id' => $_GET['id']
           ]);
          
          } else {
            header("Location: /manage-profiles");
            exit;
          }
    }

    public static function getProfileByUser( $user_id )
    {
     if ( isset( $_GET['id'] ) ) {
        $database = new DB();
  
        return $database->fetch(
        "SELECT * FROM users WHERE id = :id",
          [
            'id' => $_GET['id']
          ]
          );
  
      } else {
        header("Location: /manage-profiles");
        exit;
      }
    }
    

    public static function getProfilesUsers()
    {
        $database = new DB();
        return $database->fetch(
            "SELECT * FROM users
            where id = :id",
        [
            'id' => $_SESSION['user']['id']
        ]);
      
    }
    
    public static function changepwd()
    {
        $db = new DB();

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST["confirm_password"];
        $original_image = $_POST['original_image'];
        $id = $_POST['id'];

          $image = $_FILES['image'];
          $image_name = $image['name'];

      if ( !empty( $image_name ) ) {
          $target_dir = "uploads/";
          $target_file = $target_dir . basename( $image_name );
          move_uploaded_file( $image["tmp_name"], $target_file );
      }

        if(empty($name) || empty($email) || empty($id) || empty($password) || empty($confirm_password)){
            $error = "Please enter fields";
        }else if ( $password !== $confirm_password ) {
            $error = 'The password is not match.';
        }else if ( strlen( $password ) < 8 ) {
            $error = "Your password must be at least 8 characters";
        }else{
            $sql = "SELECT * FROM users WHERE email = :email AND id != :id";
            $user = $db->fetch(
                $sql,
                [
                   'email' => $email,
                    'id' => $id 
                ]);

            if ($user){
                $error = "The email provided does not exists";
            }
        }

        if(isset($error)){
            $_SESSION['error'] = $error;
            header("Location: /manage-profiles-changepwd?id=$id");
            exit;
        }
        $sql = "UPDATE users set 
        name = :name,
        email = :email,
        password = :password,
        image = :image
        WHERE id = :id";
        $db->update(
            $sql,
            [
                'name' => $name,
                'email' => $email,
                'password' => password_hash( $password, PASSWORD_DEFAULT ),
                'image' => ( !empty( $image_name ) ? $image_name : ( !empty( $original_image ) ? $original_image : null ) ),
                'id' => $id
            ]);

        $_SESSION["success"] = "Profile has been changed.";
        
        header("Location: /manage-profiles");
        exit;
    }

    public static function edit()
    {
        $db = new DB();

        $age = $_POST['age'];
        $from_where = $_POST['from_where'];
        $study_at = $_POST['study_at'];
        $hobi = $_POST["hobi"];
        $introduce = $_POST["introduce"];
        $profile_image = $_POST['profile_image'];
        $id = $_POST['id'];

          $background_image = $_FILES['background_image'];
          $image_name = $background_image['name'];

      if ( !empty( $background_image_name ) ) {
          $target_dir = "uploads/";
          $target_file = $target_dir . basename( $background_image_name );
          move_uploaded_file( $background_image["background_tmp_name"], $target_file );
      }

        if(empty($age) || empty($from_where) || empty($study_at) || empty($hobi) || empty($introduce) || empty($id)){
            $error = "Please enter fields";
        }

        if(isset($error)){
            $_SESSION['error'] = $error;
            header("Location: /manage-profiles-edit?id=$id");
            exit;
        }

        header("Location: /manage-profiles");
        exit;
    }




}