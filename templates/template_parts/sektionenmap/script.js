
jQuery(document).on("click", ".sektion", function(){
    jQuery(".sektion.active").removeClass("active")
    jQuery(this).addClass("active")
    jQuery("#sektionenmap-inner").addClass("sektionactive")
    history.replaceState(null,'',`/sektionen/#${jQuery(this).attr("data-sektion")}`)
    var sektion = jQuery(this).attr("data-sektion");

    jQuery(`.section.active`).removeClass("active")
    jQuery(`.section#${sektion}`).addClass("active")
    jQuery('html, body').animate({
        scrollTop: jQuery(`.section#${sektion}`).offset().top - 50
    });

    jQuery(".kandi.open .kandi-info-container").css("max-height", 0)
    jQuery(".kandi.open .kandi-infos-placeholder").css("padding-bottom", 0)
    jQuery(".kandi.open").removeClass("open")
    jQuery(".kandigrid.kandiopen").removeClass("kandiopen")

})


if (window.location.hash) {
    var sektion = window.location.hash.slice(1);
    jQuery(".sektion.active").removeClass("active")
    jQuery(`.sektion[data-sektion="${sektion}"]`).addClass("active")
    jQuery("#sektionenmap-inner").addClass("sektionactive")

    jQuery(`.section.active`).removeClass("active")
    jQuery(`.section#${sektion}`).addClass("active")
    jQuery('html, body').animate({
        scrollTop: jQuery(`.section#${sektion}`).offset().top - 50
    });

    jQuery(".kandi.open .kandi-info-container").css("max-height", 0)
    jQuery(".kandi.open .kandi-infos-placeholder").css("padding-bottom", 0)
    jQuery(".kandi.open").removeClass("open")
    jQuery(".kandigrid.kandiopen").removeClass("kandiopen")
}