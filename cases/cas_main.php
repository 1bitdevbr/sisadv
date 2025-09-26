    <?php
        if( !isset( $_SESSION ) ) session_start();
        $required_level = 1;
        require_once(__DIR__ . '/../access/level.php');
        require_once(__DIR__ . '/../access/conn.php');

        if(  $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) {
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_mainAdm'; }, 0);</script>";
        } else {
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_mainSec'; }, 0);</script>";
        }
    ?>