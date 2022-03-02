function checkStatus(inputfield) {
    if (inputfield.val() < 0) {
        inputfield.val(0)
    }
    if (inputfield.val() == 0){
        jQuery(inputfield).parents().eq(1).removeClass("selected")
    } else {
        jQuery(inputfield).parents().eq(1).addClass("selected")
    }
}

function checkSelection(productsStep) {
    let inputs = jQuery(productsStep).find("input[type='number']")
    let totalSelection = 0;
    inputs.each(function(i,n){
        totalSelection += parseInt(jQuery(n).val(),10); 
    });
    if (totalSelection == 0) {
        var notyf = new Notyf();
        notyf.error({
            message: "Bitte wähle mindestens einen Artikel aus!",
            duration: 10000
        });
        return false;
    } else {
        return true;
    }
}

jQuery(document).on("click", ".product-img", function(){
    let inputfield = jQuery(this).siblings(".picker-group").children().eq(0)
    let product = jQuery(this).parents().eq(0)
    inputfield.val(parseInt(inputfield.val()) + 1);
    product.addClass("selected")
})

jQuery(document).on("change", ".product-picker", function() {
    checkStatus(jQuery(this))   
})

jQuery(document).on("click", ".picker-toggle", function(){
    let inputfield = jQuery(this).siblings(".product-picker")
    if (jQuery(this).hasClass("picker-add")) {
        inputfield.val(parseInt(inputfield.val()) + 1);
        checkStatus(inputfield)
    } else {
        inputfield.val(parseInt(inputfield.val()) - 1);
        checkStatus(inputfield)
    }
})

jQuery(document).on("click", ".product-selection", function(e){
    e.stopPropagation()
})

jQuery(document).on("click", ".step-button", function(){
    var currStep = jQuery(this).parents(".step")
    var nextStep = currStep.siblings().eq(0)
    
    if (jQuery(this).hasClass("product-selection")){
        if (!checkSelection(currStep)) {
            return;
        }
    }
    currStep.removeClass("visible")
    nextStep.addClass("visible")
    nextStep.get(0).scrollIntoView();
})

jQuery(document).on("submit", ".ajax-form", function(e){
    e.preventDefault()
    var ajaxForm = jQuery(this)
    let formData = jQuery(this).serialize()
    jQuery.ajax({
        method: "POST",
        data: formData,
        url: "/wp-content/themes/jusowaehlen/interfaces/" + jQuery(this).attr("data-interface"),
        success: function(response, textStatus, jqXHR) {
            var thankyou = ajaxForm.siblings(".thank-you")
            ajaxForm.css("display", "none")
            thankyou.html(response.message)
            thankyou.css("display", "block")
        }
    })
})