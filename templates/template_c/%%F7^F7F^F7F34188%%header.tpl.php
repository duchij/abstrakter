<?php /* Smarty version 2.6.28, created on 2015-11-10 05:36:59
         compiled from header.tpl */ ?>


<?php $this->assign('userData', $_SESSION['userData']); ?>

<div class="info box align-right">
    <?php if (! $this->_tpl_vars['userData']): ?>
        <div id="userLoggedIn">
            <p class="red small" style="display:inline;">Not logged in</p>
                Prihlasit sa Meno:<input type="text" style="width:100px;display:inline;"> Heslo:<input type="password" style="width:100px;display:inline;"><button class="green button" onclick="loginUser();">Prihlas</button>
        </div>
    <?php else: ?>
        <div id="userLoggedOut">
            <p class="green small">User logged:<?php echo $this->_tpl_vars['userData']['userName']; ?>
</p><button class="red button" style="display:inline;">Odhlasit sa </button>
        </div>
<?php endif; ?>
</div>

    <a href="index.php"><img src="img/<?php echo $_SESSION['abstrakter']['logo_img']; ?>
" align="left"></a> 
    <h1 class="logo">ABSTRAKTER app</h1>
<hr>