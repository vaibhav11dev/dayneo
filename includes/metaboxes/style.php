<?php
/**
 * Custom styles for theme meta-field
 *
 * @package Dayneo
 */
?>
<style type='text/css'>
.ved_metabox {
    padding: 10px 10px 0px 10px;
}

.ved_metabox_field {
    margin-bottom: 15px;
    width: 100%;
    overflow: hidden;
}

.ved_metabox_field label {
    font-weight: bold;
    float: left;
    width: 24%;
    margin-right: 1%;
    line-height: 26px;
    font-size: 14px;
}

.ved_metabox_field .field {
    float: left;
    width: 75%;
}

.ved_metabox_field input[type=text] {
	width: 50%;
	background: #f4f2f2;
	border: 1px solid rgba(0, 0, 0, 0.05);
	box-shadow: none;
}

.ved_metabox_field .upload_field {
    width: 100% !important;
}

.ved_metabox_field .button {
	text-shadow: none;
	background: #fff;
	height: 30px;
	line-height: 28px;
	border-radius: 0;
	-webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, .08);
	box-shadow: 0 1px 0 rgba(0, 0, 0, .08);
	-webkit-transition: .1s linear all;
	-moz-transition: .1s linear all;
	-ms-transition: .1s linear all;
	-o-transition: .1s linear all;
	transition: .1s linear all;
}

.ved_metabox_field select {
	width: 50%;
	height: 30px;
	line-height: 30px;
	background: #f4f2f2;
	border: 1px solid rgba(0, 0, 0, 0.05);
	box-shadow: none;
}

.description {
    padding-left: 25%;
    display: block;
    margin: 1em 0;
}

.ved_metabox_tabs i {
    font-size: 1em;
    line-height: 1em;
    vertical-align: middle;
    margin-right: 5px;
}

#ved_page_options .inside,
#ved_post_options .inside,
#ved_portfolio_options .inside,
#ved_woocommerce_options .inside,
#ved_slide_options .inside {
    padding: 0;
    margin: 0;
}

.ved_metabox_tabs {
    margin: 0;
    padding: 0;
    width: 20%;
    float: left;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.ved_metabox_tabs li {
    margin: 0;
    padding: 0;
    position: relative;
}

.ved_metabox_tabs li a {
    background: #505050;
    display: block;
    font-size: 14px;
    color: #fff;
    text-decoration: none;
    padding: 15px 8px 15px 14px;
    font-weight: 600;
    text-transform: uppercase;
}

.ved_metabox_tabs li.active a,
.ved_metabox_tabs li.active a:hover {
    background-color: #FCFCFC;
    color: #23282d;
}

.ved_metabox_tabs li a:hover {
    color: #fff;
}

.ved_metabox_tabs li a:focus {
    box-shadow: none;
}

.ved_metabox_main {
    width: 80%;
    float: left;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    padding: 0px 30px;
}

.ved_metabox_tab.active {
    display: block;
}

.ved_metabox_tab {
    display: none;
}

.dayneo_img_selected {
    border: 3px solid #aaa !important;
}

.dayneo_img_border_radio {
    border: 3px solid #dedede;
    margin: 10px 5px 5px 0;
    cursor: pointer;
}

@media (max-width: 782px) {
    .ved_metabox_tabs {
        width: 100%;
    }
    .ved_metabox_main {
        width: 100%;
        padding: 0px;
    }
    .ved_metabox_field input[type=text] {
        width: 75%;
    }
    .ved_metabox_field select {
        width: 75%;
    }
}

@media (min-width: 782px) and (max-width: 1200px) {
    .ved_metabox_tabs {
        width: 30%;
    }
    .ved_metabox_main {
        width: 70%;
        padding: 0px;
    }
    .ved_metabox_field input[type=text] {
        width: 75%;
    }
    .ved_metabox_field select {
        width: 75%;
    }
}
</style>