<?php
/**
	* The template for displaying single
*/
get_header();

function hex2rgba( $color, $opacity = false ) {
 
	$default = 'rgb( 0, 0, 0 )';
 
	/**
	 * Return default if no color provided
	 */
	if( empty( $color ) ) {
 
        return $default; 
	
	}
 
	/**
	 * Sanitize $color if "#" is provided
	 */
    if ( $color[0] == '#' ) {
 
    	$color = substr( $color, 1 );
 
    }
 
    /**
     * Check if color has 6 or 3 characters and get values
     */
    if ( strlen($color) == 6 ) {
 
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
 
    } elseif ( strlen( $color ) == 3 ) {
 
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
 
    } else {
 
        return $default;
 
    }
 
    /**
     * [$rgb description]
     * @var array
     */
    $rgb =  array_map( 'hexdec', $hex );
 
    /**
     * Check if opacity is set(rgba or rgb)
     */
    if( $opacity ) {
 
    	if( abs( $opacity ) > 1 )
 
    	$opacity = 1.0;
 
    	$output = 'rgba( ' . implode( "," ,$rgb ) . ',' . $opacity . ' )';
 
    } else {
 
    	$output = 'rgb( ' . implode( "," , $rgb ) . ' )';
    	
    }
 
    /**
     * Return rgb(a) color string
     */
    return $output;
}
?>
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin />
<link rel="preconnect" href="https://w.ladicdn.com/" crossorigin />
<link rel="preconnect" href="https://s.ladicdn.com/" crossorigin />
<link rel="preconnect" href="https://api.form.ladipage.com/" crossorigin />
<link rel="preconnect" href="https://a.ladipage.com/" crossorigin />
<link rel="preconnect" href="https://api.ladisales.com/" crossorigin />
<link rel="preload" href="https://fonts.googleapis.com/css?family=Muli:bold,regular|Oswald:bold,regular&display=swap"
    as="style" onload="this.onload = null;this.rel = 'stylesheet';" />
<link rel="preload" href="https://w.ladicdn.com/v2/source/ladipage.min.js?v=1602061636293" as="script" />
<style id="style_ladi" type="text/css">
a,
abbr,
acronym,
address,
applet,
article,
aside,
audio,
b,
big,
blockquote,
body,
button,
canvas,
caption,
center,
cite,
code,
dd,
del,
details,
dfn,
div,
dl,
dt,
em,
embed,
fieldset,
figcaption,
figure,
footer,
form,
h1,
h2,
h3,
h4,
h5,
h6,
header,
hgroup,
html,
i,
iframe,
img,
input,
ins,
kbd,
label,
legend,
li,
mark,
menu,
nav,
object,
ol,
output,
p,
pre,
q,
ruby,
s,
samp,
section,
select,
small,
span,
strike,
strong,
sub,
summary,
sup,
table,
tbody,
td,
textarea,
tfoot,
th,
thead,
time,
tr,
tt,
u,
ul,
var,
video {
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
menu,
nav,
section {
    display: block;
}

body {
    line-height: 1;
}

a {
    text-decoration: none;
}

ol,
ul {
    list-style: none;
}

blockquote,
q {
    quotes: none;
}

blockquote:after,
blockquote:before,
q:after,
q:before {
    content: "";
    content: none;
}

table {
    border-collapse: collapse;
    border-spacing: 0;
}

body {
    font-size: 12px;
    -ms-text-size-adjust: none;
    -moz-text-size-adjust: none;
    -o-text-size-adjust: none;
    -webkit-text-size-adjust: none;
    background: #fff;
}

.overflow-hidden {
    overflow: hidden;
}

.ladi-transition {
    transition: all 150ms linear 0s;
}

.opacity-0 {
    opacity: 0;
}

.pointer-events-none {
    pointer-events: none;
}

.ladipage-message {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1000000000;
    background: rgba(0, 0, 0, 0.3);
}

.ladipage-message .ladipage-message-box {
    width: 400px;
    max-width: calc(100% - 50px);
    height: 160px;
    border: 1px solid rgba(0, 0, 0, 0.3);
    background-color: #fff;
    position: fixed;
    top: calc(50% - 155px);
    left: 0;
    right: 0;
    margin: auto;
    border-radius: 10px;
}

.ladipage-message .ladipage-message-box h1 {
    background-color: rgba(6, 21, 40, 0.05);
    color: #000;
    padding: 12px 15px;
    font-weight: 600;
    font-size: 16px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.ladipage-message .ladipage-message-box .ladipage-message-text {
    font-size: 14px;
    padding: 0 20px;
    margin-top: 10px;
    line-height: 18px;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
}

.ladipage-message .ladipage-message-box .ladipage-message-close {
    display: block;
    position: absolute;
    right: 15px;
    bottom: 10px;
    margin: 0 auto;
    padding: 10px 0;
    border: none;
    width: 80px;
    text-transform: uppercase;
    text-align: center;
    color: #000;
    background-color: #e6e6e6;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.ladi-wraper {
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: #fff;
}

.ladi-section {
    margin: 0 auto;
    position: relative;
}

.ladi-section .ladi-section-arrow-down {
    position: absolute;
    width: 36px;
    height: 30px;
    bottom: 0;
    right: 0;
    left: 0;
    margin: auto;
    background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
    background-position: 4px;
    cursor: pointer;
    z-index: 90000040;
}

.ladi-section.ladi-section-readmore {
    transition: height 350ms linear 0s;
}

.ladi-section .ladi-section-background {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
    overflow: hidden;
}

.ladi-container {
    position: relative;
    margin: 0 auto;
    height: 100%;
}

.ladi-element {
    position: absolute;
}

.ladi-overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    pointer-events: none;
}

.ladi-carousel {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.ladi-carousel .ladi-carousel-content {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    transition: left 350ms ease-in-out;
}

.ladi-carousel .ladi-carousel-arrow {
    position: absolute;
    width: 30px;
    height: 36px;
    top: calc(50% - 18px);
    background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
    cursor: pointer;
    z-index: 90000040;
}

.ladi-carousel .ladi-carousel-arrow-left {
    left: 5px;
    background-position: -28px;
}

.ladi-carousel .ladi-carousel-arrow-right {
    right: 5px;
    background-position: -52px;
}

.ladi-gallery {
    position: absolute;
    width: 100%;
    height: 100%;
}

.ladi-gallery .ladi-gallery-view {
    position: absolute;
    overflow: hidden;
}

.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    width: 100%;
    height: 100%;
    position: relative;
    display: none;
    transition: transform 350ms ease-in-out;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-perspective: 1000px;
    perspective: 1000px;
}

.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.play-video {
    cursor: pointer;
}

.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.play-video:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    width: 60px;
    height: 60px;
    background: url(https://w.ladicdn.com/source/ladipage-play.svg) no-repeat center center;
    background-size: contain;
    pointer-events: none;
    cursor: pointer;
}

.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.next,
.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.selected.right {
    left: 0;
    transform: translate3d(100%, 0, 0);
}

.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.prev,
.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.selected.left {
    left: 0;
    transform: translate3d(-100%, 0, 0);
}

.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.next.left,
.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.prev.right,
.ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.selected {
    left: 0;
    transform: translate3d(0, 0, 0);
}

.ladi-gallery .ladi-gallery-view>.next,
.ladi-gallery .ladi-gallery-view>.prev,
.ladi-gallery .ladi-gallery-view>.selected {
    display: block;
}

.ladi-gallery .ladi-gallery-view>.selected {
    left: 0;
}

.ladi-gallery .ladi-gallery-view>.next,
.ladi-gallery .ladi-gallery-view>.prev {
    position: absolute;
    top: 0;
    width: 100%;
}

.ladi-gallery .ladi-gallery-view>.next {
    left: 100%;
}

.ladi-gallery .ladi-gallery-view>.prev {
    left: -100%;
}

.ladi-gallery .ladi-gallery-view>.next.left,
.ladi-gallery .ladi-gallery-view>.prev.right {
    left: 0;
}

.ladi-gallery .ladi-gallery-view>.selected.left {
    left: -100%;
}

.ladi-gallery .ladi-gallery-view>.selected.right {
    left: 100%;
}

.ladi-gallery .ladi-gallery-control {
    position: absolute;
    overflow: hidden;
}

.ladi-gallery.ladi-gallery-top .ladi-gallery-view {
    width: 100%;
}

.ladi-gallery.ladi-gallery-top .ladi-gallery-control {
    top: 0;
    width: 100%;
}

.ladi-gallery.ladi-gallery-bottom .ladi-gallery-view {
    top: 0;
    width: 100%;
}

.ladi-gallery.ladi-gallery-bottom .ladi-gallery-control {
    width: 100%;
    bottom: 0;
}

.ladi-gallery.ladi-gallery-left .ladi-gallery-view {
    height: 100%;
}

.ladi-gallery.ladi-gallery-left .ladi-gallery-control {
    height: 100%;
}

.ladi-gallery.ladi-gallery-right .ladi-gallery-view {
    height: 100%;
}

.ladi-gallery.ladi-gallery-right .ladi-gallery-control {
    height: 100%;
    right: 0;
}

.ladi-gallery .ladi-gallery-view .ladi-gallery-view-arrow {
    position: absolute;
    width: 30px;
    height: 36px;
    top: calc(50% - 18px);
    background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(0, 0, 0, 0.4) no-repeat;
    cursor: pointer;
    z-index: 90000040;
}

.ladi-gallery .ladi-gallery-view .ladi-gallery-view-arrow-left {
    left: 5px;
    background-position: -28px;
}

.ladi-gallery .ladi-gallery-view .ladi-gallery-view-arrow-right {
    right: 5px;
    background-position: -52px;
}

.ladi-gallery .ladi-gallery-control .ladi-gallery-control-arrow {
    position: absolute;
    background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
    cursor: pointer;
    z-index: 90000040;
}

.ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-arrow,
.ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-arrow {
    top: calc(50% - 18px);
    width: 30px;
    height: 36px;
}

.ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-arrow-left {
    left: 0;
    background-position: -28px;
    transform: scale(0.6);
}

.ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-arrow-right {
    right: 0;
    background-position: -52px;
    transform: scale(0.6);
}

.ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-arrow-left {
    left: 0;
    background-position: -28px;
    transform: scale(0.6);
}

.ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-arrow-right {
    right: 0;
    background-position: -52px;
    transform: scale(0.6);
}

.ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-arrow,
.ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-arrow {
    left: calc(50% - 18px);
    width: 36px;
    height: 30px;
}

.ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-arrow-left {
    top: 0;
    background-position: -77px;
    transform: scale(0.6);
}

.ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-arrow-right {
    bottom: 0;
    background-position: 3px;
    transform: scale(0.6);
}

.ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-arrow-left {
    top: 0;
    background-position: -77px;
    transform: scale(0.6);
}

.ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-arrow-right {
    bottom: 0;
    background-position: 3px;
    transform: scale(0.6);
}

.ladi-gallery .ladi-gallery-control .ladi-gallery-control-box {
    position: relative;
}

.ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-box {
    display: inline-flex;
    left: 0;
    transition: left 150ms ease-in-out;
}

.ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-box {
    display: inline-flex;
    left: 0;
    transition: left 150ms ease-in-out;
}

.ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-box {
    display: inline-grid;
    top: 0;
    transition: top 150ms ease-in-out;
}

.ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-box {
    display: inline-grid;
    top: 0;
    transition: top 150ms ease-in-out;
}

.ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    float: left;
    position: relative;
    cursor: pointer;
    filter: invert(15%);
}

.ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item.play-video:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    width: 30px;
    height: 30px;
    background: url(https://w.ladicdn.com/source/ladipage-play.svg) no-repeat center center;
    background-size: contain;
    pointer-events: none;
    cursor: pointer;
}

.ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item:hover {
    filter: none;
}

.ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item.selected {
    filter: none;
}

.ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item:last-child {
    margin-right: 0 !important;
    margin-bottom: 0 !important;
}

.ladi-box {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.ladi-frame {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.ladi-frame .ladi-frame-background {
    height: 100%;
    width: 100%;
    pointer-events: none;
}

.ladi-banner {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.ladi-banner .ladi-banner-background {
    height: 100%;
    width: 100%;
    pointer-events: none;
}

#SECTION_POPUP .ladi-container {
    z-index: 90000070;
}

#SECTION_POPUP .ladi-container>.ladi-element {
    z-index: 90000070;
    position: fixed;
    display: none;
}

#SECTION_POPUP .ladi-container>.ladi-element.hide-visibility {
    display: block !important;
    visibility: hidden !important;
}

#SECTION_POPUP .popup-close {
    width: 30px;
    height: 30px;
    position: absolute;
    right: 0;
    top: 0;
    transform: scale(0.8);
    -webkit-transform: scale(0.8);
    z-index: 9000000080;
    background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
    background-position: -108px;
    cursor: pointer;
    display: none;
}

.ladi-popup {
    position: absolute;
    width: 100%;
    height: 100%;
}

.ladi-popup .ladi-popup-background {
    height: 100%;
    width: 100%;
    pointer-events: none;
}

.ladi-countdown {
    position: absolute;
    width: 100%;
    height: 100%;
}

.ladi-countdown .ladi-countdown-background {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
    display: table;
    pointer-events: none;
}

.ladi-countdown .ladi-countdown-text {
    position: absolute;
    width: 100%;
    height: 100%;
    text-decoration: inherit;
    display: table;
    pointer-events: none;
}

.ladi-countdown .ladi-countdown-text span {
    display: table-cell;
    vertical-align: middle;
}

.ladi-countdown>.ladi-element {
    text-decoration: inherit;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
    position: relative;
    display: inline-block;
}

.ladi-countdown>.ladi-element:last-child {
    margin-right: 0 !important;
}

.ladi-button {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.ladi-button:active {
    transform: translateY(2px);
}

.ladi-button .ladi-button-background {
    height: 100%;
    width: 100%;
    pointer-events: none;
}

.ladi-button>.ladi-element {
    width: 100% !important;
    height: 100% !important;
    top: 0 !important;
    left: 0 !important;
    display: table;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

.ladi-button>.ladi-element .ladi-headline {
    display: table-cell;
    vertical-align: middle;
}

.ladi-collection {
    position: absolute;
    width: 100%;
    height: 100%;
}

.ladi-collection.carousel {
    overflow: hidden;
}

.ladi-collection .ladi-collection-content {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    transition: left 350ms ease-in-out;
}

.ladi-collection .ladi-collection-content .ladi-collection-item {
    display: block;
    position: relative;
    float: left;
    box-shadow: 0 0 0 1px #fff;
}

.ladi-collection .ladi-collection-content .ladi-collection-page {
    float: left;
}

.ladi-collection .ladi-collection-arrow {
    position: absolute;
    width: 30px;
    height: 36px;
    top: calc(50% - 18px);
    background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
    cursor: pointer;
    z-index: 90000040;
}

.ladi-collection .ladi-collection-arrow-left {
    left: 5px;
    background-position: -28px;
}

.ladi-collection .ladi-collection-arrow-right {
    right: 5px;
    background-position: -52px;
}

.ladi-collection .ladi-collection-button-next {
    position: absolute;
    width: 36px;
    height: 30px;
    bottom: -40px;
    right: 0;
    left: 0;
    margin: auto;
    background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
    background-position: 4px;
    cursor: pointer;
    z-index: 90000040;
}

.ladi-form {
    position: absolute;
    width: 100%;
    height: 100%;
}

.ladi-form>.ladi-element {
    text-transform: inherit;
    text-decoration: inherit;
    text-align: inherit;
    letter-spacing: inherit;
    color: inherit;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
}

.ladi-form .ladi-element[id^="BUTTON_TEXT"] {
    color: initial;
    font-size: initial;
    font-weight: initial;
    text-transform: initial;
    text-decoration: initial;
    font-style: initial;
    text-align: initial;
    letter-spacing: initial;
    line-height: initial;
}

.ladi-form>.ladi-element .ladi-form-item-container {
    text-transform: inherit;
    text-decoration: inherit;
    text-align: inherit;
    letter-spacing: inherit;
    color: inherit;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item {
    text-transform: inherit;
    text-decoration: inherit;
    text-align: inherit;
    letter-spacing: inherit;
    color: inherit;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item-background {
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-size: 9px 6px !important;
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select-3 {
    width: calc(100% / 3 - 5px);
    max-width: calc(100% / 3 - 5px);
    min-width: calc(100% / 3 - 5px);
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select-3:nth-child(3) {
    margin-left: 7.5px;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select-3:nth-child(4) {
    margin-left: 7.5px;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select option {
    color: initial;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control:not(.ladi-form-control-select) {
    text-transform: inherit;
    text-decoration: inherit;
    text-align: inherit;
    letter-spacing: inherit;
    color: inherit;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select:not([data-selected=""]) {
    text-transform: inherit;
    text-decoration: inherit;
    text-align: inherit;
    letter-spacing: inherit;
    color: inherit;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select[data-selected=""] {
    text-transform: inherit;
    text-align: inherit;
    letter-spacing: inherit;
    color: inherit;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-checkbox-item {
    text-transform: inherit;
    text-decoration: inherit;
    text-align: inherit;
    letter-spacing: inherit;
    color: inherit;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
    vertical-align: middle;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-checkbox-item span {
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-checkbox-item span[data-checked="true"] {
    text-transform: inherit;
    text-decoration: inherit;
    text-align: inherit;
    letter-spacing: inherit;
    color: inherit;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
}

.ladi-form>.ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-checkbox-item span[data-checked="false"] {
    text-transform: inherit;
    text-align: inherit;
    letter-spacing: inherit;
    color: inherit;
    background-size: inherit;
    background-attachment: inherit;
    background-origin: inherit;
}

.ladi-form .ladi-form-item-container {
    position: absolute;
    width: 100%;
    height: 100%;
}

.ladi-form .ladi-form-item {
    width: 100%;
    height: 100%;
    position: absolute;
}

.ladi-form .ladi-form-item-background {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
}

.ladi-form .ladi-form-item.ladi-form-checkbox {
    height: auto;
}

.ladi-form .ladi-form-item .ladi-form-control {
    background-color: transparent;
    min-width: 100%;
    min-height: 100%;
    max-width: 100%;
    max-height: 100%;
    width: 100%;
    height: 100%;
    padding: 0 5px;
    color: inherit;
    font-size: inherit;
    border: none;
}

.ladi-form .ladi-form-item.ladi-form-checkbox {
    padding: 10px 5px;
}

.ladi-form .ladi-form-item.ladi-form-checkbox.ladi-form-checkbox-vertical .ladi-form-checkbox-item {
    margin-top: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    display: table;
    border: none;
}

.ladi-form .ladi-form-item.ladi-form-checkbox.ladi-form-checkbox-horizontal .ladi-form-checkbox-item {
    margin-top: 0 !important;
    margin-left: 0 !important;
    margin-right: 10px !important;
    display: inline-block;
    border: none;
    position: relative;
}

.ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item input {
    vertical-align: middle;
    width: 13px;
    height: 13px;
    display: table-cell;
    margin-right: 5px;
}

.ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span {
    display: table-cell;
    cursor: default;
    vertical-align: middle;
    word-break: break-word;
}

.ladi-form .ladi-form-item.ladi-form-checkbox.ladi-form-checkbox-horizontal .ladi-form-checkbox-item input {
    position: absolute;
    top: 4px;
}

.ladi-form .ladi-form-item.ladi-form-checkbox.ladi-form-checkbox-horizontal .ladi-form-checkbox-item span {
    padding-left: 18px;
}

.ladi-form .ladi-form-item textarea.ladi-form-control {
    resize: none;
    padding: 5px;
}

.ladi-form .ladi-button {
    cursor: pointer;
}

.ladi-form .ladi-button .ladi-headline {
    cursor: pointer;
    user-select: none;
}

.ladi-cart {
    position: absolute;
    width: 100%;
    font-size: 12px;
}

.ladi-cart .ladi-cart-row {
    position: relative;
    display: inline-table;
    width: 100%;
}

.ladi-cart .ladi-cart-row:after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 1px;
    width: 100%;
    background: #dcdcdc;
}

.ladi-cart .ladi-cart-no-product {
    text-align: center;
    font-size: 16px;
    vertical-align: middle;
}

.ladi-cart .ladi-cart-image {
    width: 16%;
    vertical-align: middle;
    position: relative;
    text-align: center;
}

.ladi-cart .ladi-cart-image img {
    max-width: 100%;
}

.ladi-cart .ladi-cart-title {
    vertical-align: middle;
    padding: 0 5px;
    word-break: break-all;
}

.ladi-cart .ladi-cart-title .ladi-cart-title-name {
    display: block;
    margin-bottom: 5px;
}

.ladi-cart .ladi-cart-title .ladi-cart-title-variant {
    font-weight: 700;
    display: block;
}

.ladi-cart .ladi-cart-image .ladi-cart-image-quantity {
    position: absolute;
    top: -3px;
    right: -5px;
    background: rgba(150, 149, 149, 0.9);
    width: 20px;
    height: 20px;
    border-radius: 50%;
    text-align: center;
    color: #fff;
    line-height: 20px;
}

.ladi-cart .ladi-cart-quantity {
    width: 70px;
    vertical-align: middle;
    text-align: center;
}

.ladi-cart .ladi-cart-quantity-content {
    display: inline-flex;
}

.ladi-cart .ladi-cart-quantity input {
    width: 24px;
    text-align: center;
    height: 22px;
    -moz-appearance: textfield;
    border-top: 1px solid #dcdcdc;
    border-bottom: 1px solid #dcdcdc;
}

.ladi-cart .ladi-cart-quantity input::-webkit-inner-spin-button,
.ladi-cart .ladi-cart-quantity input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.ladi-cart .ladi-cart-quantity button {
    border: 1px solid #dcdcdc;
    cursor: pointer;
    text-align: center;
    width: 21px;
    height: 22px;
    position: relative;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

.ladi-cart .ladi-cart-quantity button:active {
    transform: translateY(2px);
}

.ladi-cart .ladi-cart-quantity button span {
    font-size: 18px;
    position: relative;
    left: 0.5px;
}

.ladi-cart .ladi-cart-quantity button:first-child span {
    top: -1.2px;
}

.ladi-cart .ladi-cart-price {
    width: 100px;
    vertical-align: middle;
    text-align: right;
    padding: 0 5px;
}

.ladi-cart .ladi-cart-action {
    width: 28px;
    vertical-align: middle;
    text-align: center;
}

.ladi-cart .ladi-cart-action button {
    border: 1px solid #dcdcdc;
    cursor: pointer;
    text-align: center;
    width: 25px;
    height: 22px;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

.ladi-cart .ladi-cart-action button:active {
    transform: translateY(2px);
}

.ladi-cart .ladi-cart-action button span {
    font-size: 13px;
    position: relative;
    top: 0.5px;
}

.ladi-video {
    position: absolute;
    width: 100%;
    height: 100%;
    cursor: pointer;
    overflow: hidden;
}

.ladi-video .ladi-video-background {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
}

.ladi-group {
    position: absolute;
    width: 100%;
    height: 100%;
}

.ladi-checkout {
    position: absolute;
    width: 100%;
    height: 100%;
}

.ladi-shape {
    position: absolute;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.ladi-html-code {
    position: absolute;
    width: 100%;
    height: 100%;
}

.ladi-image {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
}

.ladi-image .ladi-image-background {
    background-repeat: no-repeat;
    background-position: left top;
    background-size: cover;
    background-attachment: scroll;
    background-origin: content-box;
    position: absolute;
    margin: 0 auto;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.ladi-headline {
    width: 100%;
    display: inline-block;
    background-size: cover;
    background-position: center center;
}

.ladi-headline a {
    text-decoration: underline;
}

.ladi-paragraph {
    width: 100%;
    display: inline-block;
}

.ladi-paragraph a {
    text-decoration: underline;
}

.ladi-list-paragraph {
    width: 100%;
    display: inline-block;
}

.ladi-list-paragraph a {
    text-decoration: underline;
}

.ladi-list-paragraph ul li {
    position: relative;
    counter-increment: linum;
}

.ladi-list-paragraph ul li:before {
    position: absolute;
    background-repeat: no-repeat;
    background-size: 100% 100%;
    left: 0;
}

.ladi-list-paragraph ul li:last-child {
    padding-bottom: 0 !important;
}

.ladi-line {
    position: relative;
}

.ladi-line .ladi-line-container {
    border-bottom: 0 !important;
    border-right: 0 !important;
    width: 100%;
    height: 100%;
}

a[data-action] {
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    cursor: pointer;
}

a:visited {
    color: inherit;
}

a:link {
    color: inherit;
}

[data-opacity="0"] {
    opacity: 0;
}

[data-hidden="true"] {
    display: none;
}

[data-action="true"] {
    cursor: pointer;
}

.ladi-hidden {
    display: none;
}

.backdrop-popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 90000060;
}

.lightbox-screen {
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    margin: auto;
    z-index: 9000000080;
    background: rgba(0, 0, 0, 0.5);
}

.lightbox-screen .lightbox-close {
    width: 30px;
    height: 30px;
    position: absolute;
    z-index: 9000000090;
    background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
    background-position: -108px;
    transform: scale(0.7);
    -webkit-transform: scale(0.7);
    cursor: pointer;
}

.lightbox-screen .lightbox-hidden {
    display: none;
}

.ladi-animation-hidden {
    visibility: hidden !important;
}

.ladi-lazyload {
    background-image: none !important;
}

.ladi-list-paragraph ul li.ladi-lazyload:before {
    background-image: none !important;
}

@media (min-width: 768px) {
    .ladi-fullwidth {
        width: 100vw !important;
        left: calc(-50vw + 50%) !important;
        box-sizing: border-box !important;
        transform: none !important;
    }
}

@media (max-width: 767px) {
    .ladi-element.ladi-auto-scroll {
        overflow-x: scroll;
        overflow-y: hidden;
        width: 100% !important;
        left: 0 !important;
        -webkit-overflow-scrolling: touch;
    }

    .ladi-section.ladi-auto-scroll {
        overflow-x: scroll;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
    }

    .ladi-carousel .ladi-carousel-content {
        transition: left 0.3s ease-in-out;
    }

    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item {
        transition: transform 0.3s ease-in-out;
    }
}

.ladi-notify-transition {
    transition: top 0.5s ease-in-out, bottom 0.5s ease-in-out, opacity 0.5s ease-in-out;
}

.ladi-notify {
    padding: 5px;
    box-shadow: 0 0 1px rgba(64, 64, 64, 0.3), 0 8px 50px rgba(64, 64, 64, 0.05);
    border-radius: 40px;
    color: rgba(64, 64, 64, 1);
    background: rgba(250, 250, 250, 0.9);
    line-height: 1.6;
    width: 100%;
    height: 100%;
    font-size: 13px;
}

.ladi-notify .ladi-notify-image img {
    float: left;
    margin-right: 13px;
    border-radius: 50%;
    width: 53px;
    height: 53px;
    pointer-events: none;
}

.ladi-notify .ladi-notify-title {
    font-size: 100%;
    height: 17px;
    overflow: hidden;
    font-weight: 700;
    overflow-wrap: break-word;
    text-overflow: ellipsis;
    white-space: nowrap;
    line-height: 1;
}

.ladi-notify .ladi-notify-content {
    font-size: 92.308%;
    height: 17px;
    overflow: hidden;
    overflow-wrap: break-word;
    text-overflow: ellipsis;
    white-space: nowrap;
    line-height: 1;
    padding-top: 2px;
}

.ladi-notify .ladi-notify-time {
    line-height: 1.6;
    font-size: 84.615%;
    display: inline-block;
    overflow-wrap: break-word;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: calc(100% - 155px);
    overflow: hidden;
}

.ladi-notify .ladi-notify-copyright {
    font-size: 76.9231%;
    margin-left: 2px;
    position: relative;
    padding: 0 5px;
    cursor: pointer;
    opacity: 0.6;
    display: inline-block;
    top: -4px;
}

.ladi-notify .ladi-notify-copyright svg {
    vertical-align: middle;
}

.ladi-notify .ladi-notify-copyright svg:not(:root) {
    overflow: hidden;
}

.ladi-notify .ladi-notify-copyright div {
    text-decoration: none;
    color: rgba(64, 64, 64, 1);
    display: inline;
}

.ladi-notify .ladi-notify-copyright strong {
    font-weight: 700;
}

.builder-container .ladi-notify {
    transition: unset;
}

.ladi-spin-lucky {
    width: 100%;
    height: 100%;
    border-radius: 100%;
    box-shadow: 0 0 7px 0 rgba(64, 64, 64, 0.6), 0 8px 50px rgba(64, 64, 64, 0.3);
    background-repeat: no-repeat;
    background-size: cover;
}

.ladi-spin-lucky .ladi-spin-lucky-start {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    width: 20%;
    height: 20%;
    cursor: pointer;
    background-size: contain;
    background-position: center center;
    background-repeat: no-repeat;
    transition: transform 0.3s ease-in-out;
    -webkit-transition: transform 0.3s ease-in-out;
}

.ladi-spin-lucky .ladi-spin-lucky-start:hover {
    transform: scale(1.1);
}

.ladi-spin-lucky .ladi-spin-lucky-screen {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    border-radius: 100%;
    transition: transform 7s cubic-bezier(0.25, 0.1, 0, 1);
    -webkit-transition: transform 7s cubic-bezier(0.25, 0.1, 0, 1);
    text-decoration-line: inherit;
    text-transform: inherit;
    -webkit-text-decoration-line: inherit;
}

.ladi-spin-lucky .ladi-spin-lucky-label {
    position: absolute;
    top: 50%;
    left: 50%;
    overflow: hidden;
    text-align: center;
    width: 42%;
    padding-left: 12%;
    transform-origin: 0 0;
    -webkit-transform-origin: 0 0;
    text-decoration-line: inherit;
    text-transform: inherit;
    -webkit-text-decoration-line: inherit;
    line-height: 1;
    text-shadow: rgba(0, 0, 0, 0.5) 1px 0 2px;
}
</style>
<style id="style_page" type="text/css">
@media (min-width: 768px) {
    .ladi-section .ladi-container {
        width: 1200px;
    }
}

@media (max-width: 767px) {
    .ladi-section .ladi-container {
        width: 420px;
    }
}

body {
    font-family: Muli, sans-serif;
}
</style>
<style id="style_element" type="text/css">
@media (min-width: 768px) {
    #SECTION_POPUP {
        height: 0px;
    }

    #SECTION3 {
        height: 763.6px;
    }

    #SECTION3>.ladi-section-background {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("<?=wp_get_attachment_url((int)get_field('background_thelecuocthi'));?>");
        background-position: center top;
        background-repeat: repeat;
    }

    #BOX4 {
        width: 300px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX4>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX4>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s650x550/5c7362c6c417ab07e5196b05/cv19_108-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE11 {
        width: 163px;
        top: 73.611px;
        left: 39.1039px;
    }

    #HEADLINE11>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE11>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE12 {
        width: 48px;
        top: 37.792px;
        left: 39.1039px;
    }

    #LINE12>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE12>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE17 {
        width: 953px;
        top: 184.6px;
        left: 124px;
    }

    #HEADLINE17>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 16px;
        text-align: center;
        line-height: 1.6;
    }

    #GROUP24 {
        width: 300px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX26 {
        width: 300px;
        height: 441px;
        top: 0px;
        left: 0px;
    }

    #BOX26>.ladi-box>.ladi-overlay {
        background: rgba(164, 31, 36, 0.9);
        background: -webkit-linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
    }

    #BOX26>.ladi-box {
        box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        -webkit-box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s650x750/5c7362c6c417ab07e5196b05/cv19_108-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE27 {
        width: 163px;
        top: 74.611px;
        left: 39.1039px;
    }

    #HEADLINE27>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE27>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE28 {
        width: 48px;
        top: 38.792px;
        left: 39.1039px;
    }

    #LINE28>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE28>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #SECTION30 {
        height: 211px;
        display: none !important;
    }

    #SECTION30.ladi-animation {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SECTION30>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #SECTION31 {
        height: 595.4px;
    }

    #SECTION31>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #BOX32 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #BOX32>.ladi-box {
        background-color: rgb(243, 243, 243);
    }

    #BOX38 {
        width: 786px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #BOX38>.ladi-box>.ladi-overlay {
        background: <?=hex2rgba(get_field('primary_color'),0.9);?>;
        /* background: -webkit-linear-gradient(180deg, rgba(164, 31, 35, 0.9), rgba(124, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 35, 0.9), rgba(124, 20, 22, 1)); */
    }

    #BOX38>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("<?=wp_get_attachment_url((int)get_field('background_bangiamkhao'));?>");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE39 {
        width: 261px;
        top: 73.611px;
        left: 39.1039px;
    }

    #HEADLINE39>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE39>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE40 {
        width: 48px;
        top: 37.792px;
        left: 39.1039px;
    }

    #LINE40>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE40>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP37 {
        width: 786px;
        height: 400px;
        top: 115px;
        left: 870px;
        z-index: 20;
    }

    #GROUP37.ladi-animation>.ladi-group {
        animation-name: fadeInRight;
        -webkit-animation-name: fadeInRight;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SECTION41 {
        height: 1028.01px;
    }

    #SECTION41>.ladi-section-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #IMAGE42 {
        width: 262.086px;
        height: 300.221px;
        top: 54.3774px;
        left: 468.957px;
    }

    #IMAGE42>.ladi-image>.ladi-image-background {
        width: 262.086px;
        height: 300.221px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/5c7362c6c417ab07e5196b05/asset-2-20200821032954.svg");
    }

    #IMAGE42.ladi-animation>.ladi-image {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #IMAGE43 {
        width: 1162.04px;
        height: 411.422px;
        top: 232.592px;
        left: 26.98px;
    }

    #IMAGE43>.ladi-image>.ladi-image-background {
        width: 1162.04px;
        height: 411.422px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1500x750/5c7362c6c417ab07e5196b05/asset-43x-20200822115004.png");
    }

    #IMAGE43.ladi-animation>.ladi-image {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1.5s;
        -webkit-animation-duration: 1.5s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #HEADLINE47 {
        width: 1200px;
        top: 685.514px;
        left: 0px;
    }

    #HEADLINE47>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 18px;
        text-align: justify;
        line-height: 1.6;
    }

    #BOX48 {
        width: 2094px;
        height: 402.996px;
        top: 625.014px;
        left: -450px;
    }

    #BOX48>.ladi-box {
        background-color: rgb(243, 243, 243);
    }

    #BUTTON50 {
        width: 189px;
        height: 52px;
        top: 926.014px;
        left: 1011px;
    }

    #BUTTON50>.ladi-button>.ladi-button-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #BUTTON50>.ladi-button {
        border-style: solid;
        border-color: <?=get_field('secondary_color')?>;
        border-width: 2px;
    }

    #BUTTON50>.ladi-button:hover {
        transform: scale(1.03);
        -webkit-transform: scale(1.03);
    }

    #BUTTON_TEXT50 {
        width: 175px;
        top: 9px;
        left: 0px;
    }

    #BUTTON_TEXT50>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 18px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE51 {
        width: 430px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE51>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 20, 22);
        font-size: 48px;
        text-align: center;
        line-height: 1.6;
    }

    #LINE57 {
        width: 73px;
        top: 85.611px;
        left: 178.5px;
    }

    #LINE57>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE57>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #BOX59 {
        width: 300px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX59>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX59>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s650x550/5c7362c6c417ab07e5196b05/cv19_242-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE60 {
        width: 140px;
        top: 73.611px;
        left: 39.1039px;
    }

    #HEADLINE60>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE60>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE61 {
        width: 48px;
        top: 37.792px;
        left: 39.1039px;
    }

    #LINE61>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE61>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP58 {
        width: 300px;
        height: 230px;
        top: 0px;
        left: 300px;
    }

    #BOX63 {
        width: 300px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX63>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX63>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s650x550/5c7362c6c417ab07e5196b05/cv19_248-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE64 {
        width: 153px;
        top: 73.611px;
        left: 39.1039px;
    }

    #HEADLINE64>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE64>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE65 {
        width: 48px;
        top: 37.792px;
        left: 39.1039px;
    }

    #LINE65>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE65>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP62 {
        width: 300px;
        height: 230px;
        top: 0px;
        left: 600px;
    }

    #BOX67 {
        width: 300px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX67>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX67>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s650x550/5c7362c6c417ab07e5196b05/cv19_79-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE68 {
        width: 248px;
        top: 73.611px;
        left: 39.1039px;
    }

    #HEADLINE68>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE68>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE69 {
        width: 48px;
        top: 37.792px;
        left: 39.1039px;
    }

    #LINE69>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE69>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP66 {
        width: 300px;
        height: 230px;
        top: 0px;
        left: 900px;
    }

    #HEADLINE71 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE71>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE72 {
        width: 234px;
        top: 0px;
        left: 41.6559px;
    }

    #HEADLINE72>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #HEADLINE73 {
        width: 236px;
        top: 44px;
        left: 40.6559px;
    }

    #HEADLINE73>.ladi-headline {
        text-decoration-line: underline;
        -webkit-text-decoration-line: underline;
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        line-height: 1.6;
    }

    #BOX89 {
        width: 300px;
        height: 560px;
        top: 0px;
        left: 0px;
    }

    #BOX89>.ladi-box>.ladi-overlay {
        background: rgba(164, 31, 36, 0.9);
        background: -webkit-linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
    }

    #BOX89>.ladi-box {
        box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        -webkit-box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s650x900/5c7362c6c417ab07e5196b05/cv19_242-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE90 {
        width: 143px;
        top: 74.611px;
        left: 39.1039px;
    }

    #HEADLINE90>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE90>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE91 {
        width: 48px;
        top: 38.792px;
        left: 39.1039px;
    }

    #LINE91>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE91>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE97 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE97>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE98 {
        width: 234px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE98>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #SECTION87 {
        height: 330px;
        display: none !important;
    }

    #SECTION87.ladi-animation {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SECTION87>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #HEADLINE104 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE104>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE105 {
        width: 234px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE105>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP106 {
        width: 300px;
        height: 560px;
        top: -230px;
        left: 300px;
    }

    #BOX109 {
        width: 499px;
        height: 866.6px;
        top: 0px;
        left: 0px;
    }

    #BOX109>.ladi-box>.ladi-overlay {
        background: rgba(164, 31, 36, 0.9);
        background: -webkit-linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
    }

    #BOX109>.ladi-box {
        box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        -webkit-box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s800x1200/5c7362c6c417ab07e5196b05/cv19_248-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE110 {
        width: 151px;
        top: 74.611px;
        left: 39.104px;
    }

    #HEADLINE110>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE110>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE111 {
        width: 48px;
        top: 38.792px;
        left: 39.1039px;
    }

    #LINE111>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE111>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE112 {
        width: 39px;
        top: 0.5px;
        left: 0px;
    }

    #HEADLINE112>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE113 {
        width: 440px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE113>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #SECTION107 {
        height: 636.6px;
        display: none !important;
    }

    #SECTION107.ladi-animation {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SECTION107>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #SHAPE116 {
        width: 22px;
        height: 22px;
        top: 400px;
        left: 137.5px;
    }

    #SHAPE116 svg:last-child {
        fill: rgba(244, 184, 156, 1);
    }

    #SHAPE117 {
        width: 24px;
        height: 24px;
        top: 290.6px;
        left: 438px;
    }

    #SHAPE117 svg:last-child {
        fill: rgba(244, 184, 156, 1);
    }

    #GROUP118 {
        width: 275.656px;
        height: 187px;
        top: 203.553px;
        left: 0px;
    }

    #GROUP119 {
        width: 275.656px;
        height: 93px;
        top: 411.553px;
        left: 0px;
    }

    #GROUP120 {
        width: 481.656px;
        height: 33.5px;
        top: 208.553px;
        left: 0px;
    }

    #HEADLINE122 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE122>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE123 {
        width: 439px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE123>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP121 {
        width: 480.656px;
        height: 47px;
        top: 255.859px;
        left: 0.5px;
    }

    #HEADLINE125 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE125>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE126 {
        width: 439px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE126>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP124 {
        width: 480.656px;
        height: 93px;
        top: 316.665px;
        left: 0.5px;
    }

    #HEADLINE128 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE128>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE129 {
        width: 439px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE129>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP127 {
        width: 480.656px;
        height: 70px;
        top: 423.471px;
        left: 0.5px;
    }

    #HEADLINE139 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE139>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE140 {
        width: 439px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE140>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP138 {
        width: 480.656px;
        height: 70px;
        top: 507.276px;
        left: 0px;
    }

    #HEADLINE142 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE142>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE143 {
        width: 439px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE143>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP141 {
        width: 480.656px;
        height: 47px;
        top: 591.082px;
        left: 0px;
    }

    #HEADLINE145 {
        width: 39px;
        top: 1.5px;
        left: 0px;
    }

    #HEADLINE145>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE146 {
        width: 439px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE146>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP144 {
        width: 480.656px;
        height: 34.5px;
        top: 651.888px;
        left: 0px;
    }

    #HEADLINE148 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE148>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE149 {
        width: 439px;
        top: 4px;
        left: 41.656px;
    }

    #HEADLINE149>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP147 {
        width: 480.656px;
        height: 44px;
        top: 700.194px;
        left: 0px;
    }

    #SHAPE150 {
        width: 24px;
        height: 24px;
        top: 826.2px;
        left: 237.5px;
    }

    #SHAPE150 svg:last-child {
        fill: rgba(244, 184, 156, 1);
    }

    #BOX154 {
        width: 499px;
        height: 678.6px;
        top: 0px;
        left: 0px;
    }

    #BOX154>.ladi-box>.ladi-overlay {
        background: rgba(164, 31, 36, 0.9);
        background: -webkit-linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
    }

    #BOX154>.ladi-box {
        box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        -webkit-box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s800x1000/5c7362c6c417ab07e5196b05/cv19_79-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE155 {
        width: 270px;
        top: 74.611px;
        left: 39.104px;
    }

    #HEADLINE155>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE155>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE156 {
        width: 48px;
        top: 38.792px;
        left: 39.104px;
    }

    #LINE156>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE156>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE158 {
        width: 39px;
        top: 0.5px;
        left: 0px;
    }

    #HEADLINE158>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE159 {
        width: 440px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE159>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        font-weight: bold;
        line-height: 1.6;
    }

    #GROUP157 {
        width: 481.656px;
        height: 33.5px;
        top: 0px;
        left: 0px;
    }

    #SHAPE181 {
        width: 24px;
        height: 24px;
        top: 639.2px;
        left: 237.5px;
    }

    #SHAPE181 svg:last-child {
        fill: rgba(244, 184, 156, 1);
    }

    #SECTION152 {
        height: 448.6px;
        display: none !important;
    }

    #SECTION152.ladi-animation {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SECTION152>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #BOX183 {
        width: 250px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX183>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX183>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s600x550/5c7362c6c417ab07e5196b05/cv19_108-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE184 {
        width: 170px;
        top: 73.611px;
        left: 32.5866px;
    }

    #HEADLINE184>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE184>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE185 {
        width: 48px;
        top: 37.792px;
        left: 32.5866px;
    }

    #LINE185>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE185>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP182 {
        width: 250px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX187 {
        width: 250px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX187>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX187>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s600x550/5c7362c6c417ab07e5196b05/cv19_242-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE188 {
        width: 131px;
        top: 73.611px;
        left: 32.5866px;
    }

    #HEADLINE188>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE188>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE189 {
        width: 48px;
        top: 37.792px;
        left: 32.5866px;
    }

    #LINE189>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE189>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP186 {
        width: 250px;
        height: 230px;
        top: 0px;
        left: 250.5px;
    }

    #BOX191 {
        width: 200.5px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX191>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX191>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s550x550/5c7362c6c417ab07e5196b05/cv19_79-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE192 {
        width: 166px;
        top: 73.611px;
        left: 26.1344px;
    }

    #HEADLINE192>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE192>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE193 {
        width: 48px;
        top: 37.792px;
        left: 26.1344px;
    }

    #LINE193>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE193>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP190 {
        width: 200.5px;
        height: 230px;
        top: 0px;
        left: 999.5px;
    }

    #BOX196 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX196>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX196>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s550x550/5c7362c6c417ab07e5196b05/cv19_108-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE197 {
        width: 151px;
        top: 73.611px;
        left: 30.4576px;
    }

    #HEADLINE197>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE197>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE198 {
        width: 48px;
        top: 37.792px;
        left: 30.4576px;
    }

    #LINE198>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE198>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP195 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX200 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX200>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX200>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s550x550/5c7362c6c417ab07e5196b05/cv19_242-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE201 {
        width: 131px;
        top: 73.611px;
        left: 30.4576px;
    }

    #HEADLINE201>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE201>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE202 {
        width: 48px;
        top: 37.792px;
        left: 30.4576px;
    }

    #LINE202>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE202>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP199 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 233.667px;
    }

    #BOX204 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX204>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX204>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s550x550/5c7362c6c417ab07e5196b05/cv19_248-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE205 {
        width: 156px;
        top: 73.611px;
        left: 30.4576px;
    }

    #HEADLINE205>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE205>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE206 {
        width: 48px;
        top: 37.792px;
        left: 30.4576px;
    }

    #LINE206>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE206>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP203 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 467.333px;
    }

    #LINE208 {
        width: 970px;
        top: 943.514px;
        left: 0px;
    }

    #LINE208>.ladi-line>.ladi-line-container {
        border-top: 1px solid rgba(244, 184, 157, 0.6);
        border-right: 1px solid rgba(244, 184, 157, 0.6);
        border-bottom: 1px solid rgba(244, 184, 157, 0.6);
        border-left: 0px !important;
    }

    #LINE208>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #LIST_PARAGRAPH209 {
        width: 443px;
        top: 40.389px;
        left: 39.104px;
    }

    #LIST_PARAGRAPH209>.ladi-list-paragraph {
        color: rgb(255, 255, 255);
        font-size: 15px;
        text-align: left;
        line-height: 1.6;
    }

    #LIST_PARAGRAPH209 ul li {
        padding-bottom: 8px;
        padding-left: 25px;
    }

    #LIST_PARAGRAPH209 ul li:before {
        content: "";
        background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20version%3D%221.1%22%20x%3D%220px%22%20y%3D%220px%22%20viewBox%3D%220%200%20100%20100%22%20enable-background%3D%22new%200%200%20100%20100%22%20xml%3Aspace%3D%22preserve%22%20%20width%3D%22100%25%22%20height%3D%22100%25%22%20class%3D%22%22%20fill%3D%22rgba(255%2C%20235%2C%200%2C%201)%22%3E%3Cpath%20d%3D%22M50.1%2C10c22.1%2C0%2C40%2C17.9%2C40%2C40s-17.9%2C40-40%2C40s-40-17.9-40-40S28%2C10%2C50.1%2C10%20M50.1%2C5c-24.9%2C0-45%2C20.1-45%2C45s20.1%2C45%2C45%2C45%20%20s45-20.1%2C45-45S74.9%2C5%2C50.1%2C5L50.1%2C5z%22%3E%3C%2Fpath%3E%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M73.6%2C38.9L73.6%2C38.9L46.9%2C66.2l0%2C0c-0.6%2C0.6-1.5%2C1-2.5%2C1c-1%2C0-1.8-0.4-2.5-1l0%2C0%20%20L26.8%2C50.8l0%2C0c-0.6-0.6-1-1.5-1-2.5c0-2%2C1.6-3.6%2C3.5-3.6c1%2C0%2C1.8%2C0.4%2C2.5%2C1l0%2C0l12.6%2C12.9l24.3-24.8l0%2C0c0.6-0.6%2C1.5-1%2C2.5-1%20%20c1.9%2C0%2C3.5%2C1.6%2C3.5%2C3.6C74.6%2C37.4%2C74.2%2C38.3%2C73.6%2C38.9z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E");
        width: 20px;
        height: 20px;
        top: 3px;
    }

    #GROUP210 {
        width: 482.104px;
        height: 196.389px;
        top: 144.553px;
        left: 0px;
    }

    #HEADLINE213 {
        width: 39px;
        top: 0.5px;
        left: 0px;
    }

    #HEADLINE213>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE214 {
        width: 440px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE214>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        font-weight: bold;
        line-height: 1.6;
    }

    #GROUP212 {
        width: 481.656px;
        height: 33.5px;
        top: 0px;
        left: 0px;
    }

    #LIST_PARAGRAPH215 {
        width: 443px;
        top: 40.389px;
        left: 39.104px;
    }

    #LIST_PARAGRAPH215>.ladi-list-paragraph {
        color: rgb(255, 255, 255);
        font-size: 15px;
        text-align: left;
        line-height: 1.6;
    }

    #LIST_PARAGRAPH215 ul li {
        padding-bottom: 8px;
        padding-left: 25px;
    }

    #LIST_PARAGRAPH215 ul li:before {
        content: "";
        background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20version%3D%221.1%22%20x%3D%220px%22%20y%3D%220px%22%20viewBox%3D%220%200%20100%20100%22%20enable-background%3D%22new%200%200%20100%20100%22%20xml%3Aspace%3D%22preserve%22%20%20width%3D%22100%25%22%20height%3D%22100%25%22%20class%3D%22%22%20fill%3D%22rgba(255%2C%20235%2C%200%2C%201)%22%3E%3Cpath%20d%3D%22M50.1%2C10c22.1%2C0%2C40%2C17.9%2C40%2C40s-17.9%2C40-40%2C40s-40-17.9-40-40S28%2C10%2C50.1%2C10%20M50.1%2C5c-24.9%2C0-45%2C20.1-45%2C45s20.1%2C45%2C45%2C45%20%20s45-20.1%2C45-45S74.9%2C5%2C50.1%2C5L50.1%2C5z%22%3E%3C%2Fpath%3E%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M73.6%2C38.9L73.6%2C38.9L46.9%2C66.2l0%2C0c-0.6%2C0.6-1.5%2C1-2.5%2C1c-1%2C0-1.8-0.4-2.5-1l0%2C0%20%20L26.8%2C50.8l0%2C0c-0.6-0.6-1-1.5-1-2.5c0-2%2C1.6-3.6%2C3.5-3.6c1%2C0%2C1.8%2C0.4%2C2.5%2C1l0%2C0l12.6%2C12.9l24.3-24.8l0%2C0c0.6-0.6%2C1.5-1%2C2.5-1%20%20c1.9%2C0%2C3.5%2C1.6%2C3.5%2C3.6C74.6%2C37.4%2C74.2%2C38.3%2C73.6%2C38.9z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E");
        width: 20px;
        height: 20px;
        top: 3px;
    }

    #GROUP211 {
        width: 482.104px;
        height: 196.389px;
        top: 360.748px;
        left: 0px;
    }

    #HEADLINE218 {
        width: 248px;
        top: 154.5px;
        left: 26px;
    }

    #HEADLINE218>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 19, 21);
        font-size: 23px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE219 {
        width: 248px;
        top: 197.5px;
        left: 26px;
    }

    #HEADLINE219>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        text-align: center;
        line-height: 1.6;
    }

    #BOX220 {
        width: 457px;
        height: 400px;
        top: 115px;
        left: -457px;
    }

    #BOX220>.ladi-box {
        background: <?=hex2rgba(get_field('primary_color'),0.9);?>;
        /* background: -webkit-linear-gradient(90deg, rgba(164, 31, 34, 0.3), rgba(164, 31, 33, 1));
        background: linear-gradient(90deg, rgba(164, 31, 34, 0.3), rgba(164, 31, 33, 1)); */
    }

    #GROUP222 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #SECTION230 {
        height: 412.4px;
    }

    #SECTION230>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #CAROUSEL231 {
        width: 900px;
        height: 400px;
        top: 115px;
        left: 0px;
    }

    #SECTION250 {
        height: 749.4px;
    }

    #SECTION250>.ladi-overlay {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("<?=wp_get_attachment_url((int)get_field('background_nopbai'));?>");
        background-position: center top;
        background-repeat: repeat;
        mix-blend-mode: multiply;
        will-change: transform, opacity;
    }

    #SECTION250>.ladi-section-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #GROUP251 {
        width: 430px;
        height: 104.611px;
        top: 58.986px;
        left: 385px;
    }

    #HEADLINE253 {
        width: 430px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE253>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 20, 22);
        font-size: 48px;
        text-align: center;
        line-height: 1.6;
    }

    #LINE254 {
        width: 73px;
        top: 85.611px;
        left: 178.5px;
    }

    #LINE254>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE254>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP252 {
        width: 430px;
        height: 104.611px;
        top: 36.344px;
        left: 385px;
    }

    #FRAME268 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #FRAME268>.ladi-frame>.ladi-frame-background {
        background-color: rgba(251, 251, 251, 0);
    }

    #GROUP270 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #BOX273 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #BOX273>.ladi-box {
        background-color: rgb(243, 243, 243);
    }

    #HEADLINE274 {
        width: 248px;
        top: 154.5px;
        left: 26px;
    }

    #HEADLINE274>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 19, 21);
        font-size: 23px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE275 {
        width: 248px;
        top: 197.5px;
        left: 26px;
    }

    #HEADLINE275>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        text-align: center;
        line-height: 1.6;
    }

    #GROUP272 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #FRAME276 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #FRAME276>.ladi-frame>.ladi-frame-background {
        background-color: rgba(251, 251, 251, 0);
    }

    #GROUP271 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 300px;
    }

    #BOX287 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #BOX287>.ladi-box {
        background-color: rgb(243, 243, 243);
    }

    #HEADLINE288 {
        width: 248px;
        top: 154.5px;
        left: 26px;
    }

    #HEADLINE288>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 19, 21);
        font-size: 23px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE289 {
        width: 248px;
        top: 197.5px;
        left: 26px;
    }

    #HEADLINE289>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        text-align: center;
        line-height: 1.6;
    }

    #GROUP286 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #IMAGE291 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #IMAGE291>.ladi-image>.ladi-image-background {
        width: 300px;
        height: 406.78px;
        top: 0px;
        left: 0px;
        background-image: url("https://demo.digityze.asia/vnpr/wp-content/uploads/2021/03/166324212_2771952573070458_7156981449962380149_n.jpg");
    }

    /* #IMAGE291 > .ladi-image {
                    filter: grayscale(100%);
                } */
    #IMAGE291:hover>.ladi-image {
        transform: scale(1.15);
        -webkit-transform: scale(1.15);
        opacity: 0.07;
    }

    #FRAME290 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #FRAME290>.ladi-frame>.ladi-frame-background {
        background-color: rgba(251, 251, 251, 0);
    }

    #GROUP285 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 600px;
    }

    #IMAGE299 {
        width: 200px;
        height: 104.245px;
        top: 54.3774px;
        left: 0px;
    }

    #IMAGE299>.ladi-image>.ladi-image-background {
        width: 200px;
        height: 104.245px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x450/5c7362c6c417ab07e5196b05/asset-33x-20200822113849.png");
    }

    #IMAGE299.ladi-animation>.ladi-image {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 2s;
        -webkit-animation-duration: 2s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #IMAGE300 {
        width: 190.622px;
        height: 74.6933px;
        top: 87.6536px;
        left: 55px;
    }

    #IMAGE300>.ladi-image>.ladi-image-background {
        width: 190.622px;
        height: 74.6933px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x400/5c7362c6c417ab07e5196b05/asset-143x-20200822142004.png");
    }

    #IMAGE301 {
        width: 202.622px;
        height: 80.8269px;
        top: 84.586px;
        left: 349.167px;
    }

    #IMAGE301>.ladi-image>.ladi-image-background {
        width: 202.622px;
        height: 80.8269px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x400/5c7362c6c417ab07e5196b05/asset-153x-20200822142004.png");
    }

    #IMAGE302 {
        width: 206.928px;
        height: 48.7924px;
        top: 100.604px;
        left: 648.335px;
    }

    #IMAGE302>.ladi-image>.ladi-image-background {
        width: 206.928px;
        height: 48.7924px;
        top: -0.000046px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x350/5c7362c6c417ab07e5196b05/layer-1-20200822142539.png");
    }

    #IMAGE303 {
        width: 167.748px;
        height: 108.655px;
        top: 70.672px;
        left: 967.808px;
    }

    #IMAGE303>.ladi-image>.ladi-image-background {
        width: 167.748px;
        height: 108.655px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x450/5c7362c6c417ab07e5196b05/asset-73x-20200822120323.png");
    }

    #IMAGE304 {
        width: 173.875px;
        height: 56.3594px;
        top: 96.82px;
        left: 1264.13px;
    }

    #IMAGE304>.ladi-image>.ladi-image-background {
        width: 173.875px;
        height: 56.3594px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x400/5c7362c6c417ab07e5196b05/asset-83x-20200822120323.png");
    }

    #IMAGE305 {
        width: 190.622px;
        height: 86.9592px;
        top: 81.52px;
        left: 1857.93px;
    }

    #IMAGE305>.ladi-image>.ladi-image-background {
        width: 190.622px;
        height: 86.9592px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x400/5c7362c6c417ab07e5196b05/layer-2-20200822120333.png");
    }

    #IMAGE306 {
        width: 191px;
        height: 49.5618px;
        top: 100.219px;
        left: 1557.59px;
    }

    #IMAGE306>.ladi-image>.ladi-image-background {
        width: 191px;
        height: 49.5618px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x350/5c7362c6c417ab07e5196b05/asset-53x-20200822120323.png");
    }

    #CAROUSEL307 {
        width: 1200px;
        height: 250px;
        top: 134.688px;
        left: 0px;
    }

    #IMAGE308 {
        width: 200px;
        height: 118.423px;
        top: 19.2888px;
        left: 1019px;
        display: none !important;
    }

    #IMAGE308>.ladi-image>.ladi-image-background {
        width: 200px;
        height: 118.423px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x450/5c7362c6c417ab07e5196b05/asset-33x-20200821032937.png");
    }

    #HEADLINE310 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE310>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE311 {
        width: 439px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE311>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP309 {
        width: 480.656px;
        height: 47px;
        top: 758px;
        left: 0.5px;
    }

    #GROUP312 {
        width: 499px;
        height: 866.6px;
        top: 0px;
        left: 500.5px;
    }

    #POPUP334 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP334>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP334>.ladi-popup {
        border-radius: 0px;
    }

    #BOX335 {
        width: 128px;
        height: 48px;
        top: 0px;
        left: 0px;
    }

    #BOX335>.ladi-box {
        box-shadow: 0px -5px 10px 0px rgba(1, 1, 1, 0.1);
        -webkit-box-shadow: 0px -5px 10px 0px rgba(1, 1, 1, 0.1);
        background-color: rgb(243, 243, 243);
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    #SECTION336 {
        height: 335.9px;
    }

    #SECTION336>.ladi-overlay {
        background-color: rgb(122, 20, 22);
    }

    #SECTION336>.ladi-section-background {
        background-color: rgb(122, 20, 22);
    }

    #HEADLINE398 {
        width: 123px;
        top: 4px;
        left: 3px;
    }

    #HEADLINE398>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 12px;
        text-align: center;
        line-height: 1.6;
    }

    #IMAGE399 {
        width: 90px;
        height: 23px;
        top: 20.556px;
        left: 20px;
    }

    #IMAGE399>.ladi-image>.ladi-image-background {
        width: 90px;
        height: 23.3333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/5c7362c6c417ab07e5196b05/ladipage-logo-color-1558579165-20200823023440.svg");
    }

    #GROUP400 {
        width: 128px;
        height: 48px;
        top: auto;
        left: auto;
        bottom: 0px;
        right: 8px;
        position: fixed;
        z-index: 90000050;
    }

    #GROUP400.ladi-animation>.ladi-group {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 1s;
        -webkit-animation-delay: 1s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #IMAGE401 {
        width: 615.585px;
        height: 364.497px;
        top: -157.585px;
        left: 292.207px;
    }

    #IMAGE401>.ladi-image>.ladi-image-background {
        width: 615.585px;
        height: 364.497px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s950x700/5c7362c6c417ab07e5196b05/asset-33x-20200821032937.png");
    }

    #IMAGE401.ladi-animation>.ladi-image {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #IMAGE411 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE411>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_203s-20200823132902.jpg");
    }

    #HEADLINE412 {
        width: 294px;
        top: 2.5px;
        left: 467.167px;
    }

    #HEADLINE412>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE413 {
        width: 418px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE413>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE414 {
        height: 19px;
        top: 4.5px;
        left: 437.5px;
    }

    #LINE414>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE414>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE415 {
        width: 753px;
        top: 47.5px;
        left: 0px;
    }

    #HEADLINE415>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP416 {
        width: 1200px;
        height: 230px;
        top: 533.6px;
        left: 0px;
    }

    #SHAPE417 {
        width: 28.0002px;
        height: 28.0002px;
        top: 0px;
        left: 0px;
        display: none !important;
    }

    #SHAPE417.ladi-animation>.ladi-shape {
        animation-name: shake;
        -webkit-animation-name: shake;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 10s;
        -webkit-animation-duration: 10s;
        animation-iteration-count: infinite;
        -webkit-animation-iteration-count: infinite;
    }

    #SHAPE417 svg:last-child {
        fill: rgba(180, 180, 180, 1);
    }

    #IMAGE277 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #IMAGE277>.ladi-image>.ladi-image-background {
        width: 320px;
        height: 400px;
        top: 0px;
        left: 0px;
        background-image: url("https://demo.digityze.asia/vnpr/wp-content/uploads/2021/03/166754410_2771952356403813_868393098652331968_n.jpg");
    }

    /* #IMAGE277 > .ladi-image {
                    filter: grayscale(100%);
                } */
    #IMAGE277:hover>.ladi-image {
        transform: scale(1.15);
        -webkit-transform: scale(1.15);
        opacity: 0.07;
    }

    #IMAGE269 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #IMAGE269>.ladi-image>.ladi-image-background {
        width: 300.242px;
        height: 400px;
        top: 0px;
        left: 0px;
        background-image: url("https://demo.digityze.asia/vnpr/wp-content/uploads/2021/03/166672532_2771952473070468_3559815766938865075_n.jpg");
    }

    /* #IMAGE269 > .ladi-image {
                    filter: grayscale(100%);
                } */
    #IMAGE269:hover>.ladi-image {
        transform: scale(1.15);
        -webkit-transform: scale(1.15);
        opacity: 0.07;
    }

    #HEADLINE460 {
        width: 39px;
        top: 6.5px;
        left: 0px;
    }

    #HEADLINE460>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE461 {
        width: 440px;
        top: 0px;
        left: 41.656px;
    }

    #HEADLINE461>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        font-weight: bold;
        line-height: 1.6;
    }

    #GROUP459 {
        width: 481.656px;
        height: 47px;
        top: 576.942px;
        left: 0px;
    }

    #GROUP463 {
        width: 499px;
        height: 678.6px;
        top: 0px;
        left: 701px;
    }

    #HEADLINE465 {
        width: 1200px;
        top: 477.008px;
        left: 0px;
    }

    #HEADLINE465>.ladi-headline {
        color: rgb(228, 228, 228);
        font-size: 16px;
        font-style: italic;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE350 {
        width: 293px;
        top: 3px;
        left: 35px;
    }

    #HEADLINE350>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 14px;
        text-align: left;
        line-height: 1.4;
    }

    #SHAPE349 {
        width: 28.7993px;
        height: 22.5469px;
        top: 0px;
        left: 0px;
    }

    #SHAPE349 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP348 {
        width: 327px;
        height: 22.5469px;
        top: 118.953px;
        left: 0px;
    }

    #HEADLINE347 {
        width: 293px;
        top: 2px;
        left: 33px;
    }

    #HEADLINE347>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 14px;
        text-align: left;
        line-height: 1.4;
    }

    #SHAPE346 {
        width: 22.5469px;
        height: 22.5469px;
        top: 0px;
        left: 0px;
    }

    #SHAPE346 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP345 {
        width: 325px;
        height: 22.5469px;
        top: 85.62px;
        left: 3.06581px;
    }

    #HEADLINE344 {
        width: 293px;
        top: 2px;
        left: 33px;
    }

    #HEADLINE344>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 14px;
        text-align: left;
        line-height: 1.4;
    }

    #SHAPE343 {
        width: 22.5469px;
        height: 22.5469px;
        top: 0px;
        left: 0px;
    }

    #SHAPE343 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP342 {
        width: 325px;
        height: 22.5469px;
        top: 52.286px;
        left: 3.06581px;
    }

    #HEADLINE338 {
        width: 549px;
        top: 0px;
        left: 0.766455px;
    }

    #HEADLINE338>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 18px;
        font-weight: bold;
        text-align: left;
        line-height: 1.4;
    }

    #GROUP337 {
        width: 549.766px;
        height: 141.5px;
        top: 62.671px;
        left: 0px;
    }

    #HTML_CODE466 {
        width: 430px;
        height: 240px;
        top: 62.671px;
        left: 770px;
    }

    #GROUP467 {
        width: 1200px;
        height: 678.6px;
        top: -230px;
        left: 0px;
    }

    #GROUP469 {
        width: 1200px;
        height: 866.6px;
        top: -230px;
        left: 0px;
    }

    #BOX472 {
        width: 1200px;
        height: 27px;
        top: 0px;
        left: 0px;
    }

    #BOX472>.ladi-box {
        background: rgba(255, 236, 0, 0.2);
        background: -webkit-radial-gradient(circle, rgba(255, 236, 0, 0.2), rgba(255, 255, 255, 0));
        background: radial-gradient(circle, rgba(255, 236, 0, 0.2), rgba(255, 255, 255, 0));
    }

    #HEADLINE474 {
        width: 398px;
        top: 3.5px;
        left: 401px;
    }

    #HEADLINE474>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 13px;
        text-align: center;
        line-height: 1.6;
    }

    #GROUP475 {
        width: 1200px;
        height: 27px;
        top: 506.6px;
        left: 0px;
    }

    #HEADLINE506 {
        width: 118px;
        top: 0px;
        left: 118px;
    }

    #HEADLINE506>.ladi-headline {
        text-decoration-line: underline;
        -webkit-text-decoration-line: underline;
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        line-height: 1.6;
    }

    #HEADLINE507 {
        width: 126px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE507>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP508 {
        width: 236px;
        height: 23px;
        top: 80.447px;
        left: 40.6559px;
    }

    #HEADLINE510 {
        width: 234px;
        top: 114.447px;
        left: 40.6559px;
    }

    #HEADLINE510>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.4;
    }

    #GROUP523 {
        width: 276.656px;
        height: 174.447px;
        top: 203.553px;
        left: 0px;
    }

    #GROUP524 {
        width: 300px;
        height: 441px;
        top: -230px;
        left: 0px;
    }

    #HEADLINE525 {
        width: 1200px;
        top: 614.008px;
        left: 0px;
    }

    #HEADLINE525>.ladi-headline {
        color: rgb(228, 228, 228);
        font-size: 16px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE526 {
        width: 608px;
        top: 565.008px;
        left: 296px;
    }

    #HEADLINE526>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('secondary_color')?>;
        font-size: 23px;
        text-align: center;
        line-height: 1.6;
    }

    #BOX527 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX527>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #SHAPE528 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE528 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #SHAPE529 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE529>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE529 svg:last-child {
        fill: rgba(255, 255, 255, 0.5);
    }

    #BOX530 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX530>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #BOX531 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX531>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #GROUP532 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #GROUP626 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #POPUP640 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP640>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP640>.ladi-popup {
        border-radius: 0px;
    }

    #BOX641 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX641>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE642 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE642>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_3s-20200823132902.jpg");
    }

    #HEADLINE643 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE643>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE644 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE644>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE645 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE645>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE645>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE646 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE646>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP647 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX648 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX648>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE649 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE649>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE649 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP650 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX651 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX651>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE652 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE652 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP653 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP653>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP653>.ladi-popup {
        border-radius: 0px;
    }

    #BOX654 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX654>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE655 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE655>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_46s-20200823132902.jpg");
    }

    #HEADLINE656 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE656>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE657 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE657>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE658 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE658>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE658>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE659 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE659>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP660 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX661 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX661>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE662 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE662>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE662 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP663 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX664 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX664>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE665 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE665 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP666 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP666>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP666>.ladi-popup {
        border-radius: 0px;
    }

    #BOX667 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX667>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE668 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE668>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_55s-20200823132902.jpg");
    }

    #HEADLINE669 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE669>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE670 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE670>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE671 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE671>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE671>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE672 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE672>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP673 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX674 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX674>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE675 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE675>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE675 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP676 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX677 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX677>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE678 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE678 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP679 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP679>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP679>.ladi-popup {
        border-radius: 0px;
    }

    #BOX680 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX680>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE681 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE681>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_261s-20200823132902.jpg");
    }

    #HEADLINE682 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE682>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE683 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE683>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE684 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE684>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE684>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE685 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE685>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP686 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX687 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX687>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE688 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE688>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE688 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP689 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX690 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX690>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE691 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE691 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP692 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP692>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP692>.ladi-popup {
        border-radius: 0px;
    }

    #BOX693 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX693>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE694 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE694>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_236s-20200823132902.jpg");
    }

    #HEADLINE695 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE695>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE696 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE696>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE697 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE697>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE697>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE698 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE698>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP699 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX700 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX700>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE701 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE701>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE701 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP702 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX703 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX703>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE704 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE704 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #HEADLINE403 {
        width: 608px;
        top: 32.566px;
        left: 21px;
    }

    #HEADLINE403>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        text-align: center;
        line-height: 1.6;
    }

    #BUTTON_TEXT738 {
        width: 210px;
        top: 9px;
        left: 0px;
    }

    #BUTTON_TEXT738>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        line-height: 1.6;
    }

    #BUTTON738 {
        width: 239.057px;
        height: 52px;
        top: 113.654px;
        left: 205.471px;
    }

    #BUTTON738>.ladi-button>.ladi-button-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #BUTTON738>.ladi-button {
        border-color: <?=get_field('secondary_color')?>;
        border-width: 2px;
    }

    #BUTTON738>.ladi-button:hover {
        transform: scale(1.03);
        -webkit-transform: scale(1.03);
    }

    #BOX744 {
        width: 650px;
        height: 246px;
        top: 0px;
        left: 0px;
    }

    #BOX744>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #POPUP749 {
        width: 651px;
        height: 548px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP749>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #BOX752 {
        width: 478px;
        height: 255.069px;
        top: 0px;
        left: 0px;
    }

    #BOX752>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #HEADLINE753 {
        width: 391px;
        top: 32.566px;
        left: 43.5px;
    }

    #HEADLINE753>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        text-align: center;
        line-height: 1.6;
    }

    #BUTTON_TEXT756 {
        width: 239px;
        top: 9px;
        left: 0px;
    }

    #BUTTON_TEXT756>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        line-height: 1.6;
    }

    #BUTTON756 {
        width: 239.057px;
        height: 52px;
        top: 109.654px;
        left: 119.472px;
    }

    #BUTTON756>.ladi-button>.ladi-button-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #BUTTON756>.ladi-button {
        border-color: <?=get_field('secondary_color')?>;
        border-width: 2px;
    }

    #BUTTON756>.ladi-button:hover {
        transform: scale(1.03);
        -webkit-transform: scale(1.03);
    }

    #IMAGE758 {
        width: 483.854px;
        height: 286.497px;
        top: 20px;
        left: 83.573px;
    }

    #IMAGE758>.ladi-image>.ladi-image-background {
        width: 483.854px;
        height: 286.497px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s800x600/5c7362c6c417ab07e5196b05/asset-33x-20200821032937.png");
    }

    #IMAGE758.ladi-animation>.ladi-image {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #HEADLINE759 {
        width: 511px;
        top: 180px;
        left: 69.4995px;
    }

    #HEADLINE759>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 15px;
        text-align: center;
        line-height: 1.4;
    }

    #GROUP760 {
        width: 650px;
        height: 246px;
        top: 189.346px;
        left: 275px;
    }

    #HEADLINE761 {
        width: 386px;
        top: 183.069px;
        left: 46px;
    }

    #HEADLINE761>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 15px;
        text-align: center;
        line-height: 1.4;
    }

    #GROUP762 {
        width: 478px;
        height: 255.069px;
        top: 292.931px;
        left: 86.5px;
    }

    #GROUP762.ladi-animation>.ladi-group {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #POPUP763 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP763>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP763>.ladi-popup {
        border-radius: 0px;
    }

    #BOX764 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX764>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE765 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE765>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.641px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_199-20200824104830.jpg");
    }

    #HEADLINE766 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE766>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE767 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE767>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE768 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE768>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE768>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE769 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE769>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP770 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX771 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX771>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE772 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE772>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE772 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP773 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX774 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX774>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE775 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE775 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP776 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP776>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP776>.ladi-popup {
        border-radius: 0px;
    }

    #BOX777 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX777>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE778 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE778>.ladi-image>.ladi-image-background {
        width: 810.724px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_188-20200824104830.jpg");
    }

    #HEADLINE779 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE779>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE780 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE780>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE781 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE781>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE781>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE782 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE782>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP783 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX784 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX784>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE785 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE785>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE785 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP786 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX787 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX787>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE788 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE788 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP789 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP789>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP789>.ladi-popup {
        border-radius: 0px;
    }

    #BOX790 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX790>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE791 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE791>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_67-20200824104829.jpg");
    }

    #HEADLINE792 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE792>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE793 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE793>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE794 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE794>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE794>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE795 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE795>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP796 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX797 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX797>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE798 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE798>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE798 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP799 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX800 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX800>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE801 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE801 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP802 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP802>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP802>.ladi-popup {
        border-radius: 0px;
    }

    #BOX803 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX803>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE804 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE804>.ladi-image>.ladi-image-background {
        width: 810.951px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_52-20200824104829.jpg");
    }

    #HEADLINE805 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE805>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE806 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE806>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE807 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE807>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE807>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE808 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE808>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP809 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX810 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX810>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE811 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE811>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE811 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP812 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX813 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX813>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE814 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE814 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP815 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP815>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP815>.ladi-popup {
        border-radius: 0px;
    }

    #BOX816 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX816>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE817 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE817>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_87-20200824104829.jpg");
    }

    #HEADLINE818 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE818>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE819 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE819>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE820 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE820>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE820>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE821 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE821>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP822 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX823 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX823>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE824 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE824>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE824 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP825 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX826 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX826>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE827 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE827 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP828 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP828>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP828>.ladi-popup {
        border-radius: 0px;
    }

    #BOX829 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX829>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE830 {
        width: 359.5px;
        height: 541.335px;
        top: 0px;
        left: 228.333px;
    }

    #IMAGE830>.ladi-image>.ladi-image-background {
        width: 360.358px;
        height: 541.335px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s700x850/5c7362c6c417ab07e5196b05/cv19_196-20200824104829.jpg");
    }

    #HEADLINE831 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE831>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE832 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE832>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE833 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE833>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE833>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE834 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE834>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP835 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX836 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX836>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE837 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE837>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE837 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP838 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX839 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX839>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE840 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE840 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #IMAGE841 {
        width: 811.003px;
        height: 540.668px;
        top: 0px;
        left: 0px;
    }

    #IMAGE841>.ladi-image>.ladi-image-background {
        width: 811.003px;
        height: 540.669px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_196-20200824104829.jpg");
    }

    #IMAGE841>.ladi-image {
        filter: brightness(70%) grayscale(100%);
    }

    #HEADLINE844 {
        width: 638px;
        top: 36.344px;
        left: 281.5px;
    }

    #HEADLINE844>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 20, 22);
        font-size: 48px;
        text-align: center;
        line-height: 1.6;
    }

    #LINE845 {
        width: 73px;
        top: 125px;
        left: 563.5px;
    }

    #LINE845>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE845>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #IMAGE847 {
        width: 221.841px;
        height: 47.6446px;
        top: 101.178px;
        left: 43.0121px;
    }

    #IMAGE847>.ladi-image>.ladi-image-background {
        width: 221.841px;
        height: 47.7267px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x350/5c7362c6c417ab07e5196b05/mangsec-vn-20200825091835.png");
    }

    #IMAGE848 {
        width: 227.525px;
        height: 90.7609px;
        top: 81.52px;
        left: 340.167px;
    }

    #IMAGE848>.ladi-image>.ladi-image-background {
        width: 265.655px;
        height: 187.759px;
        top: -38.1788px;
        left: -15.6725px;
        background-image: url("https://w.ladicdn.com/5c7362c6c417ab07e5196b05/logo_baopnvn_web-20200825061516.svg");
    }

    #IMAGE849 {
        width: 180.482px;
        height: 56.1879px;
        top: 96.9063px;
        left: 661.335px;
    }

    #IMAGE849>.ladi-image>.ladi-image-background {
        width: 180.482px;
        height: 56.1879px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x400/5c7362c6c417ab07e5196b05/logo-20200825061516.png");
    }

    #IMAGE850 {
        width: 197.378px;
        height: 66.655px;
        top: 93.573px;
        left: 951.311px;
    }

    #IMAGE850>.ladi-image>.ladi-image-background {
        width: 197.378px;
        height: 66.655px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x400/5c7362c6c417ab07e5196b05/dnvn-logo-20200825061516.png");
    }

    #CAROUSEL846 {
        width: 1200px;
        height: 250px;
        top: 173.688px;
        left: 0px;
    }

    #SECTION842 {
        height: 200px;
    }

    #SECTION842>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #IMAGE854 {
        width: 274px;
        height: 51.3446px;
        top: 99.328px;
        left: 1214px;
    }

    #IMAGE854>.ladi-image>.ladi-image-background {
        width: 274px;
        height: 51.3446px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s600x400/5c7362c6c417ab07e5196b05/logo_full-20200825061516.png");
    }

    #IMAGE855 {
        width: 204.49px;
        height: 96.7609px;
        top: 78.5201px;
        left: 1550.51px;
    }

    #IMAGE855>.ladi-image>.ladi-image-background {
        width: 204.49px;
        height: 144.71px;
        top: -25.1652px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x450/5c7362c6c417ab07e5196b05/bao-the-thao-van-hoa-dua-tin-ve-muabannhanh-com-giai-phap-mua-ban-nhanh-hon-tren-di-dong_555ff99162fef1432353169-20200826014326.jpg");
    }

    #IMAGE855>.ladi-image {
        border-radius: 5px;
    }

    #IMAGE856 {
        width: 115.921px;
        height: 134px;
        top: 57.9995px;
        left: 1890.37px;
    }

    #IMAGE856>.ladi-image>.ladi-image-background {
        width: 115.921px;
        height: 134.279px;
        top: -0.279106px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x450/5c7362c6c417ab07e5196b05/unnamed-2-20200826020502.jpg");
    }

    #IMAGE857 {
        width: 219.939px;
        height: 40.9853px;
        top: 106.408px;
        left: 2142.31px;
    }

    #IMAGE857>.ladi-image>.ladi-image-background {
        width: 219.939px;
        height: 41.0553px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x350/5c7362c6c417ab07e5196b05/logo-1-20200826014326.png");
    }

    #HEADLINE860 {
        width: 398px;
        top: 113.344px;
        left: 401px;
    }

    #HEADLINE860>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 14px;
        text-align: center;
        line-height: 1.6;
    }

    #POPUP892 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP892>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP892>.ladi-popup {
        border-radius: 0px;
    }

    #BOX893 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX893>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE894 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE894>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_27-20200825070311.jpg");
    }

    #HEADLINE895 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE895>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE896 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE896>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE897 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE897>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE897>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE898 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE898>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP899 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX900 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX900>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE901 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE901>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE901 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP902 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX903 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX903>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE904 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE904 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP905 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP905>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP905>.ladi-popup {
        border-radius: 0px;
    }

    #BOX906 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX906>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE907 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE907>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_32-20200825070310.jpg");
    }

    #HEADLINE908 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE908>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE909 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE909>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE910 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE910>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE910>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE911 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE911>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP912 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX913 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX913>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE914 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE914>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE914 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP915 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX916 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX916>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE917 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE917 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP918 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP918>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP918>.ladi-popup {
        border-radius: 0px;
    }

    #BOX919 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX919>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE920 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE920>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_50-20200825070309.jpg");
    }

    #HEADLINE921 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE921>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE922 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE922>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE923 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE923>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE923>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE924 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE924>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP925 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX926 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX926>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE927 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE927>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE927 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP928 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX929 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX929>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE930 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE930 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP931 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP931>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP931>.ladi-popup {
        border-radius: 0px;
    }

    #BOX932 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX932>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE933 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE933>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_224-20200825070309.jpg");
    }

    #HEADLINE934 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE934>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE935 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE935>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE936 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE936>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE936>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE937 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE937>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP938 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX939 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX939>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE940 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE940>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE940 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP941 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX942 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX942>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE943 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE943 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP944 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP944>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP944>.ladi-popup {
        border-radius: 0px;
    }

    #BOX945 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX945>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE946 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE946>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_248-2-20200825070708.jpg");
    }

    #HEADLINE947 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE947>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE948 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE948>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE949 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE949>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE949>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE950 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE950>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP951 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX952 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX952>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE953 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE953>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE953 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP954 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX955 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX955>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE956 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE956 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP957 {
        width: 981px;
        height: 740px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP957>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP957>.ladi-popup {
        border-radius: 0px;
    }

    #BOX958 {
        width: 810.5px;
        height: 740.994px;
        top: 0.006779px;
        left: 85.6249px;
    }

    #BOX958>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE959 {
        width: 810.5px;
        height: 540.333px;
        top: 0.003435px;
        left: 85.6249px;
    }

    #IMAGE959>.ladi-image>.ladi-image-background {
        width: 810.5px;
        height: 540.333px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_231-20200825070308.jpg");
    }

    #HEADLINE960 {
        width: 294px;
        top: 561.389px;
        left: 584.375px;
    }

    #HEADLINE960>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE961 {
        width: 418px;
        top: 558.889px;
        left: 117.208px;
    }

    #HEADLINE961>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE962 {
        height: 19px;
        top: 563.389px;
        left: 554.708px;
    }

    #LINE962>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE962>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE963 {
        width: 753px;
        top: 606.389px;
        left: 117.208px;
    }

    #HEADLINE963>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP964 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.006779px;
        left: 0px;
    }

    #BOX965 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX965>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE966 {
        width: 43.9997px;
        height: 43.9997px;
        top: 348px;
        left: 20.8126px;
    }

    #SHAPE966>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE966 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP967 {
        width: 85.6249px;
        height: 739.997px;
        top: 0.505279px;
        left: 896.125px;
    }

    #BOX968 {
        width: 85.6249px;
        height: 739.997px;
        top: 0px;
        left: 0px;
    }

    #BOX968>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE969 {
        width: 43.9997px;
        height: 43.9997px;
        top: 347.999px;
        left: 20.813px;
    }

    #SHAPE969 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #IMAGE1005 {
        width: 237.462px;
        height: 71.3745px;
        top: 91.2133px;
        left: 2430.27px;
    }

    #IMAGE1005>.ladi-image>.ladi-image-background {
        width: 237.462px;
        height: 71.3745px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x400/5c7362c6c417ab07e5196b05/xuctiendoanhnghiep-01_2a8028292c-20200826014326.png");
    }

    #IMAGE1006 {
        width: 200px;
        height: 73.1707px;
        top: 90.3153px;
        left: 2750px;
    }

    #IMAGE1006>.ladi-image>.ladi-image-background {
        width: 200px;
        height: 73.1707px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x400/5c7362c6c417ab07e5196b05/logo-cnds-20200826021243.png");
    }

    #SECTION313 {
        height: 1138.4px;
    }

    #SECTION313>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #GROUP314 {
        width: 430px;
        height: 104.611px;
        top: 40.344px;
        left: 385px;
    }

    #LINE316 {
        width: 73px;
        top: 85.611px;
        left: 178.5px;
    }

    #LINE316>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE316>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE315 {
        width: 430px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE315>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 20, 22);
        font-size: 48px;
        text-align: center;
        line-height: 1.6;
    }

    #GROUP1200 {
        width: 761.167px;
        height: 70.5px;
        top: 558.889px;
        left: 117.208px;
    }

    #GROUP1305 {
        width: 811.003px;
        height: 541.335px;
        top: 0.505279px;
        left: 85.6249px;
    }

    #GALLERY1762 {
        width: 880px;
        height: 750.703px;
        top: 190.861px;
        left: 160px;
    }

    #GALLERY1762>.ladi-gallery>.ladi-gallery-view {
        height: calc(100% - 0px);
    }

    #GALLERY1762>.ladi-gallery>.ladi-gallery-control {
        height: 0px;
        display: none;
    }

    #GALLERY1762>.ladi-gallery>.ladi-gallery-control>.ladi-gallery-control-box>.ladi-gallery-control-item {
        width: 0px;
        height: 0px;
        margin-right: 0px;
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/mat-phuc-bat-nguoi-vuot-bien-trai-phep-cua-khau-qt-cau-treo-ha-tinh-20200921071755.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/mat-phuc-bat-nguoi-vuot-bien-trai-phep-cua-khau-qt-cau-treo-ha-tinh-20200921071755.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tre-trong-trang-phuc-bao-ho-nghi-met-ben-cau-thang-sau-khi-di-bo-nam-tang-lau-de-do-than-nhiet-cho-nguoi-duoc-cach-ly-o-ktx-khu-a-dhqg-tphcm-20200914103846.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tre-trong-trang-phuc-bao-ho-nghi-met-ben-cau-thang-sau-khi-di-bo-nam-tang-lau-de-do-than-nhiet-cho-nguoi-duoc-cach-ly-o-ktx-khu-a-dhqg-tphcm-20200914103846.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/tang-khau-trang-cho-tre-em-ngheo-vung-cao-20200924023204.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tang-khau-trang-cho-tre-em-ngheo-vung-cao-20200924023204.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="3"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/dem-chong-dich-ben-dong-song-se-pon-20200924023525.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="3"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/dem-chong-dich-ben-dong-song-se-pon-20200924023525.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="4"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/tam-biet-covid-19-20200924024146.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="4"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tam-biet-covid-19-20200924024146.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="5"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/hoang-thi-xuan-20200923082209.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="5"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/hoang-thi-xuan-20200923082209.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="6"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/ben-xe-buyt-nhung-ngay-gian-cach-20200907093802.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="6"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/ben-xe-buyt-nhung-ngay-gian-cach-20200907093802.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="7"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/phia-truoc-la-bau-troi-20200908031123.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="7"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/phia-truoc-la-bau-troi-20200908031123.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="8"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/huong-dan-rua-tay-phong-dich-covid-19-20200907093701.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="8"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/huong-dan-rua-tay-phong-dich-covid-19-20200907093701.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="9"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/huong-dan-deo-khau-trang-phong-dich-20200908030710.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="9"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/huong-dan-deo-khau-trang-phong-dich-20200908030710.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="10"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/chot-phong-dich-covid-19-vung-bien-gioi-20200907093742.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="10"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chot-phong-dich-covid-19-vung-bien-gioi-20200907093742.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="11"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/tham-du-thanh-le-online-20200911033603.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="11"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tham-du-thanh-le-online-20200911033603.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="12"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/covid-mua-02-2020-20200925045631.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="12"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/covid-mua-02-2020-20200925045631.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="13"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/chung-tay-day-lui-covid-19-20200908034009.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="13"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chung-tay-day-lui-covid-19-20200908034009.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="14"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/hoang-hon-mua-covid-20200908031358.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="14"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/hoang-hon-mua-covid-20200908031358.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="15"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/nhip-song-dan-tro-lai-hau-covid-19--20200908045540.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="15"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhip-song-dan-tro-lai-hau-covid-19--20200908045540.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="16"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/tinh-nguyen-vien-tiep-suc-mua-thi-tai-truong-thpt-thai-phien-ngo-quyen-hai-phong-20200907093619.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="16"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tinh-nguyen-vien-tiep-suc-mua-thi-tai-truong-thpt-thai-phien-ngo-quyen-hai-phong-20200907093619.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="17"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/bo-doi-phong-hoa-phun-khu-khuan-tren-cac-tuyen-pho-20200907093016.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="17"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/bo-doi-phong-hoa-phun-khu-khuan-tren-cac-tuyen-pho-20200907093016.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="18"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/tinh-yeu-tu-tam-dich-20200907092758.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="18"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tinh-yeu-tu-tam-dich-20200907092758.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="19"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/bua-com-trong-khu-cach-ly-20200908032720.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="19"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/bua-com-trong-khu-cach-ly-20200908032720.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="20"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/tranh-thu-20200908032703.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="20"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tranh-thu-20200908032703.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="21"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/oan-minh-chong-dich-giua-dai-ngan-truong-son-20200908032622.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="21"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/oan-minh-chong-dich-giua-dai-ngan-truong-son-20200908032622.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="22"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/xoa-deu-dung-dich-20201012025804.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="22"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/xoa-deu-dung-dich-20201012025804.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="23"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/1-mot-to-chot-cua-don-bien-phong-a-pa-chai-bo-chi-huy-bo-doi-bien-phong-tinh-dien-bien-tuan-tra-kiem-soat-duong-mon-loi-mo-doc-tuyen-bien-gioi-viet-trung-20200911070842.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="23"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/1-mot-to-chot-cua-don-bien-phong-a-pa-chai-bo-chi-huy-bo-doi-bien-phong-tinh-dien-bien-tuan-tra-kiem-soat-duong-mon-loi-mo-doc-tuyen-bien-gioi-viet-trung-20200911070842.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="24"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/2-kiem-tra-than-nhiet-cua-cac-lai-xe-truoc-khi-lam-thu-tuc-nhap-canh-tai-mot-chot-kiem-dich-cua-khau-quoc-te-tay-trang-tinh-dien-bien-20200911070936.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="24"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/2-kiem-tra-than-nhiet-cua-cac-lai-xe-truoc-khi-lam-thu-tuc-nhap-canh-tai-mot-chot-kiem-dich-cua-khau-quoc-te-tay-trang-tinh-dien-bien-20200911070936.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="25"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/trien-khai-xet-nghiem-nhanh-covid-19-tai-cho-dau-moi-nong-san-lon-nhat-ha-noi-20200909074929.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="25"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/trien-khai-xet-nghiem-nhanh-covid-19-tai-cho-dau-moi-nong-san-lon-nhat-ha-noi-20200909074929.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="26"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/hon-200-hanh-khach-mac-ket-tai-da-nang--20200908034818.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="26"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/hon-200-hanh-khach-mac-ket-tai-da-nang--20200908034818.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="27"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/chuyen-bay-dau-tien-dua-hanh-khach-mac-ket-tai-da-nang-20200908034842.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="27"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chuyen-bay-dau-tien-dua-hanh-khach-mac-ket-tai-da-nang-20200908034842.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="28"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/nguoi-hung-giau-mat-truy-tim-virut-corona-20200908041531.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="28"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nguoi-hung-giau-mat-truy-tim-virut-corona-20200908041531.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="29"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/niem-tin-quyet-thang-20200908041810.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="29"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/niem-tin-quyet-thang-20200908041810.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="30"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/nhung-anh-nuoi-khu-phong-toa-mua-covid-19-20200908041840.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="30"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhung-anh-nuoi-khu-phong-toa-mua-covid-19-20200908041840.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="31"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/mau-ao-thanh-nien-xung-phong-trong-chien-dich-phong-chong-covid-19-20200908041903.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="31"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/mau-ao-thanh-nien-xung-phong-trong-chien-dich-phong-chong-covid-19-20200908041903.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="32"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/tuyen-truyen-luu-dong-phong-chong-dich-covid-19-20200908041949.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="32"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tuyen-truyen-luu-dong-phong-chong-dich-covid-19-20200908041949.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="33"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/chot-da-chien-cua-khau-huu-nghi-lang-son-20200908043838.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="33"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chot-da-chien-cua-khau-huu-nghi-lang-son-20200908043838.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="34"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/cac-co-quan-doan-the-tuyen-truyen-chong-dich-covid-19-tai-cua-khau-quoc-te-huu-nghi-lang-son-20200908043913.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="34"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/cac-co-quan-doan-the-tuyen-truyen-chong-dich-covid-19-tai-cua-khau-quoc-te-huu-nghi-lang-son-20200908043913.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="35"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/thanh-nien-tinh-nguyen-tiep-suc-mua-thi-2020-tai-thi-tran-dong-dang-cao-loc-lang-son-20200908044026.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="35"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/thanh-nien-tinh-nguyen-tiep-suc-mua-thi-2020-tai-thi-tran-dong-dang-cao-loc-lang-son-20200908044026.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="36"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/doan-thanh-nien-thi-tran-dong-dang-cao-loc-lang-son-trong-mua-chong-dich-2020-20200908044045.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="36"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/doan-thanh-nien-thi-tran-dong-dang-cao-loc-lang-son-trong-mua-chong-dich-2020-20200908044045.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="37"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/da-day-lui-dich-covid-19-20200908044105.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="37"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/da-day-lui-dich-covid-19-20200908044105.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="38"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/bau-oi-thuong-lay-bi-cung-20200908045019.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="38"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/bau-oi-thuong-lay-bi-cung-20200908045019.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="39"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/mot-nhan-vien-y-te-truc-chot-di-dong-phong-dich-covid-19-o-da-nang-dang-co-chong-lai-con-buon-ngu-sau-ca-truc-dai-day-cang-thang-va-met-moi--20200911040033.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="39"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/mot-nhan-vien-y-te-truc-chot-di-dong-phong-dich-covid-19-o-da-nang-dang-co-chong-lai-con-buon-ngu-sau-ca-truc-dai-day-cang-thang-va-met-moi--20200911040033.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="40"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tien-hanh-lay-mau-xet-nghiem-covid-19-cho-nguoi-nuoc-ngoai-20200911040245.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="40"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tien-hanh-lay-mau-xet-nghiem-covid-19-cho-nguoi-nuoc-ngoai-20200911040245.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="41"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tinh-nguyen-den-tu-cac-tinh-thanh-chuan-bi-trang-phuc-bao-ho-truoc-gio-buoc-vao-tran-chien-chong-covid-19-o-da-nang-20200911040623.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="41"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tinh-nguyen-den-tu-cac-tinh-thanh-chuan-bi-trang-phuc-bao-ho-truoc-gio-buoc-vao-tran-chien-chong-covid-19-o-da-nang-20200911040623.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="42"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/mot-can-bo-dan-phong-quan-son-tra-20200911041250.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="42"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/mot-can-bo-dan-phong-quan-son-tra-20200911041250.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="43"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/nhan-vien-y-te-da-nang-cang-minh-chay-dua-voi-thoi-gian-de-luon-co-mat-trong-moi-tinh-huong-khi-dot-dich-covid-19-lan-thu-hai-bung-phat-o-da-nang-20200911042107.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="43"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhan-vien-y-te-da-nang-cang-minh-chay-dua-voi-thoi-gian-de-luon-co-mat-trong-moi-tinh-huong-khi-dot-dich-covid-19-lan-thu-hai-bung-phat-o-da-nang-20200911042107.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="44"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/niem-vui-cua-phi-cong-chuyen-bay-vn7160-dua-207-hanh-khach-mac-ket-o-da-nang-ve-ha-noi-20200911071717.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="44"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/niem-vui-cua-phi-cong-chuyen-bay-vn7160-dua-207-hanh-khach-mac-ket-o-da-nang-ve-ha-noi-20200911071717.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="45"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/nu-hon-thoi-covid-20200911072108.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="45"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nu-hon-thoi-covid-20200911072108.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="46"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/cac-cong-dan-tro-ve-tu-guinea-xich-dao-the-hien-su-biet-on-toi-dang-nha-nuoc-da-quan-tam-ho-tro-trong-luc-kho-khan-do-dich-covid-19-20200911073007.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="46"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/cac-cong-dan-tro-ve-tu-guinea-xich-dao-the-hien-su-biet-on-toi-dang-nha-nuoc-da-quan-tam-ho-tro-trong-luc-kho-khan-do-dich-covid-19-20200911073007.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="47"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/cong-dan-hoan-thanh-thoi-gian-cach-ly-cam-on-su-giup-do-cua-cac-can-bo-chien-sy-trung-doan-814-20200917035238.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="47"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/cong-dan-hoan-thanh-thoi-gian-cach-ly-cam-on-su-giup-do-cua-cac-can-bo-chien-sy-trung-doan-814-20200917035238.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="48"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/cu-ba-va-can-bo-y-te-tai-khu-cach-ly-tap-trung-quyen-luyen-truoc-khi-chia-tay-20200917035942.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="48"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/cu-ba-va-can-bo-y-te-tai-khu-cach-ly-tap-trung-quyen-luyen-truoc-khi-chia-tay-20200917035942.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="49"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/dong-chi-dai-ta-vu-hai-ninh-pho-chi-huy-truong-bo-chi-huy-quan-su-tinh-hoa-binh-trao-giay-chung-nhan-cho-cong-dan-hoan-thanh-thoi-gian-cach-ly-tap-trung-20200917035724.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="49"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/dong-chi-dai-ta-vu-hai-ninh-pho-chi-huy-truong-bo-chi-huy-quan-su-tinh-hoa-binh-trao-giay-chung-nhan-cho-cong-dan-hoan-thanh-thoi-gian-cach-ly-tap-trung-20200917035724.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="50"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/chot-chan-cong-tinh-20200911082349.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="50"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chot-chan-cong-tinh-20200911082349.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="51"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/thuc-canh-bien-gioi-20200911083027.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="51"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/thuc-canh-bien-gioi-20200911083027.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="52"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/truoc-gio-don-chuyen-bay-tro-ve-tu-vung-dich-20200911083049.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="52"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/truoc-gio-don-chuyen-bay-tro-ve-tu-vung-dich-20200911083049.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="53"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/khoang-cach-2m-20200911083104.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="53"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/khoang-cach-2m-20200911083104.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="54"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/kien-cuong-bam-chot-noi-bien-thuy-20200911085347.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="54"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/kien-cuong-bam-chot-noi-bien-thuy-20200911085347.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="55"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/y-thuc-chong-dich-20200911090132.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="55"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/y-thuc-chong-dich-20200911090132.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="56"] {
        background-image: url("https://w.ladicdn.com/s1200x1100/5c7362c6c417ab07e5196b05/nhung-chien-binh-covid-19-20200918033214.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="56"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhung-chien-binh-covid-19-20200918033214.jpg");
    }

    #IMAGE1768 {
        width: 200px;
        height: 57.7465px;
        top: 98.0274px;
        left: 3050px;
    }

    #IMAGE1768>.ladi-image>.ladi-image-background {
        width: 200px;
        height: 57.7465px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s550x400/5c7362c6c417ab07e5196b05/beatvn-logo-20200917100516.png");
    }

    #HTML_CODE1777 {
        width: 1200px;
        height: 743.5px;
        top: -0.5px;
        left: 0px;
    }

    #SECTION1776 {
        height: 743px;
        display: none !important;
    }

    #SECTION1776>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }
}

@media (max-width: 767px) {
    #SECTION_POPUP {
        height: 0px;
    }

    #SECTION3 {
        height: 754.881px;
    }

    #SECTION3>.ladi-section-background {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s768x754/5c7362c6c417ab07e5196b05/untitled-2-20200822125029.png");
        background-position: center top;
        background-repeat: repeat;
    }

    #BOX4 {
        width: 189.13px;
        height: 145px;
        top: 0px;
        left: 0px;
    }

    #BOX4>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX4>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s500x450/5c7362c6c417ab07e5196b05/cv19_108-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE11 {
        width: 116px;
        top: 46.407px;
        left: 24.6524px;
    }

    #HEADLINE11>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 28px;
        line-height: 1.4;
    }

    #HEADLINE11>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE12 {
        width: 30px;
        top: 23.8254px;
        left: 24.6524px;
    }

    #LINE12>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE12>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE17 {
        width: 373px;
        top: 147.611px;
        left: 24px;
    }

    #HEADLINE17>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        text-align: justify;
        line-height: 1.6;
    }

    #GROUP24 {
        width: 189.13px;
        height: 145px;
        top: 0px;
        left: 0px;
    }

    #BOX26 {
        width: 420px;
        height: 328px;
        top: 0px;
        left: 0px;
    }

    #BOX26>.ladi-box>.ladi-overlay {
        background: rgba(164, 31, 36, 0.9);
        background: -webkit-linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
    }

    #BOX26>.ladi-box {
        box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        -webkit-box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s750x650/5c7362c6c417ab07e5196b05/cv19_108-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE27 {
        width: 340px;
        top: 62.611px;
        left: 39.1039px;
    }

    #HEADLINE27>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE27>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE28 {
        width: 48px;
        top: 27.792px;
        left: 39.1039px;
    }

    #LINE28>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE28>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #SECTION30 {
        height: 342px;
        display: none !important;
    }

    #SECTION30.ladi-animation {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SECTION30>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #SECTION31 {
        height: 628px;
    }

    #SECTION31>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #BOX32 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #BOX32>.ladi-box {
        background-color: rgb(243, 243, 243);
    }

    #BOX38 {
        width: 420px;
        height: 184px;
        top: 0px;
        left: 0px;
    }

    #BOX38>.ladi-box>.ladi-overlay {
        background: rgba(164, 31, 35, 0.9);
        background: -webkit-linear-gradient(180deg, rgba(164, 31, 35, 0.9), rgba(124, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 35, 0.9), rgba(124, 20, 22, 1));
    }

    #BOX38>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s750x500/5c7362c6c417ab07e5196b05/cv19_261s-20200823132902.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE39 {
        width: 261px;
        top: 94.611px;
        left: 39.1039px;
    }

    #HEADLINE39>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE39>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE40 {
        width: 48px;
        top: 63.792px;
        left: 39.1039px;
    }

    #LINE40>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE40>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP37 {
        width: 420px;
        height: 184px;
        top: -1px;
        left: 0px;
    }

    #SECTION41 {
        height: 1283.95px;
    }

    #SECTION41>.ladi-section-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #IMAGE42 {
        width: 230.933px;
        height: 264px;
        top: 129.946px;
        left: 94.5335px;
    }

    #IMAGE42>.ladi-image>.ladi-image-background {
        width: 230.933px;
        height: 264px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/5c7362c6c417ab07e5196b05/asset-2-20200821032954.svg");
    }

    #IMAGE42.ladi-animation>.ladi-image {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #IMAGE43 {
        width: 381.43px;
        height: 225.85px;
        top: 235.245px;
        left: -479.715px;
        display: none !important;
    }

    #IMAGE43>.ladi-image>.ladi-image-background {
        width: 637.194px;
        height: 225.85px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s950x550/5c7362c6c417ab07e5196b05/asset-43x-20200822115004.png");
    }

    #IMAGE43.ladi-animation>.ladi-image {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1.5s;
        -webkit-animation-duration: 1.5s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #HEADLINE47 {
        width: 299px;
        top: 656.946px;
        left: 59.5px;
    }

    #HEADLINE47>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 14px;
        text-align: justify;
        line-height: 1.6;
    }

    #BOX48 {
        width: 372px;
        height: 608.443px;
        top: 624.095px;
        left: 24px;
    }

    #BOX48>.ladi-box {
        background-color: rgb(243, 243, 243);
    }

    #BUTTON50 {
        width: 180px;
        height: 48px;
        top: 1151.95px;
        left: 178.5px;
    }

    #BUTTON50>.ladi-button>.ladi-button-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #BUTTON50>.ladi-button {
        border-style: solid;
        border-color: <?=get_field('secondary_color')?>;
        border-width: 2px;
    }

    #BUTTON50>.ladi-button:hover {
        transform: scale(1.03);
        -webkit-transform: scale(1.03);
    }

    #BUTTON_TEXT50 {
        width: 185px;
        top: 9px;
        left: 0px;
    }

    #BUTTON_TEXT50>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 18px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE51 {
        width: 373px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE51>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 20, 22);
        font-size: 36px;
        text-align: center;
        line-height: 1.6;
    }

    #LINE57 {
        width: 73px;
        top: 64.611px;
        left: 149.5px;
    }

    #LINE57>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE57>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #BOX59 {
        width: 189.13px;
        height: 145px;
        top: 0px;
        left: 0px;
    }

    #BOX59>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX59>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s500x450/5c7362c6c417ab07e5196b05/cv19_242-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE60 {
        width: 110px;
        top: 46.407px;
        left: 24.6524px;
    }

    #HEADLINE60>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 28px;
        line-height: 1.4;
    }

    #HEADLINE60>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE61 {
        width: 30px;
        top: 23.8254px;
        left: 24.6524px;
    }

    #LINE61>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE61>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP58 {
        width: 189.13px;
        height: 145px;
        top: 0px;
        left: 189.13px;
    }

    #BOX63 {
        width: 189.13px;
        height: 145px;
        top: 0px;
        left: 0px;
    }

    #BOX63>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX63>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s500x450/5c7362c6c417ab07e5196b05/cv19_248-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE64 {
        width: 114px;
        top: 46.407px;
        left: 24.6524px;
    }

    #HEADLINE64>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 28px;
        line-height: 1.4;
    }

    #HEADLINE64>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE65 {
        width: 30px;
        top: 23.8254px;
        left: 24.6524px;
    }

    #LINE65>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE65>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP62 {
        width: 189.13px;
        height: 145px;
        top: 0px;
        left: 378.261px;
    }

    #BOX67 {
        width: 189.13px;
        height: 145px;
        top: 0px;
        left: 0px;
    }

    #BOX67>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX67>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s500x450/5c7362c6c417ab07e5196b05/cv19_79-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE68 {
        width: 106px;
        top: 46.407px;
        left: 24.6524px;
    }

    #HEADLINE68>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 28px;
        line-height: 1.4;
    }

    #HEADLINE68>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE69 {
        width: 30px;
        top: 23.8254px;
        left: 24.6524px;
    }

    #LINE69>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE69>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP66 {
        width: 189.13px;
        height: 145px;
        top: 0px;
        left: 567.391px;
    }

    #HEADLINE71 {
        width: 39px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE71>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE72 {
        width: 359px;
        top: 0px;
        left: 41.6559px;
    }

    #HEADLINE72>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #HEADLINE73 {
        width: 236px;
        top: 23px;
        left: 41.6559px;
    }

    #HEADLINE73>.ladi-headline {
        text-decoration-line: underline;
        -webkit-text-decoration-line: underline;
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        line-height: 1.6;
    }

    #BOX89 {
        width: 420px;
        height: 423px;
        top: 0px;
        left: 0px;
    }

    #BOX89>.ladi-box>.ladi-overlay {
        background: rgba(164, 31, 36, 0.9);
        background: -webkit-linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
    }

    #BOX89>.ladi-box {
        box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        -webkit-box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s750x750/5c7362c6c417ab07e5196b05/cv19_242-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE90 {
        width: 264px;
        top: 70.611px;
        left: 46.7454px;
    }

    #HEADLINE90>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE90>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE91 {
        width: 48px;
        top: 45.792px;
        left: 46.7454px;
    }

    #LINE91>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE91>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE97 {
        width: 46px;
        top: 4px;
        left: 0px;
    }

    #HEADLINE97>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE98 {
        width: 350px;
        top: 0px;
        left: 49.3184px;
    }

    #HEADLINE98>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #SECTION87 {
        height: 436px;
        display: none !important;
    }

    #SECTION87.ladi-animation {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SECTION87>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #HEADLINE104 {
        width: 46px;
        top: 6px;
        left: 0px;
    }

    #HEADLINE104>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE105 {
        width: 353px;
        top: 0px;
        left: 49.3184px;
    }

    #HEADLINE105>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP106 {
        width: 420px;
        height: 423px;
        top: 13px;
        left: 0px;
    }

    #BOX109 {
        width: 420px;
        height: 889.6px;
        top: 0px;
        left: 0px;
    }

    #BOX109>.ladi-box>.ladi-overlay {
        background: rgba(164, 31, 36, 0.9);
        background: -webkit-linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
    }

    #BOX109>.ladi-box {
        box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        -webkit-box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s750x1200/5c7362c6c417ab07e5196b05/cv19_248-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE110 {
        width: 300px;
        top: 72.611px;
        left: 45.9132px;
    }

    #HEADLINE110>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE110>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE111 {
        width: 48px;
        top: 33.792px;
        left: 45.9132px;
    }

    #LINE111>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE111>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE112 {
        width: 48px;
        top: 8.5px;
        left: 0px;
    }

    #HEADLINE112>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE113 {
        width: 358px;
        top: 0px;
        left: 47.0612px;
    }

    #HEADLINE113>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #SECTION107 {
        height: 905.6px;
        display: none !important;
    }

    #SECTION107.ladi-animation {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SECTION107>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #SHAPE116 {
        width: 26px;
        height: 26px;
        top: 288px;
        left: 196px;
    }

    #SHAPE116 svg:last-child {
        fill: rgba(244, 184, 156, 1);
    }

    #SHAPE117 {
        width: 24px;
        height: 24px;
        top: 395px;
        left: 198px;
    }

    #SHAPE117 svg:last-child {
        fill: rgba(244, 184, 156, 1);
    }

    #GROUP118 {
        width: 399.318px;
        height: 140px;
        top: 151.553px;
        left: 0px;
    }

    #GROUP119 {
        width: 401.318px;
        height: 50px;
        top: 310.553px;
        left: 0px;
    }

    #GROUP120 {
        width: 405.061px;
        height: 47px;
        top: 154.553px;
        left: 0px;
    }

    #HEADLINE122 {
        width: 48px;
        top: 5px;
        left: 0px;
    }

    #HEADLINE122>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE123 {
        width: 358px;
        top: 0px;
        left: 48.0611px;
    }

    #HEADLINE123>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP121 {
        width: 405.061px;
        height: 49px;
        top: 213.609px;
        left: 0.420842px;
    }

    #HEADLINE125 {
        width: 48px;
        top: 4px;
        left: 0px;
    }

    #HEADLINE125>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE126 {
        width: 358px;
        top: 0px;
        left: 48.0611px;
    }

    #HEADLINE126>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP124 {
        width: 405.061px;
        height: 117px;
        top: 274.665px;
        left: 0.420842px;
    }

    #HEADLINE128 {
        width: 48px;
        top: 6px;
        left: 0px;
    }

    #HEADLINE128>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE129 {
        width: 358px;
        top: 0px;
        left: 47.56px;
    }

    #HEADLINE129>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP127 {
        width: 405.56px;
        height: 70px;
        top: 403.721px;
        left: 0.420842px;
    }

    #HEADLINE139 {
        width: 48px;
        top: 7px;
        left: 0px;
    }

    #HEADLINE139>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE140 {
        width: 358px;
        top: 0px;
        left: 47.56px;
    }

    #HEADLINE140>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP138 {
        width: 405.56px;
        height: 93px;
        top: 485.777px;
        left: 0px;
    }

    #HEADLINE142 {
        width: 48px;
        top: 7px;
        left: 0px;
    }

    #HEADLINE142>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE143 {
        width: 358px;
        top: 0px;
        left: 47.56px;
    }

    #HEADLINE143>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP141 {
        width: 405.56px;
        height: 51px;
        top: 590.832px;
        left: 0.420842px;
    }

    #HEADLINE145 {
        width: 48px;
        top: 9.5px;
        left: 0px;
    }

    #HEADLINE145>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE146 {
        width: 358px;
        top: 0px;
        left: 47.56px;
    }

    #HEADLINE146>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP144 {
        width: 405.56px;
        height: 47px;
        top: 653.888px;
        left: 0.920842px;
    }

    #HEADLINE148 {
        width: 48px;
        top: 4px;
        left: 0px;
    }

    #HEADLINE148>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE149 {
        width: 358px;
        top: 0px;
        left: 47.56px;
    }

    #HEADLINE149>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP147 {
        width: 405.56px;
        height: 48px;
        top: 712.944px;
        left: 0px;
    }

    #SHAPE150 {
        width: 22.2004px;
        height: 24px;
        top: 856.2px;
        left: 198.9px;
    }

    #SHAPE150 svg:last-child {
        fill: rgba(244, 184, 156, 1);
    }

    #BOX154 {
        width: 420px;
        height: 736.6px;
        top: 0px;
        left: 0.3408px;
    }

    #BOX154>.ladi-box>.ladi-overlay {
        background: rgba(164, 31, 36, 0.9);
        background: -webkit-linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
        background: linear-gradient(180deg, rgba(164, 31, 36, 0.9), rgba(122, 20, 22, 1));
    }

    #BOX154>.ladi-box {
        box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        -webkit-box-shadow: 0px 7px 15px -5px rgba(232, 109, 48, 0.3);
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s750x1050/5c7362c6c417ab07e5196b05/cv19_79-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE155 {
        width: 228px;
        top: 67.611px;
        left: 46.254px;
    }

    #HEADLINE155>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE155>.ladi-headline:hover {
        opacity: 0.96;
    }

    #LINE156 {
        width: 48px;
        top: 40.792px;
        left: 46.254px;
    }

    #LINE156>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE156>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE158 {
        width: 48px;
        top: 11.5px;
        left: 0px;
    }

    #HEADLINE158>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE159 {
        width: 358px;
        top: 0px;
        left: 47.402px;
    }

    #HEADLINE159>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        font-weight: bold;
        line-height: 1.6;
    }

    #GROUP157 {
        width: 405.402px;
        height: 47px;
        top: 0px;
        left: 0px;
    }

    #SHAPE181 {
        width: 25.2004px;
        height: 24px;
        top: 698.2px;
        left: 197.741px;
    }

    #SHAPE181 svg:last-child {
        fill: rgba(244, 184, 156, 1);
    }

    #SECTION152 {
        height: 751.601px;
        display: none !important;
    }

    #SECTION152.ladi-animation {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SECTION152>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #BOX183 {
        width: 250px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX183>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX183>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s600x550/5c7362c6c417ab07e5196b05/cv19_108-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE184 {
        width: 170px;
        top: 73.611px;
        left: 32.5866px;
    }

    #HEADLINE184>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE184>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE185 {
        width: 48px;
        top: 37.792px;
        left: 32.5866px;
    }

    #LINE185>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE185>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP182 {
        width: 250px;
        height: 230px;
        top: 0.002px;
        left: 0px;
        display: none !important;
    }

    #BOX187 {
        width: 250px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX187>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX187>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s600x550/5c7362c6c417ab07e5196b05/cv19_242-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE188 {
        width: 131px;
        top: 73.611px;
        left: 32.5866px;
    }

    #HEADLINE188>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE188>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE189 {
        width: 48px;
        top: 37.792px;
        left: 32.5866px;
    }

    #LINE189>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE189>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP186 {
        width: 250px;
        height: 230px;
        top: 0.002px;
        left: 250.5px;
        display: none !important;
    }

    #BOX191 {
        width: 200.5px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX191>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX191>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s550x550/5c7362c6c417ab07e5196b05/cv19_79-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE192 {
        width: 166px;
        top: 73.611px;
        left: 26.1344px;
    }

    #HEADLINE192>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE192>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE193 {
        width: 48px;
        top: 37.792px;
        left: 26.1344px;
    }

    #LINE193>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE193>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP190 {
        width: 200.5px;
        height: 230px;
        top: 0px;
        left: 920.5px;
        display: none !important;
    }

    #BOX196 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX196>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX196>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s550x550/5c7362c6c417ab07e5196b05/cv19_108-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE197 {
        width: 151px;
        top: 73.611px;
        left: 30.4576px;
    }

    #HEADLINE197>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE197>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE198 {
        width: 48px;
        top: 37.792px;
        left: 30.4576px;
    }

    #LINE198>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE198>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP195 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 0px;
        display: none !important;
    }

    #BOX200 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX200>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX200>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s550x550/5c7362c6c417ab07e5196b05/cv19_242-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE201 {
        width: 131px;
        top: 73.611px;
        left: 30.4576px;
    }

    #HEADLINE201>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE201>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE202 {
        width: 48px;
        top: 37.792px;
        left: 30.4576px;
    }

    #LINE202>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE202>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP199 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 233.667px;
        display: none !important;
    }

    #BOX204 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 0px;
    }

    #BOX204>.ladi-box>.ladi-overlay {
        background-color: rgb(209, 211, 212);
        mix-blend-mode: screen;
        will-change: transform, opacity;
    }

    #BOX204>.ladi-box {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s550x550/5c7362c6c417ab07e5196b05/cv19_248-copy-20200822123953.jpg");
        background-position: center center;
        background-repeat: repeat;
    }

    #HEADLINE205 {
        width: 156px;
        top: 73.611px;
        left: 30.4576px;
    }

    #HEADLINE205>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 36px;
        line-height: 1.4;
    }

    #HEADLINE205>.ladi-headline:hover {
        color: rgb(204, 51, 53);
        opacity: 0.96;
    }

    #LINE206 {
        width: 48px;
        top: 37.792px;
        left: 30.4576px;
    }

    #LINE206>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE206>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP203 {
        width: 233.667px;
        height: 230px;
        top: 0px;
        left: 467.333px;
        display: none !important;
    }

    #LINE208 {
        width: 99px;
        top: 705.445px;
        left: -236.5px;
    }

    #LINE208>.ladi-line>.ladi-line-container {
        border-top: 1px solid rgba(244, 184, 157, 0.6);
        border-right: 1px solid rgba(244, 184, 157, 0.6);
        border-bottom: 1px solid rgba(244, 184, 157, 0.6);
        border-left: 0px !important;
    }

    #LINE208>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #LIST_PARAGRAPH209 {
        width: 360px;
        top: 58.389px;
        left: 45.402px;
    }

    #LIST_PARAGRAPH209>.ladi-list-paragraph {
        color: rgb(255, 255, 255);
        font-size: 15px;
        text-align: left;
        line-height: 1.6;
    }

    #LIST_PARAGRAPH209 ul li {
        padding-bottom: 8px;
        padding-left: 25px;
    }

    #LIST_PARAGRAPH209 ul li:before {
        content: "";
        background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20version%3D%221.1%22%20x%3D%220px%22%20y%3D%220px%22%20viewBox%3D%220%200%20100%20100%22%20enable-background%3D%22new%200%200%20100%20100%22%20xml%3Aspace%3D%22preserve%22%20%20width%3D%22100%25%22%20height%3D%22100%25%22%20class%3D%22%22%20fill%3D%22rgba(255%2C%20235%2C%200%2C%201)%22%3E%3Cpath%20d%3D%22M50.1%2C10c22.1%2C0%2C40%2C17.9%2C40%2C40s-17.9%2C40-40%2C40s-40-17.9-40-40S28%2C10%2C50.1%2C10%20M50.1%2C5c-24.9%2C0-45%2C20.1-45%2C45s20.1%2C45%2C45%2C45%20%20s45-20.1%2C45-45S74.9%2C5%2C50.1%2C5L50.1%2C5z%22%3E%3C%2Fpath%3E%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M73.6%2C38.9L73.6%2C38.9L46.9%2C66.2l0%2C0c-0.6%2C0.6-1.5%2C1-2.5%2C1c-1%2C0-1.8-0.4-2.5-1l0%2C0%20%20L26.8%2C50.8l0%2C0c-0.6-0.6-1-1.5-1-2.5c0-2%2C1.6-3.6%2C3.5-3.6c1%2C0%2C1.8%2C0.4%2C2.5%2C1l0%2C0l12.6%2C12.9l24.3-24.8l0%2C0c0.6-0.6%2C1.5-1%2C2.5-1%20%20c1.9%2C0%2C3.5%2C1.6%2C3.5%2C3.6C74.6%2C37.4%2C74.2%2C38.3%2C73.6%2C38.9z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E");
        width: 20px;
        height: 20px;
        top: 3px;
    }

    #GROUP210 {
        width: 405.402px;
        height: 237.389px;
        top: 144.553px;
        left: 0.3408px;
    }

    #HEADLINE213 {
        width: 48px;
        top: 8.5px;
        left: 0px;
    }

    #HEADLINE213>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE214 {
        width: 358px;
        top: 0px;
        left: 48.0612px;
    }

    #HEADLINE214>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        font-weight: bold;
        line-height: 1.6;
    }

    #GROUP212 {
        width: 405.061px;
        height: 41.5px;
        top: 0px;
        left: 0px;
    }

    #LIST_PARAGRAPH215 {
        width: 358px;
        top: 36.389px;
        left: 47.0612px;
    }

    #LIST_PARAGRAPH215>.ladi-list-paragraph {
        color: rgb(255, 255, 255);
        font-size: 15px;
        text-align: left;
        line-height: 1.6;
    }

    #LIST_PARAGRAPH215 ul li {
        padding-bottom: 8px;
        padding-left: 25px;
    }

    #LIST_PARAGRAPH215 ul li:before {
        content: "";
        background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20version%3D%221.1%22%20x%3D%220px%22%20y%3D%220px%22%20viewBox%3D%220%200%20100%20100%22%20enable-background%3D%22new%200%200%20100%20100%22%20xml%3Aspace%3D%22preserve%22%20%20width%3D%22100%25%22%20height%3D%22100%25%22%20class%3D%22%22%20fill%3D%22rgba(255%2C%20235%2C%200%2C%201)%22%3E%3Cpath%20d%3D%22M50.1%2C10c22.1%2C0%2C40%2C17.9%2C40%2C40s-17.9%2C40-40%2C40s-40-17.9-40-40S28%2C10%2C50.1%2C10%20M50.1%2C5c-24.9%2C0-45%2C20.1-45%2C45s20.1%2C45%2C45%2C45%20%20s45-20.1%2C45-45S74.9%2C5%2C50.1%2C5L50.1%2C5z%22%3E%3C%2Fpath%3E%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M73.6%2C38.9L73.6%2C38.9L46.9%2C66.2l0%2C0c-0.6%2C0.6-1.5%2C1-2.5%2C1c-1%2C0-1.8-0.4-2.5-1l0%2C0%20%20L26.8%2C50.8l0%2C0c-0.6-0.6-1-1.5-1-2.5c0-2%2C1.6-3.6%2C3.5-3.6c1%2C0%2C1.8%2C0.4%2C2.5%2C1l0%2C0l12.6%2C12.9l24.3-24.8l0%2C0c0.6-0.6%2C1.5-1%2C2.5-1%20%20c1.9%2C0%2C3.5%2C1.6%2C3.5%2C3.6C74.6%2C37.4%2C74.2%2C38.3%2C73.6%2C38.9z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E");
        width: 20px;
        height: 20px;
        top: 3px;
    }

    #GROUP211 {
        width: 405.061px;
        height: 215.389px;
        top: 398.748px;
        left: 0.3408px;
    }

    #HEADLINE218 {
        width: 248px;
        top: 154.5px;
        left: 26px;
    }

    #HEADLINE218>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 19, 21);
        font-size: 23px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE219 {
        width: 248px;
        top: 197.5px;
        left: 26px;
    }

    #HEADLINE219>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        text-align: center;
        line-height: 1.6;
    }

    #BOX220 {
        width: 300px;
        height: 400px;
        top: 183px;
        left: -300px;
        display: none !important;
    }

    #BOX220>.ladi-box {
        background: rgba(164, 31, 34, 0.3);
        background: -webkit-linear-gradient(90deg, rgba(164, 31, 34, 0.3), rgba(164, 31, 33, 1));
        background: linear-gradient(90deg, rgba(164, 31, 34, 0.3), rgba(164, 31, 33, 1));
    }

    #GROUP222 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #SECTION230 {
        height: 246.901px;
    }

    #SECTION230>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #CAROUSEL231 {
        width: 420px;
        height: 400px;
        top: 183px;
        left: 0px;
    }

    #SECTION250 {
        height: 826.67px;
    }

    #SECTION250>.ladi-overlay {
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url("https://w.ladicdn.com/s350x1150/5c7362c6c417ab07e5196b05/untitled-2-20200822125029.png");
        background-position: center top;
        background-repeat: repeat;
        mix-blend-mode: multiply;
        will-change: transform, opacity;
    }

    #SECTION250>.ladi-section-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #GROUP251 {
        width: 372px;
        height: 83.611px;
        top: 40px;
        left: 24px;
    }

    #HEADLINE253 {
        width: 241px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE253>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 20, 22);
        font-size: 36px;
        text-align: center;
        line-height: 1.6;
    }

    #LINE254 {
        width: 73px;
        top: 61.611px;
        left: 84px;
    }

    #LINE254>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE254>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #GROUP252 {
        width: 241px;
        height: 80.611px;
        top: 26px;
        left: 89.5px;
    }

    #FRAME268 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #FRAME268>.ladi-frame>.ladi-frame-background {
        background-color: rgba(251, 251, 251, 0);
    }

    #GROUP270 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #BOX273 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #BOX273>.ladi-box {
        background-color: rgb(243, 243, 243);
    }

    #HEADLINE274 {
        width: 248px;
        top: 154.5px;
        left: 26px;
    }

    #HEADLINE274>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 19, 21);
        font-size: 23px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE275 {
        width: 248px;
        top: 197.5px;
        left: 26px;
    }

    #HEADLINE275>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        text-align: center;
        line-height: 1.6;
    }

    #GROUP272 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #FRAME276 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #FRAME276>.ladi-frame>.ladi-frame-background {
        background-color: rgba(251, 251, 251, 0);
    }

    #GROUP271 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 300px;
    }

    #BOX287 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #BOX287>.ladi-box {
        background-color: rgb(243, 243, 243);
    }

    #HEADLINE288 {
        width: 248px;
        top: 154.5px;
        left: 26px;
    }

    #HEADLINE288>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 19, 21);
        font-size: 23px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE289 {
        width: 248px;
        top: 197.5px;
        left: 26px;
    }

    #HEADLINE289>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        text-align: center;
        line-height: 1.6;
    }

    #GROUP286 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #IMAGE291 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #IMAGE291>.ladi-image>.ladi-image-background {
        width: 300px;
        height: 450px;
        top: 0px;
        left: 0px;
        background-image: url("https://demo.digityze.asia/vnpr/wp-content/uploads/2021/03/166324212_2771952573070458_7156981449962380149_n.jpg");
    }

    #IMAGE291>.ladi-image {
        filter: grayscale(100%);
    }

    #IMAGE291:hover>.ladi-image {
        transform: scale(1.15);
        -webkit-transform: scale(1.15);
        opacity: 0.07;
    }

    #FRAME290 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #FRAME290>.ladi-frame>.ladi-frame-background {
        background-color: rgba(251, 251, 251, 0);
    }

    #GROUP285 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 600px;
    }

    #IMAGE299 {
        width: 153.955px;
        height: 80.2453px;
        top: 17.701px;
        left: 132.022px;
    }

    #IMAGE299>.ladi-image>.ladi-image-background {
        width: 153.955px;
        height: 80.2453px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x400/5c7362c6c417ab07e5196b05/asset-33x-20200822113849.png");
    }

    #IMAGE299.ladi-animation>.ladi-image {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 2s;
        -webkit-animation-duration: 2s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #IMAGE300 {
        width: 126px;
        height: 49px;
        top: 19.5613px;
        left: 33px;
    }

    #IMAGE300>.ladi-image>.ladi-image-background {
        width: 126px;
        height: 49px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x350/5c7362c6c417ab07e5196b05/asset-143x-20200822142004.png");
    }

    #IMAGE301 {
        width: 115.184px;
        height: 45.3926px;
        top: 19.5613px;
        left: 228.794px;
    }

    #IMAGE301>.ladi-image>.ladi-image-background {
        width: 115.184px;
        height: 46.0735px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x350/5c7362c6c417ab07e5196b05/asset-153x-20200822142004.png");
    }

    #IMAGE302 {
        width: 125.037px;
        height: 29.2352px;
        top: 29.0874px;
        left: 411.545px;
    }

    #IMAGE302>.ladi-image>.ladi-image-background {
        width: 125.037px;
        height: 29.2352px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x350/5c7362c6c417ab07e5196b05/layer-1-20200822142539.png");
    }

    #IMAGE303 {
        width: 101.362px;
        height: 65.655px;
        top: 11.2338px;
        left: 614.319px;
    }

    #IMAGE303>.ladi-image>.ladi-image-background {
        width: 101.362px;
        height: 65.655px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x400/5c7362c6c417ab07e5196b05/asset-73x-20200822120323.png");
    }

    #IMAGE304 {
        width: 105.064px;
        height: 34.0553px;
        top: 27.0337px;
        left: 804.641px;
    }

    #IMAGE304>.ladi-image>.ladi-image-background {
        width: 105.064px;
        height: 34.0553px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x350/5c7362c6c417ab07e5196b05/asset-83x-20200822120323.png");
    }

    #IMAGE305 {
        width: 115.184px;
        height: 52.5453px;
        top: 17.7887px;
        left: 1178.24px;
    }

    #IMAGE305>.ladi-image>.ladi-image-background {
        width: 115.184px;
        height: 52.5453px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x400/5c7362c6c417ab07e5196b05/layer-2-20200822120333.png");
    }

    #IMAGE306 {
        width: 115.412px;
        height: 29.9478px;
        top: 29.0874px;
        left: 990.569px;
    }

    #IMAGE306>.ladi-image>.ladi-image-background {
        width: 115.412px;
        height: 29.9478px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x350/5c7362c6c417ab07e5196b05/asset-53x-20200822120323.png");
    }

    #CAROUSEL307 {
        width: 420px;
        height: 91px;
        top: 111.611px;
        left: 0px;
    }

    #IMAGE308 {
        width: 366px;
        height: 216.713px;
        top: 417.672px;
        left: 34px;
    }

    #IMAGE308>.ladi-image>.ladi-image-background {
        width: 366px;
        height: 216.713px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s700x550/5c7362c6c417ab07e5196b05/asset-33x-20200821032937.png");
    }

    #HEADLINE310 {
        width: 48px;
        top: 8px;
        left: 0px;
    }

    #HEADLINE310>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.6;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE311 {
        width: 358px;
        top: 0px;
        left: 48.0611px;
    }

    #HEADLINE311>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP309 {
        width: 405.061px;
        height: 70px;
        top: 773px;
        left: 0.420842px;
    }

    #GROUP312 {
        width: 420px;
        height: 889.6px;
        top: 0px;
        left: 500.5px;
    }

    #POPUP334 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP334>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP334>.ladi-popup {
        border-radius: 0px;
    }

    #BOX335 {
        width: 128px;
        height: 48px;
        top: 0px;
        left: 0px;
    }

    #BOX335>.ladi-box {
        box-shadow: 0px -5px 10px 0px rgba(1, 1, 1, 0.1);
        -webkit-box-shadow: 0px -5px 10px 0px rgba(1, 1, 1, 0.1);
        background-color: rgb(243, 243, 243);
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    #SECTION336 {
        height: 528.5px;
    }

    #SECTION336>.ladi-overlay {
        background-color: rgb(122, 20, 22);
    }

    #SECTION336>.ladi-section-background {
        background-color: rgb(122, 20, 22);
    }

    #HEADLINE398 {
        width: 123px;
        top: 4px;
        left: 3px;
    }

    #HEADLINE398>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 12px;
        text-align: center;
        line-height: 1.6;
    }

    #IMAGE399 {
        width: 95px;
        height: 24px;
        top: 20.556px;
        left: 18px;
    }

    #IMAGE399>.ladi-image>.ladi-image-background {
        width: 95px;
        height: 24px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/5c7362c6c417ab07e5196b05/ladipage-logo-color-1558579165-20200823023440.svg");
    }

    #GROUP400 {
        width: 128px;
        height: 48px;
        top: auto;
        left: auto;
        bottom: 0px;
        right: 16px;
        position: fixed;
        z-index: 90000050;
        margin-right: calc((100% - 420px) / 2);
    }

    #GROUP400.ladi-animation>.ladi-group {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 1s;
        -webkit-animation-delay: 1s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #IMAGE401 {
        width: 314.968px;
        height: 186.497px;
        top: -80px;
        left: 52.516px;
    }

    #IMAGE401>.ladi-image>.ladi-image-background {
        width: 314.968px;
        height: 186.497px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s650x500/5c7362c6c417ab07e5196b05/asset-33x-20200821032937.png");
    }

    #IMAGE401.ladi-animation>.ladi-image {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #IMAGE411 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE411>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_203s-20200823132902.jpg");
    }

    #HEADLINE412 {
        width: 294px;
        top: 2.5px;
        left: 467.167px;
    }

    #HEADLINE412>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE413 {
        width: 418px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE413>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE414 {
        height: 19px;
        top: 4.5px;
        left: 437.5px;
    }

    #LINE414>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE414>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE415 {
        width: 753px;
        top: 47.5px;
        left: 0px;
    }

    #HEADLINE415>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP416 {
        width: 756.521px;
        height: 145px;
        top: 571.611px;
        left: 0px;
    }

    #GROUP416.ladi-animation>.ladi-group {
        animation-name: bounceInRight;
        -webkit-animation-name: bounceInRight;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #SHAPE417 {
        width: 28.0002px;
        height: 28.0002px;
        top: 723.881px;
        left: 392px;
    }

    #SHAPE417.ladi-animation>.ladi-shape {
        animation-name: shake;
        -webkit-animation-name: shake;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 10s;
        -webkit-animation-duration: 10s;
        animation-iteration-count: infinite;
        -webkit-animation-iteration-count: infinite;
    }

    #SHAPE417 svg:last-child {
        fill: rgba(180, 180, 180, 1);
    }

    #IMAGE277 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #IMAGE277>.ladi-image>.ladi-image-background {
        width: 300px;
        height: 450px;
        top: 0px;
        left: 0px;
        background-image: url("https://demo.digityze.asia/vnpr/wp-content/uploads/2021/03/166754410_2771952356403813_868393098652331968_n.jpg");
    }

    #IMAGE277>.ladi-image {
        filter: grayscale(100%);
    }

    #IMAGE277:hover>.ladi-image {
        transform: scale(1.15);
        -webkit-transform: scale(1.15);
        opacity: 0.07;
    }

    #IMAGE269 {
        width: 300px;
        height: 400px;
        top: 0px;
        left: 0px;
    }

    #IMAGE269>.ladi-image>.ladi-image-background {
        width: 300px;
        height: 450px;
        top: 0px;
        left: 0px;
        background-image: url("https://demo.digityze.asia/vnpr/wp-content/uploads/2021/03/166324212_2771952573070458_7156981449962380149_n.jpg");
    }

    #IMAGE269>.ladi-image {
        filter: grayscale(100%);
    }

    #IMAGE269:hover>.ladi-image {
        transform: scale(1.15);
        -webkit-transform: scale(1.15);
        opacity: 0.07;
    }

    #HEADLINE460 {
        width: 48px;
        top: 9.5px;
        left: 0px;
    }

    #HEADLINE460>.ladi-headline {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        font-family: "Oswald", sans-serif;
        color: rgba(1, 1, 1, 0);
        font-size: 28px;
        font-weight: bold;
        text-align: right;
        line-height: 1.2;
        -webkit-text-stroke: 1px rgba(255, 236, 0, 0.4);
    }

    #HEADLINE461 {
        width: 358px;
        top: 0px;
        left: 47.402px;
    }

    #HEADLINE461>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        font-weight: bold;
        line-height: 1.6;
    }

    #GROUP459 {
        width: 405.402px;
        height: 47px;
        top: 630.942px;
        left: 0px;
    }

    #GROUP463 {
        width: 420.341px;
        height: 736.6px;
        top: 0px;
        left: 700.659px;
    }

    #HEADLINE465 {
        width: 373px;
        top: 357px;
        left: 25.2619px;
    }

    #HEADLINE465>.ladi-headline {
        color: rgb(228, 228, 228);
        font-size: 15px;
        font-style: italic;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE350 {
        width: 293px;
        top: 3px;
        left: 35px;
    }

    #HEADLINE350>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 14px;
        text-align: left;
        line-height: 1.4;
    }

    #SHAPE349 {
        width: 28.7993px;
        height: 22.5469px;
        top: 0px;
        left: 0px;
    }

    #SHAPE349 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP348 {
        width: 327px;
        height: 22.5469px;
        top: 134.953px;
        left: 0px;
    }

    #HEADLINE347 {
        width: 293px;
        top: 2px;
        left: 33px;
    }

    #HEADLINE347>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 14px;
        text-align: left;
        line-height: 1.4;
    }

    #SHAPE346 {
        width: 22.5469px;
        height: 22.5469px;
        top: 0px;
        left: 0px;
    }

    #SHAPE346 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP345 {
        width: 325px;
        height: 22.5469px;
        top: 101.62px;
        left: 3.06581px;
    }

    #HEADLINE344 {
        width: 293px;
        top: 2px;
        left: 33px;
    }

    #HEADLINE344>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 14px;
        text-align: left;
        line-height: 1.4;
    }

    #SHAPE343 {
        width: 22.5469px;
        height: 22.5469px;
        top: 0px;
        left: 0px;
    }

    #SHAPE343 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP342 {
        width: 325px;
        height: 22.5469px;
        top: 68.286px;
        left: 3.06581px;
    }

    #HEADLINE338 {
        width: 373px;
        top: 0px;
        left: 3.06581px;
    }

    #HEADLINE338>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 18px;
        font-weight: bold;
        text-align: left;
        line-height: 1.4;
    }

    #GROUP337 {
        width: 375.066px;
        height: 157.5px;
        top: 42px;
        left: 23.729px;
    }

    #HTML_CODE466 {
        width: 372px;
        height: 240px;
        top: 232.5px;
        left: 23.729px;
    }

    #GROUP467 {
        width: 1121px;
        height: 736.6px;
        top: 15.001px;
        left: -701px;
    }

    #GROUP469 {
        width: 1121px;
        height: 889.6px;
        top: 16px;
        left: -500.5px;
    }

    #BOX472 {
        width: 420px;
        height: 27px;
        top: 0px;
        left: 0px;
    }

    #BOX472>.ladi-box {
        background: rgba(255, 236, 0, 0.2);
        background: -webkit-radial-gradient(circle, rgba(255, 236, 0, 0.2), rgba(255, 255, 255, 0));
        background: radial-gradient(circle, rgba(255, 236, 0, 0.2), rgba(255, 255, 255, 0));
    }

    #HEADLINE474 {
        width: 398px;
        top: 3.5px;
        left: 11px;
    }

    #HEADLINE474>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 12px;
        text-align: center;
        line-height: 1.6;
    }

    #GROUP475 {
        width: 420px;
        height: 27px;
        top: 545.611px;
        left: 0px;
    }

    #HEADLINE506 {
        width: 238px;
        top: 0px;
        left: 120px;
    }

    #HEADLINE506>.ladi-headline {
        text-decoration-line: underline;
        -webkit-text-decoration-line: underline;
        color: <?=get_field('secondary_color')?>;
        font-size: 15px;
        line-height: 1.6;
    }

    #HEADLINE507 {
        width: 128px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE507>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP508 {
        width: 358px;
        height: 23px;
        top: 53px;
        left: 41.6559px;
    }

    #HEADLINE510 {
        width: 359px;
        top: 87px;
        left: 39px;
    }

    #HEADLINE510>.ladi-headline {
        color: rgb(255, 255, 255);
        font-size: 15px;
        line-height: 1.4;
    }

    #GROUP523 {
        width: 400.656px;
        height: 127px;
        top: 141.553px;
        left: 0px;
    }

    #GROUP524 {
        width: 420px;
        height: 328px;
        top: 14px;
        left: 0px;
    }

    #HEADLINE525 {
        width: 373px;
        top: 572.931px;
        left: 23.729px;
    }

    #HEADLINE525>.ladi-headline {
        color: rgb(228, 228, 228);
        font-size: 15px;
        text-align: center;
        line-height: 1.6;
    }

    #HEADLINE526 {
        width: 371px;
        top: 523.931px;
        left: 24.229px;
    }

    #HEADLINE526>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('secondary_color')?>;
        font-size: 23px;
        text-align: center;
        line-height: 1.6;
    }

    #BOX527 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX527>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #SHAPE528 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE528 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #SHAPE529 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE529>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE529 svg:last-child {
        fill: rgba(255, 255, 255, 0.5);
    }

    #BOX530 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX530>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #BOX531 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX531>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #GROUP532 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #GROUP626 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #POPUP640 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP640>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP640>.ladi-popup {
        border-radius: 0px;
    }

    #BOX641 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX641>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE642 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE642>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_3s-20200823132902.jpg");
    }

    #HEADLINE643 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE643>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE644 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE644>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE645 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE645>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE645>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE646 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE646>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP647 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX648 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX648>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE649 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE649>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE649 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP650 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX651 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX651>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE652 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE652 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP653 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP653>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP653>.ladi-popup {
        border-radius: 0px;
    }

    #BOX654 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX654>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE655 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE655>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_46s-20200823132902.jpg");
    }

    #HEADLINE656 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE656>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE657 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE657>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE658 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE658>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE658>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE659 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE659>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP660 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX661 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX661>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE662 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE662>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE662 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP663 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX664 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX664>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE665 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE665 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP666 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP666>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP666>.ladi-popup {
        border-radius: 0px;
    }

    #BOX667 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX667>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE668 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE668>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_55s-20200823132902.jpg");
    }

    #HEADLINE669 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE669>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE670 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE670>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE671 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE671>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE671>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE672 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE672>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP673 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX674 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX674>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE675 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE675>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE675 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP676 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX677 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX677>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE678 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE678 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP679 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP679>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP679>.ladi-popup {
        border-radius: 0px;
    }

    #BOX680 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX680>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE681 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE681>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_261s-20200823132902.jpg");
    }

    #HEADLINE682 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE682>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE683 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE683>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE684 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE684>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE684>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE685 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE685>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP686 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX687 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX687>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE688 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE688>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE688 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP689 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX690 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX690>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE691 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE691 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP692 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP692>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP692>.ladi-popup {
        border-radius: 0px;
    }

    #BOX693 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX693>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE694 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE694>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_236s-20200823132902.jpg");
    }

    #HEADLINE695 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE695>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE696 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE696>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE697 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE697>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE697>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE698 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE698>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP699 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX700 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX700>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE701 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE701>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE701 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP702 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX703 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX703>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE704 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE704 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #HEADLINE403 {
        width: 300px;
        top: 27.566px;
        left: 3.5px;
    }

    #HEADLINE403>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 28px;
        text-align: center;
        line-height: 1.6;
    }

    #BUTTON_TEXT738 {
        width: 239px;
        top: 9px;
        left: 0px;
    }

    #BUTTON_TEXT738>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        line-height: 1.6;
    }

    #BUTTON738 {
        width: 210px;
        height: 48px;
        top: 87.654px;
        left: 48.5px;
    }

    #BUTTON738>.ladi-button>.ladi-button-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #BUTTON738>.ladi-button {
        border-color: <?=get_field('secondary_color')?>;
        border-width: 2px;
    }

    #BUTTON738>.ladi-button:hover {
        transform: scale(1.03);
        -webkit-transform: scale(1.03);
    }

    #BOX744 {
        width: 307px;
        height: 229px;
        top: 0px;
        left: 0px;
    }

    #BOX744>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #POPUP749 {
        width: 317px;
        height: 458px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP749>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #BOX752 {
        width: 303px;
        height: 237.931px;
        top: 0px;
        left: 13.5px;
    }

    #BOX752>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #HEADLINE753 {
        width: 330px;
        top: 32.497px;
        left: 0px;
    }

    #HEADLINE753>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: <?=get_field('primary_color')?>;
        font-size: 28px;
        text-align: center;
        line-height: 1.6;
    }

    #BUTTON_TEXT756 {
        width: 202px;
        top: 9px;
        left: 0px;
    }

    #BUTTON_TEXT756>.ladi-headline {
        color: <?=get_field('secondary_color')?>;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        line-height: 1.6;
    }

    #BUTTON756 {
        width: 203.057px;
        height: 48px;
        top: 93.585px;
        left: 63.4715px;
    }

    #BUTTON756>.ladi-button>.ladi-button-background {
        background-color: <?=get_field('primary_color')?>;
    }

    #BUTTON756>.ladi-button {
        border-color: <?=get_field('secondary_color')?>;
        border-width: 2px;
    }

    #BUTTON756>.ladi-button:hover {
        transform: scale(1.03);
        -webkit-transform: scale(1.03);
    }

    #IMAGE758 {
        width: 292.174px;
        height: 173px;
        top: 0px;
        left: 18.913px;
    }

    #IMAGE758>.ladi-image>.ladi-image-background {
        width: 292.174px;
        height: 173px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s600x500/5c7362c6c417ab07e5196b05/asset-33x-20200821032937.png");
    }

    #IMAGE758.ladi-animation>.ladi-image {
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #HEADLINE759 {
        width: 246px;
        top: 149.089px;
        left: 30.5px;
    }

    #HEADLINE759>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 13px;
        text-align: center;
        line-height: 1.4;
    }

    #GROUP760 {
        width: 307px;
        height: 229px;
        top: 97.931px;
        left: 56.5px;
    }

    #HEADLINE761 {
        width: 259px;
        top: 159px;
        left: 35.5px;
    }

    #HEADLINE761>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 13px;
        text-align: center;
        line-height: 1.4;
    }

    #GROUP762 {
        width: 330px;
        height: 237.931px;
        top: 165px;
        left: 0px;
    }

    #GROUP762.ladi-animation>.ladi-group {
        animation-name: fadeIn;
        -webkit-animation-name: fadeIn;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
    }

    #POPUP763 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP763>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP763>.ladi-popup {
        border-radius: 0px;
    }

    #BOX764 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX764>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE765 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE765>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_199-20200824104830.jpg");
    }

    #HEADLINE766 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE766>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE767 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE767>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE768 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE768>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE768>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE769 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE769>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP770 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX771 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX771>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE772 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE772>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE772 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP773 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX774 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX774>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE775 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE775 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP776 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP776>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP776>.ladi-popup {
        border-radius: 0px;
    }

    #BOX777 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX777>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE778 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE778>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_188-20200824104830.jpg");
    }

    #HEADLINE779 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE779>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE780 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE780>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE781 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE781>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE781>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE782 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE782>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP783 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX784 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX784>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE785 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE785>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE785 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP786 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX787 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX787>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE788 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE788 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP789 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP789>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP789>.ladi-popup {
        border-radius: 0px;
    }

    #BOX790 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX790>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE791 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE791>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_67-20200824104829.jpg");
    }

    #HEADLINE792 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE792>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE793 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE793>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE794 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE794>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE794>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE795 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE795>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP796 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX797 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX797>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE798 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE798>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE798 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP799 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX800 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX800>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE801 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE801 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP802 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP802>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP802>.ladi-popup {
        border-radius: 0px;
    }

    #BOX803 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX803>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE804 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE804>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_52-20200824104829.jpg");
    }

    #HEADLINE805 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE805>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE806 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE806>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE807 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE807>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE807>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE808 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE808>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP809 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX810 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX810>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE811 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE811>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE811 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP812 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX813 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX813>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE814 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE814 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP815 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP815>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP815>.ladi-popup {
        border-radius: 0px;
    }

    #BOX816 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX816>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE817 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE817>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_87-20200824104829.jpg");
    }

    #HEADLINE818 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE818>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE819 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE819>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE820 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE820>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE820>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE821 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE821>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP822 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX823 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX823>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE824 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE824>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE824 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP825 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX826 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX826>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE827 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE827 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP828 {
        width: 420px;
        height: 511px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP828>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP828>.ladi-popup {
        border-radius: 0px;
    }

    #BOX829 {
        width: 420.25px;
        height: 436.5px;
        top: 74.5005px;
        left: -0.000313px;
    }

    #BOX829>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE830 {
        width: 359.5px;
        height: 541.335px;
        top: 0px;
        left: 228.333px;
    }

    #IMAGE830>.ladi-image>.ladi-image-background {
        width: 360.358px;
        height: 541.335px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s700x850/5c7362c6c417ab07e5196b05/cv19_196-20200824104829.jpg");
    }

    #HEADLINE831 {
        width: 372px;
        top: 399.386px;
        left: 21.083px;
    }

    #HEADLINE831>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE832 {
        width: 372px;
        top: 371.386px;
        left: 21.083px;
    }

    #HEADLINE832>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE833 {
        height: 19px;
        top: 375.886px;
        left: 456.083px;
    }

    #LINE833>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE833>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE834 {
        width: 372px;
        top: 440.886px;
        left: 21.083px;
    }

    #HEADLINE834>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP835 {
        width: 85.6249px;
        height: 354.498px;
        top: 0px;
        left: -0.000313px;
    }

    #BOX836 {
        width: 85.6249px;
        height: 354.498px;
        top: 0px;
        left: 0px;
    }

    #BOX836>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE837 {
        width: 43.9997px;
        height: 43.9997px;
        top: 155.249px;
        left: 0px;
    }

    #SHAPE837>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE837 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP838 {
        width: 85.6249px;
        height: 354.498px;
        top: 0px;
        left: 334.625px;
    }

    #BOX839 {
        width: 85.6249px;
        height: 354.498px;
        top: 0px;
        left: 0px;
    }

    #BOX839>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE840 {
        width: 43.9997px;
        height: 43.9997px;
        top: 155.249px;
        left: 41.1253px;
    }

    #SHAPE840 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #IMAGE841 {
        width: 811.003px;
        height: 540.668px;
        top: 0px;
        left: 0px;
    }

    #IMAGE841>.ladi-image>.ladi-image-background {
        width: 811.003px;
        height: 540.669px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s1150x850/5c7362c6c417ab07e5196b05/cv19_196-20200824104829.jpg");
    }

    #IMAGE841>.ladi-image {
        filter: brightness(70%) grayscale(100%);
    }

    #HEADLINE844 {
        width: 260px;
        top: 10px;
        left: 80px;
    }

    #HEADLINE844>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 20, 22);
        font-size: 36px;
        text-align: center;
        line-height: 1.6;
    }

    #LINE845 {
        width: 73px;
        top: 90px;
        left: 173.5px;
    }

    #LINE845>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE845>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #IMAGE847 {
        width: 150.422px;
        height: 32px;
        top: 29.5983px;
        left: 20px;
    }

    #IMAGE847>.ladi-image>.ladi-image-background {
        width: 150.422px;
        height: 32.3617px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x350/5c7362c6c417ab07e5196b05/mangsec-vn-20200825091835.png");
    }

    #IMAGE848 {
        width: 145.469px;
        height: 57.3275px;
        top: 16.8362px;
        left: 213.794px;
    }

    #IMAGE848>.ladi-image>.ladi-image-background {
        width: 170.485px;
        height: 120.494px;
        top: -25.4697px;
        left: -11.8405px;
        background-image: url("https://w.ladicdn.com/5c7362c6c417ab07e5196b05/logo_baopnvn_web-20200825061516.svg");
    }

    #IMAGE849 {
        width: 114px;
        height: 35px;
        top: 28px;
        left: 420px;
    }

    #IMAGE849>.ladi-image>.ladi-image-background {
        width: 114px;
        height: 35px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x350/5c7362c6c417ab07e5196b05/logo-20200825061516.png");
    }

    #IMAGE850 {
        width: 135.07px;
        height: 45.3926px;
        top: 22.8036px;
        left: 597.465px;
    }

    #IMAGE850>.ladi-image>.ladi-image-background {
        width: 135.07px;
        height: 45.3926px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x350/5c7362c6c417ab07e5196b05/dnvn-logo-20200825061516.png");
    }

    #CAROUSEL846 {
        width: 420px;
        height: 91px;
        top: 128px;
        left: 0px;
    }

    #SECTION842 {
        height: 245px;
    }

    #SECTION842>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #IMAGE854 {
        width: 138.957px;
        height: 45.3926px;
        top: 22.8038px;
        left: 787.043px;
    }

    #IMAGE854>.ladi-image>.ladi-image-background {
        width: 138.957px;
        height: 45.3926px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x350/5c7362c6c417ab07e5196b05/logo_full-20200825061516.png");
    }

    #IMAGE855 {
        width: 136.562px;
        height: 61.3275px;
        top: 14.8362px;
        left: 977.531px;
    }

    #IMAGE855>.ladi-image>.ladi-image-background {
        width: 136.562px;
        height: 96.6406px;
        top: -17.8367px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x400/5c7362c6c417ab07e5196b05/bao-the-thao-van-hoa-dua-tin-ve-muabannhanh-com-giai-phap-mua-ban-nhanh-hon-tren-di-dong_555ff99162fef1432353169-20200826014326.jpg");
    }

    #IMAGE855>.ladi-image {
        border-radius: 5px;
    }

    #IMAGE856 {
        width: 57.4932px;
        height: 67px;
        top: 12.0983px;
        left: 1206px;
    }

    #IMAGE856>.ladi-image>.ladi-image-background {
        width: 57.4932px;
        height: 67px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/unnamed-2-20200826020502.jpg");
    }

    #IMAGE857 {
        width: 162.185px;
        height: 30.7942px;
        top: 31.2711px;
        left: 1344.4px;
    }

    #IMAGE857>.ladi-image>.ladi-image-background {
        width: 162.185px;
        height: 30.7942px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x350/5c7362c6c417ab07e5196b05/logo-1-20200826014326.png");
    }

    #HEADLINE860 {
        width: 398px;
        top: 63px;
        left: 11px;
    }

    #HEADLINE860>.ladi-headline {
        color: rgb(132, 132, 132);
        font-size: 12px;
        text-align: center;
        line-height: 1.6;
    }

    #POPUP892 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP892>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP892>.ladi-popup {
        border-radius: 0px;
    }

    #BOX893 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX893>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE894 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE894>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_27-20200825070311.jpg");
    }

    #HEADLINE895 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE895>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE896 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE896>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE897 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE897>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE897>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE898 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE898>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP899 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX900 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX900>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE901 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE901>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE901 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP902 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX903 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX903>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE904 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE904 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP905 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP905>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP905>.ladi-popup {
        border-radius: 0px;
    }

    #BOX906 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX906>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE907 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE907>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_32-20200825070310.jpg");
    }

    #HEADLINE908 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE908>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE909 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE909>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE910 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE910>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE910>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE911 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE911>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP912 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX913 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX913>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE914 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE914>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE914 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP915 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX916 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX916>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE917 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE917 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP918 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP918>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP918>.ladi-popup {
        border-radius: 0px;
    }

    #BOX919 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX919>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE920 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE920>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_50-20200825070309.jpg");
    }

    #HEADLINE921 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE921>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE922 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE922>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE923 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE923>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE923>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE924 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE924>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP925 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX926 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX926>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE927 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE927>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE927 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP928 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX929 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX929>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE930 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE930 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP931 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP931>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP931>.ladi-popup {
        border-radius: 0px;
    }

    #BOX932 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX932>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE933 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE933>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_224-20200825070309.jpg");
    }

    #HEADLINE934 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE934>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE935 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE935>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE936 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE936>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE936>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE937 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE937>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP938 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX939 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX939>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE940 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE940>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE940 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP941 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX942 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX942>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE943 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE943 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP944 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP944>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP944>.ladi-popup {
        border-radius: 0px;
    }

    #BOX945 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX945>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE946 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE946>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_248-2-20200825070708.jpg");
    }

    #HEADLINE947 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE947>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE948 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE948>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE949 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE949>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE949>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE950 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE950>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP951 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX952 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX952>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE953 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE953>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE953 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP954 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX955 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX955>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE956 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE956 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #POPUP957 {
        width: 420px;
        height: 436px;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        margin: auto;
    }

    #POPUP957>.ladi-popup>.ladi-popup-background {
        background-color: rgba(255, 255, 255, 0);
    }

    #POPUP957>.ladi-popup {
        border-radius: 0px;
    }

    #BOX958 {
        width: 420.25px;
        height: 436.5px;
        top: 0px;
        left: 0.25px;
    }

    #BOX958>.ladi-box {
        background-color: rgb(255, 255, 255);
    }

    #IMAGE959 {
        width: 420.25px;
        height: 280.166px;
        top: 0px;
        left: 0.25px;
    }

    #IMAGE959>.ladi-image>.ladi-image-background {
        width: 420.25px;
        height: 280.167px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s750x600/5c7362c6c417ab07e5196b05/cv19_231-20200825070308.jpg");
    }

    #HEADLINE960 {
        width: 372px;
        top: 324.885px;
        left: 21.3333px;
    }

    #HEADLINE960>.ladi-headline {
        color: <?=get_field('primary_color')?>;
        font-size: 15px;
        font-style: italic;
        line-height: 1.6;
    }

    #HEADLINE961 {
        width: 372px;
        top: 296.885px;
        left: 21.3333px;
    }

    #HEADLINE961>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(84, 84, 84);
        font-size: 18px;
        line-height: 1.6;
    }

    #LINE962 {
        height: 19px;
        top: 301.385px;
        left: 456.333px;
    }

    #LINE962>.ladi-line>.ladi-line-container {
        border-top: 0px !important;
        border-right: 1px solid rgb(228, 228, 228);
        border-bottom: 1px solid rgb(228, 228, 228);
        border-left: 1px solid rgb(228, 228, 228);
    }

    #LINE962>.ladi-line {
        height: 100%;
        padding: 0px 8px;
    }

    #HEADLINE963 {
        width: 372px;
        top: 366.385px;
        left: 21.3333px;
    }

    #HEADLINE963>.ladi-headline {
        color: rgb(84, 84, 84);
        font-size: 15px;
        line-height: 1.6;
    }

    #GROUP964 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0.25px;
    }

    #BOX965 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX965>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE966 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 0px;
    }

    #SHAPE966>.ladi-shape {
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
    }

    #SHAPE966 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #GROUP967 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 334.875px;
    }

    #BOX968 {
        width: 85.6249px;
        height: 279.997px;
        top: 0px;
        left: 0px;
    }

    #BOX968>.ladi-box {
        background-color: rgba(255, 255, 255, 0);
    }

    #SHAPE969 {
        width: 43.9997px;
        height: 43.9997px;
        top: 117.999px;
        left: 41.1253px;
    }

    #SHAPE969 svg:last-child {
        fill: rgba(255, 255, 255, 1);
    }

    #IMAGE1005 {
        width: 183.358px;
        height: 55.1124px;
        top: 19.6255px;
        left: 1524.54px;
    }

    #IMAGE1005>.ladi-image>.ladi-image-background {
        width: 183.358px;
        height: 55.1124px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s500x400/5c7362c6c417ab07e5196b05/xuctiendoanhnghiep-01_2a8028292c-20200826014326.png");
    }

    #IMAGE1006 {
        width: 147.834px;
        height: 54.0855px;
        top: 19.6255px;
        left: 1735.16px;
    }

    #IMAGE1006>.ladi-image>.ladi-image-background {
        width: 147.834px;
        height: 54.0855px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x400/5c7362c6c417ab07e5196b05/logo-cnds-20200826021243.png");
    }

    #SECTION313 {
        height: 594.84px;
    }

    #SECTION313>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }

    #GROUP314 {
        width: 272px;
        height: 80.8055px;
        top: 25.8055px;
        left: 74px;
    }

    #LINE316 {
        width: 73px;
        top: 61.8055px;
        left: 99.5px;
    }

    #LINE316>.ladi-line>.ladi-line-container {
        border-top: 3px solid <?=get_field('secondary_color')?>;
        border-right: 3px solid <?=get_field('secondary_color')?>;
        border-bottom: 3px solid <?=get_field('secondary_color')?>;
        border-left: 0px !important;
    }

    #LINE316>.ladi-line {
        width: 100%;
        padding: 8px 0px;
    }

    #HEADLINE315 {
        width: 273px;
        top: 0px;
        left: 0px;
    }

    #HEADLINE315>.ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(122, 20, 22);
        font-size: 36px;
        text-align: center;
        line-height: 1.6;
    }

    #GROUP1200 {
        width: 761.167px;
        height: 70.5px;
        top: 558.889px;
        left: 117.208px;
    }

    #GROUP1305 {
        width: 811.003px;
        height: 541.335px;
        top: 0.505279px;
        left: 85.6249px;
    }

    #GALLERY1762 {
        width: 420px;
        height: 358.29px;
        top: 132.08px;
        left: 0px;
    }

    #GALLERY1762>.ladi-gallery>.ladi-gallery-view {
        height: calc(100% - 0px);
    }

    #GALLERY1762>.ladi-gallery>.ladi-gallery-control {
        height: 0px;
        display: none;
    }

    #GALLERY1762>.ladi-gallery>.ladi-gallery-control>.ladi-gallery-control-box>.ladi-gallery-control-item {
        width: 0px;
        height: 0px;
        margin-right: 0px;
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/mat-phuc-bat-nguoi-vuot-bien-trai-phep-cua-khau-qt-cau-treo-ha-tinh-20200921071755.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/mat-phuc-bat-nguoi-vuot-bien-trai-phep-cua-khau-qt-cau-treo-ha-tinh-20200921071755.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tre-trong-trang-phuc-bao-ho-nghi-met-ben-cau-thang-sau-khi-di-bo-nam-tang-lau-de-do-than-nhiet-cho-nguoi-duoc-cach-ly-o-ktx-khu-a-dhqg-tphcm-20200914103846.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tre-trong-trang-phuc-bao-ho-nghi-met-ben-cau-thang-sau-khi-di-bo-nam-tang-lau-de-do-than-nhiet-cho-nguoi-duoc-cach-ly-o-ktx-khu-a-dhqg-tphcm-20200914103846.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/tang-khau-trang-cho-tre-em-ngheo-vung-cao-20200924023204.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tang-khau-trang-cho-tre-em-ngheo-vung-cao-20200924023204.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="3"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/dem-chong-dich-ben-dong-song-se-pon-20200924023525.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="3"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/dem-chong-dich-ben-dong-song-se-pon-20200924023525.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="4"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/tam-biet-covid-19-20200924024146.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="4"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tam-biet-covid-19-20200924024146.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="5"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/hoang-thi-xuan-20200923082209.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="5"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/hoang-thi-xuan-20200923082209.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="6"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/ben-xe-buyt-nhung-ngay-gian-cach-20200907093802.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="6"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/ben-xe-buyt-nhung-ngay-gian-cach-20200907093802.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="7"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/phia-truoc-la-bau-troi-20200908031123.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="7"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/phia-truoc-la-bau-troi-20200908031123.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="8"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/huong-dan-rua-tay-phong-dich-covid-19-20200907093701.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="8"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/huong-dan-rua-tay-phong-dich-covid-19-20200907093701.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="9"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/huong-dan-deo-khau-trang-phong-dich-20200908030710.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="9"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/huong-dan-deo-khau-trang-phong-dich-20200908030710.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="10"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/chot-phong-dich-covid-19-vung-bien-gioi-20200907093742.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="10"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chot-phong-dich-covid-19-vung-bien-gioi-20200907093742.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="11"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/tham-du-thanh-le-online-20200911033603.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="11"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tham-du-thanh-le-online-20200911033603.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="12"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/covid-mua-02-2020-20200925045631.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="12"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/covid-mua-02-2020-20200925045631.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="13"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/chung-tay-day-lui-covid-19-20200908034009.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="13"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chung-tay-day-lui-covid-19-20200908034009.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="14"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/hoang-hon-mua-covid-20200908031358.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="14"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/hoang-hon-mua-covid-20200908031358.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="15"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/nhip-song-dan-tro-lai-hau-covid-19--20200908045540.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="15"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhip-song-dan-tro-lai-hau-covid-19--20200908045540.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="16"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/tinh-nguyen-vien-tiep-suc-mua-thi-tai-truong-thpt-thai-phien-ngo-quyen-hai-phong-20200907093619.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="16"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tinh-nguyen-vien-tiep-suc-mua-thi-tai-truong-thpt-thai-phien-ngo-quyen-hai-phong-20200907093619.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="17"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/bo-doi-phong-hoa-phun-khu-khuan-tren-cac-tuyen-pho-20200907093016.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="17"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/bo-doi-phong-hoa-phun-khu-khuan-tren-cac-tuyen-pho-20200907093016.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="18"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/tinh-yeu-tu-tam-dich-20200907092758.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="18"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tinh-yeu-tu-tam-dich-20200907092758.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="19"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/bua-com-trong-khu-cach-ly-20200908032720.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="19"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/bua-com-trong-khu-cach-ly-20200908032720.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="20"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/tranh-thu-20200908032703.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="20"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tranh-thu-20200908032703.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="21"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/oan-minh-chong-dich-giua-dai-ngan-truong-son-20200908032622.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="21"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/oan-minh-chong-dich-giua-dai-ngan-truong-son-20200908032622.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="22"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/xoa-deu-dung-dich-20201012025804.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="22"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/xoa-deu-dung-dich-20201012025804.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="23"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/1-mot-to-chot-cua-don-bien-phong-a-pa-chai-bo-chi-huy-bo-doi-bien-phong-tinh-dien-bien-tuan-tra-kiem-soat-duong-mon-loi-mo-doc-tuyen-bien-gioi-viet-trung-20200911070842.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="23"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/1-mot-to-chot-cua-don-bien-phong-a-pa-chai-bo-chi-huy-bo-doi-bien-phong-tinh-dien-bien-tuan-tra-kiem-soat-duong-mon-loi-mo-doc-tuyen-bien-gioi-viet-trung-20200911070842.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="24"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/2-kiem-tra-than-nhiet-cua-cac-lai-xe-truoc-khi-lam-thu-tuc-nhap-canh-tai-mot-chot-kiem-dich-cua-khau-quoc-te-tay-trang-tinh-dien-bien-20200911070936.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="24"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/2-kiem-tra-than-nhiet-cua-cac-lai-xe-truoc-khi-lam-thu-tuc-nhap-canh-tai-mot-chot-kiem-dich-cua-khau-quoc-te-tay-trang-tinh-dien-bien-20200911070936.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="25"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/trien-khai-xet-nghiem-nhanh-covid-19-tai-cho-dau-moi-nong-san-lon-nhat-ha-noi-20200909074929.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="25"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/trien-khai-xet-nghiem-nhanh-covid-19-tai-cho-dau-moi-nong-san-lon-nhat-ha-noi-20200909074929.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="26"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/hon-200-hanh-khach-mac-ket-tai-da-nang--20200908034818.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="26"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/hon-200-hanh-khach-mac-ket-tai-da-nang--20200908034818.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="27"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/chuyen-bay-dau-tien-dua-hanh-khach-mac-ket-tai-da-nang-20200908034842.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="27"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chuyen-bay-dau-tien-dua-hanh-khach-mac-ket-tai-da-nang-20200908034842.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="28"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/nguoi-hung-giau-mat-truy-tim-virut-corona-20200908041531.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="28"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nguoi-hung-giau-mat-truy-tim-virut-corona-20200908041531.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="29"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/niem-tin-quyet-thang-20200908041810.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="29"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/niem-tin-quyet-thang-20200908041810.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="30"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/nhung-anh-nuoi-khu-phong-toa-mua-covid-19-20200908041840.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="30"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhung-anh-nuoi-khu-phong-toa-mua-covid-19-20200908041840.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="31"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/mau-ao-thanh-nien-xung-phong-trong-chien-dich-phong-chong-covid-19-20200908041903.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="31"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/mau-ao-thanh-nien-xung-phong-trong-chien-dich-phong-chong-covid-19-20200908041903.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="32"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/tuyen-truyen-luu-dong-phong-chong-dich-covid-19-20200908041949.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="32"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/tuyen-truyen-luu-dong-phong-chong-dich-covid-19-20200908041949.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="33"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/chot-da-chien-cua-khau-huu-nghi-lang-son-20200908043838.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="33"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chot-da-chien-cua-khau-huu-nghi-lang-son-20200908043838.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="34"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/cac-co-quan-doan-the-tuyen-truyen-chong-dich-covid-19-tai-cua-khau-quoc-te-huu-nghi-lang-son-20200908043913.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="34"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/cac-co-quan-doan-the-tuyen-truyen-chong-dich-covid-19-tai-cua-khau-quoc-te-huu-nghi-lang-son-20200908043913.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="35"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/thanh-nien-tinh-nguyen-tiep-suc-mua-thi-2020-tai-thi-tran-dong-dang-cao-loc-lang-son-20200908044026.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="35"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/thanh-nien-tinh-nguyen-tiep-suc-mua-thi-2020-tai-thi-tran-dong-dang-cao-loc-lang-son-20200908044026.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="36"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/doan-thanh-nien-thi-tran-dong-dang-cao-loc-lang-son-trong-mua-chong-dich-2020-20200908044045.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="36"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/doan-thanh-nien-thi-tran-dong-dang-cao-loc-lang-son-trong-mua-chong-dich-2020-20200908044045.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="37"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/da-day-lui-dich-covid-19-20200908044105.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="37"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/da-day-lui-dich-covid-19-20200908044105.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="38"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/bau-oi-thuong-lay-bi-cung-20200908045019.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="38"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/bau-oi-thuong-lay-bi-cung-20200908045019.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="39"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/mot-nhan-vien-y-te-truc-chot-di-dong-phong-dich-covid-19-o-da-nang-dang-co-chong-lai-con-buon-ngu-sau-ca-truc-dai-day-cang-thang-va-met-moi--20200911040033.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="39"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/mot-nhan-vien-y-te-truc-chot-di-dong-phong-dich-covid-19-o-da-nang-dang-co-chong-lai-con-buon-ngu-sau-ca-truc-dai-day-cang-thang-va-met-moi--20200911040033.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="40"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tien-hanh-lay-mau-xet-nghiem-covid-19-cho-nguoi-nuoc-ngoai-20200911040245.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="40"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tien-hanh-lay-mau-xet-nghiem-covid-19-cho-nguoi-nuoc-ngoai-20200911040245.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="41"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tinh-nguyen-den-tu-cac-tinh-thanh-chuan-bi-trang-phuc-bao-ho-truoc-gio-buoc-vao-tran-chien-chong-covid-19-o-da-nang-20200911040623.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="41"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhan-vien-y-te-tinh-nguyen-den-tu-cac-tinh-thanh-chuan-bi-trang-phuc-bao-ho-truoc-gio-buoc-vao-tran-chien-chong-covid-19-o-da-nang-20200911040623.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="42"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/mot-can-bo-dan-phong-quan-son-tra-20200911041250.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="42"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/mot-can-bo-dan-phong-quan-son-tra-20200911041250.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="43"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/nhan-vien-y-te-da-nang-cang-minh-chay-dua-voi-thoi-gian-de-luon-co-mat-trong-moi-tinh-huong-khi-dot-dich-covid-19-lan-thu-hai-bung-phat-o-da-nang-20200911042107.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="43"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhan-vien-y-te-da-nang-cang-minh-chay-dua-voi-thoi-gian-de-luon-co-mat-trong-moi-tinh-huong-khi-dot-dich-covid-19-lan-thu-hai-bung-phat-o-da-nang-20200911042107.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="44"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/niem-vui-cua-phi-cong-chuyen-bay-vn7160-dua-207-hanh-khach-mac-ket-o-da-nang-ve-ha-noi-20200911071717.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="44"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/niem-vui-cua-phi-cong-chuyen-bay-vn7160-dua-207-hanh-khach-mac-ket-o-da-nang-ve-ha-noi-20200911071717.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="45"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/nu-hon-thoi-covid-20200911072108.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="45"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nu-hon-thoi-covid-20200911072108.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="46"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/cac-cong-dan-tro-ve-tu-guinea-xich-dao-the-hien-su-biet-on-toi-dang-nha-nuoc-da-quan-tam-ho-tro-trong-luc-kho-khan-do-dich-covid-19-20200911073007.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="46"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/cac-cong-dan-tro-ve-tu-guinea-xich-dao-the-hien-su-biet-on-toi-dang-nha-nuoc-da-quan-tam-ho-tro-trong-luc-kho-khan-do-dich-covid-19-20200911073007.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="47"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/cong-dan-hoan-thanh-thoi-gian-cach-ly-cam-on-su-giup-do-cua-cac-can-bo-chien-sy-trung-doan-814-20200917035238.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="47"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/cong-dan-hoan-thanh-thoi-gian-cach-ly-cam-on-su-giup-do-cua-cac-can-bo-chien-sy-trung-doan-814-20200917035238.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="48"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/cu-ba-va-can-bo-y-te-tai-khu-cach-ly-tap-trung-quyen-luyen-truoc-khi-chia-tay-20200917035942.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="48"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/cu-ba-va-can-bo-y-te-tai-khu-cach-ly-tap-trung-quyen-luyen-truoc-khi-chia-tay-20200917035942.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="49"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/dong-chi-dai-ta-vu-hai-ninh-pho-chi-huy-truong-bo-chi-huy-quan-su-tinh-hoa-binh-trao-giay-chung-nhan-cho-cong-dan-hoan-thanh-thoi-gian-cach-ly-tap-trung-20200917035724.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="49"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/dong-chi-dai-ta-vu-hai-ninh-pho-chi-huy-truong-bo-chi-huy-quan-su-tinh-hoa-binh-trao-giay-chung-nhan-cho-cong-dan-hoan-thanh-thoi-gian-cach-ly-tap-trung-20200917035724.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="50"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/chot-chan-cong-tinh-20200911082349.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="50"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/chot-chan-cong-tinh-20200911082349.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="51"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/thuc-canh-bien-gioi-20200911083027.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="51"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/thuc-canh-bien-gioi-20200911083027.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="52"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/truoc-gio-don-chuyen-bay-tro-ve-tu-vung-dich-20200911083049.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="52"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/truoc-gio-don-chuyen-bay-tro-ve-tu-vung-dich-20200911083049.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="53"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/khoang-cach-2m-20200911083104.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="53"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/khoang-cach-2m-20200911083104.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="54"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/kien-cuong-bam-chot-noi-bien-thuy-20200911085347.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="54"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/kien-cuong-bam-chot-noi-bien-thuy-20200911085347.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="55"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/y-thuc-chong-dich-20200911090132.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="55"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/y-thuc-chong-dich-20200911090132.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="56"] {
        background-image: url("https://w.ladicdn.com/s750x700/5c7362c6c417ab07e5196b05/nhung-chien-binh-covid-19-20200918033214.jpg");
    }

    #GALLERY1762 .ladi-gallery .ladi-gallery-control-item[data-index="56"] {
        background-image: url("https://w.ladicdn.com/s400x400/5c7362c6c417ab07e5196b05/nhung-chien-binh-covid-19-20200918033214.jpg");
    }

    #IMAGE1768 {
        width: 134.195px;
        height: 38.7465px;
        top: 26.2251px;
        left: 1929.8px;
    }

    #IMAGE1768>.ladi-image>.ladi-image-background {
        width: 134.195px;
        height: 38.7465px;
        top: 0px;
        left: 0px;
        background-image: url("https://w.ladicdn.com/s450x350/5c7362c6c417ab07e5196b05/beatvn-logo-20200917100516.png");
    }

    #HTML_CODE1777 {
        width: 420px;
        height: 261.125px;
        top: -1px;
        left: 0px;
    }

    #SECTION1776 {
        height: 259.125px;
        display: none !important;
    }

    #SECTION1776>.ladi-section-background {
        background-color: rgb(250, 250, 250);
    }
}
</style>
<style id="style_lazyload" type="text/css">
.ladi-section-background,
.ladi-image-background,
.ladi-button-background,
.ladi-headline,
.ladi-video-background,
.ladi-countdown-background,
.ladi-box,
.ladi-frame-background,
.ladi-banner,
.ladi-form-item-background,
.ladi-gallery-view-item,
.ladi-gallery-control-item,
.ladi-spin-lucky-screen,
.ladi-spin-lucky-start,
.ladi-list-paragraph ul li:before {
    background-image: none !important;
}
</style>
<?php echo eventchamp_sub_content_before(); ?>

<?php 
        global $post;
        $postcat = get_the_category( $post->ID );
        $checkCat = false;
        foreach ($postcat as $key => $value) {
            if($value->parent==286){
                $checkCat = true;
                $chiendich_child_id = $value->term_id;
            }
        }
        if( !$checkCat ){
            echo eventchamp_page_title_bar(); 
        }
        ?>

<?php while ( have_posts() ) { ?>

<?php the_post(); ?>

<?php
					if( post_password_required() ) {

                        echo eventchamp_container_before();

						if( function_exists( 'eventchamp_password_protected_box' ) ) {

							echo eventchamp_password_protected_box();

						}

					} else {
				?>
<?php
                    global $post;
                    if(!$checkCat ){?>

<?php echo eventchamp_container_before(); ?>

<?php echo eventchamp_row_before(); ?>

<?php echo eventchamp_content_area_before(); ?>

<div class="gt-page-content">
    <?php echo eventchamp_post_header( $id = get_the_ID() ); ?>

    <div class="gt-content">
        <?php the_content(); ?>
    </div>

    <?php
                                            wp_link_pages(
                                                array(
                                                    'before' => '<div class="gt-post-pages"><span class="gt-title">' . esc_html__( 'Pages:', 'eventchamp' ) . '</span>',
                                                    'after' => '</div>',
                                                    'link_before' => '<span>',
                                                    'link_after' => '</span>',
                                                )
                                            );
                                        ?>


    <?php echo eventchamp_post_meta( $id = get_the_ID() ); ?>

    <?php 
                                            $post_tags = ot_get_option( 'post_post_tags', 'on' );
                                            $tag_style = ot_get_option( 'post-tags-style', 'style-1' );

                                            if ( $post_tags == 'on' ) {

                                                the_tags( '<div class="gt-tags gt-' . esc_attr( $tag_style ) . '"><ul><li>', '</li><li>', '</li></ul></div>' );

                                            }
                                        ?>

    <?php echo eventchamp_post_social_sharing(); ?>
</div>

<?php echo eventchamp_post_navigation(); ?>

<?php echo eventchamp_author_box(); ?>

<?php echo eventchamp_related_posts( $id = get_the_ID() ); ?>

<?php
                                        $post_comments = ot_get_option( 'post_post_comment_area', 'on' );

                                        if( $post_comments == "on" ) {

                                            if ( comments_open() || get_comments_number() ) {

                                                comments_template();

                                            }

                                        }
                                    ?>

<?php echo eventchamp_content_area_after(); ?>

<?php get_sidebar(); ?>

<?php echo eventchamp_row_after(); ?>

<?php echo eventchamp_container_after(); ?>

<?php }else{
                        $check = true;
                        if($chiendich_child_id == 287){
                        ?>
<!-- header -->
<?php
                            global $wpdb;    
                            $id_contest = get_field('id_contest');
                            $queryCacAnhDuThi = 'SELECT wp_postmeta.post_id,wp_posts.post_title,wp_posts.post_content,wp_photo_contest_list.contest_name,wp_postmeta.meta_key,wp_postmeta.meta_value FROM wp_photo_contest_list JOIN wp_postmeta ON wp_photo_contest_list.id = wp_postmeta.meta_value JOIN wp_posts ON wp_posts.ID = wp_postmeta.post_id WHERE wp_postmeta.meta_key LIKE "photo-related-to-contest" AND wp_postmeta.meta_value = ' . $id_contest;
                            $resultCacAnhDuThi = $wpdb->get_results( $queryCacAnhDuThi );
                            $queryThongTinChienDich = 'SELECT * FROM wp_photo_contest_list WHERE wp_photo_contest_list.id = ' . $id_contest;
                            $resultThongTinChienDich = $wpdb->get_results( $queryThongTinChienDich );
                            //print_r($resultThongTinChienDich[0]->contest_condition);exit;
                            $queryThongTinTacGia = 'SELECT * FROM wp_postmeta WHERE wp_postmeta.meta_key LIKE "contest-user-name" AND wp_postmeta.post_id = ';
                            
                            $resultThongTinBaoChi=acf_photo_gallery('thongtinbaochi',$post->ID);
                            //print_r($resultThongTinBaoChi);exit;
                            $nhataitro = get_field('nhataitro');
                            $resultNhaTaiTro = explode(",",$nhataitro);

                            
                            $resultBanGiamKhao = acf_photo_gallery('bangiamkhao',$post->ID);
                        ?>
<div class="ladi-wraper">
    <div id="SECTION1776" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="HTML_CODE1777" class="ladi-element">
                <div class="ladi-html-code">
                    <iframe
                        src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fmangluoiprvietnam%2Fvideos%2F658945038330788%2F&amp;width=1280"
                        width="100%" height="100%" style="border: none; overflow: hidden;" scrolling="no"
                        frameborder="0" allowtransparency="true" allowfullscreen="true"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION41" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="BOX48" class="ladi-element">
                <div class="ladi-box"></div>
            </div>
            <div id="IMAGE42" class="ladi-element">
                <div class="ladi-image">
                    <div class="ladi-image-background"></div>
                </div>
            </div>
            <div id="HEADLINE47" class="ladi-element">
                <h3 class="ladi-headline">
                    <?=get_field('textarea1');?>
                </h3>
            </div>
            <div id="IMAGE43" class="ladi-element">
                <div class="ladi-image">
                    <div class="ladi-image-background"></div>
                </div>
            </div>
            <a href="<?=get_field('url_contest')?>">
                <div data-action="true" id="BUTTON50" class="ladi-element">
                    <div class="ladi-button ladi-transition">
                        <div class="ladi-button-background"></div>
                        <div id="BUTTON_TEXT50" class="ladi-element">
                            <p class="ladi-headline">Tham gia ngay</p>
                        </div>
                    </div>
                </div>
            </a>
            <div id="LINE208" class="ladi-element">
                <div class="ladi-line">
                    <div class="ladi-line-container"></div>
                </div>
            </div>
            <div id="IMAGE299" class="ladi-element">
                <div class="ladi-image">
                    <div class="ladi-image-background"></div>
                </div>
            </div>
            <div id="IMAGE308" class="ladi-element">
                <div class="ladi-image">
                    <div class="ladi-image-background"></div>
                </div>
            </div>
        </div>
    </div>
  
    <div id="SECTION3" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="HEADLINE17" class="ladi-element">
                <h3 class="ladi-headline">
                    <?=$resultThongTinChienDich[0]->contest_condition;?>
                </h3>
            </div>
            <div id="GROUP251" class="ladi-element">
                <div class="ladi-group">
                    <div id="HEADLINE51" class="ladi-element">
                        <h3 class="ladi-headline">THỂ LỆ CUỘC THI</h3>
                    </div>
                    <div id="LINE57" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ( $post->ID == 5878 ){ ?>
            <div id="GROUP416" class="ladi-element">
                <div class="ladi-group">
                    <div id="GROUP24" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX4" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE11" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Cách thức tham gia</h3>
                            </div>
                            <div id="LINE12" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP58" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX59" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE60" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Chủ đề cuộc thi</h3>
                            </div>
                            <div id="LINE61" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP62" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX63" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE64" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Ảnh dự thi hợp lệ</h3>
                            </div>
                            <div id="LINE65" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP66" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX67" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE68" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Giải thưởng</h3>
                            </div>
                            <div id="LINE69" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="SHAPE417" class="ladi-element">
                <div class="ladi-shape">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"
                        preserveAspectRatio="none" width="100%" height="100%" class="" fill="rgba(180, 180, 180, 1.0)">
                        <g>
                            <path
                                d="M58,85c-12.131,0-22-9.869-22-22V22c0-3.86,3.14-7,7-7s7,3.14,7,7v17.676C50.91,39.243,51.927,39,53,39   c2.801,0,5.223,1.653,6.341,4.035C60.406,42.378,61.659,42,63,42c2.801,0,5.223,1.653,6.341,4.035C70.406,45.378,71.659,45,73,45   c3.859,0,7,3.14,7,7v11C80,75.131,70.131,85,58,85z M43,19c-1.654,0-3,1.346-3,3v41c0,9.925,8.075,18,18,18c9.925,0,18-8.075,18-18   V52c0-1.654-1.346-3-3-3s-3,1.346-3,3c0,1.104-0.896,2-2,2s-2-0.896-2-2v-3c0-1.654-1.346-3-3-3s-3,1.346-3,3c0,1.104-0.896,2-2,2   s-2-0.896-2-2v-3c0-1.654-1.346-3-3-3s-3,1.346-3,3c0,1.104-0.896,2-2,2s-2-0.896-2-2V22C46,20.346,44.654,19,43,19z">
                            </path>
                            <path
                                d="M65.41,23.41l-5,5C60.02,28.8,59.51,29,59,29s-1.02-0.2-1.41-0.59c-0.79-0.78-0.79-2.04,0-2.82L59.18,24H55   c-1.1,0-2-0.9-2-2s0.9-2,2-2h4.18l-1.59-1.59c-0.79-0.78-0.79-2.04,0-2.82c0.78-0.79,2.04-0.79,2.82,0l5,5   C66.2,21.37,66.2,22.63,65.41,23.41z">
                            </path>
                            <path
                                d="M33,22c0,1.1-0.9,2-2,2h-4.18l1.59,1.59c0.79,0.78,0.79,2.04,0,2.82C28.02,28.8,27.51,29,27,29s-1.02-0.2-1.41-0.59l-5-5   c-0.79-0.78-0.79-2.04,0-2.82l5-5c0.78-0.79,2.04-0.79,2.82,0c0.79,0.78,0.79,2.04,0,2.82L26.82,20H31C32.1,20,33,20.9,33,22z">
                            </path>
                        </g>
                    </svg>
                </div>
            </div>
            <div id="GROUP475" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX472" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="HEADLINE474" class="ladi-element">
                        <h3 class="ladi-headline">Click vào từng mục để xem chi tiết</h3>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php if ( $post->ID == 5878 ){ ?>
    <div id="SECTION30" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="GROUP524" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX26" class="ladi-element">
                        <div class="ladi-box">
                            <div class="ladi-overlay"></div>
                        </div>
                    </div>
                    <div data-action="true" id="SHAPE116" class="ladi-element">
                        <div class="ladi-shape">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100"
                                xml:space="preserve" preserveAspectRatio="none" width="100%" height="100%" class=""
                                fill="rgba(244, 184, 156, 1.0)">
                                <path
                                    d="M40.315,63.066c0.005-0.004,0.008-0.01,0.011-0.015l46.875-46.873c0.933-0.935,0.933-2.455-0.001-3.391  c-0.905-0.904-2.484-0.905-3.39,0.001L70.173,26.427C63.402,22.687,56.625,20.77,50,20.77c-25.085,0-43.795,26.722-44.58,27.859  c-0.561,0.814-0.561,1.907,0,2.721C5.764,51.848,13.473,62.927,25.599,71l-12.8,12.801c-0.933,0.936-0.933,2.454,0.001,3.391  c0.453,0.451,1.056,0.701,1.694,0.701c0.641,0,1.242-0.25,1.695-0.703L40.3,63.079C40.305,63.075,40.31,63.072,40.315,63.066z   M29.065,67.534c-9.358-6.024-16.25-14.361-18.688-17.543c3.922-5.1,20.087-24.428,39.623-24.428c5.417,0,11.003,1.482,16.643,4.396  l-5.384,5.383c-3.218-2.484-7.132-3.845-11.259-3.845c-10.196,0-18.493,8.296-18.493,18.492c0,4.131,1.361,8.044,3.844,11.259  L29.065,67.534z M36.3,49.989c0-7.553,6.146-13.699,13.699-13.699c2.845,0,5.553,0.872,7.836,2.474L38.772,57.826  C37.172,55.544,36.3,52.837,36.3,49.989z">
                                </path>
                                <path
                                    d="M50,63.688c-1.363,0-2.692-0.205-3.96-0.588l-3.704,3.703c2.376,1.09,4.972,1.68,7.664,1.68  c10.195,0,18.493-8.297,18.493-18.493c0-2.692-0.589-5.289-1.679-7.664l-3.705,3.705c0.385,1.267,0.59,2.596,0.59,3.959  C63.699,57.543,57.553,63.688,50,63.688z">
                                </path>
                                <path
                                    d="M94.579,48.627c-0.313-0.452-6.681-9.562-16.815-17.251l-3.43,3.43c7.618,5.674,13.157,12.4,15.29,15.182  C85.702,55.088,69.54,74.416,50,74.416c-4.146,0-8.394-0.876-12.687-2.59l-3.634,3.635C39.161,77.93,44.63,79.209,50,79.209  c25.068,0,43.795-26.721,44.58-27.859C95.141,50.537,95.141,49.444,94.579,48.627z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div id="HEADLINE27" class="ladi-element">
                        <h3 class="ladi-headline ladi-transition">Cách thức tham gia</h3>
                    </div>
                    <div id="LINE28" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="GROUP523" class="ladi-element">
                        <div class="ladi-group">
                            <div id="HEADLINE71" class="ladi-element">
                                <h3 class="ladi-headline">01</h3>
                            </div>
                            <div id="HEADLINE72" class="ladi-element">
                                <h3 class="ladi-headline">Tác giả gửi bài dự thi thông qua Website&nbsp;</h3>
                            </div>
                            <a href="vnpr.vn/kiencuongvietnam" target="_blank" id="HEADLINE73" class="ladi-element">
                                <h3 class="ladi-headline">vnpr.vn/kiencuongvietnam</h3>
                            </a>
                            <div id="GROUP508" class="ladi-element">
                                <div class="ladi-group">
                                    <a href="mailto: admin@vnpr.vn" id="HEADLINE506" class="ladi-element">
                                        <h3 class="ladi-headline">admin@vnpr.vn</h3>
                                    </a>
                                    <div id="HEADLINE507" class="ladi-element">
                                        <h3 class="ladi-headline">Hoặc qua email:</h3>
                                    </div>
                                </div>
                            </div>
                            <div id="HEADLINE510" class="ladi-element">
                                <h3 class="ladi-headline">(Tiêu đề email: Bài dự thi_Tên tác giả_Cuộc thi ảnh “Kiên
                                    cường Việt Nam - Resilient Vietnam”)</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION87" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="GROUP106" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX89" class="ladi-element">
                        <div class="ladi-box">
                            <div class="ladi-overlay"></div>
                        </div>
                    </div>
                    <div id="HEADLINE90" class="ladi-element">
                        <h3 class="ladi-headline ladi-transition">Chủ đề cuộc thi</h3>
                    </div>
                    <div id="LINE91" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="GROUP118" class="ladi-element">
                        <div class="ladi-group">
                            <div id="HEADLINE97" class="ladi-element">
                                <h3 class="ladi-headline">01</h3>
                            </div>
                            <div id="HEADLINE98" class="ladi-element">
                                <h3 class="ladi-headline">
                                    Thực trạng mùa dịch, những nỗ lực của người dân, các cấp chính quyền, các bộ ngành,
                                    các tổ chức xã hội, các doanh nghiệp … trong hoạt động phòng, chống dịch COVID-19 và
                                    cùng nhau vượt qua những
                                    khó khăn trong đời sống do dịch bệnh gây ra.
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP119" class="ladi-element">
                        <div class="ladi-group">
                            <div id="HEADLINE104" class="ladi-element">
                                <h3 class="ladi-headline">02</h3>
                            </div>
                            <div id="HEADLINE105" class="ladi-element">
                                <h3 class="ladi-headline">Phẩm chất kiên cường Việt Nam thông qua các bức ảnh, thái độ
                                    người Việt Nam vượt qua đại dịch.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-action="true" id="SHAPE117" class="ladi-element">
                <div class="ladi-shape">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"
                        preserveAspectRatio="none" width="100%" height="100%" class="" fill="rgba(244, 184, 156, 1.0)">
                        <path
                            d="M40.315,63.066c0.005-0.004,0.008-0.01,0.011-0.015l46.875-46.873c0.933-0.935,0.933-2.455-0.001-3.391  c-0.905-0.904-2.484-0.905-3.39,0.001L70.173,26.427C63.402,22.687,56.625,20.77,50,20.77c-25.085,0-43.795,26.722-44.58,27.859  c-0.561,0.814-0.561,1.907,0,2.721C5.764,51.848,13.473,62.927,25.599,71l-12.8,12.801c-0.933,0.936-0.933,2.454,0.001,3.391  c0.453,0.451,1.056,0.701,1.694,0.701c0.641,0,1.242-0.25,1.695-0.703L40.3,63.079C40.305,63.075,40.31,63.072,40.315,63.066z   M29.065,67.534c-9.358-6.024-16.25-14.361-18.688-17.543c3.922-5.1,20.087-24.428,39.623-24.428c5.417,0,11.003,1.482,16.643,4.396  l-5.384,5.383c-3.218-2.484-7.132-3.845-11.259-3.845c-10.196,0-18.493,8.296-18.493,18.492c0,4.131,1.361,8.044,3.844,11.259  L29.065,67.534z M36.3,49.989c0-7.553,6.146-13.699,13.699-13.699c2.845,0,5.553,0.872,7.836,2.474L38.772,57.826  C37.172,55.544,36.3,52.837,36.3,49.989z">
                        </path>
                        <path
                            d="M50,63.688c-1.363,0-2.692-0.205-3.96-0.588l-3.704,3.703c2.376,1.09,4.972,1.68,7.664,1.68  c10.195,0,18.493-8.297,18.493-18.493c0-2.692-0.589-5.289-1.679-7.664l-3.705,3.705c0.385,1.267,0.59,2.596,0.59,3.959  C63.699,57.543,57.553,63.688,50,63.688z">
                        </path>
                        <path
                            d="M94.579,48.627c-0.313-0.452-6.681-9.562-16.815-17.251l-3.43,3.43c7.618,5.674,13.157,12.4,15.29,15.182  C85.702,55.088,69.54,74.416,50,74.416c-4.146,0-8.394-0.876-12.687-2.59l-3.634,3.635C39.161,77.93,44.63,79.209,50,79.209  c25.068,0,43.795-26.721,44.58-27.859C95.141,50.537,95.141,49.444,94.579,48.627z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION107" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="GROUP469" class="ladi-element">
                <div class="ladi-group">
                    <div id="GROUP182" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX183" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE184" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Cách thức tham gia</h3>
                            </div>
                            <div id="LINE185" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP186" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX187" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE188" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Chủ đề cuộc thi</h3>
                            </div>
                            <div id="LINE189" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP190" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX191" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE192" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Giải thưởng</h3>
                            </div>
                            <div id="LINE193" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP312" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX109" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div id="HEADLINE110" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Ảnh dự thi hợp lệ</h3>
                            </div>
                            <div id="LINE111" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                            <div id="GROUP120" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE112" class="ladi-element">
                                        <h3 class="ladi-headline">01</h3>
                                    </div>
                                    <div id="HEADLINE113" class="ladi-element">
                                        <h3 class="ladi-headline">Ảnh dự thi phải phù hợp và đúng theo chủ đề của cuộc
                                            thi.</h3>
                                    </div>
                                </div>
                            </div>
                            <div id="GROUP121" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE122" class="ladi-element">
                                        <h3 class="ladi-headline">02</h3>
                                    </div>
                                    <div id="HEADLINE123" class="ladi-element">
                                        <h3 class="ladi-headline">Ảnh được chụp tại Việt Nam từ ngày <span
                                                style="color: <?=get_field('secondary_color')?>;">23/01/2020</span> tới ngày <span
                                                style="color: <?=get_field('secondary_color')?>;">30/09/2020</span>.</h3>
                                    </div>
                                </div>
                            </div>
                            <div id="GROUP124" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE125" class="ladi-element">
                                        <h3 class="ladi-headline">03</h3>
                                    </div>
                                    <div id="HEADLINE126" class="ladi-element">
                                        <h3 class="ladi-headline">
                                            Ảnh có độ phân giải <span style="color: <?=get_field('secondary_color')?>;">full HD (1920 x
                                                1080)</span> trở lên đối với ảnh tham gia hạng mục Ảnh chụp bằng điện
                                            thoại. Và ảnh có độ phân giải trên
                                            <span style="color: <?=get_field('secondary_color')?>;">3.000 pixels</span> đối với ảnh tham
                                            gia hạng mục Ảnh chụp bằng máy ảnh chuyên nghiệp.
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div id="GROUP127" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE128" class="ladi-element">
                                        <h3 class="ladi-headline">04</h3>
                                    </div>
                                    <div id="HEADLINE129" class="ladi-element">
                                        <h3 class="ladi-headline">Ảnh phải kèm theo thông tin về tác giả, nội dung bức
                                            ảnh, thời gian và địa điểm chụp. Khuyến khích các bức ảnh gửi kèm bối cảnh
                                            và lời bình.</h3>
                                    </div>
                                </div>
                            </div>
                            <div id="GROUP138" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE139" class="ladi-element">
                                        <h3 class="ladi-headline">05</h3>
                                    </div>
                                    <div id="HEADLINE140" class="ladi-element">
                                        <h3 class="ladi-headline">Ảnh dự thi phải là tác phẩm của người đăng ký dự thi,
                                            không bị tranh chấp tác quyền, quyền nhân thân, quyền riêng tư và quyền sở
                                            hữu trí tuệ với bất kỳ ai.</h3>
                                    </div>
                                </div>
                            </div>
                            <div id="GROUP141" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE142" class="ladi-element">
                                        <h3 class="ladi-headline">06</h3>
                                    </div>
                                    <div id="HEADLINE143" class="ladi-element">
                                        <h3 class="ladi-headline">Ảnh dự thi có hình ảnh của người khác thì phải có sự
                                            đồng ý của nhân vật trước khi dự thi.</h3>
                                    </div>
                                </div>
                            </div>
                            <div id="GROUP144" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE145" class="ladi-element">
                                        <h3 class="ladi-headline">07</h3>
                                    </div>
                                    <div id="HEADLINE146" class="ladi-element">
                                        <h3 class="ladi-headline">Mỗi thí sinh có thể nộp một hoặc nhiều ảnh, tối đa 5
                                            ảnh.</h3>
                                    </div>
                                </div>
                            </div>
                            <div id="GROUP147" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE148" class="ladi-element">
                                        <h3 class="ladi-headline">08</h3>
                                    </div>
                                    <div id="HEADLINE149" class="ladi-element">
                                        <h3 class="ladi-headline">Ảnh dự thi là ảnh chưa từng đoạt giải bất kỳ cuộc thi
                                            ảnh nào.</h3>
                                    </div>
                                </div>
                            </div>
                            <div data-action="true" id="SHAPE150" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(244, 184, 156, 1.0)">
                                        <path
                                            d="M40.315,63.066c0.005-0.004,0.008-0.01,0.011-0.015l46.875-46.873c0.933-0.935,0.933-2.455-0.001-3.391  c-0.905-0.904-2.484-0.905-3.39,0.001L70.173,26.427C63.402,22.687,56.625,20.77,50,20.77c-25.085,0-43.795,26.722-44.58,27.859  c-0.561,0.814-0.561,1.907,0,2.721C5.764,51.848,13.473,62.927,25.599,71l-12.8,12.801c-0.933,0.936-0.933,2.454,0.001,3.391  c0.453,0.451,1.056,0.701,1.694,0.701c0.641,0,1.242-0.25,1.695-0.703L40.3,63.079C40.305,63.075,40.31,63.072,40.315,63.066z   M29.065,67.534c-9.358-6.024-16.25-14.361-18.688-17.543c3.922-5.1,20.087-24.428,39.623-24.428c5.417,0,11.003,1.482,16.643,4.396  l-5.384,5.383c-3.218-2.484-7.132-3.845-11.259-3.845c-10.196,0-18.493,8.296-18.493,18.492c0,4.131,1.361,8.044,3.844,11.259  L29.065,67.534z M36.3,49.989c0-7.553,6.146-13.699,13.699-13.699c2.845,0,5.553,0.872,7.836,2.474L38.772,57.826  C37.172,55.544,36.3,52.837,36.3,49.989z">
                                        </path>
                                        <path
                                            d="M50,63.688c-1.363,0-2.692-0.205-3.96-0.588l-3.704,3.703c2.376,1.09,4.972,1.68,7.664,1.68  c10.195,0,18.493-8.297,18.493-18.493c0-2.692-0.589-5.289-1.679-7.664l-3.705,3.705c0.385,1.267,0.59,2.596,0.59,3.959  C63.699,57.543,57.553,63.688,50,63.688z">
                                        </path>
                                        <path
                                            d="M94.579,48.627c-0.313-0.452-6.681-9.562-16.815-17.251l-3.43,3.43c7.618,5.674,13.157,12.4,15.29,15.182  C85.702,55.088,69.54,74.416,50,74.416c-4.146,0-8.394-0.876-12.687-2.59l-3.634,3.635C39.161,77.93,44.63,79.209,50,79.209  c25.068,0,43.795-26.721,44.58-27.859C95.141,50.537,95.141,49.444,94.579,48.627z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div id="GROUP309" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE310" class="ladi-element">
                                        <h3 class="ladi-headline">09</h3>
                                    </div>
                                    <div id="HEADLINE311" class="ladi-element">
                                        <h3 class="ladi-headline">Ảnh dự thi cần ghi rõ tham gia hạng mục ảnh chụp bằng
                                            máy ảnh chuyên nghiệp hay ảnh chụp bằng điện thoại.</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION152" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="GROUP467" class="ladi-element">
                <div class="ladi-group">
                    <div id="GROUP195" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX196" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE197" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Cách thức tham gia</h3>
                            </div>
                            <div id="LINE198" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP199" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX200" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE201" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Chủ đề cuộc thi</h3>
                            </div>
                            <div id="LINE202" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP203" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX204" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div data-action="true" id="HEADLINE205" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Ảnh dự thi hợp lệ</h3>
                            </div>
                            <div id="LINE206" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP463" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX154" class="ladi-element">
                                <div class="ladi-box">
                                    <div class="ladi-overlay"></div>
                                </div>
                            </div>
                            <div id="GROUP459" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="HEADLINE460" class="ladi-element">
                                        <h3 class="ladi-headline">03</h3>
                                    </div>
                                    <div id="HEADLINE461" class="ladi-element">
                                        <h3 class="ladi-headline">Giải thưởng truyền cảm hứng: <span
                                                style="color: rgb(255, 255, 255); font-weight: 400;">1 điện thoại VSmart
                                                Aris + Giấy chứng nhận giải</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div id="HEADLINE155" class="ladi-element">
                                <h3 class="ladi-headline ladi-transition">Giải thưởng</h3>
                            </div>
                            <div id="LINE156" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                            <div data-action="true" id="SHAPE181" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(244, 184, 156, 1.0)">
                                        <path
                                            d="M40.315,63.066c0.005-0.004,0.008-0.01,0.011-0.015l46.875-46.873c0.933-0.935,0.933-2.455-0.001-3.391  c-0.905-0.904-2.484-0.905-3.39,0.001L70.173,26.427C63.402,22.687,56.625,20.77,50,20.77c-25.085,0-43.795,26.722-44.58,27.859  c-0.561,0.814-0.561,1.907,0,2.721C5.764,51.848,13.473,62.927,25.599,71l-12.8,12.801c-0.933,0.936-0.933,2.454,0.001,3.391  c0.453,0.451,1.056,0.701,1.694,0.701c0.641,0,1.242-0.25,1.695-0.703L40.3,63.079C40.305,63.075,40.31,63.072,40.315,63.066z   M29.065,67.534c-9.358-6.024-16.25-14.361-18.688-17.543c3.922-5.1,20.087-24.428,39.623-24.428c5.417,0,11.003,1.482,16.643,4.396  l-5.384,5.383c-3.218-2.484-7.132-3.845-11.259-3.845c-10.196,0-18.493,8.296-18.493,18.492c0,4.131,1.361,8.044,3.844,11.259  L29.065,67.534z M36.3,49.989c0-7.553,6.146-13.699,13.699-13.699c2.845,0,5.553,0.872,7.836,2.474L38.772,57.826  C37.172,55.544,36.3,52.837,36.3,49.989z">
                                        </path>
                                        <path
                                            d="M50,63.688c-1.363,0-2.692-0.205-3.96-0.588l-3.704,3.703c2.376,1.09,4.972,1.68,7.664,1.68  c10.195,0,18.493-8.297,18.493-18.493c0-2.692-0.589-5.289-1.679-7.664l-3.705,3.705c0.385,1.267,0.59,2.596,0.59,3.959  C63.699,57.543,57.553,63.688,50,63.688z">
                                        </path>
                                        <path
                                            d="M94.579,48.627c-0.313-0.452-6.681-9.562-16.815-17.251l-3.43,3.43c7.618,5.674,13.157,12.4,15.29,15.182  C85.702,55.088,69.54,74.416,50,74.416c-4.146,0-8.394-0.876-12.687-2.59l-3.634,3.635C39.161,77.93,44.63,79.209,50,79.209  c25.068,0,43.795-26.721,44.58-27.859C95.141,50.537,95.141,49.444,94.579,48.627z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div id="GROUP210" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="GROUP157" class="ladi-element">
                                        <div class="ladi-group">
                                            <div id="HEADLINE158" class="ladi-element">
                                                <h3 class="ladi-headline">01</h3>
                                            </div>
                                            <div id="HEADLINE159" class="ladi-element">
                                                <h3 class="ladi-headline">Hạng mục dành cho ảnh chụp bằng máy ảnh chuyên
                                                    nghiệp</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="LIST_PARAGRAPH209" class="ladi-element">
                                        <div class="ladi-list-paragraph">
                                            <ul>
                                                <li><span style="font-weight: bold;">Giải Vàng: </span>01 máy ảnh Canon
                                                    EOS M6 Mark II (trị giá 28,050,000VND) + 1 điện thoại VSmart Aris +
                                                    Giấy chứng nhận giải</li>
                                                <li><span style="font-weight: bold;">Giải Bạc:</span>&nbsp;1 điện thoại
                                                    VSmart Aris + Giấy chứng nhận giải</li>
                                                <li><span style="font-weight: bold;">Giải Đồng:</span>&nbsp;1 điện thoại
                                                    VSmart Live 4 + Giấy chứng nhận giải</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="GROUP211" class="ladi-element">
                                <div class="ladi-group">
                                    <div id="GROUP212" class="ladi-element">
                                        <div class="ladi-group">
                                            <div id="HEADLINE213" class="ladi-element">
                                                <h3 class="ladi-headline">02</h3>
                                            </div>
                                            <div id="HEADLINE214" class="ladi-element">
                                                <h3 class="ladi-headline">Hạng mục dành cho ảnh chụp bằng điện thoại
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="LIST_PARAGRAPH215" class="ladi-element">
                                        <div class="ladi-list-paragraph">
                                            <ul>
                                                <li><span style="font-weight: 700;">Giải Vàng: </span>01 máy ảnh Canon
                                                    EOS M200 (trị giá 15,950,000VND) + 1 điện thoại VSmart Aris + Giấy
                                                    chứng nhận giải</li>
                                                <li><span style="font-weight: 700;">Giải Bạc: </span>1 điện thoại VSmart
                                                    Aris + Giấy chứng nhận giải</li>
                                                <li><span style="font-weight: 700;">Giải Đồng: </span>1 điện thoại
                                                    VSmart Live 4 + Giấy chứng nhận giải</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if ( $post->ID != 5878 ){ ?>
        <div class="RA-container-contest-info row">
            <div class="col-6 col-lg-6 row RA-container-contest-info-element">
                <div class="col-1 col-lg-1 RA-container-contest-info-icon"><i class="fas fa-book"></i></div>
                <div class="col-11 col-lg-11 RA-container-contest-info-area">
                    <h2 class="RA-container-contest-info-heading">Cách Thức Tham Gia</h2>
                    <p class="RA-container-contest-info-description">
                    Tác giả gửi bài dự thi thông qua Website vnpr.vn/kiencuongvietnamadmin@vnpr.vn<br>
                    Hoặc qua email:(Tiêu đề email: Bài dự thi_Tên tác giả_Cuộc thi ảnh “Kiên cường Việt Nam - Resilient Vietnam”)
                    </p>
                </div>
            </div>
            <div class="col-6 col-lg-6 row RA-container-contest-info-element">
                <div class="col-1 col-lg-1 RA-container-contest-info-icon"><i class="fas fa-tree"></i></div>
                <div class="col-11 col-lg-11 RA-container-contest-info-area">
                    <h2 class="RA-container-contest-info-heading">Chủ Đề Cuộc Thi</h2>
                    <p class="RA-container-contest-info-description">
                    Thực trạng mùa dịch, những nỗ lực của người dân, các cấp chính quyền, các bộ ngành, các tổ chức xã hội, các doanh nghiệp … trong hoạt động phòng, chống dịch COVID-19 và cùng nhau vượt qua những khó khăn trong đời sống do dịch bệnh gây ra.
                    <br>Phẩm chất kiên cường Việt Nam thông qua các bức ảnh, thái độ người Việt Nam vượt qua đại dịch.
                    </p>
                </div>
            </div>
            <div class="col-6 col-lg-6 row RA-container-contest-info-element">
                <div class="col-1 col-lg-1 RA-container-contest-info-icon"><i class="fas fa-camera"></i></div>
                <div class="col-11 col-lg-11 RA-container-contest-info-area">
                    <h2 class="RA-container-contest-info-heading">Ảnh Dự Thi Hợp Lệ</h2>
                    <p class="RA-container-contest-info-description">
                    Ảnh dự thi phải phù hợp và đúng theo chủ đề của cuộc thi.<br>
                    Ảnh được chụp tại Việt Nam từ ngày 23/01/2020 tới ngày 30/09/2020.<br>
                    Ảnh có độ phân giải full HD (1920 x 1080) trở lên đối với ảnh tham gia hạng mục Ảnh chụp bằng điện thoại.<br>
                    Và ảnh có độ phân giải trên 3.000 pixels đối với ảnh tham gia hạng mục Ảnh chụp bằng máy ảnh chuyên nghiệp.<br>
                    Ảnh phải kèm theo thông tin về tác giả, nội dung bức ảnh, thời gian và địa điểm chụp. Khuyến khích các bức ảnh gửi kèm bối cảnh và lời bình.<br>
                    Ảnh dự thi phải là tác phẩm của người đăng ký dự thi, không bị tranh chấp tác quyền, quyền nhân thân, quyền riêng tư và quyền sở hữu trí tuệ với bất kỳ ai.<br>
                    Ảnh dự thi có hình ảnh của người khác thì phải có sự đồng ý của nhân vật trước khi dự thi.<br>
                    Mỗi thí sinh có thể nộp một hoặc nhiều ảnh, tối đa 5 ảnh.<br>
                    Ảnh dự thi là ảnh chưa từng đoạt giải bất kỳ cuộc thi ảnh nào.<br>
                    Ảnh dự thi cần ghi rõ tham gia hạng mục ảnh chụp bằng máy ảnh chuyên nghiệp hay ảnh chụp bằng điện thoại.<br>
                    </p>
                </div>
            </div>
            <div class="col-6 col-lg-6 row RA-container-contest-info-element">
                <div class="col-1 col-lg-1 RA-container-contest-info-icon"><i class="fas fa-award"></i></div>
                <div class="col-11 col-lg-11 RA-container-contest-info-area">
                    <h2 class="RA-container-contest-info-heading">Giải Thưởng</h2>
                    <p class="RA-container-contest-info-description">
                    <span class="RA-container-contest-info-description-heading">Hạng mục dành cho ảnh chụp bằng máy ảnh chuyên nghiệp</span><br>
                    Giải Vàng: 01 máy ảnh Canon EOS M6 Mark II (trị giá 28,050,000VND) + 1 điện thoại VSmart Aris + Giấy chứng nhận giải.<br>
                    Giải Bạc: 1 điện thoại VSmart Aris + Giấy chứng nhận giải.<br>
                    Giải Đồng: 1 điện thoại VSmart Live 4 + Giấy chứng nhận giải.<br>
                    <span class="RA-container-contest-info-description-heading">Hạng mục dành cho ảnh chụp bằng điện thoại</span><br>
                    Giải Vàng: 01 máy ảnh Canon EOS M200 (trị giá 15,950,000VND) + 1 điện thoại VSmart Aris + Giấy chứng nhận giải.<br>
                    Giải Bạc: 1 điện thoại VSmart Aris + Giấy chứng nhận giải.<br>
                    Giải Đồng: 1 điện thoại VSmart Live 4 + Giấy chứng nhận giải.<br>
                    <span class="RA-container-contest-info-description-heading">Giải thưởng truyền cảm hứng:</span> 1 điện thoại VSmart Aris + Giấy chứng nhận giải.<br>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    <div id="SECTION31" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="GROUP37" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX38" class="ladi-element">
                        <div class="ladi-box">
                            <div class="ladi-overlay"></div>
                        </div>
                    </div>
                    <div id="HEADLINE39" class="ladi-element">
                        <h3 class="ladi-headline ladi-transition">Ban giám khảo</h3>
                    </div>
                    <div id="LINE40" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="BOX220" class="ladi-element">
                <div class="ladi-box"></div>
            </div>

            <div id="CAROUSEL_RA_BGK" class="RA_Section_BanGiamKhao RA-element">
                <div class="container owl-carousel owl-theme owl-loaded owl-drag bgk-carousel RA-bgk-carousel">
                    <div class="owl-stage-outer RA-bgk-carousel-content">
                        <div class="owl-stage"
                            style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">
                            <?php
                            foreach ($resultBanGiamKhao as $key => $value) { ?>
                            <div class="owl-item RA-BGK-<?=$value['id']?> active" style="">
                                <img class="item" style="" src="<?=wp_get_attachment_url((int)$value['id']);?>">
                                <div class="RA-BGK-description-<?=$value['id']?>">
                                    <p class="RA-BGK-title"><?=$value['title']?></p>
                                    <span class="RA-BGK-caption"><?=$value['caption']?></span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    foreach ($resultBanGiamKhao as $key => $value) { ?>
        <style>
            .RA-BGK-<?=$value['id']?>:hover .RA-BGK-description-<?=$value['id']?>{
                display:block !important;
            }
        </style>
    <?php } ?>

    <?php $layout_ntt =  get_field('layout_nha_tai_tro'); ?>
    <?php if ( $layout_ntt == 'Carousel' ){ ?>
        <div class="RA_Section_Nhataitro">
            <div id="SECTION842" class="ladi-section">
                <div class="ladi-container">
                    <div id="HEADLINE860" class="ladi-element"></div>
                    <div id="HEADLINE844" class="ladi-element">
                        <h3 class="ladi-headline">Nhà tài trợ</h3>
                    </div>
                    <div id="LINE845" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container owl-carousel owl-theme owl-loaded owl-drag owl-same">
                <div class="owl-stage-outer">
                    <div class="owl-stage"
                        style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">
                        <?php foreach ($resultNhaTaiTro as $key => $value) { ?>
                        <div class="owl-item active" style="">
                            <img class="item" style="margin: 5px auto !important;"
                                src="<?=wp_get_attachment_url((int)$value);?>">
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
   <?php } else { ?>
        <div class="RA_Section_Nhataitro">
            <div id="SECTION842" class="ladi-section">
                <div class="ladi-container">
                    <div id="HEADLINE860" class="ladi-element"></div>
                    <div id="HEADLINE844" class="ladi-element">
                        <h3 class="ladi-headline">Nhà tài trợ</h3>
                    </div>
                    <div id="LINE845" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <style>
    .RA_Section_Nhataitro_Gallery{
        max-width: 1300px;
        margin: auto;
    }
    .RA-col-nha-tai-tro {
        -ms-flex: 0 0 <?=100/(int)get_field('col_nha_tai_tro');?>%;
        flex: 0 0 <?=100/(int)get_field('col_nha_tai_tro');?>%;
        max-width: <?=100/(int)get_field('col_nha_tai_tro');?>%;
        padding: <?=get_field('col_space_nha_tai_tro');?>px <?=get_field('col_space_nha_tai_tro');?>px;
    }
    </style>
    <div class="RA_Section_Nhataitro_Gallery row">
        <?php foreach ($resultNhaTaiTro as $key => $value) { ?>
            <div class="RA-col-nha-tai-tro" style="">
                <img class="RA-col-nha-tai-tro-item" style="margin: 5px auto;"
                    src="<?=wp_get_attachment_url((int)$value);?>">
            </div>
        <?php } ?>
    </div>
   <?php } ?>
  
    <?php $layout_ttbc =  get_field('layout_thongtinbaochi'); ?>
    <?php if ( $layout_ttbc == 'Carousel' ){ ?>
    <div class="RA_Section_Nhataitro RA_Section_Plus_BaoChi">
        <div id="SECTION842" class="ladi-section">
            <div class="ladi-container">
                <div id="HEADLINE860" class="ladi-element"></div>
                <div id="HEADLINE844" class="ladi-element">
                    <h3 class="ladi-headline">Thông tin Báo chí</h3>
                </div>
                <div id="LINE845" class="ladi-element">
                    <div class="ladi-line">
                        <div class="ladi-line-container"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container owl-carousel owl-theme owl-loaded owl-drag owl-same">
            <div class="owl-stage-outer">
                <div class="owl-stage"
                    style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">
                    <?php foreach ($resultThongTinBaoChi as $key => $value) { ?>
                    <div class="owl-item active" style="">
                        <?php if($value['url'] == '' || $value['url'] == '#') {?>
                           
                            <img class="item" style="margin: 5px auto !important;"
                                src="<?=wp_get_attachment_url((int)$value['id']);?>">
                          
                        <?php } else { ?>
                            <a href="<?=$value['url']?>">
                            <img class="item" style="margin: 5px auto !important;"
                                src="<?=wp_get_attachment_url((int)$value['id']);?>">
                            </a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
        <style>
        .RA_Section_Thongtinbaochi_Gallery{
            max-width: 1300px;
            margin: auto;
        }
        .RA-col-thong-tin-bao-chi {
            -ms-flex: 0 0 <?=100/(int)get_field('col_thong_tin_bao_chi');?>%;
            flex: 0 0 <?=100/(int)get_field('col_thong_tin_bao_chi');?>%;
            max-width: <?=100/(int)get_field('col_thong_tin_bao_chi');?>%;
            padding: <?=get_field('col_space_thong_tin_bao_chi');?>px <?=get_field('col_space_thong_tin_bao_chi');?>px;
        }
        </style>
         <div class="RA_Section_Nhataitro RA_Section_Plus_BaoChi">
            <div id="SECTION842" class="ladi-section">
                <div class="ladi-container">
                    <div id="HEADLINE860" class="ladi-element"></div>
                    <div id="HEADLINE844" class="ladi-element">
                        <h3 class="ladi-headline">Thông tin Báo chí</h3>
                    </div>
                    <div id="LINE845" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="RA_Section_Thongtinbaochi_Gallery row">
            <?php foreach ($resultThongTinBaoChi as $key => $value) { ?>
                <div class="RA-col-thong-tin-bao-chi" style="">
                    <?php if($value['url']=='' || $value['url']=='#') {?>
                        
                        <img class="item" style="margin: 5px auto !important;"
                            src="<?=wp_get_attachment_url((int)$value['id']);?>">
                        
                    <?php } else { ?>
                        <a href="<?=$value['url']?>">
                        <img class="item" style="margin: 5px auto !important;"
                            src="<?=wp_get_attachment_url((int)$value['id']);?>">
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <div id="SECTION313" class="ladi-section">
        <style>
        <?php $stt_img=0;

        foreach ($resultCacAnhDuThi as $key=> $value) {
            $src_img=wp_get_attachment_url((int)$value->post_id);

            ?>#GALLERY1762 .ladi-gallery .ladi-gallery-view-item[data-index="<?=$stt_img?>"] {
                background-image: url("<?=$src_img;?>");
            }

            <?php $stt_img++;
        }

        ?>
        </style>
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="GROUP314" class="ladi-element">
                <div class="ladi-group">
                    <div id="HEADLINE315" class="ladi-element">
                        <h3 class="ladi-headline">Hình ảnh dự thi</h3>
                    </div>
                    <div id="LINE316" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="GALLERY1762" class="ladi-element">
                <div class="ladi-gallery ladi-gallery-bottom">
                    <div class="ladi-gallery-view">
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-left"></div>
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-right"></div>
                        <?php 
                                    $stt_img=0;
                                    foreach ($resultCacAnhDuThi as $key => $value) {
                                    $resultThongTinTacGia = $wpdb->get_results( $queryThongTinTacGia . $value->post_id );
                                ?>
                        <div class="ladi-gallery-view-item <?=$stt_img==0?'selected':''?>" data-index="<?=$stt_img?>">
                            <div class="RA-description-item-contest-area">
                                <h3 class="RA-title-item-contest"><?=$value->post_title;?></h3>
                                <p class="RA-description-item-contest"><?=$value->post_content;?></p>
                                <strong class="RA-item-author"><?=$resultThongTinTacGia[0]->meta_value;?></strong>
                            </div>
                        </div>

                        <?php 
                                $stt_img++;
                                } ?>
                    </div>
                    <div class="ladi-gallery-control">
                        <div class="ladi-gallery-control-box">
                            <?php 
                                    $stt_img=0;
                                    foreach ($resultCacAnhDuThi as $key => $value) {
                                ?>
                            <div class="ladi-gallery-control-item <?=$stt_img==0?'selected':''?>"
                                data-index="<?=$stt_img?>"></div>
                            <?php 
                                $stt_img++;
                                } ?>
                        </div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-left"></div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-right"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION250" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-overlay"></div>
        <div class="ladi-container">
            <div id="HEADLINE465" class="ladi-element">
                <h3 class="ladi-headline">
                    <span style="font-weight: bold; color: <?=get_field('secondary_color')?>;">Quyền sử dụng ảnh:</span> Ban Tổ chức có
                    quyền xuất bản và sử dụng các bức ảnh dự thi cho mục đích quảng bá cuộc thi mà không phải trả bất kỳ
                    khoản chi
                    phí phát sinh nào. Việc lựa chọn ảnh đăng cho mục đích quảng bá của cuộc thi không đồng nghĩa với
                    việc những bức ảnh đó sẽ đoạt giải.
                </h3>
            </div>
            <div id="HEADLINE525" class="ladi-element">
                <h3 class="ladi-headline">
                    Vietnam Public Relations Network (VNPR) là mạng lưới những người làm nghề Quan hệ Công chúng nhằm
                    hướng tới mục tiêu lâu dài là thành lập một tổ chức xã hội nghề nghiệp. Với tổ chức này, ngành quan
                    hệ công chúng
                    sẽ được phát triển mạnh mẽ hơn, được công nhận và tôn vinh như một nghề nghiệp đúng với ý nghĩa của
                    nó, đáp ứng những thay đổi mô hình PR trong giai đoạn mới, góp phần tích cực hơn vào việc phát triển
                    kinh tế và
                    xã hội.
                </h3>
            </div>
            <div id="HEADLINE526" class="ladi-element">
                <h3 class="ladi-headline">VIETNAM PUBLIC RELATIONS NETWORK</h3>
            </div>
            <div id="GROUP760" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX744" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="HEADLINE403" class="ladi-element">
                        <h3 class="ladi-headline">Nộp bài dự thi</h3>
                    </div>
                    <a href="<?=get_field('url_contest')?>" id="BUTTON738" class="ladi-element">
                        <div class="ladi-button ladi-transition">
                            <div class="ladi-button-background"></div>
                            <div id="BUTTON_TEXT738" class="ladi-element">
                                <p class="ladi-headline">Tham Gia Ngay</p>
                            </div>
                        </div>
                    </a>
                    <!-- <div id="HEADLINE759" class="ladi-element">
                        <h3 class="ladi-headline">(Tiêu đề email: Bài dự thi_Tên tác giả_Cuộc thi ảnh “Kiên cường Việt
                            Nam - Resilient Vietnam”)</h3>
                    </div> -->
                </div>
            </div>
            <div id="IMAGE401" class="ladi-element">
                <div class="ladi-image">
                    <div class="ladi-image-background"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="SECTION_POPUP" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="POPUP334" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX527" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE411" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="GROUP1200" class="ladi-element">
                        <div class="ladi-group">
                            <div id="HEADLINE412" class="ladi-element">
                                <h3 class="ladi-headline">Tác giả: Phiphivinh</h3>
                            </div>
                            <div id="HEADLINE413" class="ladi-element">
                                <h3 class="ladi-headline">Tên tác phẩm</h3>
                            </div>
                            <div id="LINE414" class="ladi-element">
                                <div class="ladi-line">
                                    <div class="ladi-line-container"></div>
                                </div>
                            </div>
                            <div id="HEADLINE415" class="ladi-element">
                                <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP532" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX530" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE529" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 0.5)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP626" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX531" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE528" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP640" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX641" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE642" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE643" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: Phiphivinh</h3>
                    </div>
                    <div id="HEADLINE644" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE645" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE646" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP647" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX648" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE649" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP650" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX651" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE652" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP653" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX654" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE655" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE656" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: Phiphivinh</h3>
                    </div>
                    <div id="HEADLINE657" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE658" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE659" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP660" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX661" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE662" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP663" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX664" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE665" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP666" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX667" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE668" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE669" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: Phiphivinh</h3>
                    </div>
                    <div id="HEADLINE670" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE671" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE672" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP673" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX674" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE675" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP676" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX677" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE678" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP679" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX680" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE681" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE682" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: Phiphivinh</h3>
                    </div>
                    <div id="HEADLINE683" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE684" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE685" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP686" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX687" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE688" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP689" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX690" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE691" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP692" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX693" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE694" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE695" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE696" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE697" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE698" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP699" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX700" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE701" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP702" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX703" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE704" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div id="POPUP749" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="GROUP762" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX752" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="HEADLINE761" class="ladi-element">
                                <h3 class="ladi-headline">(Tiêu đề email: Bài dự thi_Tên tác giả_Cuộc thi ảnh “Kiên
                                    cường Việt Nam - Resilient Vietnam”)</h3>
                            </div>
                            <div id="HEADLINE753" class="ladi-element">
                                <h3 class="ladi-headline">Đăng ký dự thi ngay</h3>
                            </div>
                            <a href="mailto:admin@vnpr.vn" id="BUTTON756" class="ladi-element">
                                <div class="ladi-button ladi-transition">
                                    <div class="ladi-button-background"></div>
                                    <div id="BUTTON_TEXT756" class="ladi-element">
                                        <p class="ladi-headline">Gửi qua Email</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div id="IMAGE758" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div id="POPUP763" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX764" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE765" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE766" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE767" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE768" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE769" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP770" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX771" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE772" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP773" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX774" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE775" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP776" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX777" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE778" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE779" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE780" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE781" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE782" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP783" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX784" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE785" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP786" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX787" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE788" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP789" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX790" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE791" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE792" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE793" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE794" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE795" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP796" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX797" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE798" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP799" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX800" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE801" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP802" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX803" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE804" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE805" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE806" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE807" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE808" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP809" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX810" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE811" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP812" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX813" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE814" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP815" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX816" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE817" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE818" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE819" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE820" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE821" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP822" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX823" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE824" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP825" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX826" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE827" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP828" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX829" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="GROUP1305" class="ladi-element">
                        <div class="ladi-group">
                            <div id="IMAGE841" class="ladi-element">
                                <div class="ladi-image">
                                    <div class="ladi-image-background"></div>
                                </div>
                            </div>
                            <div id="IMAGE830" class="ladi-element">
                                <div class="ladi-image">
                                    <div class="ladi-image-background"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="HEADLINE831" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE832" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE833" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE834" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP835" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX836" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE837" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP838" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX839" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE840" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP892" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX893" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE894" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE895" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE896" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE897" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE898" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP899" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX900" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE901" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP902" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX903" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE904" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP905" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX906" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE907" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE908" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE909" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE910" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE911" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP912" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX913" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE914" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP915" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX916" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE917" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP918" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX919" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE920" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE921" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE922" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE923" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE924" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP925" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX926" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE927" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP928" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX929" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE930" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP931" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX932" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE933" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE934" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE935" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE936" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE937" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP938" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX939" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE940" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP941" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX942" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE943" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP944" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX945" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE946" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE947" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE948" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE949" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE950" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP951" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX952" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE953" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="GROUP954" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX955" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE956" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP957" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="BOX958" class="ladi-element">
                        <div class="ladi-box"></div>
                    </div>
                    <div id="IMAGE959" class="ladi-element">
                        <div class="ladi-image">
                            <div class="ladi-image-background"></div>
                        </div>
                    </div>
                    <div id="HEADLINE960" class="ladi-element">
                        <h3 class="ladi-headline">Tác giả: VNPR</h3>
                    </div>
                    <div id="HEADLINE961" class="ladi-element">
                        <h3 class="ladi-headline">Tên tác phẩm</h3>
                    </div>
                    <div id="LINE962" class="ladi-element">
                        <div class="ladi-line">
                            <div class="ladi-line-container"></div>
                        </div>
                    </div>
                    <div id="HEADLINE963" class="ladi-element">
                        <h3 class="ladi-headline">Nội dung tác phẩm</h3>
                    </div>
                    <div data-action="true" id="GROUP964" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX965" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE966" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP967" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX968" class="ladi-element">
                                <div class="ladi-box"></div>
                            </div>
                            <div id="SHAPE969" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100" xml:space="preserve"
                                        preserveAspectRatio="none" width="100%" height="100%" class=""
                                        fill="rgba(255, 255, 255, 1.0)">
                                        <g>
                                            <path
                                                d="M69.43,54.255c-1.167,1.167-3.076,1.167-4.242,0L28.437,17.507c-1.167-1.167-1.167-3.076,0-4.242l2.134-2.135   c1.167-1.167,3.076-1.167,4.243,0l36.751,36.748c1.166,1.167,1.167,3.075,0,4.242L69.43,54.255z">
                                            </path>
                                        </g>
                                        <g>
                                            <path
                                                d="M28.438,86.735c-1.167-1.167-1.167-3.076,0-4.242l36.748-36.75c1.167-1.167,3.076-1.167,4.242,0l2.135,2.135   c1.166,1.167,1.167,3.076,0,4.242L34.814,88.87c-1.167,1.166-3.076,1.167-4.242,0L28.438,86.735z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="backdrop-popup" class="backdrop-popup"></div>
<div id="lightbox-screen" class="lightbox-screen"></div>

<?php if($check){?>
<style>
footer {
    margin-top: 0 !important;
}
</style>
<?php } ?>
<!-- 287 id cate -->
<?php } //else if($chiendich_child_id==288) {?>
    <?php 
    // global $hardcode_options;
    // $hardcode_options['header_layout_select'] = 'header-style-4';
    // $hardcode_options['default_footer_style'] = 'footer-style-1';
    // $hardcode_options['footer_gap'] = 'off';

    // $id_contest = get_field('id_contest_2');
    
    // $queryThongTinChienDich = 'SELECT * FROM wp_photo_contest_list WHERE wp_photo_contest_list.id = ' . $id_contest;
    // $resultThongTinChienDich = $wpdb->get_results( $queryThongTinChienDich );
    // $contest_name_RA            =   $resultThongTinChienDich[0]->contest_name;
    // $contest_start_RA           =   date("Y/m/d",strtotime($resultThongTinChienDich[0]->contest_start)); echo $contest_start_RA;
    // $contest_end_RA             =   date("Y/m/d",strtotime($resultThongTinChienDich[0]->contest_end));
    // $contest_vote_start_RA      =   date("Y/m/d",strtotime($resultThongTinChienDich[0]->contest_vote_start));
    // $contest_register_end_RA    =   date("Y/m/d",strtotime($resultThongTinChienDich[0]->contest_register_end));
    // $now_RA                     =   date("Y/m/d");
    // if( $now_RA < $contest_start_RA ){
    //     $section_banner = '[eventchamp_event_counter_slider detail-button-status="true" ticket-button-status="true" style="style-1" separator="False" opacity="true" opacity-value="0.4" slider-column="1" slider-space="0" autoplay="true" loopstatus="true" slider-centered-slides="false" slider-direction="horizontal" slider-effect="fade" slider-free-mode="false" navbuttons="false" navigation-style="style-1" dots="false" titleone="Chiến Dịch" titletwo="" bgtext="" addressdate="Chiến dịch chưa diễn ra" excerpt="" detaillink="url:%23About|title:Chi%20ti%E1%BA%BFt" detaillinkicon="" ticketlink="url:%23Tickets|title:%C4%90%C4%83ng%20k%C3%BD" ticketlinkicon="" eventdate="'.$contest_start_RA.'" datebgtext="" day-text="" hour-text="" minute-text="" second-text="" bgimages="4566" separator-color="#ffffff" sliderheight="" opacity-color="" slider-autoplay-delay="" slider-slide-speed="" detail-button-svg-icon="" ticket-button-svg-icon=""]';
    // }else if( $now_RA >= $contest_start_RA && $now_RA < $contest_vote_start_RA ){
    //     $section_banner = '[eventchamp_event_counter_slider detail-button-status="true" ticket-button-status="true" style="style-1" separator="False" opacity="true" opacity-value="0.4" slider-column="1" slider-space="0" autoplay="true" loopstatus="true" slider-centered-slides="false" slider-direction="horizontal" slider-effect="fade" slider-free-mode="false" navbuttons="false" navigation-style="style-1" dots="false" titleone="Chiến Dịch" titletwo="'.$contest_name_RA.'" bgtext="" addressdate="Chiến dịch đang diễn ra và chưa mở vote" excerpt="" detaillink="url:%23About|title:Chi%20ti%E1%BA%BFt" detaillinkicon="" ticketlink="url:%23Tickets|title:%C4%90%C4%83ng%20k%C3%BD" ticketlinkicon="" eventdate="'.$contest_vote_start_RA.'" datebgtext="" day-text="" hour-text="" minute-text="" second-text="" bgimages="4566" separator-color="#ffffff" sliderheight="" opacity-color="" slider-autoplay-delay="" slider-slide-speed="" detail-button-svg-icon="" ticket-button-svg-icon=""]';
    // }else if ( $now_RA >= $contest_vote_start_RA && $now_RA < $contest_end_RA ){
    //     $section_banner = '[eventchamp_event_counter_slider detail-button-status="true" ticket-button-status="true" style="style-1" separator="False" opacity="true" opacity-value="0.4" slider-column="1" slider-space="0" autoplay="true" loopstatus="true" slider-centered-slides="false" slider-direction="horizontal" slider-effect="fade" slider-free-mode="false" navbuttons="false" navigation-style="style-1" dots="false" titleone="Chiến Dịch" titletwo="'.$contest_name_RA.'" bgtext="" addressdate="Chiến dịch đang diễn ra và đang mở vote" excerpt="" detaillink="url:%23About|title:Chi%20ti%E1%BA%BFt" detaillinkicon="" ticketlink="url:%23Tickets|title:%C4%90%C4%83ng%20k%C3%BD" ticketlinkicon="" eventdate="'.$contest_end_RA.'" datebgtext="" day-text="" hour-text="" minute-text="" second-text="" bgimages="4566" separator-color="#ffffff" sliderheight="" opacity-color="" slider-autoplay-delay="" slider-slide-speed="" detail-button-svg-icon="" ticket-button-svg-icon=""]';
    // }else{
    //     $section_banner = '[eventchamp_event_counter_slider detail-button-status="true" ticket-button-status="true" style="style-1" separator="False" opacity="true" opacity-value="0.4" slider-column="1" slider-space="0" autoplay="true" loopstatus="true" slider-centered-slides="false" slider-direction="horizontal" slider-effect="fade" slider-free-mode="false" navbuttons="false" navigation-style="style-1" dots="false" titleone="Chiến Dịch" titletwo="'.$contest_name_RA.'" bgtext="" addressdate="Chiến dịch đã kết thúc" excerpt="" detaillink="" detaillinkicon="" ticketlink="" ticketlinkicon="" eventdate="'.$contest_end_RA.'" datebgtext="" day-text="" hour-text="" minute-text="" second-text="" bgimages="4566" separator-color="#ffffff" sliderheight="" opacity-color="" slider-autoplay-delay="" slider-slide-speed="" detail-button-svg-icon="" ticket-button-svg-icon=""]';
    // }

    // echo do_shortcode($section_banner);
    ?>

    
<?php //} ?>
<!-- layout 2 RA -->
<?php }?>

<?php } ?>

<?php } ?>

<?php echo eventchamp_sub_content_after(); ?>

<?php get_footer();?>
<script id="script_lazyload" type="text/javascript">
(function() {
    var list_element_lazyload = document.querySelectorAll(
        ".ladi-section-background, .ladi-image-background, .ladi-button-background, .ladi-headline, .ladi-video-background, .ladi-countdown-background, .ladi-box, .ladi-frame-background, .ladi-banner, .ladi-form-item-background, .ladi-gallery-view-item, .ladi-gallery-control-item, .ladi-spin-lucky-screen, .ladi-spin-lucky-start, .ladi-list-paragraph ul li"
    );
    var style_lazyload = document.getElementById("style_lazyload");
    for (var i = 0; i < list_element_lazyload.length; i++) {
        var rect = list_element_lazyload[i].getBoundingClientRect();
        if (rect.x == "undefined" || rect.x == undefined || rect.y == "undefined" || rect.y == undefined) {
            rect.x = rect.left;
            rect.y = rect.top;
        }
        var offset_top = rect.y + window.scrollY;
        if (offset_top >= window.scrollY + window.innerHeight || window.scrollY >= offset_top +
            list_element_lazyload[i].offsetHeight) {
            list_element_lazyload[i].classList.add("ladi-lazyload");
        }
    }
    style_lazyload.parentElement.removeChild(style_lazyload);
    var currentScrollY = window.scrollY;
    var stopLazyload = function(event) {
        if (event.type == "scroll" && window.scrollY == currentScrollY) {
            currentScrollY = -1;
            return;
        }
        window.removeEventListener("scroll", stopLazyload);
        list_element_lazyload = document.getElementsByClassName("ladi-lazyload");
        while (list_element_lazyload.length > 0) {
            list_element_lazyload[0].classList.remove("ladi-lazyload");
        }
    };
    window.addEventListener("scroll", stopLazyload);
})();
</script>
<!--[if lt IE 9]>
            <script src="https://w.ladicdn.com/v2/source/html5shiv.min.js?v=1602061636293"></script>
            <script src="https://w.ladicdn.com/v2/source/respond.min.js?v=1602061636293"></script>
        <![endif]-->
<link href="https://fonts.googleapis.com/css?family=Muli:bold,regular|Oswald:bold,regular&display=swap" rel="stylesheet"
    type="text/css" />
<link href="https://w.ladicdn.com/v2/source/ladipage.min.css?v=1602061636293" rel="stylesheet" type="text/css" />
<script src="https://w.ladicdn.com/v2/source/ladipage.min.js?v=1602061636293" type="text/javascript"></script>
<script id="script_event_data" type="text/javascript">
(function() {
    var run = function() {
        if (typeof window.LadiPageScript == "undefined" || window.LadiPageScript == undefined || typeof window
            .ladi == "undefined" || window.ladi == undefined) {
            setTimeout(run, 100);
            return;
        }
        window.LadiPageApp = window.LadiPageApp || new window.LadiPageAppV2();
        window.LadiPageScript.runtime.ladipage_id = "5f3f1f0cdded2c4d133b4908";
        window.LadiPageScript.runtime.publish_platform = "LADIPAGEDNS";
        window.LadiPageScript.runtime.isMobileOnly = false;
        window.LadiPageScript.runtime.DOMAIN_SET_COOKIE = ["vnpr.vn"];
        window.LadiPageScript.runtime.DOMAIN_FREE = [];
        window.LadiPageScript.runtime.bodyFontSize = 12;
        window.LadiPageScript.runtime.store_id = "5c7362c6c417ab07e5196b05";
        window.LadiPageScript.runtime.time_zone = 7;
        window.LadiPageScript.runtime.currency = "VND";
        window.LadiPageScript.runtime.eventData =
            "%7B%22SECTION_POPUP%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22SECTION3%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22image%22%2C%22mobile.option.background-style%22%3A%22image%22%7D%2C%22HEADLINE11%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION87%22%2C%22SECTION107%22%2C%22SECTION152%22%5D%2C%22show_ids%22%3A%5B%22SECTION30%22%5D%7D%7D%2C%22SECTION30%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.style.animation-name%22%3A%22fadeIn%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeIn%22%2C%22mobile.style.animation-delay%22%3A%220s%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22SECTION31%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22GROUP37%22%3A%7B%22type%22%3A%22group%22%2C%22desktop.style.animation-name%22%3A%22fadeInRight%22%2C%22desktop.style.animation-delay%22%3A%220s%22%7D%2C%22SECTION41%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22IMAGE42%22%3A%7B%22type%22%3A%22image%22%2C%22desktop.style.animation-name%22%3A%22fadeInUp%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeInUp%22%2C%22mobile.style.animation-delay%22%3A%220s%22%7D%2C%22IMAGE43%22%3A%7B%22type%22%3A%22image%22%2C%22desktop.style.animation-name%22%3A%22fadeInUp%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeInUp%22%2C%22mobile.style.animation-delay%22%3A%220s%22%7D%2C%22BUTTON50%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP749%22%7D%7D%2C%22HEADLINE60%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION30%22%2C%22SECTION107%22%2C%22SECTION152%22%5D%2C%22show_ids%22%3A%5B%22SECTION87%22%5D%7D%7D%2C%22HEADLINE64%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION87%22%2C%22SECTION30%22%2C%22SECTION152%22%5D%2C%22show_ids%22%3A%5B%22SECTION107%22%5D%7D%7D%2C%22HEADLINE68%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION87%22%2C%22SECTION107%22%2C%22SECTION30%22%5D%2C%22show_ids%22%3A%5B%22SECTION152%22%5D%7D%7D%2C%22HEADLINE73%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22vnpr.vn%2Fkiencuongvietnam%22%7D%7D%2C%22SECTION87%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.style.animation-name%22%3A%22fadeIn%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeIn%22%2C%22mobile.style.animation-delay%22%3A%220s%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22SECTION107%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.style.animation-name%22%3A%22fadeIn%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeIn%22%2C%22mobile.style.animation-delay%22%3A%220s%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22SHAPE116%22%3A%7B%22type%22%3A%22shape%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION30%22%5D%7D%7D%2C%22SHAPE117%22%3A%7B%22type%22%3A%22shape%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION87%22%5D%7D%7D%2C%22SHAPE150%22%3A%7B%22type%22%3A%22shape%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION107%22%5D%7D%7D%2C%22SHAPE181%22%3A%7B%22type%22%3A%22shape%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION152%22%5D%7D%7D%2C%22SECTION152%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.style.animation-name%22%3A%22fadeIn%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeIn%22%2C%22mobile.style.animation-delay%22%3A%220s%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22HEADLINE184%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION87%22%2C%22SECTION107%22%2C%22SECTION152%22%5D%2C%22show_ids%22%3A%5B%22SECTION30%22%5D%7D%7D%2C%22HEADLINE188%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION30%22%2C%22SECTION107%22%2C%22SECTION152%22%5D%2C%22show_ids%22%3A%5B%22SECTION87%22%5D%7D%7D%2C%22HEADLINE192%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION87%22%2C%22SECTION107%22%2C%22SECTION30%22%5D%2C%22show_ids%22%3A%5B%22SECTION152%22%5D%7D%7D%2C%22HEADLINE197%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION87%22%2C%22SECTION107%22%2C%22SECTION152%22%5D%2C%22show_ids%22%3A%5B%22SECTION30%22%5D%7D%7D%2C%22HEADLINE201%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION30%22%2C%22SECTION107%22%2C%22SECTION152%22%5D%2C%22show_ids%22%3A%5B%22SECTION87%22%5D%7D%7D%2C%22HEADLINE205%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22hidden_show%22%2C%22hidden_ids%22%3A%5B%22SECTION87%22%2C%22SECTION30%22%2C%22SECTION152%22%5D%2C%22show_ids%22%3A%5B%22SECTION107%22%5D%7D%7D%2C%22SECTION230%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22CAROUSEL231%22%3A%7B%22type%22%3A%22carousel%22%2C%22desktop.option.carousel_setting.autoplay%22%3Atrue%2C%22desktop.option.carousel_setting.autoplay_time%22%3A2%2C%22desktop.option.carousel_crop.width%22%3A%22900px%22%2C%22desktop.option.carousel_crop.width_item%22%3A%22300px%22%2C%22mobile.option.carousel_setting.autoplay%22%3Atrue%2C%22mobile.option.carousel_setting.autoplay_time%22%3A2%2C%22mobile.option.carousel_crop.width%22%3A%22900px%22%2C%22mobile.option.carousel_crop.width_item%22%3A%22300px%22%7D%2C%22SECTION250%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22IMAGE299%22%3A%7B%22type%22%3A%22image%22%2C%22desktop.style.animation-name%22%3A%22fadeIn%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeIn%22%2C%22mobile.style.animation-delay%22%3A%220s%22%7D%2C%22CAROUSEL307%22%3A%7B%22type%22%3A%22carousel%22%2C%22desktop.option.carousel_setting.autoplay%22%3Atrue%2C%22desktop.option.carousel_setting.autoplay_time%22%3A2%2C%22desktop.option.carousel_crop.width%22%3A%222100px%22%2C%22desktop.option.carousel_crop.width_item%22%3A%22300px%22%2C%22mobile.option.carousel_setting.autoplay%22%3Atrue%2C%22mobile.option.carousel_setting.autoplay_time%22%3A2%2C%22mobile.option.carousel_crop.width%22%3A%221330px%22%2C%22mobile.option.carousel_crop.width_item%22%3A%22190px%22%7D%2C%22POPUP334%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22SECTION336%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22GROUP400%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fladipage.vn%2F%22%7D%2C%22desktop.option.sticky%22%3Atrue%2C%22desktop.option.sticky_position%22%3A%22bottom_right%22%2C%22desktop.option.sticky_position_top%22%3A%220px%22%2C%22desktop.option.sticky_position_left%22%3A%220px%22%2C%22desktop.option.sticky_position_bottom%22%3A%220px%22%2C%22desktop.option.sticky_position_right%22%3A%228px%22%2C%22desktop.style.animation-name%22%3A%22fadeInUp%22%2C%22desktop.style.animation-delay%22%3A%221s%22%2C%22mobile.option.sticky%22%3Atrue%2C%22mobile.option.sticky_position%22%3A%22bottom_right%22%2C%22mobile.option.sticky_position_top%22%3A%220px%22%2C%22mobile.option.sticky_position_left%22%3A%220px%22%2C%22mobile.option.sticky_position_bottom%22%3A%220px%22%2C%22mobile.option.sticky_position_right%22%3A%2216px%22%2C%22mobile.style.animation-name%22%3A%22fadeInUp%22%2C%22mobile.style.animation-delay%22%3A%221s%22%7D%2C%22IMAGE401%22%3A%7B%22type%22%3A%22image%22%2C%22desktop.style.animation-name%22%3A%22fadeInUp%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeInUp%22%2C%22mobile.style.animation-delay%22%3A%220s%22%7D%2C%22GROUP416%22%3A%7B%22type%22%3A%22group%22%2C%22mobile.option.auto_scroll%22%3Atrue%2C%22mobile.style.animation-name%22%3A%22bounceInRight%22%2C%22mobile.style.animation-delay%22%3A%220s%22%7D%2C%22SHAPE417%22%3A%7B%22type%22%3A%22shape%22%2C%22desktop.style.animation-name%22%3A%22shake%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22shake%22%2C%22mobile.style.animation-delay%22%3A%220s%22%7D%2C%22HEADLINE506%22%3A%7B%22type%22%3A%22headline%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22email%22%2C%22action%22%3A%22%20admin%40vnpr.vn%22%7D%7D%2C%22GROUP626%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP640%22%7D%7D%2C%22POPUP640%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP647%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP334%22%7D%7D%2C%22GROUP650%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP653%22%7D%7D%2C%22POPUP653%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP660%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP640%22%7D%7D%2C%22GROUP663%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP666%22%7D%7D%2C%22POPUP666%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP673%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP653%22%7D%7D%2C%22GROUP676%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP679%22%7D%7D%2C%22POPUP679%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP686%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP666%22%7D%7D%2C%22GROUP689%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP692%22%7D%7D%2C%22POPUP692%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP699%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP679%22%7D%7D%2C%22GROUP702%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP763%22%7D%7D%2C%22BUTTON738%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22email%22%2C%22action%22%3A%22admin%40vnpr.vn%22%7D%7D%2C%22POPUP749%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(0%2C%200%2C%200%2C%200.5)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(0%2C%200%2C%200%2C%200.5)%3B%22%7D%2C%22BUTTON756%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22email%22%2C%22action%22%3A%22admin%40vnpr.vn%22%7D%7D%2C%22IMAGE758%22%3A%7B%22type%22%3A%22image%22%2C%22desktop.style.animation-name%22%3A%22fadeInUp%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeInUp%22%2C%22mobile.style.animation-delay%22%3A%220s%22%7D%2C%22GROUP762%22%3A%7B%22type%22%3A%22group%22%2C%22desktop.style.animation-name%22%3A%22fadeIn%22%2C%22desktop.style.animation-delay%22%3A%220s%22%2C%22mobile.style.animation-name%22%3A%22fadeIn%22%2C%22mobile.style.animation-delay%22%3A%220s%22%7D%2C%22POPUP763%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP770%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP692%22%7D%7D%2C%22GROUP773%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP776%22%7D%7D%2C%22POPUP776%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP783%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP763%22%7D%7D%2C%22GROUP786%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP789%22%7D%7D%2C%22POPUP789%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP796%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP776%22%7D%7D%2C%22GROUP799%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP802%22%7D%7D%2C%22POPUP802%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP809%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP789%22%7D%7D%2C%22GROUP812%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP815%22%7D%7D%2C%22POPUP815%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP822%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP802%22%7D%7D%2C%22GROUP825%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP828%22%7D%7D%2C%22POPUP828%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP835%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP815%22%7D%7D%2C%22GROUP838%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP892%22%7D%7D%2C%22IMAGE847%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Ftheleader.vn%2Fphat-dong-cuoc-thi-anh-kien-cuong-viet-nam-1598324884392.htm%22%7D%7D%2C%22IMAGE848%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fphunuvietnam.vn%2Fcuoc-thi-anh-lan-toa-tinh-than-viet-nam-kien-cuong-mua-covid-19-20200824152652755.htm%3Fgidzl%3DLl7_8riD015SxFWZKHi25r3iyY9AHWuMI-lpA1j0N4qMxgrw6aLGIXYxhIb9GrGO6UtvUpOqpya7K0i04W%22%7D%7D%2C%22IMAGE849%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fngaynay.vn%2Fvan-hoa%2Fvnpr-phat-dong-cuoc-thi-anh-kien-cuong-viet-nam-resilient-vietnam-179242.html%22%7D%7D%2C%22IMAGE850%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fdoanhnghiepvn.vn%2Ftin-tuc%2Fxa-hoi%2Fvnpr-phat-dong-cuoc-thi-anh-kien-cuong-viet-nam-resilient-vietnam-lan-toa-nhung-hinh-anh-an-tuong-trong-cuoc-chien-chong-covid-19%2F20200824094957784%22%7D%7D%2C%22CAROUSEL846%22%3A%7B%22type%22%3A%22carousel%22%2C%22desktop.option.carousel_setting.autoplay%22%3Atrue%2C%22desktop.option.carousel_setting.autoplay_time%22%3A2%2C%22desktop.option.carousel_crop.width%22%3A%223300px%22%2C%22desktop.option.carousel_crop.width_item%22%3A%22300px%22%2C%22mobile.option.carousel_setting.autoplay%22%3Atrue%2C%22mobile.option.carousel_setting.autoplay_time%22%3A2%2C%22mobile.option.carousel_crop.width%22%3A%222090px%22%2C%22mobile.option.carousel_crop.width_item%22%3A%22190px%22%7D%2C%22SECTION842%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22IMAGE854%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fgiadinhvietnam.com%2Fkien-cuong-viet-nam--cuoc-thi-anh-lan-toa-tinh-than-viet-nam-kien-cuong-chien-thang-covid-19-d160699.html%22%7D%7D%2C%22IMAGE855%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fthethaovanhoa.vn%2Fvan-hoa%2Fphat-dong-cuoc-thi-anh-kien-cuong-viet-nam-resilient-vietnam-n20200825193724963.htm%22%7D%7D%2C%22IMAGE856%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22http%3A%2F%2Fhoinhabaovietnam.vn%2FPhat-dong-cuoc-thi-anh-Kien-cuong-Viet-Nam-Lan-toa-tinh-than-chien-thang-dai-dich_n67504.html%22%7D%7D%2C%22IMAGE857%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fcongluan.vn%2Fphat-dong-cuoc-thi-anh-kien-cuong-viet-nam-lan-toa-tinh-than-chien-thang-dai-dich-post92981.html%22%7D%7D%2C%22POPUP892%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP899%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP828%22%7D%7D%2C%22GROUP902%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP905%22%7D%7D%2C%22POPUP905%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP912%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP892%22%7D%7D%2C%22GROUP915%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP918%22%7D%7D%2C%22POPUP918%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP925%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP905%22%7D%7D%2C%22GROUP928%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP931%22%7D%7D%2C%22POPUP931%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP938%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP918%22%7D%7D%2C%22GROUP941%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP944%22%7D%7D%2C%22POPUP944%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP951%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP931%22%7D%7D%2C%22GROUP954%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP957%22%7D%7D%2C%22POPUP957%22%3A%7B%22type%22%3A%22popup%22%2C%22desktop.option.popup_position%22%3A%22default%22%2C%22desktop.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(1%2C%201%2C%201%2C%200.6)%3B%22%7D%2C%22GROUP964%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP944%22%7D%7D%2C%22GROUP967%22%3A%7B%22type%22%3A%22group%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%7D%7D%2C%22IMAGE1005%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22http%3A%2F%2Fxuctiendoanhnghiep.vn%2Fchuong-trinh%2Fsu-kien%2Fvnpr-phat-dong-cuoc-thi-anh-kien-cuong-viet-nam-resilient-vi.html%22%7D%7D%2C%22IMAGE1006%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22http%3A%2F%2Fcongnghevadoisong.vn%2Fkien-cuong-viet-nam---cuoc-thi-anh-lan-toa-tinh-than-nguoi-viet-d33599.html%22%7D%7D%2C%22SECTION313%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%2C%22GALLERY1762%22%3A%7B%22type%22%3A%22gallery%22%2C%22desktop.option.gallery_control.autoplay%22%3Atrue%2C%22desktop.option.gallery_control.autoplay_time%22%3A3%2C%22mobile.option.gallery_control.autoplay%22%3Atrue%2C%22mobile.option.gallery_control.autoplay_time%22%3A3%7D%2C%22SECTION1776%22%3A%7B%22type%22%3A%22section%22%2C%22desktop.option.background-style%22%3A%22solid%22%2C%22mobile.option.background-style%22%3A%22solid%22%7D%7D";
        window.LadiPageScript.run(true);
        window.LadiPageScript.runEventScroll();
    };
    run();
})();
</script>
<link href="https://fonts.googleapis.com/css?family=Muli:bold,regular|Oswald:bold,regular&display=swap" rel="stylesheet"
    type="text/css">
<link href="https://w.ladicdn.com/v2/source/ladipage.min.css?v=1602061636293" rel="stylesheet" type="text/css">
<style>
@import url("https://use.fontawesome.com/releases/v5.13.0/css/all.css");

#VC-custom-bangk .col-md-4 {
    padding: 0 !important;
}

.gt-page-title-bar .gt-background {}

#VC-custom-bangk #backgroundleft-bgk {
    width: 16.5% !important;
    background: rgba(164, 31, 34, 0.3);
    background: -webkit-linear-gradient(90deg, rgba(164, 31, 34, 0.3), rgba(164, 31, 33, 1));
    background: linear-gradient(90deg, rgba(164, 31, 34, 0.3), rgba(164, 31, 33, 1));
}

#VC-custom-bangk #recipeCarousel {
    width: 47.5% !important;
    height: 400px !important;
}

#VC-custom-bangk #recipeCarousel .carousel-item {
    height: 400px !important;
}

#VC-custom-bangk #backgroundright-bgk {
    width: 36% !important;
    background-size: cover;
    background-attachment: scroll;
    background-origin: content-box;
    background-image: url(https://w.ladicdn.com/s1100x750/5c7362c6c417ab07e5196b05/cv19_261s-20200823132902.jpg);
    background-position: center center;
    background-repeat: repeat;
}

#VC-custom-bangk #backgroundright-bgk #HEADLINE39 {
    width: 100%;
    height: 100%;
    position: relative;
    background: rgba(164, 31, 35, 0.9);
    background: -webkit-linear-gradient(180deg, rgba(164, 31, 35, 0.9), rgba(124, 20, 22, 1.0));
    background: linear-gradient(180deg, rgba(164, 31, 35, 0.9), rgba(124, 20, 22, 1.0));
}

#VC-custom-bangk #backgroundright-bgk #HEADLINE39 .ladi-headline.ladi-transition {
    margin: 8% 5% 0;
    font: inherit;
    position: absolute;
    font-family: "Oswald", sans-serif;
    color: rgb(255, 255, 255);
    font-size: 36px;
    line-height: 1.4;
}

#VC-custom-bangk #backgroundright-bgk #LINE40 {
    margin: 35px 36px 0px;
    position: absolute;
    width: 48px;
}

#VC-custom-bangk #backgroundright-bgk #LINE40>.ladi-line {
    width: 100%;
    position: absolute;
    z-index: 29;
}

#VC-custom-bangk #backgroundright-bgk #LINE40>.ladi-line>.ladi-line-container {
    border-top: 3px solid <?=get_field('secondary_color')?>;
    border-right: 3px solid <?=get_field('secondary_color')?>;
    border-bottom: 3px solid <?=get_field('secondary_color')?>;
    border-left: 0px;
    border-bottom: 0;
    border-right: 0;
    width: 100%;
    height: 100%;
}

#VC-custom-bangk span#custom-kienthuc {
    width: 40px !important;
    height: 40px !important;
    border-radius: 0 !important;
    background-size: 50% 100% !important;
    background-color: rgba(255, 255, 255, 0.2) !important;
    border: none !important;
}

@media (max-width: 768px) {
    .carousel-inner .carousel-item>div {
        display: none;
    }

    .carousel-inner .carousel-item>div:first-child {
        display: block;
    }
}

.carousel-inner .carousel-item.active,
.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
    display: flex;
}

@media (min-width: 768px) {

    .carousel-inner .carousel-item-right.active,
    .carousel-inner .carousel-item-next {
        transform: translateX(33.333%);
    }

    .carousel-inner .carousel-item-left.active,
    .carousel-inner .carousel-item-prev {
        transform: translateX(-33.333%);
    }
}

.carousel-inner .carousel-item-right,
.carousel-inner .carousel-item-left {
    transform: translateX(0);
}

/* css nhà tài trợ */
.banner-ntt {
    display: flex;
    justify-content: center;
    flex-direction: column;
    place-items: center;
}

.banner-ntt h3.banner {
    font-family: "Oswald", sans-serif;
    color: rgb(122, 20, 22);
    font-size: 48px !important;
    text-align: center;
    line-height: 1.6;
    margin: 0;
    font: inherit;
}

.banner-ntt h3.xct {
    color: rgb(132, 132, 132);
    font-size: 14px;
    text-align: center;
    line-height: 1.6;
    margin: 0;
}

.linentt {
    margin-top: 20px;
    width: 73px;
    border-top: 3px solid <?=get_field('secondary_color')?>;
    border-right: 3px solid <?=get_field('secondary_color')?>;
    border-bottom: 3px solid <?=get_field('secondary_color')?>;
    border-left: 0px !important;
    border-bottom: 0 !important;
    border-right: 0 !important;
}

#VC-custom-thongtinbaotri .slick-slide,
#VC-custom-ntt .slick-slide {
    margin: 25px;
    display: flex !important;
    flex-direction: column;
    justify-content: center;
}

#VC-custom-thongtinbaotri .slick-track,
#VC-custom-ntt .slick-track {
    height: 250px;
}

#VC-custom-thongtinbaotri .slick-prev,
#VC-custom-ntt .slick-prev {
    width: 40px !important;
    height: 40px !important;
    z-index: 29;
    left: -5px;
    outline: none !important;
    border: none !important;
}

#VC-custom-thongtinbaotri .slick-prev:before,
#VC-custom-ntt .slick-prev:before {
    content: "\f053";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
}

#VC-custom-thongtinbaotri .slick-next,
#VC-custom-ntt .slick-next {
    width: 40px !important;
    height: 40px !important;
    z-index: 29;
    right: -6px;
    outline: none !important;
    border: none !important;
}

#VC-custom-thongtinbaotri .slick-next:before,
#VC-custom-ntt .slick-next:before {
    content: "\f054";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
}

#VC-custom-thongtinbaotri .slick-prev:hover,
#VC-custom-ntt .slick-prev:hover,
#VC-custom-thongtinbaotri .slick-next:hover,
#VC-custom-ntt .slick-next:hover {
    border-radius: 0 !important;
    background-size: 50% 100% !important;
    background-color: rgba(255, 255, 255, 0.2) !important;
    border: none !important;
}

/* Hình ảnh dự thi*/
#Carouselhinhanhduthi .slick-slide img {
    width: 880px;
}

#recipeCarouselntt .slick-slide img {
    width: 80%;
    height: auto;
}

#Carouselhinhanhduthi .slick-slide {
    text-align: center;
    text-align: -webkit-center;
}

#Carouselhinhanhduthi .slick-prev {
    width: 40px !important;
    height: 40px !important;
    z-index: 29;
    left: 16.5%;
    outline: none !important;
    border: none !important;
}

#Carouselhinhanhduthi .slick-next {
    width: 40px !important;
    height: 40px !important;
    z-index: 29;
    right: 16.5%;
    outline: none !important;
    border: none !important;
}

#Carouselhinhanhduthi .slick-prev:before {
    content: "\f053";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
}

#Carouselhinhanhduthi .slick-next:before {
    content: "\f054";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
}

#Carouselhinhanhduthi .slick-prev:hover,
#Carouselhinhanhduthi .slick-next:hover {
    border-radius: 0 !important;
    background-size: 50% 100% !important;
    background-color: rgba(255, 255, 255, 0.2) !important;
    border: none !important;
}

/* Đăng Ký Tham Gia Ngay*/
#VC-custom-dangky {
    height: 750px;
    padding-left: 0 !important;
    padding-right: 0 !important;
}

#VC-custom-dangky .ladi-section-background {
    background-color: <?=get_field('primary_color')?>;
    position: absolute;
    width: 100%;
    height: inherit;
}

#VC-custom-dangky .ladi-overlay {
    position: absolute;
    width: 100%;
    height: inherit;
    background-size: cover;
    background-attachment: scroll;
    background-origin: content-box;
    background-image: url(https://w.ladicdn.com/s350x1050/5c7362c…/untitled-2-20200822125029.png);
    background-position: center top;
    background-repeat: repeat;
    mix-blend-mode: multiply;
    will-change: transform, opacity;
}

#VC-custom-dangky .ladi-container {
    height: inherit;
    display: flex;
    flex-direction: column;
}

#VC-custom-dangky .ladi-container #HEADLINE465 h3 span {
    font-weight: bold;
    color: <?=get_field('secondary_color')?>;
    font-family: Muli, sans-serif;
}

#VC-custom-dangky .ladi-container #HEADLINE465 h3 {
    position: relative;
    color: rgb(228, 228, 228);
    font-size: 16px;
    font-style: italic;
    text-align: center;
    line-height: 1.6;
    font-weight: 400;
}

#VC-custom-dangky .ladi-container #HEADLINE526 h3 {
    font-family: "Oswald", sans-serif;
    color: <?=get_field('secondary_color')?>;
    font-size: 23px;
    text-align: center;
    line-height: 1.6;
    position: relative;
    font-weight: inherit;
}

#VC-custom-dangky .ladi-container #HEADLINE525 h3 {
    position: relative;
    color: rgb(228, 228, 228);
    font-size: 16px;
    text-align: center;
    line-height: 1.6;
    font-weight: 400;
}

#VC-custom-dangky .ladi-container #GROUP760 {
    margin-top: 183px;
    z-index: 10;
}

#VC-custom-dangky .ladi-container #GROUP760 .ladi-group {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    text-align: -webkit-center;
}

#VC-custom-dangky .ladi-container #GROUP760 .ladi-group #BOX744 {
    position: absolute;
    width: 650px;
    height: inherit;
    background-color: rgb(255, 255, 255);
}

#VC-custom-dangky .ladi-container #GROUP760 .ladi-group #HEADLINE403 .ladi-headline {
    font-family: "Oswald", sans-serif;
    color: <?=get_field('primary_color')?>;
    font-size: 26px;
    text-align: center;
    line-height: 1.6;
    mix-blend-mode: multiply;
}

#VC-custom-dangky .ladi-container #GROUP760 .ladi-group #BUTTON738:hover {
    transform: scale(1.05);
    -webkit-transform: scale(1.05);
}

#VC-custom-dangky .ladi-container #GROUP760 .ladi-group #BUTTON738 {
    mix-blend-mode: multiply;
    width: 20%;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: <?=get_field('primary_color')?>;
    border-color: <?=get_field('secondary_color')?>;
    border-width: 2px;
    color: <?=get_field('secondary_color')?>;
    font-size: 18px;
    font-weight: 500;
    text-align: center;
    line-height: 1.6;
    transition: all 150ms linear 0s;
}

#VC-custom-dangky .ladi-container #GROUP760 .ladi-group #HEADLINE759 {
    width: 50%;
}

#VC-custom-dangky .ladi-container #GROUP760 .ladi-group #HEADLINE759 .ladi-headline {
    mix-blend-mode: multiply;
    color: rgb(132, 132, 132);
    font-size: 15px;
    text-align: center;
    line-height: 1.4;
    font-weight: 400;
    padding: 0 10%;
}

#VC-custom-dangky .ladi-container #IMAGE401 {
    display: flex;
    justify-content: center;
}

#VC-custom-dangky .ladi-container #IMAGE401 .ladi-image {
    width: 650px;
    height: 365px;
    animation-name: fadeInUp;
    -webkit-animation-name: fadeInUp;
    animation-delay: 0s;
    -webkit-animation-delay: 0s;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    animation-iteration-count: 1;
    -webkit-animation-iteration-count: 1;
    z-index: 5;
    position: absolute;
}

#VC-custom-dangky .ladi-container #IMAGE401 .ladi-image .ladi-image-background {
    position: relative;
    background-image: url(https://w.ladicdn.com/s950x700/5c7362c6c417ab07e5196b05/asset-33x-20200821032937.png);
    background-repeat: no-repeat;
    background-position: left top;
    background-size: contain;
    background-attachment: scroll;
    background-origin: content-box;
    margin: 0 auto;
    width: 100%;
    height: 100%;
    pointer-events: none;
    top: -165px;
    left: 20px;
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
jQuery(function($) {
    $(document).ready(function() {
        $('#recipeCarousel').carousel({
            interval: false
        });

        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 3;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });

        $('#recipeCarouselntt').slick({
            slidesToShow: 4,
            slidesToScroll: 1
        });

        $('#Carouselthongtinbaotri').slick({
            slidesToShow: 4,
            slidesToScroll: 1
        });

        $('#Carouselhinhanhduthi').slick({
            speed: 300,
            slidesToShow: 1,
        });

    });
});
</script>
<?php 