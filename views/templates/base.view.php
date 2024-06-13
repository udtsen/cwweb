<?php
    $HOME = $_SERVER['DOCUMENT_ROOT'];
    $user = include $HOME . '/core/auth.php';
    $isLoggedIn = $user != null;
    $auth_text = $isLoggedIn ? $user['email'] : 'Увійти';
    $auth_link = $isLoggedIn ? '/pages/profile.php' : '/pages/aut.html';

    include $HOME . '/views/templates/header.view.php';
?>
<main class="main">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <?=  $content ?>
    
        </div>
    </div>
</div>
</main>
<?php
    include $HOME . '/views/templates/footer.view.php';