$(document).ready(function(){
    // по-хорошему нужно положить в resources/js и прогнать через webpack, но лень заворачивать их в планируемый докер-контейнер

    var reloadClient = function() {
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

    $(window).on('load', function() {
        reloadClient();
    });
});