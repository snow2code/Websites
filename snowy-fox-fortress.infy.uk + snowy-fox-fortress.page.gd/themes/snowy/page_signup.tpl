<table style="margin: 30px auto;">
    <tr>
        <td class="listtable_top"><b>Account Signup</b></td>
    </tr>
    <tr>
        <td class="listtable_1" style="padding: 15px;">
            <div id="login-content">
                <div id="loginUsernameDiv">
                    <label for="loginUsername">Username:</label><br />
                    <input id="loginUsername" class="loginmedium" type="text" name="username"value="" />
                </div>
                <div id="loginUsername.msg" class="badentry"></div>

                <div id="loginPasswordDiv">
                    <label for="loginPassword">Password:</label><br />
                    <input id="loginPassword" class="loginmedium" type="password" name="password" value="" />
                </div>
                <div id="loginPassword.msg" class="badentry"></div>

                <div id="loginSubmit">
                    <br>
                    -{sb_button text="Signup" onclick=$redir class="ok login" id="alogin" style="width: 100%; text-transform: uppercase;" submit=true}-
                </div>
            </div>
        </td>
    </tr>
</table>

<script>
    $E('html').onkeydown = function(event){
        var event = new Event(event);
        if (event.key == 'enter' ) -{$redir}-
    };$('loginRememberMeDiv').onkeydown = function(event){
        var event = new Event(event);
        if (event.key == 'space' ) $('loginRememberMeDiv').checked = true;
    };$('button').onkeydown = function(event){
        var event = new Event(event);
        if (event.key == 'space' ) -{$redir}-
    };
</script>
