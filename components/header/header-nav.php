<?php
/**
 * The template for displaying header nav buttons.
 *
 * @package Cover2
 */

$has_sidebar = false;
if ( is_active_sidebar( 'sidebar-overlay' ) || has_nav_menu( 'top' ) || has_nav_menu( 'jetpack-social-menu' ) ) :
	$has_sidebar = true; ?>
	<button class="nav-toggle menu-toggle" aria-label="<?php echo __( 'Toggle Menu', 'cover2' ); ?>" aria-expanded="false">
		<svg id="svg-icon-menu-icon" class="svg-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" stroke-width="2">
			<g stroke-width="2" transform="translate(0, 0)">
				<g class="nc-interact_menu-close-2-o-32" stroke-width="2">
					<path fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M2 6h28" stroke-linejoin="round" transform="translate(0 0.00) rotate(0.00 16 6)"></path>
					<path data-color="color-2" fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M2 16h28" stroke-linejoin="round" opacity="1"></path>
					<path fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M2 26h28" stroke-linejoin="round" transform="translate(0 0) rotate(0 16 26)"></path>
				</g>
				<script>
					!function(){function t(e){var i=e.parentNode;if("svg"!==i.tagName)i=t(i);return i;}function e(t,e,i,n){return 1&gt;(t/=n/2)?i/2*t*t*t*t+e:-i/2*((t-=2)*t*t*t-2)+e}function i(t){this.element=t,this.topLine=this.element.getElementsByTagName("path")[0],this.centerLine=this.element.getElementsByTagName("path")[1],this.bottomLine=this.element.getElementsByTagName("path")[2],this.time={start:null,total:250},this.status={interacted:!1,animating:!1},this.init()}if(!window.requestAnimationFrame){var n=null;window.requestAnimationFrame=function(t,e){var i=(new Date).getTime();n||(n=i);var a=Math.max(0,16-(i-n)),s=window.setTimeout(function(){t(i+a)},a);return n=i+a,s}}i.prototype.init=function(){var t=this;this.element.addEventListener("click",function(){t.status.animating||(t.status.animating=!0,window.requestAnimationFrame(t.triggerAnimation.bind(t)))})},i.prototype.triggerAnimation=function(t){var e=this.getProgress(t),i=this.status.interacted?this.time.total-e:e;this.animateIcon(i),this.checkProgress(e)},i.prototype.getProgress=function(t){return this.time.start||(this.time.start=t),t-this.time.start},i.prototype.checkProgress=function(t){var e=this;this.time.total&gt;t?window.requestAnimationFrame(e.triggerAnimation.bind(e)):(this.status={interacted:!this.status.interacted,animating:!1},this.time.start=null)},i.prototype.animateIcon=function(t){if(t&gt;this.time.total)(t=this.time.total);if(0&gt;t)(t=0);var i=e(Math.min(t,this.time.total/2),0,10,this.time.total/2).toFixed(2),n=e(Math.max(t-this.time.total/2,0),0,45,this.time.total/2).toFixed(2);this.topLine.setAttribute("transform","translate(0 "+i+") rotate("+n+" 16 6)"),this.bottomLine.setAttribute("transform","translate(0 "+-i+") rotate("+-n+" 16 26)");var a=t&gt;this.time.total/2?0:1;this.centerLine.setAttribute("opacity",a)};var a=document.getElementsByClassName("nc-interact_menu-close-2-o-32");if(a)for(var s=0;a.length&gt;s;s++)new i(t(a[s]))}();
				</script>
			</g>
		</svg>
	</button>
<?php endif;

$search_button_class = '';
if ( $has_sidebar ) :
	$search_button_class = ' has-sidebar';
endif;
?>

<button type="button" class="nav-toggle search-toggle<?php echo $search_button_class; ?>" aria-label="toggle search" aria-expanded="false">
	<svg id="svg-icon-search-icon" class="svg-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" stroke-width="2">
		<g stroke-width="2" transform="translate(0, 0)">
			<g class="nc-interact_search-close-o-32" stroke-width="2">
				<path data-cap="none" data-color="color-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4l24 24" stroke-dasharray="33.94 33.94" stroke-dashoffset="-22.8"></path>
				<path data-cap="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 4L4 28" stroke-dasharray="33.94 33.94" stroke-dashoffset="-33.94" opacity="0"></path>
				<circle cx="13" cy="13" r="10" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
			</g>
			<script>
				!function(){function t(e){var i=e.parentNode;if("svg"!==i.tagName)i=t(i);return i;}function e(t,e,i,n){return 1&gt;(t/=n/2)?i/2*t*t*t*t+e:-i/2*((t-=2)*t*t*t-2)+e}function i(t){this.element=t,this.lens=this.element.getElementsByTagName("circle")[0],this.lineLens=this.element.getElementsByTagName("path")[0],this.line=this.element.getElementsByTagName("path")[1],this.lineLength=this.line.getTotalLength().toFixed(2),this.time={start:null,total:200},this.status={interacted:!1,animating:!1},this.init()}if(!window.requestAnimationFrame){var n=null;window.requestAnimationFrame=function(t,e){var i=(new Date).getTime();n||(n=i);var s=Math.max(0,16-(i-n)),a=window.setTimeout(function(){t(i+s)},s);return n=i+s,a}}i.prototype.init=function(){var t=this;this.element.addEventListener("click",function(){t.status.animating||(t.status.animating=!0,window.requestAnimationFrame(t.triggerAnimation.bind(t)))})},i.prototype.triggerAnimation=function(t){var e=this.getProgress(t),i=this.status.interacted?this.time.total-e:e;this.animateIcon(i),this.checkProgress(e)},i.prototype.getProgress=function(t){return this.time.start||(this.time.start=t),t-this.time.start},i.prototype.checkProgress=function(t){var e=this;this.time.total&gt;t?window.requestAnimationFrame(e.triggerAnimation.bind(e)):(this.status={interacted:!this.status.interacted,animating:!1},this.time.start=null)},i.prototype.animateIcon=function(t){if(t&gt;this.time.total)(t=this.time.total);if(0&gt;t)(t=0);var i=e(Math.min(t,3*this.time.total/4),0,1,3*this.time.total/4).toFixed(2),n=0==t?0:1,s=e(t,-this.lineLength,+this.lineLength,this.time.total).toFixed(2);this.lens.setAttribute("opacity",1-i),this.lineLens.setAttribute("stroke-dashoffset",22.8*(i-1)),this.line.setAttribute("stroke-dashoffset",s),this.line.setAttribute("opacity",n)};var s=document.getElementsByClassName("nc-interact_search-close-o-32");if(s)for(var a=0;s.length&gt;a;a++)new i(t(s[a]))}();
			</script>
		</g>
	</svg>
</button>

<?php if ( cover2_has_ase_chapters( $post ) ) : ?>

<button type="button" class="nav-toggle chapter-toggle" aria-label="toggle chapter list" aria-expanded="false">
	<svg id="svg-icon-bookmark-icon" class="svg-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32">
		<g class="nc-icon-wrapper js-transition-icon" data-effect="scale" data-event="click">
			<g stroke-width="2" transform="translate(0, 0)" class="js-transition-icon__state" style="">
				<polygon points="27 30 16 23 5 30 5 1 27 1 27 30" fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round"></polygon>
			</g>
			<g stroke-width="2" transform="translate(0, 0)" class="js-transition-icon__state" style="display: none;" aria-hidden="true">
				<line fill="none" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="27" y1="5" x2="5" y2="27" stroke-linejoin="round"></line>
				<line fill="none" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="27" y1="27" x2="5" y2="5" stroke-linejoin="round"></line>
			</g>
		</g>
		<script>
			!function(){"use strict";if(!window.requestAnimationFrame){var a=null;window.requestAnimationFrame=function(t,i){var e=(new Date).getTime();a||(a=e);var s=Math.max(0,16-(e-a)),n=window.setTimeout(function(){t(e+s)},s);return a=e+s,n}}function r(t,i,e,s){return 1&gt;(t/=s/2)?e/2*t*t*t*t+i:-e/2*((t-=2)*t*t*t-2)+i}function e(t){return t?[1,0]:[0,1]}function t(t){this.element=t,this.svg=function t(i){var e=i.parentNode;if("svg"!==e.tagName)e=t(e);return e;}(this.element),this.getSize(),this.states=this.element.querySelectorAll(".js-transition-icon__state"),this.time={start:null,total:200},this.status={interacted:!1,animating:!1},this.animation={effect:this.element.getAttribute("data-effect"),event:this.element.getAttribute("data-event")},this.init()}t.prototype.getSize=function(){var t=this.svg.getAttribute("viewBox");this.size=t?{width:t.split(" ")[2],height:t.split(" ")[3]}:this.svg.getBoundingClientRect()},t.prototype.init=function(){var t=this;this.svg.addEventListener(t.animation.event,function(){t.status.animating||(t.status.animating=!0,window.requestAnimationFrame(t.triggerAnimation.bind(t)))})},t.prototype.triggerAnimation=function(t){var i=this.getProgress(t);this.animateIcon(i),this.checkProgress(i)},t.prototype.getProgress=function(t){return this.time.start||(this.time.start=t),t-this.time.start},t.prototype.checkProgress=function(t){if(this.time.total&gt;t)window.requestAnimationFrame(this.triggerAnimation.bind(this));else{this.status={interacted:!this.status.interacted,animating:!1},this.time.start=null;var i=e(this.status.interacted);this.states[i[0]].removeAttribute("aria-hidden"),this.states[i[1]].setAttribute("aria-hidden","true")}},t.prototype.animateIcon=function(t){if(t&gt;this.time.total){t=this.time.total;}if(0&gt;t){t=0;};var i=e(this.status.interacted);this.states[i[0]].style.display=t&gt;this.time.total/2?"none":"block",this.states[i[1]].style.display=t&gt;this.time.total/2?"block":"none","scale"==this.animation.effect?this.scaleIcon(t,i[0],i[1]):this.rotateIcon(t,i[0],i[1])},t.prototype.scaleIcon=function(t,i,e){var s=r(Math.min(t,this.time.total/2),1,-.2,this.time.total/2).toFixed(2),n=r(Math.max(t-this.time.total/2,0),.2,-.2,this.time.total/2).toFixed(2);this.states[i].setAttribute("transform","translate("+this.size.width*(1-s)/2+" "+this.size.height*(1-s)/2+") scale("+s+")"),this.states[e].setAttribute("transform","translate("+this.size.width*n/2+" "+this.size.height*n/2+") scale("+(1-n)+")")},t.prototype.rotateIcon=function(t,i,e){var s=r(t,0,180,this.time.total).toFixed(2);this.states[i].setAttribute("transform","rotate(-"+s+" "+this.size.width/2+" "+this.size.height/2+")"),this.states[e].setAttribute("transform","rotate("+(180-s)+" "+this.size.width/2+" "+this.size.height/2+")")};var i=document.querySelectorAll(".js-transition-icon");if(i)for(var s=0;i.length&gt;s;s++)new t(i[s])}();
		</script>
	</svg>
</button>

<?php endif; ?>

<?php if ( is_search() ) : ?>

<button type="button" class="nav-toggle filter-toggle hide" aria-label="toggle search filter" aria-expanded="false">
	<svg id="svg-icon-filter-icon" class="svg-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32" stroke-width="2">
		<g stroke-width="2" transform="translate(0, 0)">
			<g class="nc-interact_filter-check-o-32" stroke-width="2">
				<path class="nc-check" data-cap="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M29 7L12 24l-9-9" stroke-dasharray="36.77 36.77" stroke-dashoffset="-36.77"></path>
				<path class="nc-line_top" data-cap="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h26" opacity="1" transform="translate(0 0)"></path>
				<path class="nc-line_center" data-cap="none" data-color="color-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16h18" opacity="1" transform="translate(0 0)"></path>
				<path class="nc-line_bottom" data-cap="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 25h10" opacity="1" transform="translate(0 0)"></path>
			</g>
			<script>
				!function(){function t(e){var i=e.parentNode;if("svg"!==i.tagName)i=t(i);return i;}function e(t,e,i,n){return 1&gt;(t/=n/2)?i/2*t*t*t*t+e:-i/2*((t-=2)*t*t*t-2)+e}function i(t){this.element=t,this.topLine=this.element.querySelectorAll(".nc-line_top")[0],this.centerLine=this.element.querySelectorAll(".nc-line_center")[0],this.bottomLine=this.element.querySelectorAll(".nc-line_bottom")[0],this.check=this.element.querySelectorAll(".nc-check")[0],this.checkLength=this.check.getTotalLength().toFixed(2),this.time={start:null,total:300},this.status={interacted:!1,animating:!1},this.init()}if(!window.requestAnimationFrame){var n=null;window.requestAnimationFrame=function(t,e){var i=(new Date).getTime();n||(n=i);var s=Math.max(0,16-(i-n)),a=window.setTimeout(function(){t(i+s)},s);return n=i+s,a}}i.prototype.init=function(){var t=this;this.element.addEventListener("click",function(){t.status.animating||(t.status.animating=!0,window.requestAnimationFrame(t.triggerAnimation.bind(t)))})},i.prototype.triggerAnimation=function(t){var e=this.getProgress(t),i=this.status.interacted?this.time.total-e:e;this.animateIcon(i),this.checkProgress(e)},i.prototype.getProgress=function(t){return this.time.start||(this.time.start=t),t-this.time.start},i.prototype.checkProgress=function(t){var e=this;this.time.total&gt;t?window.requestAnimationFrame(e.triggerAnimation.bind(e)):(this.status={interacted:!this.status.interacted,animating:!1},this.time.start=null)},i.prototype.animateIcon=function(t){if(t&gt;this.time.total)(t=this.time.total);if(0&gt;t)(t=0);var i=e(Math.min(t,.6*this.time.total),0,1,.6*this.time.total),n=e(Math.min(Math.max(t-.2*this.time.total,0),.6*this.time.total),0,1,.6*this.time.total),s=e(Math.max(t-.4*this.time.total,0),0,1,.6*this.time.total);this.bottomLine.setAttribute("opacity",1-i),this.bottomLine.setAttribute("transform","translate("+32*i+" 0)"),this.centerLine.setAttribute("opacity",1-n),this.centerLine.setAttribute("transform","translate("+32*n+" 0)"),this.topLine.setAttribute("opacity",1-s),this.topLine.setAttribute("transform","translate("+32*s+" 0)"),this.check.setAttribute("stroke-dashoffset",e(Math.max(t-.2*this.time.total,0),-this.checkLength,+this.checkLength,.8*this.time.total))};var s=document.getElementsByClassName("nc-interact_filter-check-o-32");if(s)for(var a=0;s.length&gt;a;a++)new i(t(s[a]))}();
			</script>
		</g>
	</svg>
</button>

<?php endif; ?>
