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

  $('.dropdown-item').on('click', function(){
    var order = $(this).attr("data").split('_');
    var idOrder = order[0];
    var idStatus = order[1];
    var myData = 'idOrder='+idOrder+'&idStatus='+idStatus+'&jqAction=changeStatus';
    var newValue = $(this).html();
    var thisElement = $(this);

    $.ajax({
      url: "../../ajax/ajax.php",
      type: "POST",
      dataType: "text", // Тип данных
      data: myData,
      error: function() {alert("Что-то пошло не так в main.js");},
      success: function(answer){
        thisElement.siblings(".disabled").removeClass("disabled");
        thisElement.addClass("dropdown-item disabled");
        thisElement.parent().siblings("button").html(newValue);
      }
    })
  });
  $('.amount').on('click', function(){
    var order = $(this).attr("data").split('_');
    var idOrder = order[0];
    var myData = 'idOrder='+idOrder+'&jqAction=showDetails';
    //var newValue = $(this).html();
    var thisElement = $(this);
    //console.log("Cought ya!");

    $.ajax({
      url: "../../ajax/ajax.php",
      type: "POST",
      dataType: "text", // Тип данных
      data: myData,
      error: function() {alert("Что-то пошло не так в main.js");},
      success: function(answer){
        //console.log("Got an answer!");
        $("#admin-orders > h2").html("Заказ № "+idOrder);
        thisElement.parent().parent().siblings(".order").hide();
        //thisElement.siblings(".disabled").removeClass("disabled");
        //thisElement.addClass("dropdown-item disabled");
        //thisElement.parent().siblings("button").html(newValue);
      }
    })
  });

  /*if( $("#user").val() ) {
    $('a[link="page_6"]').hide();
    var user = "Личный кабинет "+$("#user").val();
    var logout = "Выход";
    $('#login').text(user);
    $('#logout').text(logout);
  }*/

  /*$('#logout').on('click', function() {
    $("#user").val('');
    $('#logout').hide();
    $('#login').hide();
    $('a[link="page_6"]').show();
    location.href = "?path=user/index";
  });*/

});
