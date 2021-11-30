jQuery(document).on("click", "#nav-menu-button", function(){
    jQuery("html").toggleClass("menuopen")
    if (window.innerWidth > 680) {
        if (jQuery("html").hasClass("menuopen")) {
            var offset = jQuery("#main-nav-inner").height() + jQuery("#main-nav-container").height()
            jQuery("#main-navbar").css("transform", `rotate(-90deg) translateY(-${offset}px)`)
        } else {
            jQuery("#main-navbar").css("transform", `rotate(-90deg) translateY(-100%)`)
        }
    } else {
        if (jQuery("html").hasClass("menuopen")) {
            var offset = jQuery("#main-nav-container").height()
            jQuery("#main-navbar").css("transform", `translateY(-${offset}px)`)
        } else {
            jQuery("#main-navbar").css("transform", `translateY(0)`)
        }
    }
})