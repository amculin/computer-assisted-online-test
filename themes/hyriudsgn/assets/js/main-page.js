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

    /* SIDEBAR MAIN MENU LEFT */
    $('.button-sidebar-mainmenu').on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $(this).parents().find('.sidebar-mainmenu-box').toggleClass('show');
    });

    /* SIDEBAR MAIN MENU RIGHT */
    $('.navbar-toggler').on('click', function(){
        $(this).parents().find('.button-sidebar-mainmenu').removeClass('active');
        $(this).parents().find('.sidebar-mainmenu-box').removeClass('show');
    });

    /* CLOSE SIDEBAR IF CLICK BODY */
    $('.sidebar-mainmenu-bg-overlay , .button-sidebar-mainmenu-close').on('click', function(){
        $(this).parents().find('.sidebar-mainmenu-box').removeClass('show');
        $(this).parents().find('.button-sidebar-mainmenu').removeClass('active');
    });
    
 	/* extra condition for navbar submenu in responsive */
 	$('.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
 		event.preventDefault();
 		event.stopPropagation();
 		$(this).parent().siblings().removeClass('show');
 		$(this).parent().toggleClass('show');
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

 	/* equal height */
 	$('.eqh').equalHeights();
 	
   /* tab */
 	$("#parentcollapsez" ).on("shown.bs.collapse", function() {
 		$.each($.fn.dataTable.tables(true), function(){
 			$(this).DataTable().columns.adjust().draw();
 		});
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