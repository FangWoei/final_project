<?php if ( isset( $_SESSION['error'] ) ) : ?>
    <div class="alert alert-danger pb-2" role="alert">
        <?= $_SESSION['error']; ?>
        <?php
            unset( $_SESSION['error'] );
        ?>
    </div>
<?php endif; ?>

