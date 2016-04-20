// 
function init(id) {
	scheduler.config.xml_date="%Y-%m-%d %H:%i";
	scheduler.config.time_step = 15;
	scheduler.config.first_hour = 9;
	scheduler.config.last_hour = 24;
	scheduler.config.details_on_dblclick = true;
	scheduler.config.details_on_create = true;
	// scheduler.config.readonly = true;
	scheduler.templates.hour_scale = function(date){
        var hour = date.getHours();
        ampm = hour >= 12 ? 'pm' : 'am';
        hours=hour <= 12 ? hour : (hour-12);
        return hours+ampm;	
	};


		
	scheduler.templates.week_date = function(date){
		arrayMonth=new Array("იანვარი","თებერვალი","მარტი","აპრილი","მაისი","ივნისი","ივლისი","აგვისტო","სექტემბერი","ოქტომბერი","ნოემბერი","დეკემბერი");
		datee=date.getDate()+" "+arrayMonth[date.getMonth()]+" "+date.getFullYear();
		return datee;
	};
	scheduler.templates.week_scale_date = function(datee){
		arrayWeek=new Array("კვი","ორშ","სამ","ოთხ","ხუთ","პარ","შაბ");
		datee=arrayWeek[datee.getDay()]+"."+(datee.getMonth()+1)+"/"+datee.getDate();
		return datee;
	};	
	scheduler.templates.event_text = function(start, end, event){
		return '';
	};
	scheduler.templates.lightbox_header = function(start, end, event){
		html='<span class="FirstTitle">Event |</span><span class="SecondTitle">თმის მოვლა</span>';
		return html;
	};
	scheduler.config.icons_select = [
	   "icon_details",
	   "icon_delete"
	];
	procedur=[{ key: 1, label: 'თმის შეჭრა'},{ key: 2, label: 'თმის შეღებვა' },{ key: 3, label: 'დავარცხნა' }];
	personal=[{ key: 1, label: 'კარენა'},{ key: 2, label: 'ლეილა' },{ key: 3, label: 'გელა' }];								
	scheduler.config.lightbox.sections=[	
		{name:"სახელი,გვარი", height:25, map_to:"fname", type:"textarea" , focus:true},
		{name:"პროცედურა", height:43, type:"select",options: procedur, map_to:"procedur" },
		{name:"ხელოსანი", height:43, type:"select", options: personal, map_to:"personal" },
		{name:"თარიღი", height:72, type:"calendar_time", map_to:"auto"}
	];
	change=window.location.search.slice(0,11);
	if(change.length!=11)change='';
	else change+="&";
	MarkToday();
	scheduler.init('scheduler_here',new Date(Date.now()),"week");
	scheduler.load("http://bookchachava.ge/codebase/events.php"+change+"?uid="+scheduler.uid());
	var dp = new dataProcessor("http://bookchachava.ge/assets/codebase/events.php");
	dp.init(scheduler);	
	scheduler.templates.event_header=function(start,end,event){
	     return event.fname;
	}
 


	
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
            }
        });
    }
}
$(function(){
	$(".dhx_cal_next_button,.dhx_cal_prev_button").click(function(){
		MarkToday();
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