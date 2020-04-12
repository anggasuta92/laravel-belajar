//Date picker
$('#datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    useCurrent: true
});

$(function () {
    $('.select2').select2()
});

function numberFormat(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

$(".number-format").numeric({ decimal: ".", negative: false, scale: 3 });