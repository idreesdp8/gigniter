function get_gig_book_now_data(id) {
    $.ajax({
        url: base_url + 'gigs/get_gig_book_now_data',
        data: {
            id: id
        },
        method: 'POST',
        dataType: 'json',
        success: function (response) {
            $('#gig_id').val(id);
            $('#book_now_tier').empty();
            $('#book_now_tier').append('<option value="">Choose Tier</option>')
            $(response).each(function (index, value) {
                $('#book_now_tier').append('<option value="' + value.id + '">' + value.name + ' ($' + value.price + ')</option>')
            });
        }
    });
}
$(document).on('click', '.show_modal', function () {
    var id = $(this).attr('data-id');
    get_gig_book_now_data(id);
});
$('#add_to_cart').click(function () {
    var form = $(this).parents('form').serialize();
    $.ajax({
        url: base_url + 'cart/add',
        data: form,
        dataType: 'json',
        method: 'POST',
        success: function (response) {
            alert(response.message);
        }
    });
});
$('#book_now_modal').on('hide.bs.modal', function () {
    $('#quantity').val('');
});