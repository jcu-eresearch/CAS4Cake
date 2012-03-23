<?php if($loggedIn): ?>
    <h1>Seeeeecret Page</h1>
    <p>You are logged in as <?php pr($user) ?></p>
<?php else: ?>
    <h1>Totally Normal Page</h1>
    <p>Nothing here except a normal page.</p>
<?php endif ?>
<p><?php print $this->Html->link('home', '/') ?></p>
<?php pr('sessname: ' . session_name()) ?>
<?php pr($_SESSION) ?>
