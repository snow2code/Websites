<?php

/**
 * @param $fallback
 * @return array
 * @throws ErrorException
 */
function route($fallback)
{
    $page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_SPECIAL_CHARS);
    $categorie = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_SPECIAL_CHARS);
    $option = filter_input(INPUT_GET, 'o', FILTER_SANITIZE_SPECIAL_CHARS);

    switch ($page) {
        case 'login':
            switch ($option) {
                case 'steam':
                    require_once 'includes/auth/openid.php';
                    new SteamAuthHandler(new LightOpenID(Host::complete()), $GLOBALS['PDO']);
                    exit();
                default:
                    return ['Login', '/page.login.php'];
            }
        // case 'signup':
        //     return ['Signup', '/page.signup.php'];
        // case 'lostpassword':
        //     return ['Lost your password', '/page.lostpassword.php'];
        case 'logout':
            Auth::logout();
            header('Location: index.php?p=home');
            exit();
        case 'home':
            return ['Home', '/page.home.php'];
        case 'about':
            return ['About', '/page.about.php'];
        case 'server_info':
            return ['Server Info', '/page.serverinfo.php'];
        case 'links':
            return ['Links', '/page.links.php'];
        case 'whitelist_request':
            return ['Whitelist Request', '/page.whitelist_request.php'];
        case 'crew':
            return ['Crew', '/general/crew.php'];
        case 'contact':
            return ['Contact', '/page.crew.php'];

        case 'admin':
            switch ($categorie) {
                case 'whitelist_requests':
                    CheckAdminAccess(ALL_WEB);
                    return ['Admin Management', '/admin.whitelist_requests.php'];

                // case 'whitelist_requests_archive':
                //     CheckAdminAccess(ALL_WEB);
                //     return ['Admin Management', '/admin.whitelist_requests_archive.php'];

                default:
                    CheckAdminAccess(ALL_WEB);
                    return ['Administration', '/page.admin.php'];
            }
        default:
            $_GET['p'] = 'home';
            return ['Dashboard', '/page.home.php'];
    }
}

/**
 * @param null $title Unused
 * @param string $page
 */
function build(string $title, string $page)
{
    require_once(TEMPLATES_PATH.'/core/header.php');
    require_once(TEMPLATES_PATH.'/core/navbar.php');
    require_once(TEMPLATES_PATH.'/core/title.php');
    require_once(TEMPLATES_PATH.$page);
    require_once(TEMPLATES_PATH.'/core/footer.php');
}
