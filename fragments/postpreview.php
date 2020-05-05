<?php
switch( $postformat ) :

case 'audio' :
echo '<div class="audio-post post-format"></div>';
break;

case 'video' :
echo '<div class="video-post post-format"></div>';
break;

case 'image' :
echo '<div class="image-post post-format"></div>';
break;

case 'gallery' :
echo '<div class="gallery-post post-format"></div>';
break;

case 'link' :
echo '<div class="link-post post-format"></div>';
break;

case 'chat' :
echo '<div class="chat-post post-format"></div>';
break;

case 'quote' :
echo '<div class="quote-post post-format"></div>';
break;

case 'status' :
echo '<div class="status-post post-format"></div>';
break;

case 'aside' :
echo '<div class="aside-post post-format"></div>';
break;

case 'standard' :
default :
echo '<div class="standard-post post-format"></div>';

endswitch;
