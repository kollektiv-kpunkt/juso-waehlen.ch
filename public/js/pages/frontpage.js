let i = 1;

setInterval(() => {
    if (i == 4) {
        var newi = 1;
    } else {
        var newi = i + 1;
    }
    jQuery("html").addClass(`ds${newi}`);
    jQuery("html").removeClass(`ds${i}`);

    if (i == 4) {
        i = 1;
    } else {
        i++;
    }
}, 5000);