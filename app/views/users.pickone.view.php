<?php require('partials/head.php'); ?>
<div class="d-flex flex-column justify-content-center align-items-center" style="height: 50vh">
    <p style="margin: 0px auto">A pessoa sorteada foi </p>
    <h4 style="margin: 5px auto">><?= $userResult->name; ?></h4>
    <a href="/users" style="margin-top: 15px; font-size: 20px">Retornar para users</a>
</div>
<?php require('partials/footer.php'); ?>