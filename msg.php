<?php
    if( isset( $_SESSION[ 'msg' ] ) ) {
        echo '<div class="card card-danger"><div class="card-header"><h3 class="card-title" style="color: rgb( 255, 255, 255 ); font-weight: 600;">' . $_SESSION[ 'msg' ] . '</h3></div></div>';
        unset( $_SESSION[ 'msg' ] );
    }
?>