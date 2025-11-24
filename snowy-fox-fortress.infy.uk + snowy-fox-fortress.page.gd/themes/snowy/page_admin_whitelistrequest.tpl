{if NOT $permissions_submissions}
    Access Denied!
{else}
    <h3 style="margin-top:0px;">Whitelist Submissions (<span id="subcount">{$submission_count}</span>)</h3>
    Click a player's nickname to view information about their submission<br /><br />
    <div id="banlist-nav">
        {$submission_nav}
    </div>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr  class="tbl_out">
            <td width="40%" height='16' class="listtable_top"><strong>Nickname</strong></td>
            <td width="20%" height='16' class="listtable_top"><strong>ProfileID</strong></td>
            <td width="25%" height='16' class="listtable_top"><strong>Action</strong></td>
        </tr>
        
        {foreach from=$submission_list item="sub"}
            {* <tr id="sid_{$sub.subid}" class="opener3 tbl_out" onmouseout="this.className='tbl_out'" onmouseover="this.className='tbl_hover'">
                <td class="listtable_1" height='16'>{$sub.name}</td>
        <td class="listtable_1" height='16'>{if $sub.profileid!=""}{$sub.profileid}{/if}</td>
            </tr> *}
            
            <tr id="sid_{$sub.subid}" class="opener3 tbl_out" onmouseout="this.className='tbl_out'" onmouseover="this.className='tbl_hover'">
                <td class="listtable_1" height='16'>{$sub.name}</td>
                <td class="listtable_1" height='16'>{if $sub.profileid!=""}{$sub.profileid}{/if}</td>
                <td class="listtable_1" height='16'>
                    {if $permissions_editsub}
                        {* <a href="#" onclick="console.log('hello')">Remove</a> *}
                        <a href="#" onclick="RemoveWhitelistRequest({$sub.subid}, '{$sub.name|smarty_stripslashes}', '{$sub.profileid}', '1');return false;">Remove</a>
                    {/if}
                </td>
            </tr>
            <tr id="sid_{$sub.subid}a">
                <td colspan="3">
                    <div class="opener3" width="100%" align="center">
                        <table width="90%" cellspacing="0" cellpadding="0" class="listtable">
                            <tr>
                                <td height="16" align="left" class="listtable_top" colspan="3">
                                    <b>Submission Details</b>
                                </td>
                            </tr>
                            <tr align="left">
                                <td width="20%" height="16" class="listtable_1">Player</td>
                                <td height="16" class="listtable_1">{$sub.name}</td>
                            <tr align="left">
                                <td width="20%" height="16" class="listtable_1">Date</td>
                                <td height="16" class="listtable_1">{$sub.date}</td>
                            </tr>
                            <tr align="left">
                                <td width="20%" height="16" class="listtable_1">ProfileID</td>
                                <td height="16" class="listtable_1">
                                    {if $sub.profileid == ""}
                                        <i><font color="#677882">no profileid present</font></i>
                                    {else}
                                        <a href="https://steamcommunity.com/profiles/{$sub.profileid}/">{$sub.profileid}</a>
                                    {/if}
                                </td>
                            </tr>
                            <tr align="left">
                                <td width="20%" height="16" class="listtable_1">Reason</td>
                                <td height="" class="listtable_1">{$sub.reason}</td>
                            </tr>
                            <tr align="left">
                                <td width="20%" height="16" class="listtable_1">Name</td>
                                <td height="" class="listtable_1">
                                    {if $sub.name == ""}
                                        <i><font color="#677882">no name present</font></i>
                                    {else}
                                        {$sub.name}
                                    {/if}
                                </td>
                            </tr>
                            <tr align="left">
                                <td width="20%" height="16" class="listtable_1">Comments</td>
                                <td height="60" class="listtable_1" colspan="3">
                                    {$sub.reason}
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        {/foreach}
    </table>
    <script>InitAccordion('tr.opener3', 'div.opener3', 'mainwrapper');</script>
{/if}
