<?php

return [

    "home" => [
        "page_name" => "Home",
        "page_description" => "This is the home page.",
        "title" => "Home page",
        "guest_title" => "Welcome on OCA",
        "guest_text" => "In order to begin your adventure you should sign in !",
        "client_title" => "Welcome back",
        "client_text" => "Content of the section",
        "new_articles_title" => "New articles",
        "articles_description" => "Content of the section",
    ],

    "connect" => [
        "page_name" => "Sign in",
        "page_description" => "This is the Sign In page.",
        "title" => "Sign In page",
        "Login" => "Login",
        "Username" => "Username",
        "Password" => "Password",
        "Confirm password" => "Confirm password",
        "Email" => "Email",
        "Register" => "Register",
        "Confirm" => "Confirm",
        "LabelMail" => "Enter your email address",
        "LabelPassword" => "Enter your password",
        "LabelPasswordConfirm" => "Confirm your password",
        "LabelUsername" => "Enter your username",
        "PlaceholderEmail" => "english@mail.com",
        "PlaceholderUsername" => "myusername",
        "LoginError" => "Email or password incorrect",
        "your_email" => "Your email",
        "your_code" => "Your code",
        "input_email" => "Enter your email",
        "email_sender_desc" => "This page is for sending a check email to your address.",
        "email_checker_desc" => "This page is for checking an email sent to your address.",
        "email_check_title" => "Check your Mail",
        "ask_for_link" => "Give me a new link !",
    ],

    "contact" => [
        "page_name" => "Contact",
        "page_description" => "This is the contact page.",
        "text" => "This the places where you can find more about my work",
        "title" => "Contact page",
        "contacts_list" => "List of contacts",
        "github" => "My github",
        "youtube" => "My channel",
        "gmail" => "No-email",
    ],

    "channels" => [
        "page_name" => "Chatting",
        "page_description" => "This is the channels page.",
        "title" => "Channel page",

        "sidebar-menu-title" => "Channels",
        "home-btn" => "Home",
        "creategroup-btn" => "Create a new chat",
        "invitation-btn" => "Your invitations",
        "block-btn" => "Block",

        "no_group_found" => "No groups found.",
        "group_without_title" => "Group without title",
    ],

    "add" => [
        "page_name" => "Chatting",
        "page_description" => "This is the channels page.",
        "title" => "Invitations send",
        "send_new_invite" => "Send a new invitation",
        "email" => "Email of the user to invite",
        "send" => "Send invitation",
        "invite_list" => "Invitation send list",
        "no_invite_found" => "No invitations found.",
        "unknow" => "Unknow mail",

    ],

    "members" => [
        "page_name" => "Channel members",
        "page_description" => "This is the members listing page.",
        "title" => "Members group list",
        "members_of_group" => "Members of the group",
        "moderator" => "Moderator",
        "kick" => "Kick",

    ],

    "quit" => [
        "page_name" => "Leave channel",
        "page_description" => "This is the channels page.",
        "title" => "Leave the group?",
        "confirm" => "Confirm",
        "sure" => "Are you sure you want to leave the group",
        "proceed" => "Proceed",
    ],

    'admin' => [
        'title' => 'Admin',
        'meta_desc' => 'Administration page',
        'meta_author' => 'The author',

        'admin' => 'Admin',

        'ban_user_title' => 'Ban a user',
        'ban_user_email_label' => 'Email of the user to ban:',
        'ban_user_button' => 'Ban user',

        'unban_user_title' => 'Unban a user',
        'unban_user_email_label' => 'Email of the user to unban:',
        'unban_user_button' => 'Unban user',

        'delete_account_title' => 'Delete an account',
        'delete_account_email_label' => 'Email of the user to delete:',
        'delete_account_button' => 'Delete account',

        'create_article_title' => 'Create an article',
        'article_title_label' => 'Title:',
        'article_summary_label' => 'Summary:',
        'article_view_path_label' => 'Linked Blade file:',
        'article_view_path_placeholder' => 'articles_list.NameOfTheArticles',
        'create_article_button' => 'Create article',
    ],

    "account" => [
        "page_name" => "Sign in",
        "page_description" => "This is the Sign In page.",
        "title" => "Account settings",
        "change_username" => "Change username",
        "new_username" => "New username",
        "update_username" => "Update username",
        "change_password" => "Change password",
        "new_password" => "New password",
        "confirm_password" => "Confirm password",
        "update_password" => "Update password",

    ],

    'about' => [
        'title' => 'Home',
        'meta_desc' => 'This is the description.',
        'meta_author' => 'I am the author.',

        'main_title' => 'About This Project',

        'what_i_learned_title' => 'What I Learned',
        'what_i_learned_text' => 'During the development of this project, I deepened my knowledge in several areas including the Laravel framework, PostgreSQL databases, and WebSockets using Reverb. Additionally, I improved my skills in PHP and JavaScript, which allowed me to build a fully functional and interactive web application.',

        'project_features_title' => 'Project Features',
        'project_features_intro' => 'This website includes the following key features:',

        'feature_registration_login' => 'User registration and login system, allowing users to create accounts and securely access the site.',
        'feature_update_account' => 'Ability for users to update their username and password directly on the site.',
        'feature_multilanguage' => 'A multi-language system that is easy to extend to support additional languages.',
        'feature_discussion_groups' => 'A system to create and manage discussion groups, where users can communicate in real-time.',
        'feature_realtime_messaging' => 'Real-time messaging within groups, powered by WebSockets, enabling automatic message updates without page refreshes.',
        'feature_realtime_group_invites' => 'Real-time updates for group invitations, so users are notified instantly when invited to a group.',
        'feature_system_messages' => 'System messages within groups that notify members of important events such as users joining, leaving, being invited, or being removed from the group.',
        'feature_dynamic_statistics' => 'A dynamic statistics page that displays live data about site usage and activity.',
        'feature_dynamic_articles' => 'An articles page with content that updates dynamically as new articles are published.',
        'feature_admin_panel' => 'A secure admin panel that allows administrators to ban, unban, delete users, and create new articles.',
        'feature_data_cleanup' => 'Additional features like automatic cleanup of unused data in memory — for example, removing messages and groups when no members remain.',
        'feature_two_factor_auth' => 'An enhanced account creation process including two-factor authentication via a confirmation code sent by email.',

        'conclusion_title' => 'Conclusion',
        'conclusion_text' => 'This project has been an enriching experience, combining multiple technologies and concepts to build a complex, real-time web application with strong user management and administration features. It reflects not only what I have learned but also my passion for creating useful and interactive web solutions.',

        'source_inspiration_title' => 'Source & Inspiration',
        'source_inspiration_text' => 'Inspired and based on the official Laravel documentation and community packages related to WebSockets and multi-language support.',
    ],

    "stats" => [
        "page_name" => "Statistics",
        "page_description" => "This is the statistics page.",
        "title" => "Statistics",
        "big_nb" => "Big numbers",
        "nb_users" => "users have registered on the platform,",
        "nb_conversations" => "group conversations have been created,",
        "and" => "and ",
        "nb_messages" => "messages have been exchanged.",
        "also" => "Also there is currently",
        "users_online" => "users online (it refreshs every 5 minutes).",
        "charts" => "Charts",
        "per_days" => "Per days",
        "per_months" => "Per months",
    ],

    "map" => [
        "page_name" => "Web Map",
        "page_description" => "This is the web map page.",
        "title" => "Web Map",
        "home" => "Home",
        "about" => "About",
        "contact" => "Contact",
        "stats" => "Statistics",
        "map" => "Map",
        "signin" => "Sign in",
        "email_check" => "Email check",
        "email_send" => "Email send",
        "channels" => "Channels",
        "add" => "Add",
        "members_list" => "Members list",
        "quit" => "Quit",
        "articles" => "Articles",
        "tech" => "Tech",
        "admin" => "Admin",
    ],

    "tech" => [
        "page_name" => "Tech page",
        "page_description" => "This is the tech page.",
        "title" => "Tech page",
        "tests" => "Tests",
        "user_ip" => "User IP",
        "web_navigator" => "Web Navigator (User-agent)",
        "country" => "Country",
        "city" => "City",
        "lat" => "Latitude",
        "long" => "Longitude",
        "unknow" => "Unknow",
        "not_available" => "Not available",
        ],

];
