var loadFile = function(event) {
  console.log(event);
  var output = document.getElementById('output');
  output.src = URL.createObjectURL(event.target.files[0]);
};
$('.file-upload-wrp input[name="test"]').on('change',loadFile);


(function(){
  $('body').on('submit','form.contactForm',function(e){
      e.preventDefault();
      $this = $(this);
      url = $this.attr('action');
        $('.contactForm :input').removeClass("validate-error");
        $('.validate-tooltip').remove();
      $.post(url, $this.serialize(),function(resp){
        console.log(resp);
        if (resp.status){
          addnew();      
          // alert('ჩანაწერი დამატებულია');
          // window.location.href = document.location.origin+'/';
        }else{
          $.each(resp.error.name,function(field,value){
            console.log(value);
            $('.contactForm :input[name="'+field+'"]').addClass("validate-error");
            $('.contactForm :input[name="'+field+'"]').after('<p><div class="validate-tooltip">'+value+'</div></p>');
          });
        }
      },'json');
    });
    //update
    supc_right();
   $(".imagelists span img").on('click',function(){
     changeimg=$(this).attr("src");
     curent_img=$(".thumbnail img").attr("src");
     $(this).attr("src",curent_img);
     $(".thumbnail img").attr("src",changeimg);
   })
})();
$( window ).resize(function() {
  supc_right();
});
function supc_right(){
    bodyheight=parseInt($("body").css("height"));
    $(".supc_right").css("height",bodyheight*700/890+"px");
}
function addnew(){
    body=$("body");
    $(".alertDeleteCompany,.back_cover").remove();
    body.after("<div class='alertDeleteCompany allcenter'><p class='alertText'>ჩანაწერი დამატებულია</p><p><button class='AnswerYes' onclick=addok()>დათანხმება</button></p></div>");
    body.append("<div class='back_cover'></div>");
    $(".alertDeleteCompany").slideToggle("slow");  
}
function addok(){
    window.location.href = document.location.origin+'/calendar/';
}
//deleteobject
function deleteobject(id,object){
  $.post("http://localhost/calendar/Actions/delete_obj/"+id+"/"+object,{},function(e){
    if(e){
      closeAlert();
      $(".supc_left_item[data-numb='"+id+"']").slideUp("slow",function(){
        $(this).remove();
      });
    }
    else closeAlert();
  });
}
function closeAlert(){
  $( ".back_cover" ).fadeTo("slow",0);
  $(".alertDeleteCompany").slideUp("slow",function(){
    $(".alertDeleteCompany,.back_cover").remove();
  });
}
//ფილიალის წაშლა
    $(".supc_left_delete").on("click",function(){
      id=$(this).data('id');
      brach=$(this).parents(".supc_left_item").find(".titleBrach").text();
      body=$("body");
      $(".alertDeleteCompany,.back_cover").remove();
      body.after("<div class='alertDeleteCompany allcenter'><p class='alertText'>გსურთ ფილიალი "+brach+"-ის წაშლა ?</p><p><button class='AnswerYes' onclick=deleteobject("+id+",'branches')>დიახ</button><button class='AnswerNo' onclick=closeAlert()>არა</button></p></div>");
      body.append("<div class='back_cover'></div>");
      $(".alertDeleteCompany").slideToggle("slow");
    });

//ფილიალის წაშლა
// delete person
function deleteobPerson(id,object){
  $.post("http://localhost/calendar/actions/delete_obj/"+id+"/"+object,{},function(e){
    if(e){
      closePerson();
      $(".supc_list[data-numb='"+id+"']").slideUp("slow",function(){
        $(this).remove();
      });
    }
    else closePerson();
  });
}
function deletedonor(id,object){
  $.post("http://localhost/calendar/actions/delete_obj/"+id+"/"+object,{},function(e){
    if(e){
      closedonor();
      $(".supc_list[data-numb='"+id+"']").slideUp("slow",function(){
        $(this).remove();
      });
    }
    else closedonor();
  });
}
function closePerson(){
  $( ".back_cover" ).fadeTo("slow",0);
  $(".alertDeletePerson").slideUp("slow",function(){
    $(".alertDeletePerson,.back_cover").remove();
  });
}
function closedonor(){
  $( ".back_cover" ).fadeTo("slow",0);
  $(".alertDeletePerson").slideUp("slow",function(){
    $(".alertDeletePerson,.back_cover").remove(); 
     window.location.href="http://localhost/calendar/manager/donors/";
  });
}
//პერსონალის წაშლა
  $(".supc_delete").on("click",function(){
      id=$(this).data('id');
      person=$(this).parents(".supc_list").find(".supc_name").text();
      body=$("body");
      $(".alertDeletePerson,.back_cover").remove();
      body.after("<div class='alertDeletePerson allcenter'><p class='alertText'>გსურთ პერსონალ "+person+"-ის წაშლა ?</p><p><button class='AnswerYes' onclick=deleteobPerson("+id+",'personal')>დიახ</button><button class='AnswerNo' onclick=closePerson()>არა</button></p></div>");
      body.append("<div class='back_cover'></div>");
      $(".alertDeletePerson").slideToggle("slow");
    });
//პერსონალის წაშლა



//file uploader
  var uploader = new plupload.Uploader({
      drop_element : 'browse',
      runtimes : 'gears,html5,flash,silverlight,browserplus',
      max_file_size : '10mb',
      filters:[{title : "Image files", extensions : "jpg,jpeg,gif,png"}],
      resize:{
        width:500,
        quality:90
      },
      browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
      url: document.location.origin+'/Actions/file_upload/'
  });



  uploader.init();

  uploader.bind('FilesAdded', function(up, files,object) {
      var html = '';
      plupload.each(files, function(file) {
          html = '<li class="upload_status" id="' + file.id + '">ფაილი:' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
      });
      document.getElementById('filelist').innerHTML = html;
       up.start();
  });
  uploader.bind('FileUploaded', function(upldr, file, object) {
      var myData;
      try {
          myData = eval(object.response);
      } catch(err) {
          myData = eval('(' + object.response + ')');
      }
      if (myData.OK){
        $('.validate-tooltip').remove();
        $('#console').empty();
        $('input[name="filename"]').attr('value',myData.html);
        $('#output').attr('src',document.location.origin+'/uploads/'+myData.html);
      }else{
        alert('ფაილი არ აიტვირთა');
        console.log(myData.error);
      }
  });
  uploader.bind('UploadProgress', function(up, file) {
      document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
  });

  uploader.bind('Error', function(up, err) {
      document.getElementById('console').innerHTML += "\nშეცდომა #" + err.code + ": " + err.message;
  });

  // document.getElementById('start-upload').onclick = function() {
  //     uploader.start();
  // };
$(".donor_delete").on("click",function(){
    id=$(this).data('id');
    body=$("body");
    $(".alertDeletePerson,.back_cover").remove();
    body.after("<div class='alertDeletePerson allcenter'><p class='alertText'>&#4316;&#4304;&#4315;&#4307;&#4309;&#4312;&#4314;&#4304;&#4307; &#4306;&#4321;&#4323;&#4320;&#4311; &#4332;&#4304;&#4328;&#4314;&#4304; ?</p><p><button class='AnswerYes' onclick=deletedonor("+id+",'donor')>&#4307;&#4312;&#4304;&#4334;</button><button class='AnswerNo' onclick=closedonor()>&#4304;&#4320;&#4304;</button></p></div>");
    body.append("<div class='back_cover'></div>");
    $(".alertDeletePerson").slideToggle("slow");
  });  
//
$(".surogat_delete").on("click",function(){
    id=$(this).data('id');
    body=$("body");
    $(".alertDeletePerson,.back_cover").remove();
    body.after("<div class='alertDeletePerson allcenter'><p class='alertText'>&#4316;&#4304;&#4315;&#4307;&#4309;&#4312;&#4314;&#4304;&#4307; &#4306;&#4321;&#4323;&#4320;&#4311; &#4332;&#4304;&#4328;&#4314;&#4304; ?</p><p><button class='AnswerYes' onclick=surogatdelete("+id+",'surogat')>&#4307;&#4312;&#4304;&#4334;</button><button class='AnswerNo' onclick=closesurogat()>&#4304;&#4320;&#4304;</button></p></div>");
    body.append("<div class='back_cover'></div>");
    $(".alertDeletePerson").slideToggle("slow");
});  
function surogatdelete(id,object){
  $.post("http://localhost/calendar/actions/delete_obj/"+id+"/"+object,{},function(e){
    if(e){
      closesurogat();
      $(".supc_list[data-numb='"+id+"']").slideUp("slow",function(){
        $(this).remove();
      });
    }
    else closesurogat();
  });
}
function closesurogat(){
  $( ".back_cover" ).fadeTo("slow",0);
  $(".alertDeletePerson").slideUp("slow",function(){
    $(".alertDeletePerson,.back_cover").remove(); 
     window.location.href="http://localhost/calendar/manager/surogats/";
  });
}




//change uploadimage



var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        $(".imglists").after($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}),        
                $("<br/><br/>")
                ));
    });

//following function will executes on change event of file input to select different file	
var delfile='';
$('body').on('change', '#file', function(){
            if (this.files) {
                for (var i =0; i<this.files.length; i++){
                    abc += 1; //increementing global variable by 1
    				
    				var z = abc - 1;
                    // var x = $(this).parent().find('#previewimg' + z).remove();
                    $(".imglists").append("<div id='abcd"+ abc +"' class='imgblock'><img id='previewimg" + abc + "' src='' width='200'/></div>");
                   
    			    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[i]);

    			    $(this).hide();
                    $("#abcd"+ abc).append($("<img/>", {id: 'img',id:abc,src: 'http://localhost/calendar/assets/images/x.png', alt: 'delete'}).click(function() {
                        $(this).parents('.imgblock').remove();
                        idd=$(this).attr('id');
                        delfile+='-'+idd;
                        $('.delfiles').attr('value',delfile);
                    }));
                }
            }
        });

//To preview image     
    var s=1;
    function imageIsLoaded(e) {
        $('#previewimg' + (s++)).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});

