<?php
global $userbank, $theme;
if (!defined("IN_SB")) {
    echo "You should not be here. Only follow links!";
    die();
}

if (isset($GLOBALS['IN_ADMIN'])) {
    define('CUR_AID', $userbank->GetAid());
}

$ItemsPerPage = 30;

$submissions       = $GLOBALS['db']->GetAll("SELECT * FROM `" . DB_PREFIX . "_whitelistrequest` ORDER BY subid DESC ");
$submissions_count = $GLOBALS['db']->GetRow("SELECT count(subid) AS count FROM `" . DB_PREFIX . "_whitelistrequest` ORDER BY subid DESC");
$page_count        = $submissions_count['count'];

//List
$theme->assign('permissions_submissions', $userbank->HasAccess(ADMIN_OWNER | ADMIN_BAN_SUBMISSIONS));
$theme->assign('permissions_editsub', $userbank->HasAccess(ADMIN_OWNER | ADMIN_EDIT_ALL_BANS | ADMIN_EDIT_GROUP_BANS | ADMIN_EDIT_OWN_BANS));
$theme->assign('submission_count', $page_count);
$submission_list = [];

foreach ($submissions as $sub) {
    $sub['name']   = wordwrap(htmlspecialchars($sub['name']), 55, "<br />", true);
    $sub['reason'] = wordwrap(htmlspecialchars($sub['reason']), 55, "<br />", true);

    $sub['date'] = Config::time($sub['date']);

    // echo $sub['date'];
    array_push($submission_list, $sub);
}
$theme->assign('submission_list', $submission_list);
$theme->display('page_admin_whitelistrequest.tpl');
echo '</div>';

//Submissions page
/*
$ItemsPerPage = SB_BANS_PER_PAGE;
$page         = 1;
if (isset($_GET['spage']) && $_GET['spage'] > 0) {
    $page = intval($_GET['spage']);
}
$submissions       = $GLOBALS['db']->GetAll("SELECT * FROM `" . DB_PREFIX . "_whitelistrequest` ORDER BY subid DESC LIMIT " . intval(($page - 1) * $ItemsPerPage) . "," . intval($ItemsPerPage));
$submissions_count = $GLOBALS['db']->GetRow("SELECT count(subid) AS count FROM `" . DB_PREFIX . "_whitelistrequest` ORDER BY subid DESC");
$page_count        = $submissions_count['count'];
$PageStart         = intval(($page - 1) * $ItemsPerPage);
$PageEnd           = intval($PageStart + $ItemsPerPage);
if ($PageEnd > $page_count) {
    $PageEnd = $page_count;
}
if ($page > 1) {
    $prev = CreateLinkR('<i class="fas fa-arrow-left fa-lg"></i> prev', "index.php?p=admin&c=bans&spage=" . ($page - 1) . "#^2");
} else {
    $prev = "";
}
if ($PageEnd < $page_count) {
    $next = CreateLinkR('next <i class="fas fa-arrow-right fa-lg"></i>', "index.php?p=admin&c=bans&spage=" . ($page + 1) . "#^2");
} else {
    $next = "";
}

$page_nav = 'displaying&nbsp;' . $PageStart . '&nbsp;-&nbsp;' . $PageEnd . '&nbsp;of&nbsp;' . $page_count . '&nbsp;results';

if (strlen($prev) > 0) {
    $page_nav .= ' | <b>' . $prev . '</b>';
}
if (strlen($next) > 0) {
    $page_nav .= ' | <b>' . $next . '</b>';
}

$pages = ceil($page_count / $ItemsPerPage);
if ($pages > 1) {
    $page_nav .= '&nbsp;<select onchange="changePage(this,\'S\',\'\',\'\');">';
    for ($i = 1; $i <= $pages; $i++) {
        if ($i == $page) {
            $page_nav .= '<option value="' . $i . '" selected="selected">' . $i . '</option>';
            continue;
        }
        $page_nav .= '<option value="' . $i . '">' . $i . '</option>';
    }
    $page_nav .= '</select>';
}

$theme->assign('permissions_submissions', $userbank->HasAccess(ADMIN_OWNER | ADMIN_BAN_SUBMISSIONS));
$theme->assign('permissions_editsub', $userbank->HasAccess(ADMIN_OWNER | ADMIN_EDIT_ALL_BANS | ADMIN_EDIT_GROUP_BANS | ADMIN_EDIT_OWN_BANS));
$theme->assign('submission_count', $page_count);
$submission_list = [];
foreach ($submissions as $sub) {
    $sub['name']   = wordwrap(htmlspecialchars($sub['name']), 55, "<br />", true);
    $sub['reason'] = wordwrap(htmlspecialchars($sub['reason']), 55, "<br />", true);

    $sub['date'] = Config::time($sub['date']);

    //COMMENT STUFF
    //-----------------------------------
    $view_comments = true;
    $commentres    = $GLOBALS['db']->Execute("SELECT cid, aid, commenttxt, added, edittime,
														(SELECT user FROM `" . DB_PREFIX . "_admins` WHERE aid = C.aid) AS comname,
														(SELECT user FROM `" . DB_PREFIX . "_admins` WHERE aid = C.editaid) AS editname
														FROM `" . DB_PREFIX . "_comments` AS C
														WHERE type = 'S' AND bid = '" . (int) $sub['subid'] . "' ORDER BY added desc");

    if ($commentres->RecordCount() > 0) {
        $comment = [];
        $morecom = 0;
        while (!$commentres->EOF) {
            $cdata            = [];
            $cdata['morecom'] = ($morecom == 1 ? true : false);
            if ($commentres->fields['aid'] == $userbank->GetAid() || $userbank->HasAccess(ADMIN_OWNER)) {
                $cdata['editcomlink'] = CreateLinkR('<i class="fas fa-edit fa-lg"></i>', 'index.php?p=banlist&comment=' . (int) $sub['subid'] . '&ctype=S&cid=' . $commentres->fields['cid'], 'Edit Comment');
                if ($userbank->HasAccess(ADMIN_OWNER)) {
                    $cdata['delcomlink'] = "<a href=\"#\" class=\"tip\" title=\"Delete Comment\" target=\"_self\" onclick=\"RemoveComment(" . $commentres->fields['cid'] . ",'S',-1);\"><i class='fas fa-trash fa-lg'></i></a>";
                }
            } else {
                $cdata['editcomlink'] = "";
                $cdata['delcomlink']  = "";
            }

            $cdata['comname']    = $commentres->fields['comname'];
            $cdata['added']      = Config::time($commentres->fields['added']);
            $commentText         = html_entity_decode($commentres->fields['commenttxt'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $commentText         = encodePreservingBr($commentText);
            // Parse links and wrap them in a <a href=""></a> tag to be easily clickable
            $commentText         = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $commentText);
            $cdata['commenttxt'] = $commentText;

            if (!empty($commentres->fields['edittime'])) {
                $cdata['edittime'] = Config::time($commentres->fields['edittime']);
                $cdata['editname'] = $commentres->fields['editname'];
            } else {
                $cdata['edittime'] = "";
                $cdata['editname'] = "";
            }

            $morecom = 1;
            array_push($comment, $cdata);
            $commentres->MoveNext();
        }
    } else {
        $comment = "None";
    }

    $sub['commentdata']   = $comment;
    $sub['subaddcomment'] = CreateLinkR('<i class="fas fa-comment-dots fa-lg"></i> Add Comment', 'index.php?p=banlist&comment=' . (int) $sub['subid'] . '&ctype=S');
    //----------------------------------------

    array_push($submission_list, $sub);
}
$theme->assign('submission_nav', $page_nav);
$theme->assign('submission_list', $submission_list);
$theme->display('page_admin_bans_submissions.tpl');
echo '</div>';

?>






<script type="text/javascript">
var did = 0;
var dname = "";


function changeReason(szListValue)
{
    $('dreason').style.display = (szListValue == "other" ? "block" : "none");
}


function ProcessGroupBan()
{
    if (!$('groupurl').value) {
        $('groupurl.msg').setHTML('You must enter the group link of the group you are banning');
        $('groupurl.msg').setStyle('display', 'block');
    } else {
        $('groupurl.msg').setHTML('');
        $('groupurl.msg').setStyle('display', 'none');
        xajax_GroupBan($('groupurl').value, "no", "no", $('groupreason').value, "");
    }
}

</script>
</div>
*/
?>