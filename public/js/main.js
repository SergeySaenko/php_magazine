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

  /*
  * Получение данных из формы
  */
  function getData(obj_form){
    var hData = {};
    $('input, textarea, select', obj_form).each(function(){
      if(this.name && this.name != ''){
        hData[this.name] = this.value;
        console.log('hData[' + this.name + '] = ' + hData[this.name]);
      }
    });
    return hData;
  }



  $('#registerMe').on('click', function(){
    var postData = getData('#registerBox');
    $.ajax({
      type: 'POST',
      //async: false,
      url: "index.php?path=user/register/",
      data: postData,
      dataType: 'json',
      error: function() {alert("Что-то пошло не так...");},
      success: function(data){
        if(data['success']){
          alert(data['message']);

          $('#registerBox').hide();
        } else {
          alert(data['message']);
        }
      }
    })
  })
});
