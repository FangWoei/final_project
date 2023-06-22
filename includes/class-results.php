<?php

class Result
{

    public static function getResultByID()
    {
        if ( isset( $_GET['id'] ) ) {
            $database = new DB();

            return $database->fetch(
                "SELECT results.*
                FROM results"
            );
        }
    }

    public static function getResultfromMission()
    {
        if ( isset( $_GET['id'] ) ) {
        $database = new DB();
        return $database->fetch(
            "SELECT 
            results.*,
            missions.title,
            missions.date_start,
            missions.date_end,
            missions.cost,
            missions.contact,
            missions.text,
            missions.image
            FROM missions
            LEFT JOIN results
            ON results.missions_id = missions.id
            WHERE missions.id = :id",
        [
            'id' => $_GET['id']
        ]    
        );
        }
    }

    public static function getResultByUserRole()
    {
        $database = new DB();

    if ( Auth::isAdmin() || Auth::isEditor() ){
            return $database->fetchAll( 
            "SELECT 
                results.id, 
                results.title,
                results.done_by,
                users.name AS user_name 
                FROM results
                JOIN users 
                ON results.user_id = users.id",
                );
            }else{
            return $database->fetchAll( 
            "SELECT 
                results.id, 
                results.title,
                results.done_by,
                users.name AS user_name 
                FROM results 
                JOIN users 
                ON results.user_id = users.id 
                where user_id = :user_id",
            [
                'user_id' => $_SESSION["user"]["id"]
            ]
            );
            }

    }

    public static function add()
    {

          $database = new DB();

            $image = $_POST['image'];
            $title = $_POST['title'];
            $text = $_POST['text'];
            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $cost = $_POST['cost'];
            $contact = $_POST['contact'];
            $results = $_POST['results'];
            $done_by = $_POST['done_by'];
            $id = $_POST['id'];
        
             $results_image = $_FILES['results_image'];
             $image_name = $results_image['name'];
             
             if ( !empty( $image_name ) ) {
                  $target_dir = "uploads/";
                  $target_file = $target_dir . basename( $image_name );
                  move_uploaded_file( $results_image["tmp_name"], $target_file );
              }
            
            if ( empty($title) 
            || empty($date_start) 
            || empty($date_end)
            || empty($cost)
            || empty($contact)
            || empty($text) 
            || empty($results)
            || empty($done_by)
            || empty($id)
            ) {
                $error = 'All fields are required';
            }
        
            if( isset ($error)){
                $_SESSION['error'] = $error;
                header("Location: /results?id=$id");
                exit;   
            }

            
                $sql = "INSERT INTO 
                results (
                    `title`,
                    `date_start`,
                    `date_end`,
                    `cost`, 
                    `contact`, 
                    `text`, 
                    `image`,
                    `results`,
                    `done_by`,
                    `results_image`,
                    `user_id`,
                    `missions_id`)
                VALUES(
                :title, 
                :date_start, 
                :date_end, 
                :cost, 
                :contact, 
                :text, 
                :image, 
                :results,
                :done_by,
                :results_image,
                :user_id,
                :missions_id
                )";
                $database->insert($sql , [
                    'title' => $title,
                    'date_start' => $date_start,
                    'date_end' => $date_end,
                    'cost' => $cost,
                    'contact' => $contact,
                    'text' => $text,
                    'results_image' => ( !empty( $image_name ) ? $image_name : null ),
                    'image' => $image,
                    'results' => $results,
                    'done_by' => $done_by,
                    'user_id' => $_SESSION["user"]["id"],
                    'missions_id' => $id
                ]);

                $_SESSION["success"] = "The result has been created.";
                $_SESSION['new_results'] = $title;
                header("Location: /manage-results");
                exit;
        
    }

    public static function edit()
    {
        $database = new DB();

        $results = $_POST['results'];
        $done_by = $_POST['done_by'];
        $profile_image = $_POST['profile_image'];
        $id = $_POST['id'];

        
        $answer_image = $_FILES['answer_image'];
        $image_name = $answer_image['name'];

    if ( !empty( $answer_image_name ) ) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename( $answer_image_name );
        move_uploaded_file( $answer_image["background_tmp_name"], $target_file );
    }

    if(empty($results) || empty($done_by) || empty($id) ){
        $error = "Please enter fields";
    }
    if(isset($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-profiles-edit?id=$id");
        exit;
    }

    $sql = "UPDATE results set
    results = :results,
    done_by = :done_by
    WHERE id = :id";
    $database->update(
        $sql,
        [
            'results' => $results,
            'done_by' => $done_by,
            'id' => $id
        ]
    );

    $_SESSION["success"] = "Results has been changed.";

    header("Location: /manage-results");
    exit;
    }

//     public static function delete()
//     {
        
//         $database = new DB();

//         $image = $_POST['image'];
//         $title = $_POST['title'];
//         $text = $_POST['text'];
//         $date_start = $_POST['date_start'];
//         $date_end = $_POST['date_end'];
//         $cost = $_POST['cost'];
//         $contact = $_POST['contact'];
//         $id = $_POST['id'];
    
//         if ( empty($title) 
//         || empty($date_start) 
//         || empty($date_end)
//         || empty($cost)
//         || empty($contact)
//         || empty($text)
//         || empty($id)
//         ) {
//             $error = 'All fields are required';
//         }
    
//         if( isset ($error)){
//             $_SESSION['error'] = $error;
//             header("Location: /results?id=$id");
//             exit;   
//         }

        
//             $sql = "INSERT INTO 
//             missions (
//                 `title`,
//                 `date_start`,
//                 `date_end`,
//                 `cost`, 
//                 `contact`, 
//                 `text`, 
//                 `image`,
//                 `user_id`)
//             VALUES(
//             :title, 
//             :date_start, 
//             :date_end, 
//             :cost, 
//             :contact, 
//             :text, 
//             :image, 
//             :user_id
//             )";

//             $database->insert($sql , [
//                 'title' => $title,
//                 'date_start' => $date_start,
//                 'date_end' => $date_end,
//                 'cost' => $cost,
//                 'contact' => $contact,
//                 'text' => $text,
//                 'image' => $image,
//                 'user_id' => $_SESSION["user"]["id"]
//             ]);
//             $database->delete(
//                 "DELETE FROM results WHERE id = :id",
//                 [
//                     'id' => $id
//                 ]);
                
//                 $_SESSION["success"] = "The mission has been created.";
//                 $_SESSION['new_results'] = $title;
//             header("Location: /manage-missions");
//             exit;
//     }
}