<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_template_part('admin/daydream_menu/daydream', 'menu_header');
$daydream_theme = wp_get_theme();
?>
<div class="i11_support">
    <h2><?php esc_html_e('Daydream Support', 'daydream'); ?></h2>
    <p class="about"><?php esc_html_e("We know what it's like to need support. This is the reason why our customers are the top priority and we treat every issue with seriousness. The team is working hard to help every customer, to keep the theme's documentation up to date, to produce video tutorials and to develop new ways to make everything easier.", "daydream"); ?></p>
    <p class="about"><?php esc_html_e('You can count on us, we are here for you!', 'daydream'); ?></p>
</div>

<div class="three-col">
    <div class="col support">
        <h3><?php esc_html_e('Need Help?', 'daydream'); ?></h3>
        <p><?php esc_html_e("We provide 24/7 outstanding support - dedicated and friendly help. We have an amazing team to provide outstanding support at any time. Do not hesitate to contact us for support.", "daydream") ?></p>
        <p>
            <a href="<?php echo esc_url('http://themevedanta.com/contact/'); ?>" target="_blank" class="button button-primary"><?php esc_html_e('Contact Us', 'daydream'); ?></a>
        </p>
    </div>
</div>
<div class="clear"></div>
</div>