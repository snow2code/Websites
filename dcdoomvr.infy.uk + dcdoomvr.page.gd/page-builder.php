<?php
/**
 * @return array
 * @throws ErrorException
 */
function route()
{
    $page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_SPECIAL_CHARS);
    $categorie = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_SPECIAL_CHARS);
    $option = filter_input(INPUT_GET, 'o', FILTER_SANITIZE_SPECIAL_CHARS);

    switch ($page) {
        case 'home':
            return ['Home', '/page.home.php'];
            
        case 'dcdoomvr':
            return ['DCDoomVR', '/page.dcdoomvr.php'];
            
        case 'siteauthor':
            return ['Site Author', '/page.siteauthor.php'];
            
        // Errors
        case '400':
            return ['400 Bad Request', '/page.400.php'];
        case '401':
            return ['401 Unauthorized', '/page.401.php'];
        case '403':
            return ['403 Forbidden', '/page.403.php'];
        case '404':
            return ['404 Not Found', '/page.404.php'];
        case '500':
            return ['500 Internal Server Error', '/page.500.php'];
        case '503':
            return ['503 Service Unavailable', '/page.503.php'];
            
        // DEV
        case 'test':
            return ['testing', '/page.testing.php'];
        default:
            $_GET['p'] = 'home';
            return ['Home', '/page.home.php'];
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
    // require_once(TEMPLATES_PATH.'/core/title.php');
    require_once(TEMPLATES_PATH.$page);
    require_once(TEMPLATES_PATH.'/core/footer.php');
}
