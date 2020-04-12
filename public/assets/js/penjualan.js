/* search customer */
function setCustomerName(customerName){
    $("#cari_customer").val(customerName);
}

$(function () {
    $("#cari_customer").autocomplete({
        source: function (request, response) {
            var source_url = urlCustomerSearch;
            $.ajax({
                type: "GET",
                url: source_url,
                data: { q: $("#cari_customer").val() },
                dataType: "json",
                success: function (data) {
                    response(data);
                },
                error: function (data) {
                    alert("Data tidak ditemukan");
                }
            });
        },
        select: function (event, ui) {
            $("#customer_id").val(ui.item.id);
            //$("#cari_customer").val(ui.item.name);
            setCustomerName(ui.item.name);
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li></li>")
            .data("item.autocomplete", item)
            .append("<div style=\"border:1px\">" +
                "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">" +
                    "<tr>" +
                        "<td width=\"75px\">Code</td>" +
                        "<td>: " + item.code + "</td>" +
                    "</tr>" +
                    "<tr>" +
                        "<td>Name</td>" +
                        "<td>: " + item.name + "</td>" +
                    "</tr>" +
                    "<tr height=\"1\">" +
                        "<td style=\"background-color:#999999;\" colspan=\"2\"></td>" +
                    "</tr>" +
                "</table>" +
                "</div>")
            .appendTo(ul);
    }
});
