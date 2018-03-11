$(document).ready(function(){
  //console.log("JQUERY is here!");
  $('#buyme').on('click', function(){
    var id_good = $(this).attr("class").substr(5);

    $.ajax({
      url: "index.php?path=order/add/" + id_good,
      type: "GET",
      data: "",
      error: function() {alert("Что-то пошло не так...");},
      success: function(answer){
        alert("Товар добавлен в корзину!");
      },
      dataType : "text"
    })
  });

  if( $("#user").val() ) {
    $('a[link="page_6"]').hide();
    var user = "Личный кабинет "+$("#user").val();
    var logout = "Выход";
    $('#login').text(user);
    $('#logout').text(logout);
  }

  $('#logout').on('click', function() {
    $("#user").val('');
    $('#logout').hide();
    $('#login').hide();
    $('a[link="page_6"]').show();
    location.href = "?path=user/index";
  })

});
