function ajaxRequest(url,elementId){
  $.ajax(url,{
    dataType:'json',
    success:function(data){
      $('#'+elementId).html(data.content);
    }
  });
}

function setDialog(elementId,width,height){
  var dial = $('#'+elementId).dialog({
    autoOpen:false,
    resizable: false,
    width:width,
    height:height,
    hide:function(){
      $(this).fadeOut();
    },
    show:function(){
      $(this).fadeIn();
    },
    close:function(){
      $('#'+elementId).css('display','block');
      dial.dialog('destroy');
    }
  });
  dial.dialog('open');
}

function destroyDialog(elementId){
  $('#'+elementId).css('display','none');
  $('#'+elementId).dialog('destroy');
}

function ajaxyFormData(formId,url,killDialog,dialogId){
  var data = $('#'+formId).serialize();
  $.get(url,data);
  if (killDialog == true){
    destroyDialog(dialogId);
  }
}

function ajaxSendData(elementId,datas,url){
 $.ajax(url,{
    dataType:'json',
    data:datas,
    success:function(data){
      $('#'+elementId).html(data.content);
    }
  });
}

function ajaxSendDataWithOutBack(datas,url){
  $.ajax(url,{
    dataType:'json',
    data:datas,
    success:function(data){}
  });
}

function cleanForm(formId){
  $('#'+formId).find("input[type=text], textarea,input[type=password]").val("");
  $('#'+formId).find("input[type=checkbox]").attr('checked',false);
}