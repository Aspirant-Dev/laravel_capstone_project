$('.add_more').on('click', function() {

    var product = $('.product_id').html();
    var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
    var tr = '<tr><td style="display:none" class"no""">' + numberofrow + '</td>' +
        '<td><select required class="select2bs4 form-control product_id" name="product_id[]" style="width: 100%;">' +
        product +
        '</select></td>' +
        '<td><input type="text" name="brand[]" class="form-control brand text-center border-0" readonly style="background-color: white; width: 100%; padding: 0px!important"></td>' +
        '<td><input type="text" name="type[]"  class="form-control type text-center border-0" readonly style="background-color: white; width: 100%; padding: 0px!important"></td>' +
        '<td><input type="text" name="unit[]"  class="form-control unit text-center border-0" readonly style="background-color: white; width: 100%; padding: 0px!important"></td>' +
        '<td><input type="text" name="stocks[]"  class="form-control stocks text-center border-0" readonly style="background-color: white; width: 100%; padding: 0px!important"></td>' +
        '<td><input type="number" min="1" name="quantity[]" required class="form-control quantity text-center"></td>' +
        '<td><input type="number" min="1" name="price[]" class="form-control price text-center" readonly placeholder="0.00" style="background-color: white; font-weight:bold"></td>' +
        '<td><input type="number" min="1" name="total_amount[]" class="form-control total_amount text-center" placeholder="0.00" readonly style="background-color: white; font-weight:bold"></td>' +
        '<td align="center"><a type="button" class="btn btn-sm btn-danger delete"><i class="fas fa-times"></i></a></td>';

    $('.addMoreProduct').append(tr);

    $('#balance').val(((Math.round(0 * 100) / 100).toFixed(2)));
    $('#paid_amount').val(((Math.round(0 * 100) / 100).toFixed(2)));
    document.getElementById("btnSubmit").disabled = true;
    document.getElementById('msg').style.display = 'none';

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: 'Search product here... '
    });

});

function TotalAmount() {
    var total = 0;
    $('.total_amount').each(function(i, e) {
        var amount = $(this).val() - 0;
        total += amount;
    });

    var myTotal = (Math.round(total * 100) / 100).toFixed(2)
    $('.total').html(myTotal);
}
$('.addMoreProduct').delegate('.product_id', 'change', function() {
    var tr = $(this).parent().parent();
    var brand = tr.find('.product_id option:selected').attr('data-brand');
    var type = tr.find('.product_id option:selected').attr('data-type');
    var unit = tr.find('.product_id option:selected').attr('data-unit');
    var stocks = tr.find('.product_id option:selected').attr('data-stocks');
    var price = tr.find('.product_id option:selected').attr('data-price');
    tr.find('.brand').val(brand);
    tr.find('.type').val(type);
    tr.find('.unit').val(unit);
    tr.find('.stocks').val(stocks);
    tr.find('.price').val((Math.round(price * 100) / 100).toFixed(2));
    var qty = tr.find('.quantity').val() - 0;
    var price = tr.find('.price').val() - 0;
    var total_amount = (qty * price);
    tr.find('.total_amount').val((Math.round(total_amount * 100) / 100).toFixed(2));

    TotalAmount();
});
$('.addMoreProduct').delegate('.quantity', 'keyup', function() {

    $('#balance').val(((Math.round(0 * 100) / 100).toFixed(2)));
    $('#paid_amount').val(((Math.round(0 * 100) / 100).toFixed(2)));
    document.getElementById("btnSubmit").disabled = true;
    document.getElementById('msg').style.display = 'none';
    // var stocks = tr.find('.product_id option:selected').attr('data-stocks');
    var tr = $(this).parent().parent();
    var qty = tr.find('.quantity').val() - 0;
    var price = tr.find('.price').val() - 0;
    var stocks = tr.find('.stocks').val() - 0;

    if (qty > stocks) {
        this.value = stocks;
    }

    var total_amount = (qty * price);
    tr.find('.total_amount').val((Math.round(total_amount * 100) / 100).toFixed(2));
    TotalAmount();
});
$('.addMoreProduct').delegate('.delete', 'click', function() {
    $(this).parent().parent().remove();

    TotalAmount();
    $('#balance').val(((Math.round(0 * 100) / 100).toFixed(2)));
    $('#paid_amount').val(((Math.round(0 * 100) / 100).toFixed(2)));
    document.getElementById("btnSubmit").disabled = true;
    document.getElementById('msg').style.display = 'none';
    var numberofrow = ($('.addMoreProduct tr').length);

    if (numberofrow == 0) {
        // alert('All items has been removed. The page will reload.');
        // window.location.reload();
        swal(" ", {
            title: 'All items are removed.',
            icon: 'info',
            // text: 'The page will reload',
            closeOnClickOutside: true,
        }).then(function() {
            location.reload();
        });
    }
});

$('#paid_amount').keyup(function() {
    var total = $('.total').html();
    var paid_amount = $(this).val();
    if (paid_amount != '') {
        var tot = paid_amount - total;

        $('#balance').val(((Math.round(tot * 100) / 100).toFixed(2)));
        var values = $('#balance').val(((Math.round(tot * 100) / 100).toFixed(2)));
        // alert(values.val());
        if (values.val() < 0) {
            document.getElementById("btnSubmit").disabled = true;
            document.getElementById('msg').style.display = 'flex';

        } else {
            document.getElementById("btnSubmit").disabled = false;
            document.getElementById('msg').style.display = 'none';
        }
    } else {
        document.getElementById("btnSubmit").disabled = true;
        $('#balance').val(((Math.round(0 * 100) / 100).toFixed(2)));
    }
});