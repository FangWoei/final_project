<?php

class Mission
{

    public static function getPublishmissions()
    {
            $database = new DB();
    
            return $database->fetchAll(
                "SELECT * FROM missions 
                WHERE status = 'publish'
                ORDER BY id DESC"
                ); 

    }

    public static function getmissionsByUserRole()
    {
        $database = new DB();

    if ( Auth::isAdmin() || Auth::isEditor() ){
            return $database->fetchAll( 
            "SELECT 
                missions.id, 
                missions.title, 
                missions.status, 
                users.name AS user_name 
                FROM missions 
                JOIN users 
                ON missions.user_id = users.id",
                );
            }else{
            return $database->fetchAll( 
            "SELECT 
                missions.id, 
                missions.title, 
                missions.status, 
                users.name AS user_name 
                FROM missions 
                JOIN users 
                ON missions.user_id = users.id 
                where user_id = :user_id",
            [
                'user_id' => $_SESSION["user"]["id"]
            ]
            );
            }

    }

    public static function getMissionByID()
    {
        if ( isset( $_GET['id'] ) ) {
            $database = new DB();

            return $database->fetch( 
            "SELECT 
            missions.*,
            users.name 
            FROM missions 
            JOIN users
            ON missions.done_by = users.id
            WHERE missions.id = :id",
            [
             'id' => $_GET['id']
           ]);
          
          } else {
            header("Location: /manage-missions");
            exit;
          }
    }

    public static function add()
    {

          $database = new DB();

           $title = $_POST['title'];
           $text = $_POST['text'];
           $date_start = $_POST['date_start'];
           $date_end = $_POST['date_end'];
           $cost = $_POST['cost'];
           $contact = $_POST['contact'];
        
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
            
            if ( empty( $title ) || empty($date_start) || empty($date_end)|| empty($cost)|| empty($contact)|| empty($text) ) {
                $error = 'All fields are required';
            }
        
            if( isset ($error)){
                $_SESSION['error'] = $error;
                header("Location: /manage-missions-add");
                exit;   
            }

            
                $sql = "INSERT INTO missions (`title`, `date_start`, `date_end`, `cost`, `contact`, `text`, `image`, `user_id`)
                VALUES(:title, :date_start, :date_end, :cost, :contact, :text, :image, :user_id)";
               $database->insert($sql , [
                    'title' => $title,
                    'date_start' => $date_start,
                    'date_end' => $date_end,
                    'cost' => $cost,
                    'contact' => $contact,
                    'text' => $text,
                    'image' => ( !empty( $image_name ) ? $image_name : null ), // if there is an image, put it to db. If not, set null
                    'user_id' => $_SESSION["user"]["id"]
                ]);
        
                $_SESSION["success"] = "The job has been created.";
                $_SESSION['new_mission'] = $title;
                header("Location: /manage-missions");
                exit;
        
    }

    public static function edit()
    {

          $database = new DB();

        
        $title = $_POST['title'];
        $text = $_POST['text'];
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];
        $cost = $_POST['cost'];
        $contact = $_POST['contact'];
        $original_image = $_POST['original_image'];
        $status = $_POST['status'];
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
        
        
            if(empty($title) ||empty($date_start) || empty($date_end)|| empty($cost)|| empty($contact)|| empty($text) || empty($status)){
                $error = "Make sure all the fields are filled.";
            }
            
            if ( isset( $error ) ) {
                $_SESSION['error'] = $error;
                header("Location: /manage-missions-edit?id=$id");
                exit;
            }
            
        

            $database->update(
                "UPDATE missions 
                SET title = :title, 
                date_start = :date_start,
                date_end = :date_end,
                cost = :cost,
                contact = :contact,
                text = :text, 
                image = :image,
                status = :status, 
                done_by = :done_by
                 WHERE id = :id",
                [
                'title' => $title,
                'date_start' => $date_start,
                'date_end' => $date_end,
                'cost' => $cost,
                'contact' => $contact,
                'text' => $text,
                'image' => ( !empty( $image_name ) ? $image_name : ( !empty( $original_image ) ? $original_image : null ) ),
                'status' => $status,
                'id' => $id,
                'done_by' => $_SESSION["user"]['id']
            ]);
        
        
            // set success message
            $_SESSION["success"] = "Job has been edited.";
            $_SESSION['update_mission'] = $title;
            
            // redirect
            header("Location: /manage-missions");
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
            header("Location: /manage-missions");
        exit;
    }

        $database->delete(
            "DELETE FROM missions WHERE id = :id",
            [
            'id' => $id
            ]);

        $_SESSION["success"] = "Job has been deleted.";

    header("Location: /manage-missions");
    exit;
    }
}