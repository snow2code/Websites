<?php
global $userbank, $theme;

$navbar = [
     [
        'title' => 'Home',
        'endpoint' => 'home',
        'description' => 'Home page.',
        'permission' => true
    ],
    [
        'title' => 'About',
        'endpoint' => 'about',
        'description' => 'About my server',
        'permission' => true
    ],
    [
        'title' => 'Server Info',
        'endpoint' => 'server_info',
        'description' => 'Info about my server',
        'permission' => true
    ],
    [
        'title' => 'Links',
        'endpoint' => 'links',
        'description' => 'I dunno',
        'permission' => true
    ],
    [
        'title' => 'Crew',
        'endpoint' => 'crew',
        'description' => '',
        'permission' => true
    ],
    [
        'title' => 'Contact',
        'endpoint' => 'contact',
        'description' => '',
        'permission' => true
    ],
    [
        'title' => 'Whitelist Request',
        'endpoint' => 'whitelist_request',
        'description' => 'Request to be on the whitelist',
        'permission' => true
    ],
    

    [
        'title' => 'Admin Panel',
        'endpoint' => 'admin',
        'description' => 'This is the control panel for SourceBans where you can setup new admins, add new server, etc.',
        'permission' => $userbank->is_admin()
    ]
];

$admin = [
    [
        'title' => 'Whitelist Requests',
        'endpoint' => 'whitelist_requests',
        'permission' => ADMIN_OWNER|ADMIN_ADD_BAN|ADMIN_EDIT_OWN_BANS|ADMIN_EDIT_GROUP_BANS|ADMIN_EDIT_ALL_BANS|ADMIN_BAN_PROTESTS|ADMIN_BAN_SUBMISSIONS
    ]
];

$active = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_SPECIAL_CHARS);
foreach ($navbar as $key => $tab) {
    $navbar[$key]['state'] = ($active === $tab['endpoint']) ? 'active' : 'nonactive';

    if (!$tab['permission']) {
        unset($navbar[$key]);
    }
}

if ($userbank->is_admin()) {
    $cat = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_SPECIAL_CHARS);
    foreach ($admin as $key => $tab) {
        $admin[$key]['state'] = ($cat === $tab['endpoint']) ? 'active' : '';

        if (!$userbank->HasAccess($tab['permission'])) {
            unset($admin[$key]);
        }
    }
}

$theme->assign('navbar', array_values($navbar));
$theme->assign('adminbar', array_values($admin));
$theme->assign('isAdmin', $userbank->is_admin());
$theme->assign('login', $userbank->is_logged_in());
$theme->assign('username', $userbank->GetProperty("user"));
$theme->display('core/navbar.tpl');
