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

        <div class="col-md-8 form-group widget-search">
            <input id="search-text" type="text" name="s" class="form-control input-lg input-search" placeholder="<?php _e( 'Type Your Search', 'daydream' ); ?>" value="">
        </div>

        <div class="col-md-4 form-group widget-search">
            <button id="search-button" type="submit" class="btn btn-round btn-block btn-base btn-search"><?php _e( 'Submit', 'daydream' ); ?></button>
        </div>

    </div>
</form>
<!-- END SEARCHFORM -->