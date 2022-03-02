// var element = document.getElementById('bestellung-container');
// html2pdf(element);

jQuery(document).on("click", ".actionbutton", function(e){
    e.preventDefault()
    var element = document.getElementById('bestellung-container');
    if (jQuery(this).attr("id") == "print") {
        html2pdf(element, {
            filename : element.getAttribute("data-filename"),
            html2canvas : {
                scale: 4
            }
        });
    } else if (jQuery(this).attr("id") == "status") {
        if (jQuery(this).hasClass("done")){
            return;
        }
        jQuery.ajax({
            method : "POST",
            data : {
                uuid : element.getAttribute("data-uuid")
            },
            url: "/wp-content/themes/jusowaehlen/interfaces/bestellungen/status.php",
            success: function(response) {
                if (response == 1){
                    window.location.reload()
                }
            }
        })
    }
})