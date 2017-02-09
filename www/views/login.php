<div id="login" class="col-12">
	<div class="form-title">Authentication required</div>
	<?php if(isset($_SESSION['login_msg'])&&$_SESSION['login_msg']):?>
		<div class="error-msg"><?php echo $_SESSION['login_msg'];?></div>
	<?php endif;?>
	<div>Please insert username and password to login.</div>
    <form id="auth" method="post" enctype="multipart/form-data" >
		<table>
            <tr>
                <td width="30%">User Name:</td>
                <td width="70%">
                    <input id="username" name="username" type="text" value="<?php if(isset($_POST['username'])&&!empty($_POST['username'])) echo $_POST['username'];?>"/>
                </td>
            </tr>
            <tr>
                <td width="30%">Password:</td>
                <td width="70%">
                    <input id="password" name="password" type="password" />
                </td>
            </tr>
        </table>
        <div class="form-submit"><input type="submit" value="OK"></div>
    </form>
</div>