<?php

class Leave
{

    public static function getLeavesByUserRole()
    {
        $database = new DB();

    if ( Auth::isAdmin() ){
            return $database->fetchAll( 
            "SELECT 
                leaves.id, 
                leaves.name, 
                leaves.answer, 
                users.email AS user_email 
                FROM leaves 
                JOIN users 
                ON leaves.user_id = users.id",
                );
            }else{
            return $database->fetchAll( 
            "SELECT 
                leaves.id, 
                leaves.name, 
                leaves.answer, 
                users.email AS user_email 
                FROM leaves
                JOIN users 
                ON leaves.user_id = users.id 
                where user_id = :user_id",
            [
                'user_id' => $_SESSION["user"]["id"]
            ]
            );
            }

    }

    public static function getLeaveByID()
    {
        if ( isset( $_GET['id'] ) ) {
            $database = new DB();

            return $database->fetch( 
            "SELECT 
            leaves.*,
            users.email 
            FROM leaves
            JOIN users
            WHERE leaves.id = :id",
            [
             'id' => $_GET['id']
           ]);
          
          } else {
            header("Location: /manage-leaves");
            exit;
          }
    }

    public static function add()
    {

          $database = new DB();

           $name = $_POST['name'];
           $date_start = $_POST['date_start'];
           $date_end = $_POST['date_end'];
           $reason = $_POST['reason'];
           $reasons = $_POST['reasons'];

           // catch the image file
           $image = $_FILES['image'];
           // get image file name
           $image_name = $image['name'];
           
           // add image to the uploads folder
           if ( !empty( $image_name ) ) {
                // target the uploads folder
                $target_dir = "uploads/";
                // add the image name to the uploads folder
                $target_file = $target_dir . basename( $image_name ); // output: uploads/fs.jpg
                // move the file to the uploads folder
                move_uploaded_file( $image["tmp_name"], $target_file );
            }
            
            if ( empty( $name ) || empty($date_start) || empty($date_end) || empty($reason) ) {
                $error = 'All fields are required';
            }
        
            if( isset ($error)){
                $_SESSION['error'] = $error;
                header("Location: /manage-leaves-add");
                exit;   
            }

            
                $sql = "INSERT INTO leaves (`name`, `date_start`, `date_end`, `reason`, `reasons`, `image`, `user_id`)
                VALUES(:name, :date_start, :date_end, :reason, :reasons, :image, :user_id)";
                $database->insert($sql , [
                    'name' => $name,
                    'date_start' => $date_start,
                    'date_end' => $date_end,
                    'reason' => $reason,
                    'reasons' => $reasons,
                    'image' => ( !empty( $image_name ) ? $image_name : null ), // if there is an image, put it to db. If not, set null
                    'user_id' => $_SESSION["user"]["id"]
                ]);
        
                $_SESSION["success"] = "New leaves has been created.";
                $_SESSION['new_post'] = $name;
                header("Location: /manage-leaves");
                exit;
        
    }

    public static function edit()
    {

          $database = new DB();

        
            $name = $_POST['name'];
            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $reason = $_POST['reason'];
            $reasons = $_POST['reasons'];
            $original_image = $_POST['original_image'];
            $id = $_POST['id'];
        
             // catch the image file
             $image = $_FILES['image'];
             // get image file name
             $image_name = $image['name'];
             
             // add image to the uploads folder
             if ( !empty( $image_name ) ) {
                // target the uploads folder
                $target_dir = "uploads/";
                // add the image name to the uploads folder
                $target_file = $target_dir . basename( $image_name ); // output: uploads/fs.jpg
                // move the file to the uploads folder
                move_uploaded_file( $image["tmp_name"], $target_file );
             }
         
        
            if(empty($name) || empty($date_start) || empty($date_end) || empty($reason)){
                $error = "Make sure all the fields are filled.";
            }
            
            if ( isset( $error ) ) {
                $_SESSION['error'] = $error;
                header("Location: /manage-leaves-edit?id=$id");
                exit;
            }
            
        

            $database->update(
                "UPDATE leaves
                SET name = :name,
                date_start = :date_start,
                date_end = :date_end,
                reason = :reason,
                reasons = :reasons,
                image = :image
                WHERE id = :id",
                [
                'name' => $name,
                'date_start' => $date_start,
                'date_end' => $date_end,
                'reason' => $reason,
                'reasons' => $reasons,
                'image' => ( !empty( $image_name ) ? $image_name : ( !empty( $original_image ) ? $original_image : null ) ),
                'id' => $id,
            ]);
        
    
            $_SESSION["success"] = "leaves has been edited.";
            $_SESSION['update_post'] = $name;
            
            // redirect
            header("Location: /manage-leaves");
            exit;
    }

    public static function approve()
    {

          $database = new DB();

        
            $answer = $_POST['answer'];
            $id = $_POST['id'];
        
        
            if(empty($answer)){
                $error = "Make sure all the fields are filled.";
            }
            
            if ( isset( $error ) ) {
                $_SESSION['error'] = $error;
                header("Location: /manage-leaves-approve?id=$id");
                exit;
            }
            
        

            $database->update(
                "UPDATE leaves
                SET answer = :answer
                WHERE id = :id",
                [
                'answer' => $answer,
                'id' => $id,
            ]);
        
    
            $_SESSION["success"] = "leaves has been answer.";
            $_SESSION['update_post'] = $name;
            
            // redirect
            header("Location: /manage-leaves");
            exit;
    }

    public static function delete()
    {
        
  if ( !Auth::isUserLoggedIn() ) {
    header("Location: /");
    exit;
  }

  $database = new DB();


    $id = $_POST["id"];

    if (empty($id)){
        $error = "Error!";
    }

    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /manage-leaves");
        exit;
    }

    $database->delete(
        "DELETE FROM leaves WHERE id = :id",
        [
        'id' => $id
    ]);

    $_SESSION["success"] = "Post has been deleted.";

    header("Location: /manage-leaves");
    exit;
    }
}