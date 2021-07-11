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
 	if (window.pageYOffset > sticky) {
 		navheader.classList.add("sticky");
 	} else {
 		navheader.classList.remove("sticky");
 	}
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

 	/* ---------- CATEGORY: NAVBAR----------- */

 	/*disable scrollbar when showing mainmenu resposive*/ 
 	$('.finebody').click(function(e) {
 		e.preventDefault();
 		$(this).parents().find('body').toggleClass('disablescrollbar');
 	});

 	/* search */
 	$('.button-search').on('click', function(event) {
 		event.stopPropagation();
 		$(this).parents().find('#search-body').addClass('open');
 		$('#search-body input[type="search"]').focus();
 	});
 	$('.search-body').on('click keyup', function(event) {
 		event.stopPropagation();
 		if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
 			$(this).parents().find('#search-body').removeClass('open');
 		}
 	});
 	$('.search-body .close , .wrapper').on('click', function(event) {
 		$(this).parents().find('#search-body').removeClass('open');
 	});

 	/* extra condition for navbar submenu in responsive */
 	$('.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
 		event.preventDefault();
 		event.stopPropagation();
 		$(this).parent().siblings().removeClass('show');
 		$(this).parent().toggleClass('show');
 	});

 	/* ---------- CATEGORY: SLIDER ----------- */

 	/* global slider - hero */
 	$('.hero-slider').slick({
 		dots: true,
 		speed: 1000,
 		arrows: false,
 		autoplay: false,
 		// autoplaySpeed: 3000,
 		infinite: true,
 		appendDots: '.myslider-mjk-dots .container',
 		slidesToShow: 1,
 		slidesToScroll: 1
 	});
 	$('.myslider-mjk-button-prev').click(function() {
 		$('.hero-slider').slick('slickPrev');
 	});
 	$('.myslider-mjk-button-next').click(function() {
 		$('.hero-slider').slick('slickNext');
 	});

 	$('.hero-slider-1').slick({
 		dots: true,
 		speed: 1000,
 		arrows: false,
 		autoplay: false,
 		// autoplaySpeed: 3000,
 		infinite: true,
 		appendDots: '.hs .myslider-mjk-dots .container',
 		slidesToShow: 1,
 		slidesToScroll: 1
 	});
 	$('.myslider-mjk-button-prev').click(function() {
 		$('.hero-slider-1').slick('slickPrev');
 	});
 	$('.myslider-mjk-button-next').click(function() {
 		$('.hero-slider-1').slick('slickNext');
 	});

 	$('.hero-slider-2').slick({
 		dots: true,
 		speed: 1000,
 		arrows: false,
 		autoplay: false,
 		// autoplaySpeed: 3000,
 		infinite: true,
 		appendDots: '.hs-2 .myslider-mjk-dots .container',
 		slidesToShow: 1,
 		slidesToScroll: 1
 	});
 	$('.myslider-mjk-button-prev').click(function() {
 		$('.hero-slider-2').slick('slickPrev');
 	});
 	$('.myslider-mjk-button-next').click(function() {
 		$('.hero-slider-2').slick('slickNext');
 	});

 	$('.hero-slider-3').slick({
 		dots: true,
 		speed: 1000,
 		arrows: false,
 		autoplay: false,
 		// autoplaySpeed: 3000,
 		infinite: true,
 		appendDots: '.hs-3 .myslider-mjk-dots .container',
 		slidesToShow: 1,
 		slidesToScroll: 1
 	});
 	$('.myslider-mjk-button-prev').click(function() {
 		$('.hero-slider-3').slick('slickPrev');
 	});
 	$('.myslider-mjk-button-next').click(function() {
 		$('.hero-slider-3').slick('slickNext');
 	});
 	
 	
 	/* global slider for 1 slider */
 	$('.content1-slider').slick({
 		dots: false,
 		speed: 1000,
 		arrows: false,
 		autoplay: true,
 		autoplaySpeed: 3000,
 		infinite: true,
 		slidesToShow: 1,
 		slidesToScroll: 1
 	});
 	$('.globalslider-mjk-box .myslider-mjk-button-prev').click(function() {
 		$('.content1-slider').slick('slickPrev');
 	});
 	$('.globalslider-mjk-box .myslider-mjk-button-next').click(function() {
 		$('.content1-slider').slick('slickNext');
 	});

 	/* ---------- CATEGORY: FANCYBOX ----------- */

 	$('.fancybox').fancybox({
 		afterLoad : function(instance, current) {
 			var pixelRatio = window.devicePixelRatio || 1;

 			if ( pixelRatio > 1.5 ) {
 				current.width  = current.width  / pixelRatio;
 				current.height = current.height / pixelRatio;
 			}
 		}
 	});

 	$('.fancybox-video').fancybox({
 		afterLoad : function(instance, current) {
 			var pixelRatio = window.devicePixelRatio || 1;

 			if ( pixelRatio > 1.5 ) {
 				current.width  = current.width  / pixelRatio;
 				current.height = current.height / pixelRatio;
 			}
 		}
 	});

 	/* ---------- CATEGORY: BANNER ----------- */

 	/*Set banner image to default image when image src is empty */ 
 	$('.banner-box > figure > img').each(function () {
 		if($(this).attr('src')=="") {
 			$(this).attr('src','./themes/images/global/banner-default.jpg');
 		}
 	});

 	/* ---------- CATEGORY: EQUAL HEIGHT ----------- */

 	/* equal height */
 	$('.eqh').equalHeights();
 	$('.eqh-title').equalHeights();
 	$('.eqh-img').equalHeights();
 	$('.eqh-desc').equalHeights();
 	$('.eqh-h3').equalHeights();
 	$('.eqh-h4').equalHeights();
 	$('.eqh-p').equalHeights();
 	

 	/* ---------- CATEGORY: FILTER ----------- */

 	/* Open menu filter vertical responsive */
 	/* FILTER SIDEBAR PRODUCT */
 	$('.button-fine-filter').on('click', function(e) {
 		e.preventDefault();
 		$(this).parents().find('.filter-vertical-box').toggleClass('open');
 		$(this).parents().find('body').addClass('disablescrollbar');
 		$(this).parents('html').toggleClass('disablescrollbar');
 	});

 	$('.filter-vertical-box .close').on('click', function(e) {
 		e.preventDefault();
 		$(this).parents().find('.filter-vertical-box').removeClass('open');
 		$(this).parents().find('body').removeClass('disablescrollbar');
 		$(this).parents('html').removeClass('disablescrollbar');
 	});

 	/* FILTER SORT PRODUCT */
 	$('.button-fine-filter-sort').on('click', function(e) {
 		e.preventDefault();
 		$(this).parents().find('.filter-horizontal-box').toggleClass('open');
 		$(this).parents().find('body').addClass('disablescrollbar');
 		$(this).parents('html').toggleClass('disablescrollbar');
 	});

 	$('.filter-horizontal-box .close').on('click', function(e) {
 		e.preventDefault();
 		$(this).parents().find('.filter-horizontal-box').removeClass('open');
 		$(this).parents().find('body').removeClass('disablescrollbar');
 		$(this).parents('html').removeClass('disablescrollbar');
 	});

 	/*Show all/less in filter vertical*/
 	$('.list-menu .see-all').on('click',function(e) {
 		e.preventDefault();
 		$(this).closest('.list-menu').toggleClass('open-list');
 	});


 	/* ---------- CATEGORY: JUMP TO ----------- */
 	$(".js-anchor[href^='#']").on('click', function(event) {
 		event.preventDefault();
 		if (this.hash !== "") {
 			var hash = this.hash;
 			$('html,body').animate({scrollTop:$(hash).offset().top - 80}, 500);
 		} 
 	});

 	/* ---------- CATEGORY: DATATABLES ----------- */

 	$("#parentcollapsez" ).on("shown.bs.collapse", function() {
 		$.each($.fn.dataTable.tables(true), function(){
 			$(this).DataTable().columns.adjust().draw();
 		});
 	});

 	/*Datatable fixed*/ 
 	$('#datatable-fixed').DataTable({
 		scrollY:"300px", 
 		scrollX:true,
 		scrollCollapse:true,
 		info:false,
 		autoWidth:false,
 		paging:false,
 		columnDefs: [
 		/*{ width:"200px", targets:"_all"},*/
 		{ orderable: true, className:"reorder", targets:0},
 		{ orderable: false, targets:"_all"}],
 		fixedColumns:   { 
 			leftColumns: 1, 
 			heightMatch: 'none'
 		}
 		/*colReorder:true,
 		responsive:true,
 		colReorder: { 
 			order: [ 4, 3, 2, 1, 0, 5, 6 ]
 		}*/
 	});

 	/*Datatables Setia*/
 	$('#datatable-2').DataTable( {
 		responsive: true,
 		autoWidth: false,
 		ordering: false,
 		searching: true,
 		paging: true,
 		info: true
 		// "dom": '<"wrapper"tlipf>'
 	});

 	/*Kondisi delete objek menggunakan sweet alert */ 

 	$('.js-sa-delete').on('click', function(e) {
 		e.preventDefault();
 		Swal.fire({
 			title: "Are you sure to delete this file?",
 			text: "Once deleted, you will not be able to see this file anymore!",
 			icon: "warning",
 			showCancelButton: true, 			
 			showCloseButton: true,
 			allowOutsideClick: false,
 			customClass: {
 				container: 'swal-container-mjk',
 				popup: 'swal-popup-mjk',
 				header: 'swal-header-mjk',
 				title: 'swal-title-mjk',
 				closeButton: 'swal-close-button-mjk',
 				icon: 'swal-icon-warning-mjk',
 				image: 'swal-image-mjk',
 				content: 'swal-content-mjk',
 				input: 'swal-input-mjk',
 				actions: 'swal-actions-mjk',
 				confirmButton: 'swal-confirm-button-mjk',
 				denyButton: 'swal-confirm-button-mjk',
 				cancelButton: 'swal-cancel-button-mjk',
 				footer: 'swal-footer-mjk'
 			},
 		})
 		.then((result) => {
 			if (result.isConfirmed) {
 				$(this).parents().closest('.card-product-simple-box').parent('li').remove();
 				Swal.fire({
 					title: 'Deleted!',
 					text: 'Your file has been deleted.',
 					icon: 'success',
 					showConfirmButton:false,
 					// timer: 1500,
 					showLoaderOnConfirm: true,
 					customClass: {
 						container: 'swal-container-mjk',
 						popup: 'swal-popup-mjk',
 						header: 'swal-header-mjk',
 						title: 'swal-title-mjk',
 						closeButton: 'swal-close-button-mjk',
 						icon: 'swal-icon-success-mjk',
 						image: 'swal-image-mjk',
 						content: 'swal-content-mjk',
 						input: 'swal-input-mjk',
 						actions: 'swal-actions-mjk',
 						confirmButton: 'swal-confirm-button-mjk',
 						denyButton: 'swal-confirm-button-mjk',
 						cancelButton: 'swal-cancel-button-mjk',
 						footer: 'swal-footer-mjk'
 					},
 				})
 			} else if (result.dismiss) {
 				Swal.fire({
 					title: 'Cancelled!',
 					text: 'Your file is safe.',
 					icon: 'error',
 					showConfirmButton:false,
 					// timer: 1500,
 					customClass: {
 						container: 'swal-container-mjk',
 						popup: 'swal-popup-mjk',
 						header: 'swal-header-mjk',
 						title: 'swal-title-mjk',
 						closeButton: 'swal-close-button-mjk',
 						icon: 'swal-icon-cancel-mjk',
 						image: 'swal-image-mjk',
 						content: 'swal-content-mjk',
 						input: 'swal-input-mjk',
 						actions: 'swal-actions-mjk',
 						confirmButton: 'swal-confirm-button-mjk',
 						denyButton: 'swal-confirm-button-mjk',
 						cancelButton: 'swal-cancel-button-mjk',
 						footer: 'swal-footer-mjk'
 					},
 				})
 			} 
 		});
 	});


 	/*Countdown Timer*/

 	function getTimeRemaining(endtime) {
 		var t = endtime - new Date().getTime();
 		// var t = Date.parse(endtime) - Date.parse(new Date());
 		// if (t<0) { return false; }
 		var seconds = Math.floor((t / 1000) % 60);
 		var minutes = Math.floor((t / 1000 / 60) % 60);
 		var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
 		var days = Math.floor(t / (1000 * 60 * 60 * 24));
 		return {
 			'total': t,
 			'days': days,
 			'hours': hours,
 			'minutes': minutes,
 			'seconds': seconds
 		};
 	}
 	function initializeClock(id, endtime) {
 		var clock = document.getElementById(id);
 		var daysClass = clock.querySelector('.days');
 		var hoursClass = clock.querySelector('.hours');
 		var minutesClass = clock.querySelector('.minutes');
 		var secondsClass = clock.querySelector('.seconds');
 		function updateClock() {
 			var t = getTimeRemaining(endtime);
 			if (t) {
 				daysClass.innerHTML = t.days;
 				hoursClass.innerHTML = ('0' + t.hours).slice(-2);
 				minutesClass.innerHTML = ('0' + t.minutes).slice(-2);
 				secondsClass.innerHTML = ('0' + t.seconds).slice(-2);
 			} else {
 				clearInterval(timeinterval);
 			}
 		}

 		updateClock();
 		var timeinterval = setInterval(updateClock, 1000);
 	}

 	var hasCountdown = document.getElementById('openingCountdown');

 	if($(hasCountdown).length > 0) {
 		var deadline = Date.parse('Aug 30, 2021');
 		initializeClock('openingCountdown', deadline);
 	}else{
 		var deadline = null;
 	}

 	/*Countup number*/

 	var counterParam = $('.counter');

 	$('.counter').counterUp({
 		delay: 10,
 		time: 1000
 	});


 	/* ---------- ANIMATE ON SCROLL ---------- */

 	AOS.init({
 		delay: 150,
 		duration: 1800,
 		mirror: false,
 		once: true
 	}); 


 	/*Filter Fixed*/

 	$('.btn-filter-mobile-box').scrollToFixed({
 		bottom: 0,
 		limit: $('.footer').offset().top
 	});

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