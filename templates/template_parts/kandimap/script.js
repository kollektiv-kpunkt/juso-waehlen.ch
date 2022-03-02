function getGemeinden() {
    return jQuery.ajax({
        url: "/wp-json/wp/v2/gemeinde?per_page=100",
        type: "GET"
    })
}


async function setUp() {
    localStorage.setItem("selected_gemeinden", JSON.stringify([]));
    const gemeinden = await getGemeinden()
    var gemeinde_names = {}
    gemeinden.forEach(element => {
        gemeinde_names[element.slug] = element.name
    });
    localStorage.setItem("gemeinde_names", JSON.stringify(gemeinde_names))
}

window.addEventListener("load", setUp());


jQuery(document).on("click", ".gemeinde", function(){
    var selected_gemeinden = JSON.parse(localStorage.getItem("selected_gemeinden"))
    var bfs = jQuery(this).attr("data-bfs")
    var gemeinde_names = JSON.parse(localStorage.getItem("gemeinde_names"))
    var selected_names = ""

    if (selected_gemeinden.includes(bfs)) {
        selected_gemeinden.splice(selected_gemeinden.indexOf(bfs), 1)
        jQuery(this).removeClass("selected")
    } else {
        selected_gemeinden.push(bfs)
        jQuery(this).addClass("selected")
    }

    localStorage.setItem("selected_gemeinden", JSON.stringify(selected_gemeinden))
    
    selected_gemeinden.forEach(element => {
        if (selected_names == "") {
            selected_names = gemeinde_names[element]
        } else {
            selected_names = selected_names + ", " + gemeinde_names[element]
        }
    });
    if (selected_names == "") {
        jQuery("#legend b").html("Keine Gemeinden ausgewählt.")
        jQuery("#selected_gemeinden").html("")
    } else {
        jQuery("#legend b").html("Zeige Kandidierende in:")
        jQuery("#selected_gemeinden").html(" " + selected_names)
    }

    jQuery.ajax({
        url: `/wp-content/themes/jusowaehlen/interfaces/kandi/kandigrid.php?gemeinden=${selected_gemeinden.join(",")}`,
        type: "GET",
        success: function(response, textStatus, jqXHR) {
            jQuery(".kandigrid").removeClass("kandiopen")
            jQuery(".kandigrid").html(response)
        }
    })

})


jQuery(document).on("click", ".kandi-portrait", function(){
    var kandi = jQuery(this).parents().eq(0)
    var infosContainer = kandi.find(".kandi-info-container")
    var infos = kandi.find(".kandi-infos")
    var padding = kandi.find(".kandi-infos-placeholder")
    
    if (kandi.hasClass("open")) {
        kandi.removeClass("open");
        jQuery(".kandigrid").removeClass("kandiopen");
        infosContainer.css("max-height", 0)
        padding.css("padding-bottom", 0)
        return
    }
    jQuery(".kandi.open .kandi-info-container").css("max-height", 0)
    jQuery(".kandi.open .kandi-infos-placeholder").css("padding-bottom", 0)
    jQuery(".kandi.open").removeClass("open")

    kandi.addClass("open");
    jQuery('html, body').animate({
        scrollTop: kandi.offset().top - 20
    });
    jQuery(".kandigrid").addClass("kandiopen");


    infosContainer.css("max-height", infos.outerHeight(true) + "px")
    padding.css("padding-bottom", infos.outerHeight(true) + "px")

})

jQuery(document).on("click", ".kandi-info-close", function(){
    var kandi = jQuery(this).parents().eq(2)
    var infosContainer = kandi.find(".kandi-info-container")
    var infos = kandi.find(".kandi-infos")
    var padding = kandi.find(".kandi-infos-placeholder")
    kandi.removeClass("open");
    jQuery(".kandigrid").removeClass("kandiopen");
    infosContainer.css("max-height", 0)
    padding.css("padding-bottom", 0)
})