<?php

return [

    "home" => [
        "page_name" => "首页",
        "page_description" => "这是首页。",
        "title" => "首页",
        "guest_title" => "欢迎来到OCA",
        "guest_text" => "开始您的冒险之前，请先登录！",
        "client_title" => "欢迎回来",
        "client_text" => "内容区域",
        "new_articles_title" => "最新文章",
        "articles_description" => "内容区域",
    ],

    "connect" => [
        "page_name" => "登录",
        "page_description" => "这是登录页面。",
        "title" => "登录页面",
        "Login" => "登录",
        "Username" => "用户名",
        "Password" => "密码",
        "Confirm password" => "确认密码",
        "Email" => "电子邮箱",
        "Register" => "注册",
        "Confirm" => "确认",
        "LabelMail" => "请输入您的电子邮箱",
        "LabelPassword" => "请输入您的密码",
        "LabelPasswordConfirm" => "确认您的密码",
        "LabelUsername" => "请输入您的用户名",
        "PlaceholderEmail" => "example@mail.com",
        "PlaceholderUsername" => "我的昵称",
        "LoginError" => "邮箱或密码错误",
        "your_email" => "您的邮箱",
        "your_code" => "您的验证码",
        "input_email" => "请输入您的邮箱",
        "email_sender_desc" => "此页面用于向您的邮箱发送验证邮件。",
        "email_checker_desc" => "此页面用于验证发送到您邮箱的邮件。",
        "email_check_title" => "检查您的邮箱",
        "ask_for_link" => "给我一个新的链接！",
    ],

    "contact" => [
        "page_name" => "联系方式",
        "page_description" => "这是联系方式页面。",
        "text" => "这里可以了解我的更多信息",
        "title" => "联系方式页面",
        "contacts_list" => "联系人列表",
        "github" => "我的 Github",
        "youtube" => "我的频道",
        "gmail" => "无邮箱",
    ],

    "channels" => [
        "page_name" => "聊天频道",
        "page_description" => "这是频道页面。",
        "title" => "频道页面",

        "sidebar-menu-title" => "频道",
        "home-btn" => "首页",
        "creategroup-btn" => "创建新聊天",
        "invitation-btn" => "您的邀请",
        "block-btn" => "屏蔽",

        "no_group_found" => "未找到群组。",
        "group_without_title" => "无标题群组",
    ],

    "add" => [
        "page_name" => "聊天频道",
        "page_description" => "这是频道页面。",
        "title" => "已发送邀请",
        "send_new_invite" => "发送新邀请",
        "email" => "邀请用户邮箱",
        "send" => "发送邀请",
        "invite_list" => "已发送邀请列表",
        "no_invite_found" => "未找到邀请。",
        "unknow" => "未知邮箱",
    ],

    "members" => [
        "page_name" => "频道成员",
        "page_description" => "这是成员列表页面。",
        "title" => "群组成员列表",
        "members_of_group" => "群组成员",
        "moderator" => "主持人",
        "kick" => "踢出",
    ],

    "quit" => [
        "page_name" => "退出频道",
        "page_description" => "这是频道页面。",
        "title" => "确认退出群组？",
        "confirm" => "确认",
        "sure" => "您确定要退出该群组吗？",
        "proceed" => "继续",
    ],

    'admin' => [
        'title' => '管理',
        'meta_desc' => '管理页面',
        'meta_author' => '作者',

        'admin' => '管理员',

        'ban_user_title' => '封禁用户',
        'ban_user_email_label' => '要封禁的用户邮箱：',
        'ban_user_button' => '封禁用户',

        'unban_user_title' => '解封用户',
        'unban_user_email_label' => '要解封的用户邮箱：',
        'unban_user_button' => '解封用户',

        'delete_account_title' => '删除账户',
        'delete_account_email_label' => '要删除的用户邮箱：',
        'delete_account_button' => '删除账户',

        'create_article_title' => '创建文章',
        'article_title_label' => '标题：',
        'article_summary_label' => '摘要：',
        'article_view_path_label' => '关联 Blade 文件路径：',
        'article_view_path_placeholder' => 'articles_list.文章名称',
        'create_article_button' => '创建文章',
    ],

    "account" => [
        "page_name" => "账户",
        "page_description" => "这是账户页面。",
        "title" => "账户设置",
        "change_username" => "更改用户名",
        "new_username" => "新用户名",
        "update_username" => "更新用户名",
        "change_password" => "更改密码",
        "new_password" => "新密码",
        "confirm_password" => "确认密码",
        "update_password" => "更新密码",
    ],

    'about' => [
        'title' => '关于',
        'meta_desc' => '这是描述。',
        'meta_author' => '我是作者。',

        'main_title' => '关于该项目',

        'what_i_learned_title' => '我学到了什么',
        'what_i_learned_text' => '在开发此项目的过程中，我深入学习了Laravel框架、PostgreSQL数据库以及使用Reverb的WebSocket。此外，我提升了PHP和JavaScript技能，构建了一个功能完整、交互性强的网页应用。',

        'project_features_title' => '项目特点',
        'project_features_intro' => '该网站包含以下主要功能：',

        'feature_registration_login' => '用户注册和登录系统，允许用户创建账户并安全登录。',
        'feature_update_account' => '用户可以直接在网站上更新用户名和密码。',
        'feature_multilanguage' => '支持多语言系统，便于扩展其他语言。',
        'feature_discussion_groups' => '创建和管理讨论群组，用户可实时交流。',
        'feature_realtime_messaging' => '基于WebSocket的实时消息传递，实现页面无需刷新自动更新。',
        'feature_realtime_group_invites' => '群组邀请实时更新，用户被邀请时即时通知。',
        'feature_system_messages' => '群组内系统消息，通知用户重要事件，如加入、退出、邀请和踢出。',
        'feature_dynamic_statistics' => '动态统计页面，实时展示网站使用和活动数据。',
        'feature_dynamic_articles' => '文章页面内容动态更新，发布新文章即时显示。',
        'feature_admin_panel' => '安全的管理员面板，允许管理员封禁、解封、删除用户及创建文章。',
        'feature_data_cleanup' => '额外功能，如内存中未使用数据的自动清理——例如删除无成员的消息和群组。',
        'feature_two_factor_auth' => '改进的注册流程，包含通过邮箱发送验证码的双因素认证。',

        'conclusion_title' => '总结',
        'conclusion_text' => '该项目是一次丰富的经历，结合多项技术和理念，构建了一个复杂的实时网页应用，具备高级用户管理和管理功能。它不仅反映了我的学习成果，也体现了我创造实用互动网络解决方案的热情。',

        'source_inspiration_title' => '来源与灵感',
        'source_inspiration_text' => '灵感来自并基于Laravel官方文档以及与WebSocket和多语言支持相关的社区包。',
    ],

    "stats" => [
        "page_name" => "统计",
        "page_description" => "这是统计页面。",
        "title" => "统计",
        "big_nb" => "重要数字",
        "nb_users" => "用户注册平台，",
        "nb_conversations" => "群组会话已创建，",
        "and" => "和",
        "nb_messages" => "消息已发送。",
        "also" => "当前还有",
        "users_online" => "在线用户（每5分钟刷新）。",
        "charts" => "图表",
        "per_days" => "按天统计",
        "per_months" => "按月统计",
    ],

    "map" => [
        "page_name" => "网页地图",
        "page_description" => "这是网页地图页面。",
        "title" => "网页地图",
        "home" => "首页",
        "about" => "关于",
        "contact" => "联系方式",
        "stats" => "统计",
        "map" => "地图",
        "signin" => "登录",
        "email_check" => "邮箱验证",
        "email_send" => "发送邮件",
        "channels" => "频道",
        "add" => "添加",
        "members_list" => "成员列表",
        "quit" => "退出",
        "articles" => "文章",
        "tech" => "技术",
        "admin" => "管理",
    ],

    "tech" => [
        "page_name" => "技术页面",
        "page_description" => "这是技术页面。",
        "title" => "技术页面",
        "tests" => "测试",
        "user_ip" => "用户IP",
        "web_navigator" => "网页浏览器 (User-agent)",
        "country" => "国家",
        "city" => "城市",
        "lat" => "纬度",
        "long" => "经度",
        "unknow" => "未知",
        "not_available" => "不可用",
    ],

];
