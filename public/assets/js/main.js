$(document).ready(function(){
    // по-хорошему нужно положить в resources/js и прогнать через webpack, но лень заворачивать их в планируемый докер-контейнер

    var reloadClients = function() {
        var $tbl = $('#clients');

        $.ajax({
            url: $tbl.data('url'),
            dataType: 'json',
            success: function (json) {
                var $tbody = $tbl.find('tbody');

                // remove previous
                while ($tbody.find('tr').length > 0) {
                    $tbody.find('tr:first').remove();
                }

                // add new
                json.forEach(function(item) {
                    $tbody.append(
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
        var $tbl = $('#orders');

        $.ajax({
            url: $tbl.data('url'),
            dataType: 'json',
            success: function (json) {
                var $tbody = $tbl.find('tbody');

                // remove previous
                while ($tbody.find('tr').length > 0) {
                    $tbody.find('tr:first').remove();
                }

                // add new
                json.forEach(function (item) {
                    $tbody.append(
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

    $('#order').on('submit', function() {
        event.preventDefault();

        var $this = $(this);

        $.ajax({
            url: $this.attr('action'),
            method: $this.attr('method'),
            data: $this.serialize(),
            success: function (data) {
                // remove previous validation errors
                $.each($this.find('input'), function (index, elem) {
                    var $elem = $(elem);
                    if ($elem.hasClass('is-invalid')) {
                        $elem.removeClass('is-invalid');

                        var $elemErr = $elem.parent().find('div.invalid-feedback');
                        if ($elemErr.length > 0) {
                            $elemErr.remove();
                        }
                    }

                    // set readonly attribute on element
                    $elem.prop('readonly', true);
                });

                // show success message
                $this.find('h3.text-success').removeClass('d-none');

                // hide submit
                $this.find('button[type=submit]').hide();

                // reload data
                reloadClients();
                reloadOrders();
            },
            error: function (err) {
                if (err.responseJSON.errors.length == 0) {
                    console.log(err);
                    alert('wrong answer, see console');

                    return;
                }

                $.each(err.responseJSON.errors, function (field, errors) {
                    $('input[name=' + field + ']').addClass('is-invalid');

                    if ($('input[name=' + field + ']').parent().find('div.invalid-feedback').length == 0) {
                        $('input[name=' + field + ']').after(
                            $('<div>').addClass('invalid-feedback').text(errors)
                        );
                    } else {
                        $('input[name=' + field + ']').parent().find('div.invalid-feedback').text(errors);
                    }
                });
            }
        });
    });

    $(window).on('load', function() {
        reloadClients();
        reloadOrders();
    });
});