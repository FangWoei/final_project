<?php

    session_start();

     require "includes/class-db.php";
     require "includes/class-auth.php";
     require "includes/class-comment.php";
     require "includes/class-leaves.php";
     require "includes/class-mission.php";
     require "includes/class-post.php";
     require "includes/class-profiles.php";
     require "includes/class-results.php";
     require "includes/class-user.php";
     require "includes/class-chat_box_m.php";



    $path = parse_url( $_SERVER["REQUEST_URI"], PHP_URL_PATH );

    $path = trim( $path, '/' );

    switch ($path) {
        //chat_m
        case 'chats/add':
            Chat_M::add();
            break;
        //chat_m

        //comments
        case 'comments/add':
            Comment::add();
            break;

        //comments

        //auth
        case 'auth/login':
            Auth::login();
            break;

        case 'auth/signup':
            Auth::signup();
            break;
        //auth

        //posts
        case "posts/add":
            Post::add();
            break;
        case "posts/delete":
            Post::delete();
            break;
        case "posts/edit":
            Post::edit();
            break;
        case 'manage-posts':
            require "pages/posts/manage-posts.php";
            break;
        case 'manage-posts-add':
            require "pages/posts/manage-posts-add.php";
            break;
        case 'manage-posts-edit':
            require "pages/posts/manage-posts-edit.php";
            break;
        case 'post':
            require "pages/posts/post.php";
            break;
        case 'home_post':
            require "pages/posts/home_post.php";
            break;
        //posts

        //leaves
        case "leaves/approve":
            Leave::approve();
            break;
        case "leaves/add":
            Leave::add();
            break;
        case "leaves/delete":
            Leave::delete();
            break;
        case "leaves/edit":
            Leave::edit();
            break;
        case 'leaves':
            require "pages/leaves/leaves.php";
            break;
        case 'manage-leaves-approve':
            require "pages/leaves/manage-leaves-approve.php";
            break;
        case 'manage-leaves-edit':
            require "pages/leaves/manage-leaves-edit.php";
            break;
        case 'manage-leaves-add':
            require "pages/leaves/manage-leaves-add.php";
            break;
        case 'manage-leaves':
            require "pages/leaves/manage-leaves.php";
            break;

        //leaves

        //profiles
        case 'profiles/changepwd':
            Profile::changepwd();
            break;
        case 'profiles/edit':
            Profile::edit();
            break;
        case 'manage-profiles':
            require "pages/profiles/manage-profiles.php";
            break;
        case 'profiles':
            require "pages/profiles/profiles.php";
            break;
        case 'manage-profiles-edit':
            require "pages/profiles/manage-profiles-edit.php";
            break;
        case 'manage-profiles-changepwd':
            require "pages/profiles/manage-profiles-changepwd.php";
            break;
        //profiles

        //missions
        case "missions/add":
            Mission::add();
            break;
        case "missions/delete":
            Mission::delete();
            break;
        case "missions/edit":
            Mission::edit();
            break;
        case 'manage-missions-add':
            require "pages/missions/manage-missions-add.php";
            break;
        case 'manage-missions-edit':
            require "pages/missions/manage-missions-edit.php";
            break;
        case 'home_missions':
            require "pages/missions/home_missions.php";
            break;
        case 'missions':
            require "pages/missions/missions.php";
            break;
        case 'manage-missions':
            require "pages/missions/manage-missions.php";
            break;

        //missions

        //results
        case 'results/delete':
            Result::delete();
            break;
        case 'results/edit':
            Result::edit();
            break;
        case 'results/add':
            Result::add();
            break;
        case 'home_results':
            require "pages/results/home_results.php";
            break;
        case 'results':
            require "pages/results/results.php";
            break;
        case 'manage-results':
            require "pages/results/manage-results.php";
            break;
        case 'manage-results-edit':
            require "pages/results/manage-results-edit.php";
            break;       
        //results

        //users
        case "users/act-as-user":
            User::actAsUser();
            break;
        case "users/stop-acting":
            User::stopActing();
            break;
        case "users/edit":
            User::edit();
            break;
        case "users/delete":
            User::delete();
            break;
        case "users/add":
            User::add();
            break;
        case 'manage-users':
            require "pages/users/manage-users.php";
            break;
        case 'manage-users-add':
            require "pages/users/manage-users-add.php";
            break;
        case 'manage-users-edit':
            require "pages/users/manage-users-edit.php";
            break;
        //users


        //pages
        case 'dashboard':
            require "pages/dashboard.php";
            break;

        case 'logout':
            require "pages/logout.php";
            break;

        case 'login':
            require "pages/login.php";
            break;

        case 'signup':
            require "pages/signup.php";
            break;

        case 'logout':
            require "pages/logout.php";
            break;
        
        default:
            require "pages/home.php";
            break;
        //pages

    }