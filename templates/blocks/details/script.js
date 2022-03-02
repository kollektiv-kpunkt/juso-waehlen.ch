jQuery(document).on("click", ".juso-details-read-more", function(){
    var container = jQuery(this).siblings().eq(1)
    var inner = container.find(".juso-details-inner")

    container.addClass("open")
    container.css("max-height", inner.outerHeight(true))

    jQuery(this).remove()
})