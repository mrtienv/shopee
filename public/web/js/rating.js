$(document).on('click', '.rateit', function () {
    let request = {
        star: $(this)[0].lastElementChild.ariaValueNow,
        type: $(this).data('type'),
        rating_id: $(this).data('rating-id')
    };
    var _this = $(this);
    $.ajax({
        url: '/rating/rating',
        data: request,
        type: 'POST',
        dataType: 'json',
        success: function (res) {
            _this.next('.danhgia').find('.avg-rate').text(res.avg);
            _this.next('.danhgia').find('.count-rate').text(res.count);
        }
    });
});
