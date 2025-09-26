<?php
    if( !isset( $_SESSION ) ) session_start(); // A sessão precisa ser iniciada em cada página diferente

    if( isset( $_SESSION[ 'US_ID' ] ) && !empty( $_SESSION[ 'US_ID' ] ) ) {
        $NUMBER = filter_input( INPUT_GET, 'number', FILTER_VALIDATE_INT );
        if( $_SESSION[ 'US_ID' ] == $NUMBER ) {
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '/logout.php'; }, 0);</script>";
        }
    }

    if( !isset( $_SESSION[ 'USR_LOGIN' ] ) OR ( $_SESSION[ 'USR_FK_LEVEL' ] < $required_level ) ) {
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '/logout.php'; }, 0);</script>";
    }
?>