var main = function() {

    var id_now = $('.comment').attr("id");
    var last_id = 0;

    var censor = false;
    var ban = false;
	var flag = true;

	var mat =["х**","х*й","охреневший","ебанутый"];
//организовать проверку на бан

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
			
           		for (i=0;i<mat.length;i++)
			{
				if (name==mat[i])
				{
					cenzor=true;
					flag=false;
					 $('.message').prepend('&nbsp;&nbsp;В тексте вашего комментария замечены внешние ссылки. Любые внешние ссылки считаются попыткой рассылки спама.<br>' +
                            'Это противоречит правилам.<br>' +
                            'Дальнейшие нарушения могут повлечь за собой бан.<br><br>');
							//добавить очистку формы и переделать сообщение 
				}
				if (comment.indexOf(mat[i])!=-1)
				{
					cenzor=true;
					flag=false;
					$('.message').prepend('&nbsp;&nbsp;В тексте вашего комментария замечена нецензурная лексика.<br>' +
                            'Это противоречит правилам.<br>' +
                            'Дальнейшие нарушения могут повлечь за собой бан.<br><br>');
							//добавить очистку формы и переделать сообщение 
				}
			}

            if (flag) {	
                $('.comments').prepend('<div class="comment" id="' + id + '">' +
                    '<div class="name">' + name + '</div><hr>' +
                    '<div class="comment-text">&nbsp;&nbsp;&nbsp;&nbsp;' + comment + '</div>' +
                    '<div class="date">' + date + '</div>' +
                    '</div>');

                id_now++;
            }
			flag=true;
        }
    });
    setInterval(function(){
    

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
