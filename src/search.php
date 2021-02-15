<?php
    require 'includes/header.php';
?>

<div class="narrow-collumn">
    <div class="page-block">
        <h3 class="page-block-title">Поиск</h3>

        <form class="search-form" action="" method="get">
            <input class="field" type="text" name="q">
            <input class="button" type="submit" value="Поиск">
        </form>

    </div>

    <?php require 'includes/footer.php'; ?>
</div>

<div class="wide-collumn">
    <div class="page-block">
        <?php
        $search_q = $_GET['q'];
        $search_text = '/@['.$search_q.']+/m';

        if (!empty($search_q)) { ?>
            <h3 class="page-block-title">Результаты поиска <?php echo $search_q; ?></h3>
        <?php } else { ?>
            <h3 class="page-block-title">Люди</h3>
        <?php } ?>

        <?php
        if (!empty($search_q)) {
            $qr = mysqli_query($db, "SELECT `id`, `first_name`, `last_name`, `photo_url`, `city` FROM `users` WHERE `first_name`='$search_q' OR `last_name`='$search_q' OR `login`='$search_q'");
        } else {
            $qr = mysqli_query($db, "SELECT `id`, `first_name`, `last_name`, `photo_url`, `city` FROM `users`");
        }

        while($search = mysqli_fetch_array($qr)) { ?>
            <div class="search-user-row">
                <a class="search-user-photo" href="/profile.php?id=<?php echo $search['id']; ?>"><img src="<?php echo $search['photo_url']; ?>" alt=""></a>

                <div class="search-user-info">
                    <div class="search-user-title"><a href="/profile.php?id=<?php echo $search['id']; ?>"><?php echo $search['first_name'].' '.$search['last_name']; ?></a></div>
                    <div class="search-user-city"><?php echo $search['city']; ?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
