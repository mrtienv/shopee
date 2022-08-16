var DELAY = (function () {
    var queue = [];

    function processQueue() {
        if (queue.length > 0) {
            setTimeout(function () {
                queue.shift().callBack();
                processQueue();
            }, queue[0].delay);
        }
    }

    return function DELAY(delay, callBack) {
        queue.push({delay: delay, callBack: callBack});

        if (queue.length === 1) {
            processQueue();
        }
    };
}());
var GENERATE = {
    tableResult: $('.table-result'),
    iconSpin: '<i class="icomoon-spinner"></i>',
    countRandom: 10,
    timeRandom: 100,
    timeDelayRandom: 2000,
    random_number: function (length, selector, tableLoto, colLoto) {
        let number;
        let flag = 0;
        let run_random_number = setInterval(function () {
            if (flag < GENERATE.countRandom) {
                flag++;
                number = LOAD_NUMBER.random_number(length);
                selector.html(number);
            } else {
                clearInterval(run_random_number);
                number = LOAD_NUMBER.format_number(number);
                selector.html(number);
                GENERATE.show_loto(tableLoto, colLoto, number.toString());
            }
        }, GENERATE.timeRandom);
    },
    show_loto: function (selector, col, number) {
        let twoNumber = number.substr(number.length - 2);
        let head = twoNumber.substr(0, 1);
        let tail = twoNumber.substr(1, 1);

        let nthChildTr = parseInt(head) + 1;
        selector.find('tbody > tr:nth-child(' + nthChildTr + ') > td:nth-child(' + col + ')').append('<span>' + tail + '</span>');
        if (selector.hasClass('loto-single')) {
            nthChildTr = parseInt(tail) + 1;
            selector.find('tbody tr:nth-child(' + nthChildTr + ') td:nth-child(4)').append('<span>' + head + '</span>');
        }
        GENERATE.done();
    },
    show_result_MB: function (selectorKQ, selectorLoto, childTr) {
        selectorKQ.find('tbody > tr' + childTr).each(function () {
            let trElement = $(this);
            trElement.find('td').each(function (iTd) {
                $(this).find('span').each(function (iSpan) {
                    let spanElement = $(this);
                    let nc = spanElement.data('nc');
                    DELAY(GENERATE.timeDelayRandom, function (iTd) {
                        return function () {
                            let keyTD = iTd + 1;
                            return GENERATE.random_number(nc, spanElement, selectorLoto, keyTD);
                        };
                    }(iTd, iSpan));
                });
            });
        });
    },
    show_result_MN: function (selectorKQ, selectorLoto, childTr) {
        selectorKQ.find('tbody > tr' + childTr).each(function () {
            let trElement = $(this);
            trElement.find('td').each(function (iTd) {
                $(this).find('.text-number').each(function (iSpan) {
                    let spanElement = $(this);
                    let nc = spanElement.data('nc');
                    DELAY(GENERATE.timeDelayRandom, function (iTd) {
                        return function () {
                            let keyTD = iTd + 1;
                            GENERATE.random_number(nc, spanElement, selectorLoto, keyTD);
                        };
                    }(iTd, iSpan));
                });

            });
        });
    },
    init: function () {
        GENERATE.tableLoto = GENERATE.tableResult.closest('article').find('.table-loto');

        $('button.btn_spin').click(function (e) {
            e.preventDefault();
            GENERATE.tableLoto.find('span').remove();
            GENERATE.tableResult.find('.text-number').html(GENERATE.iconSpin);
            $(this).attr('disabled', true);
            if (GENERATE.tableResult.hasClass('table-result-xsmb')){
                GENERATE.show_result_MB(GENERATE.tableResult, GENERATE.tableLoto, ':nth-child(n+2)');
                GENERATE.show_result_MB(GENERATE.tableResult, GENERATE.tableLoto, ':first-child');
            } else if (GENERATE.tableResult.hasClass('table-result-province')){
                GENERATE.show_result_MN(GENERATE.tableResult, GENERATE.tableLoto, '');
            } else {
                GENERATE.show_result_MN(GENERATE.tableResult, GENERATE.tableLoto, ':not(:first-child)');
            }

        });
    },
    active: function (id) {
        $(".main-menu > li > a[href='" + base_url + "quay-thu-xsmb.html']").parent('li').addClass('active');
        $(".sub-menu a[href='" + window.location.href + "']").parent('li').addClass('active');
        var url;
        switch (id) {
            case '58':
                url = 'xsmb';
                break;
            case '59':
                url = 'xsmt';
                break;
            case '60':
                url = 'xsmn';
                break;
        }
        $(".sub-menu > li > a[href='" + base_url + "quay-thu-" + url + ".html']").parent('li').addClass('active');
    },
    done: function () {
        let checkDone = GENERATE.tableResult.find('.icon-spinner');
        let len;
        if (GENERATE.tableResult.hasClass('table-reuslt-single'))
            len = 3;
        else
            len = 0;
        if (checkDone.length == len){
            $(".btn.btn_spin").prop('disabled',false);
        }
    }
};
GENERATE.init();

const LOAD_NUMBER = {
    random_number: function (length) {
        let list_number = ''; let cl;
        for (let i = 1; i <= length; i++){
            if (i % 2 == 0){
                cl = 'do';
            }else {
                cl = 'ghi';
            }
            let rand = Math.floor(Math.random() * 10);
            list_number += '<i class="'+cl+'">'+rand+'</i>';
        }
        return list_number;
    },
    format_number: function (number) {
        let string      = number.replace(/<\/i>/g, "");
        string          = string.replace(/<i class="ghi">/g, "");
        string          = string.replace(/<i class="do">/g, "");
        return string;
    },
};

$(document).ready(function () {
    /*auto quay thu*/
    // if ($(".btn.btn_spin").length > 0) {
    //     $(".btn.btn_spin").trigger('click');
    // }
    $('.spin-select').change(function () {
        window.location.href = $(this).val();
    })
});
