/*!
* Copyright 2021 hyriudsgn.
*/

 /* ---------- CATEGORY: SCROLL TOP ----------- */
 /* begin.scroll back to top */
 function scrollFunction() {
	if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
		document.getElementById("backtotop").classList.add('active');
	} else {
		document.getElementById("backtotop").classList.remove('active');
	}
}

/* When the user clicks on the button, scroll to the top of the document */
function topFunction() {
	$("html, body").animate({ scrollTop: 0 }, 1200, 'linear');
}
/* end.scroll back to top */

function myheaders() {
	/* if (window.pageYOffset > sticky) {
		navheader.classList.add("sticky");
	} else {
		navheader.classList.remove("sticky");
	} */
}

/* header scroll */
window.onscroll = function() {
	myheaders();
	scrollFunction();
};

window.onresize = function() {
	$('body').removeClass('disablescrollbar');
};

var navheader = document.getElementById("headertop");

var hasNav = document.getElementById('navbar');

if($(hasNav).length > 0) {
	var sticky = navheader.offsetTop;
} else{
	var sticky = null;
}

/* ---------- CATEGORY: DOC READY----------- */
$(document).ready(function() {

	/* ---------- CATEGORY: PRELOADER----------- */

	$(".preload-mjk").fadeOut(1200, function(){ 
		$(this).addClass('loading');
	});

	/*Filter Fixed*/

	/* $('.btn-filter-mobile-box').scrollToFixed({
		bottom: 0,
		limit: $('.footer').offset().top
	}); */

	/*button loading process*/
	
	$('.btn-loading').on('click', function() {
		var button = $(this);
		var dataLoading = $(this).attr('data-loading-text');
		if ($(this).html() !== dataLoading) {
			button.data('original-text', $(this).html());
			button.html(dataLoading);
		}
		setTimeout(function() {
			button.html(button.data('original-text'));
		}, 3000);
	});

});