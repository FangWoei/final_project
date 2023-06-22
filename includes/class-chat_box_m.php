<?php

class Chat_M
{

    public static function getChat_MByMissionID( $mission_id )
    {

        $database = new DB();

        return $database->fetchAll(
        "SELECT
        chat_mission.*,
        users.name,
        users.role
        FROM chat_mission
        JOIN users
        ON chat_mission.user_id = users.id
        WHERE mission_id = :mission_id ORDER BY id DESC",
        [
        "mission_id" => $mission_id
        
        ]);

    }

    public static function add()
    {
        if ( !Auth::isUserLoggedIn() ) {
            header("Location: /");
            exit;
        }
    
        $database = new DB();
        $chat = $_POST['chat'];
        $mission_id = $_POST['mission_id'];
        $user_id = $_POST['user_id'];
    
        // do error checking
        if ( empty( $chat ) || empty( $mission_id ) || empty( $user_id ) ) {
            $error = "Please fill out all the things";
        }
        
        if( isset ($error)){
            $_SESSION['error'] = $error;
            header("Location: /missions?id=$mission_id" ); 
            exit;
        }
    
        // insert the comment into database
        $database->insert(
        "INSERT INTO chat_mission (`chat`, `mission_id`, `user_id`)
        VALUES(:chat, :mission_id, :user_id)",
        [
            'chat' => $chat,
            'mission_id' => $mission_id,
            'user_id' => $user_id
        ]);
        
        header("Location: /missions?id=$mission_id" );
        exit;
    }
}