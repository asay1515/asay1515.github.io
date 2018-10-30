var main = function() {

    var id_now = $('.comment').attr("id");
    var last_id = 0;

    var censor = false;
    var ban = false;
	var flag = true;
	var k=0;

	var mat =["ВЫЕБЫВАЕШЬСЯ","Выебываешься","выебываешься","ВЫЕБЫВАТЬСЯ","Выебываться","выебываться","ВЫЕБОН","Выебон","выебон","ВЫБЛЯДОК","Выблядок","выблядок","БЛЯДСТВО","Блядство","блядство","БЛЯДСКИЙ","Блядский","блядский","БЛЯ","Бля","бля","БЛЯ!","Бля!","бля!","Ёбля","ёбля","Ёбля","ЕБЛЯ","Ебля","ебля","ЕЛДА","елда","Елда","МАНДА","Манда","манда","МУДЕ","Муде","муде","х**","х*й","охреневший","ебанутый","охуевший","охуеть","хуй","нахуй","в жопу","нахрен","ебать","*бать","еб*нутый","еба*тый","еба*утый"];
   

    $('body').on('click', '.input-submit', function () {
        if (ban) {
			
            alert('Вам запрещено пользоваться комментариями ' +
                ' вследствие многократного нарушения правил с вашей стороны.' +
                ' Через некоторое время запрет может быть снят.Подумайте над своим поведением!!!');
			document.location.href = "https://asay1515.github.io/progect/ban.html";
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
					 alert('Ваше имя пользователя содержит нецензурные высказывания!' +
                            ' Это противоречит правилам.' +
                            ' Дальнейшие нарушения могут повлечь за собой бан.');
							 
					ban=true;
					
				}
				if (comment.indexOf(mat[i])!=-1)
				{
					cenzor=true;
					flag=false;
					alert('В тексте вашего комментария замечена нецензурная лексика.' +
                            ' Это противоречит правилам.' +
                            ' Дальнейшие нарушения могут повлечь за собой бан.');
						 
					
					ban=true;
				}
			}

            if (flag) {	
			k=0;
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
