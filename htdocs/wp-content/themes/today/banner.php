<?php

if(of_get_option('banner_code')!=""){
echo '
		<div class="header-banner">
'.of_get_option('banner_code').'
		</div>';
} else {
echo '
		<div class="header-banner-none"></div>';
}