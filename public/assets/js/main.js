$(document).ready(function(){
    // по-хорошему нужно положить в resources/js и прогнать через webpack, но лень заворачивать их в планируемый докер-контейнер

    var reloadClients = function() {
        $.ajax({
            url: '/clients',
            dataType: 'json',
            success: function (json) {
                var $tbl = $('#clients tbody');

                // remove previous
                while ($tbl.find('tr').length > 0) {
                    $tbl.find('tr:first').remove();
                }

                // add new
                json.forEach(function(item) {
                    $tbl.append(
                        $('<tr>').append(
                            $('<td>').text(item.id),
                            $('<td>').text(item.full_name),
                            $('<td>').text(item.phone),
                            $('<td>').text(item.created_at),
                        )
                    );
                })
            }
        });
    };

    var reloadOrders = function () {
        $.ajax({
            url: '/orders',
            dataType: 'json',
            success: function (json) {
                var $tbl = $('#orders tbody');

                // remove previous
                while ($tbl.find('tr').length > 0) {
                    $tbl.find('tr:first').remove();
                }

                // add new
                json.forEach(function (item) {
                    $tbl.append(
                        $('<tr>').append(
                            $('<td>').text(item.id),
                            $('<td>').text(item.client_id),
                            $('<td>').text(item.tariff_id),
                            $('<td>').text(item.address),
                            $('<td>').text(item.delivery_date),
                            $('<td>').text(item.created_at),
                        )
                    );
                })
            }
        });
    };

    $(window).on('load', function() {
        reloadClients();
        reloadOrders();
    });
});