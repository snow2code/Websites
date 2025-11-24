<header>
    <div class="nav">
        <a href="#" class="brand">
            <i class="fa-solid fa-paw">DCDoomVR</i>
        </a>
        <nav>
            <ul>
                {* <li><a href="#about">About</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#roblox">Roblox</a></li>
                <li><a href="#posts">Posts</a></li> *}
                {foreach from=$navbar item=nav}
                    <li>
                        <a href="index.php?p={$nav.endpoint}">{$nav.title}</a>
                    </li>
                {/foreach}
            </ul>
        </nav>
    </div>
    
    {if $systemmessage != "null"}
    <div class="notification">
        <b>{$systemmessage}</b>
    </div>
    {/if}
</header>

<main>
{* <div id="tabsWrapper">
    <div id="mainwrapper">
        <div id="tabs">
            <ul>
                {foreach from=$navbar item=nav}
                    <li class="{$nav.state}">
                        <a href="index.php?p={$nav.endpoint}" class="tip" target="_self">{$nav.title}</a>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
</div> *}
{* <div id="mainwrapper">
    <div id="innerwrapper"> *}
