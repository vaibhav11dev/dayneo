<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 */
?>

<!-- SEARCHFORM -->
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="custom-search-form">
    <div class="row">

        <div class="col-md-12 form-group widget-search">
            <input id="search-text" type="text" name="s" class="form-control input-lg input-search" placeholder="<?php esc_html_e( 'Type Your Search', 'bigbo' ); ?>" value="">
            <button id="search-button" type="submit" class="btn btn-round btn-base btn-search"><?php // esc_html_e( 'Submit', 'bigbo' ); ?><i class="flaticon-search"></i></button>
        </div>

    </div>
</form>
<!-- END SEARCHFORM -->