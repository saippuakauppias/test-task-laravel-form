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
                $.each(json, function(indxe, item) {
                    $tbody.append(
                        $('<tr>').append(
                            $('<td>').text(item.id),
                            $('<td>').text(item.full_name),
                            $('<td>').text(item.phone),
                            $('<td>').text(item.created_at),
                        )
                    );
                });
            }
        });
    };

    var reloadAdv1 = function () {
        var $tbl = $('#adv1');

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
                $.each(json, function (indxe, item) {
                    $tbody.append(
                        $('<tr>').append(
                            $('<td>').text(item.id),
                            $('<td>').text(item.full_name),
                            $('<td>').text(item.count1),
                            $('<td>').text(item.count2),
                        )
                    );
                });
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
                $.each(json, function (index, item) {
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
                });
            }
        });
    };

    var reloadAll = function() {
        reloadClients();
        reloadOrders();
        reloadAdv1();
    };

    $('#order').on('submit', function() {
        event.preventDefault();

        var $this = $(this);

        var removeValidationErrors = function() {
            $.each($this.find('input'), function (index, elem) {
                var $elem = $(elem);
                if ($elem.hasClass('is-invalid')) {
                    $elem.removeClass('is-invalid');
                }

                var $elemErr = $('#base_' + $elem.attr('name') + ' div.invalid-feedback');
                if ($elemErr.length > 0) {
                    $elemErr.remove();
                }
            });
        };

        $.ajax({
            url: $this.attr('action'),
            method: $this.attr('method'),
            data: $this.serialize(),
            success: function (json) {
                if (!json.success) {
                    console.log(err);
                    alert('wrong answer, see console');

                    return;
                }

                // remove previous validation errors
                removeValidationErrors();

                // set disabled to all fields
                $.each($this.find('input'), function (index, elem) {
                    $(elem).prop('disabled', true);
                });

                // show success message
                $this.find('h3.text-success').removeClass('d-none');

                // hide submit
                $this.find('button[type=submit]').hide();

                // reload data
                reloadAll();
            },
            error: function (err) {
                if (err.responseJSON.errors.length == 0) {
                    console.log(err);
                    alert('wrong answer, see console');

                    return;
                }

                removeValidationErrors();

                $.each(err.responseJSON.errors, function (field, errors) {
                    $('input[name=' + field + ']').addClass('is-invalid');

                    var $base_elem = $('#base_' + field + ' div.invalid-feedback');
                    if ($base_elem.length == 0) {
                        $('#base_' + field).append(
                            $('<div>').addClass('invalid-feedback d-inline').text(errors)
                        );
                    } else {
                        $base_elem.text(errors);
                    }
                });
            }
        });
    });

    $('.order-tariffs').on('click', function () {
        var $this = $(this),
            $dates = $('.order-delivery-dates')
            days = $this.data('weekdays').split(',');

        $.each($dates, function (index, elem) {
            var $elem = $(elem);
            if (days.indexOf($elem.data('weekday')) == -1) {
                $elem.prop('disabled', true);
            } else {
                $elem.prop('disabled', false);
            }
            $elem.prop('checked', false);
        });
    })

    $(window).on('load', function() {
        reloadAll();
    });
});