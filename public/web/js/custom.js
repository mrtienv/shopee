UI = {
    addDropdownMenu: function () {
        $('.sub-menu').parent().addClass('has-sub-menu').append('<span class="toggle-menu"></span>');
    },
    menuDropdown: function () {
        if (window.innerWidth > 991)
            return;
        $(document).on('click', '.toggle-menu', function () {
            $(this).parent().toggleClass('active');
        })
    },
    customJump: function (h) {
        var top = document.getElementById(h).offsetTop;
        window.scrollTo(0, top-140);
    },
    collapsibleContent: function () {
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("collapsible-active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight){
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    },
    init: function () {
        this.addDropdownMenu();
        this.menuDropdown();
        this.collapsibleContent();
    }
};
UI.init();
$(document).ready(function(){
    $('.content-expand').click(function (e) {
        e.preventDefault();
        $(this).closest('.container-show-more').find('.content-show').removeClass('d-block').addClass('d-none');
        $(this).closest('.container-show-more').find('.content-hide').removeClass('d-none').addClass('d-block');
    });
    $('.content-collapse').click(function (e) {
        e.preventDefault();
        $(this).closest('.container-show-more').find('.content-hide').removeClass('d-block').addClass('d-none');
        $(this).closest('.container-show-more').find('.content-show').removeClass('d-none').addClass('d-block');
    });
    $('.table_of_content a').on('click', function (e) {
        e.preventDefault();
        let id = $(this).attr('href');
        id = id.replace('#', '');
        window.history.pushState("", "", '#'+id);
        UI.customJump(id);
    });
    $('.spin-vietlott-select').change(function () {
        let spin = "<td class=\"d-none\"></td>\n" +
            "            <td class=\"d-flex\">\n" +
            "                <span class=\"text-number\" data-nc=\"2\"><i class=\"icomoon-spinner\"></i></span>\n" +
            "                <span class=\"text-number\" data-nc=\"2\"><i class=\"icomoon-spinner\"></i></span>\n" +
            "                <span class=\"text-number\" data-nc=\"2\"><i class=\"icomoon-spinner\"></i></span>\n" +
            "                <span class=\"text-number\" data-nc=\"2\"><i class=\"icomoon-spinner\"></i></span>\n" +
            "                <span class=\"text-number\" data-nc=\"2\"><i class=\"icomoon-spinner\"></i></span>\n" +
            "                <span class=\"text-number\" data-nc=\"2\"><i class=\"icomoon-spinner\"></i></span>\n" +
            "            </td>";
        let special = "<td class=\"vietlott-special\">\n" +
            "                <span class=\"text-number\" data-nc=\"2\"><i class=\"icomoon-spinner\"></i></span>\n" +
            "            </td>";
        let content;
        if ($('.spin-vietlott-select').val() === '6/45') {
            content = spin
        } else {
            content = spin + special;
        }
        $('.vietlot-spin').empty();
        $('.vietlot-spin').append(content);
    })
});

    var is_busy = false;
    var page = 1;
    $(document).ready(function()
    {
        $('#btn-loadmore').click(function()
        {

            let element = $('#list-posts-more');
            let button = $(this);
            let url = window.location.href;

            if (is_busy == true) {
                return false;
            }
            page++;
            button.html('Đang tải ...');
            $.ajax(
                {
                    type: 'get',
                    dataType: 'json',
                    url: url+ '/'+page,
                    success: function(post)
                    {
                        if (post == '') {
                            button.remove()
                        } else {
                            element.append(post);
                        }
                    }
                })
                .always(function()
                {
                    // Sau khi thực hiện xong thì đổi giá trị cho button
                    button.html('Xem thêm');
                    is_busy = false;
                });

        });
    });



