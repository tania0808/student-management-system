<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        <?php
        if (isset($crumbs)){
        $last = end($crumbs);
        foreach ($crumbs as $crumb) {
            if ($last[0] === $crumb[0]) { ?>
                <li class="breadcrumb-item <?php echo $last[0] === $crumb[0] ? 'active' : '' ?>"><?= $crumb[0] ?></li>
            <?php } else { ?>
                <li class="breadcrumb-item"><a href="<?= $crumb[1] ?>"><?= $crumb[0] ?></a></li>
            <?php } }} ?>
    </ol>
</nav>