urlSite="http://bookchachava.ge/";
var test=0;
function init(arg1,arg2) {
	scheduler.config.xml_date="%Y-%m-%d %H:%i";
	scheduler.config.time_step = 15;
	scheduler.config.first_hour = 9;
	scheduler.config.last_hour = 24;
        step=30;
	scheduler.config.details_on_dblclick = true;
	scheduler.config.details_on_create = true;
	scheduler.templates.week_date = function(date){
		arrayMonth=new Array("&#4312;&#4304;&#4316;&#4309;&#4304;&#4320;&#4312;","&#4311;&#4308;&#4305;&#4308;&#4320;&#4309;&#4304;&#4314;&#4312;","&#4315;&#4304;&#4320;&#4322;&#4312;","&#4304;&#4318;&#4320;&#4312;&#4314;&#4312;","&#4315;&#4304;&#4312;&#4321;&#4312;","&#4312;&#4309;&#4316;&#4312;&#4321;&#4312;","&#4312;&#4309;&#4314;&#4312;&#4321;&#4312;","&#4304;&#4306;&#4309;&#4312;&#4321;&#4322;&#4317;","&#4321;&#4308;&#4325;&#4322;&#4308;&#4315;&#4305;&#4308;&#4320;&#4312;","&#4317;&#4325;&#4322;&#4317;&#4315;&#4305;&#4308;&#4320;&#4312;","&#4316;&#4317;&#4308;&#4315;&#4305;&#4308;&#4320;&#4312;","&#4307;&#4308;&#4313;&#4308;&#4315;&#4305;&#4308;&#4320;&#4312;");
		datee=date.getDate()+" "+arrayMonth[date.getMonth()]+" "+date.getFullYear();
		return datee;
	};
var format = scheduler.date.date_to_str("%H:%i");
 
scheduler.templates.hour_scale = function(date){
	html="";
	for (var i=0; i<60/step; i++){
		html+="<div style='height:21px;line-height:21px;'>"+format(date)+"</div>";
		date = scheduler.date.add(date,step,"minute");
	}
	return html;
}
	scheduler.templates.week_scale_date = function(datee){
		arrayWeek=new Array("&#4313;&#4309;&#4312;","&#4317;&#4320;&#4328;","&#4321;&#4304;&#4315;","&#4317;&#4311;&#4334;","&#4334;&#4323;&#4311;","&#4318;&#4304;&#4320;","&#4328;&#4304;&#4305;");
		datee=arrayWeek[datee.getDay()]+"."+(datee.getMonth()+1)+"/"+datee.getDate();
		return datee;
	};
	scheduler.templates.event_text = function(start, end, event){
		return '';
	};
	scheduler.templates.lightbox_header = function(start, end, event){
		html='დაჯავნშნა';
		return html;
	};
	scheduler.config.icons_select = [
	   "icon_details",
	   "icon_delete"
	];
	$.post(urlSite+'schedule/services',{company_id : arg1,segment2: arg2},function(e){
		personal=eval(e);
		scheduler.config.lightbox.sections=[
			{name:"&#4321;&#4304;&#4334;&#4308;&#4314;&#4312;,&#4306;&#4309;&#4304;&#4320;&#4312;", height:25, map_to:"fname", type:"textarea", focus:true},
			{name:"&#4322;&#4308;&#4314;&#4308;&#4324;&#4317;&#4316;&#4312;&#4321; &#4316;&#4317;&#4315;&#4308;&#4320;&#4312;", height:25, map_to:"tel", type:"textarea"},
			{name:"&#4318;&#4320;&#4317;&#4330;&#4308;&#4307;&#4323;&#4320;&#4304;�", height:25, map_to:"procedur", type:"textarea"},
			{name:"&#4328;&#4308;&#4316;&#4312;&#4328;&#4309;&#4316;&#4304;", height:43, type:"select", options: personal, map_to:"personal" },
			{name:"&#4328;&#4308;&#4316;&#4312;&#4328;&#4309;&#4316;&#4304;", height:25, map_to:"pro_date", type:"textarea"},
			{name:"&#4311;&#4304;&#4320;&#4312;&#4326;&#4312;", height:72, type:"calendar_time", map_to:"auto"},
			{name:"company", height:72, type:"textarea",default_value:urlsplit(), map_to:"company_id"}
		];
	},'json');
	pers="?company="+urlsplit()+"&";
	if(arg2 >0)pers+='personal='+arg2+"&";
	else pers+='';
	MarkToday();
	scheduler.init('scheduler_here',new Date(Date.now()),"week");
	scheduler.load(urlSite+"calendar/events.php"+pers+"?uid="+scheduler.uid());		
	var dp = new dataProcessor(urlSite+"calendar/events.php");
	dp.init(scheduler);		
	$(".mdl-layout__drawer-button").click(function(){
		$(".mdl-layout__container").css("height","100%");
	});
	$(".mdl-layout__obfuscator").click(function(){
		$(".mdl-layout__container").css("height","50px");
	});
	scheduler.templates.event_header=function(start,end,event){
	    return "<span>"+scheduler.templates.event_date(start)+" - "+scheduler.templates.event_date(end)+"</span><span>"+event.procedur+"</span><span>"+event.fname+"</span>";
	}
	// scheduler.attachEvent("onLightbox", function(){
	//    var section = scheduler.formSection("პ� ოცედუ� ა");
	//    section.control.disabled = true;
	// });
	var format=scheduler.date.date_to_str("%Y-%m-%d %H:%i"); 
	scheduler.templates.tooltip_text = function(start,end,event) {
	    return "<strong>&#4321;&#4304;&#4334;&#4308;&#4314;&#4312;,&#4306;&#4304;&#4309;&#4320;&#4312;: </strong>"+event.fname+"<br/>"+"<strong>&#4318;&#4320;&#4317;&#4330;&#4308;&#4307;&#4323;&#4320;&#4304;: </strong>"+event.procedur+"<br/>"+"<strong>&#4318;&#4320;&#4317;&#4330;&#4308;&#4307;&#4323;&#4320;&#4312;&#4321; &#4307;&#4320;&#4317;: </strong>"+event.pro_date;
	};
	scheduler.attachEvent("onEventSave",function(id,ev){
		// alert(ev.start_date);
		if (ev.fname.length<4) {
			dhtmlx.alert("&#4321;&#4304;&#4334;&#4308;&#4314;&#4312; &#4306;&#4309;&#4304;&#4320;&#4312; &#4304;&#4323;&#4330;&#4312;&#4314;&#4308;&#4305;&#4308;&#4314;&#4312;&#4304;");
			return false;
		}
		else if(ev.tel<9){
			dhtmlx.alert("&#4322;&#4308;&#4314;&#4308;&#4324;&#4317;&#4316;&#4312;&#4321; &#4316;&#4317;&#4315;&#4308;&#4320;&#4312; &#4304;&#4320;&#4304;&#4321;&#4320;&#4323;&#4314;&#4304;&#4307;&#4304;&#4304; &#4328;&#4308;&#4327;&#4309;&#4304;&#4316;&#4312;&#4314;&#4312;");
			return false;
		}
		else if(!Number(ev.tel)){
			dhtmlx.alert("&#4322;&#4308;&#4314;&#4308;&#4324;&#4317;&#4316;&#4312;&#4321; &#4316;&#4317;&#4315;&#4308;&#4320;&#4312; &#4304;&#4320;&#4304;&#4321;&#4332;&#4317;&#4320;&#4304;&#4307;&#4304;&#4304; &#4328;&#4308;&#4327;&#4309;&#4304;&#4316;&#4312;&#4314;&#4312; &#4306;&#4304;&#4315;&#4317;&#4312;&#4327;&#4308;&#4316;&#4308;&#4311; &#4315;&#4334;&#4317;&#4314;&#4317;&#4307; &#4330;&#4312;&#4324;&#4320;&#4308;&#4305;&#4312;");
			return false;			
		}
		else if (ev.personal<1 || !Number(ev.personal)) {
			dhtmlx.alert("&#4318;&#4308;&#4320;&#4321;&#4317;&#4316;&#4304;&#4314;&#4312;&#4321; &#4315;&#4312;&#4311;&#4312;&#4311;&#4308;&#4305;&#4304; &#4304;&#4323;&#4330;&#4312;&#4314;&#4308;&#4305;&#4308;&#4314;&#4312;&#4304;");
			return false;
		}
		setTimeout(function(){
			display=$("body .dhx_cal_light_wide").css("display");
			if(display=="block"){
				dhtmlx.alert("ა� ჩეულ თა� იღსა და დ� ოზე ხელოსანი დაკავებულია");
			}
		},500);
		return true;
		// if(ev.start_date && ev.end_date){
		// 	start_time=fixtime(ev.start_date,2)
		// 	end_time=fixtime(ev.end_date,2);
		// 	$.post(urlSite+'Schedule/ChackbBoking',{start_time : start_time,end_time: end_time,personal : ev.personal},function(e){
		// 		if(e==1){
		// 			dhtmlx.alert("ა� ჩეულ თა� იღსა და დ� ოზე ხელოსანი დაკავებულია");
		// 			return false;
		// 		}
		// 	});
		// }
		// else return false;
		// return true;
	});	
	$(".list-personals-res,.siblingburger,.personalList").on("click",function() {
		$(".peopleLists").fadeToggle("slow");
	});	 	
}	
function show_minical(){
    if (scheduler.isCalendarVisible()){
        scheduler.destroyCalendar();
    } else {
        scheduler.renderCalendar({
            position:"dhx_minical_icon",
            date:scheduler._date,
            navigation:true,
            handler:function(date,calendar){
                scheduler.setCurrentView(date);
                scheduler.destroyCalendar()
                console.log(date);
            }
        });
    }
}		
$(function(){
	$(".dhx_cal_next_button,.dhx_cal_prev_button").click(function(){
		MarkToday();
	});
	$(".personalList").on('click',function(){
		id=$(this).data('id');
		$(".personalList").removeClass("activePersonal");
		thisId=$(this).data('id');
		$(".personalList[data-id='"+thisId+"']").addClass("activePersonal");

		var state = { 'page_id': 1, 'user_id': 5 };
		var title = 'Hello World';
		office=urlsplit();
		var url = urlSite+"office/"+office+"/"+id;
		history.pushState(state, title, url);
		ajaxScheduler(id);
	});
});
function MarkToday(){
	var today = new Date();
	$(".dhx_scale_bar").removeClass("today");
	setTimeout(function(){
		if($(".dhx_cal_date").html().split(" ")[2]==today.getFullYear()){
			for(i=0;i<7;i++){
				dayMonth=$(".dhx_cal_header").find(".dhx_scale_bar").eq(i).html().split(".")[1];
				if(dayMonth==((today.getMonth()+1)+"/"+today.getDate())){
					$(".dhx_cal_header").find(".dhx_scale_bar").eq(i).addClass("today");
				}
			}
		}
	},10);
}
function ajaxScheduler(arg2){
	test++;
	test2=0;
	scheduler.clearAll();
	person="?company="+urlsplit()+"&";
	if(arg2 >0)person+='personal='+arg2+"&";
	else person+='';
	MarkToday();
	scheduler.init('scheduler_here',new Date(Date.now()),"week");
	scheduler.load(urlSite+"calendar/events.php"+person+"?uid="+scheduler.uid());		
	$('body').on('click','.dhx_save_btn_set',function(){
		test2++;
		if(test==test2){
			var dp = new dataProcessor(urlSite+"calendar/events.php");
			dp.init(scheduler);	
		}
	});
	test=0;test2=0;
}
function fixtime(time,fix){
	number=Number(JSON.stringify(time).split("T")[1].slice(0,2))+4;
	if(number<10)number="0"+number;
	if(fix==1)return number+JSON.stringify(time).split("T")[1].slice(2,5);	
	left=JSON.stringify(time).split("T")[0].slice(1);
	right=JSON.stringify(time).split("T")[1].substr(2,10)+"000";
	return left+" "+number+right;
}
function urlsplit(){
	office=String(window.location.href).split("/"); 
	for (index = 0; index < office.length; index++) {
	  	if(office[index]=="")office.splice(index,1);
	}
	return office[3]; 
}