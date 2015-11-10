

{assign var="userData" value=$smarty.session.userData}

<div class="info box align-right">
    {if !$userData}
        <div id="userLoggedIn">
            <p class="red small" style="display:inline;">Not logged in</p>
                Prihlasit sa Meno:<input type="text" style="width:100px;display:inline;"> Heslo:<input type="password" style="width:100px;display:inline;"><button class="green button" onclick="loginUser();">Prihlas</button>
        </div>
    {else}
        <div id="userLoggedOut">
            <p class="green small">User logged:{$userData.userName}</p><button class="red button" style="display:inline;">Odhlasit sa </button>
        </div>
{/if}
</div>

    <a href="index.php"><img src="img/{$smarty.session.abstrakter.logo_img}" align="left"></a> 
    <h1 class="logo">ABSTRAKTER app</h1>
<hr>
{*$smarty.session.abstrakter.web_data.web_subtitle*}