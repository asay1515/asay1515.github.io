var main = function() {

    var id_now = $('.comment').attr("id");
    var last_id = 0;

    var censor = false;
    var ban = false;

    $.ajax({
        url: "check_ban.php",
        async: false,
        type: "POST",
        success: function (html) {
            if (html=='1'){
                ban = true;
            }
        }
    });

    $('body').on('click', '.input-submit', function () {
        if (ban) {
            $('.message').prepend('&nbsp;&nbsp;Вам запрещено пользоваться комментариями<br>' +
                'вследствие многократного нарушения правил с вашей стороны.<br>' +
                'Через некоторое время запрет может быть снят.<br>Подумайте над своим поведением.<br><br>');
        } else {
            $('.message').empty();

            var id;
            var name = $('.name-input').val();
            var comment = $('.comment-input').val();
            var date;

            $.ajax({
                url: "check_mat.php",
                async: false,
                type: "POST",
                data: {name: name, comment: comment},
                success: function (html) {
                    if (html.indexOf('1') + 1) {
                        $.ajax({
                            url: "new_breach.php",
                            async: false,
                            type: "POST",
                            success: function (data) {
                                if (data=='1'){
                                    location.reload();
                                }
                            }
                        });
                        censor = true;
                        $('.message').prepend('&nbsp;&nbsp;В тексте вашего комментария замечены внешние ссылки. Любые внешние ссылки считаются попыткой рассылки спама.<br>' +
                            'Это противоречит правилам.<br>' +
                            'Дальнейшие нарушения могут повлечь за собой бан.<br><br>');
                    }
                    if (html.indexOf('2') + 1) {
                        $.ajax({
                            url: "new_breach.php",
                            async: false,
                            type: "POST",
                            success: function (data) {
                                if (data=='1'){
                                    location.reload();
                                }
                            }
                        });
                        censor = true;
                        $('.message').prepend('&nbsp;&nbsp;В тексте вашего комментария замечена нецензурная лексика.<br>' +
                            'Это противоречит правилам.<br>' +
                            'Дальнейшие нарушения могут повлечь за собой бан.<br><br>');
                    }
                }
            });

            if (!censor) {
                $.ajax({
                    url: "new-comment.php",
                    async: false,
                    type: "POST",
                    data: {name: name, comment: comment},
                    dataType: "json",
                    success: function (data) {
                        id = data[0].id;
                        name = data[0].name;
                        comment = data[0].comment;
                        date = data[0].date;
                    }
                });

                $('.comments').prepend('<div class="comment" id="' + id + '">' +
                    '<div class="name">' + name + '</div><hr>' +
                    '<div class="comment-text">&nbsp;&nbsp;&nbsp;&nbsp;' + comment + '</div>' +
                    '<div class="date">' + date + '</div>' +
                    '</div>');

                id_now++;
            }
        }
    });
    setInterval(function(){
        $.ajax({
            url: "add-new-note.php",
            async: false,
            success: function(html){
                last_id = html;
            }
        });

        if (last_id>id_now){
            for (id_now = (id_now+1); id_now<=last_id; id_now++){
                $('.comments').prepend('<div class="comment" id="' + id + '">' +
                    '<div class="name">' + name + '</div><hr>' +
                    '<div class="comment-text">&nbsp;&nbsp;&nbsp;&nbsp;' + comment + '</div>' +
                    '<div class="date">' + date + '</div>' +
                    '</div>');
            }
        }
    },1000)
};

$(document).ready(main);
