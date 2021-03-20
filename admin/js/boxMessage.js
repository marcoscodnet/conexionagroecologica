function boxSuccess (title) {
    $.smallBox({
        title : title,
        color : "#739E73",
        iconSmall : "fa fa-check",
        timeout : 1400
    });
}

function boxError (title) {
    $.smallBox({
        title : title,
        color : "#C46A69",
        iconSmall : "fa fa-warning"
    });
}