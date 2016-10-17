<div class="baxe-page">

    <h1>Login</h1>

    <div>
        <form method="post" action="<?php echo $this->createLink(array("route"=>"/account/login", 'params'=>array('c'=>$this->c))) ?>">

        <label>User: <input type="text" name="email" value="" tabindex="10" /></label>

        <label>Pass: <input type="password" name="pass" value="" tabindex="20" /></label>

        <input type="submit" value="Login" tabindex="100" />
        </form>
    </div>

</div>
