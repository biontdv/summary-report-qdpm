
<!DOCTYPE html>
<title>qdPM Custom Report</title>
<head>
	<script src="https://cdn.ravenjs.com/3.10.0/raven.min.js" type="text/javascript" charset="utf-8"></script>
	<script>Raven.config('https://25a6d5e8c35148d195a1967d8374ffca@sentry.dhtmlx.ru/6').install()</script>
	<script src="https://docs.dhtmlx.com/gantt/codebase/dhtmlxgantt.js" type="text/javascript" charset="utf-8"></script>
	<script src=https://docs.dhtmlx.com/gantt/codebase/ext/dhtmlxgantt_tooltip.js></script>	
	<link rel="stylesheet" href="https://dhtmlx.com/docs/products/dhtmlxGantt/gantt/skins/dhtmlxgantt_broadway.css?v=4.0" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="https://dhtmlx.com/docs/products/dhtmlxGantt/gantt/skins/dhtmlxgantt_broadway.css?v=4.0" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="shortcut icon" type="text/css" href="image/favicon.ico">
		
	<style type="text/css" media="screen">
		html, body{
			margin:0px;
			padding:0px;
			height:100%;
			overflow:hidden;
		}
		.sample_header input, .sample_header span, .sample_header strong{
			vertical-align: middle;
		}
		#filter_days, #filter_hours{
			display: inline-block;
		}
		.sample_header input{
			margin: 0 0 0 6px;
		}
		.sample_header label span{
			padding-right: 4px;
		}
		.sample_header label{
			cursor:pointer;
		}

		.project{
			background:#3C9445;
			border-color: #3C9445;
		}
		.project .gantt_task_progress{
			background:#65C16F;
			box-shadow: none;
			border:none;
		}

		.weekend{ background: #f4f7f4 !important;}
		.gantt_selected .weekend{
			background:#FFF3A1 !important;
		}
		.gantt_task_line.project{
			background-image: none;
		}
		.gantt_task_line {
			background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAIAAAAmkwkpAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDowNEE4NEUwREFFQTYxMUUzOEMzREFBRTVCQjg1NkI5NiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDowNEE4NEUwRUFFQTYxMUUzOEMzREFBRTVCQjg1NkI5NiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjA0QTg0RTBCQUVBNjExRTM4QzNEQUFFNUJCODU2Qjk2IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjA0QTg0RTBDQUVBNjExRTM4QzNEQUFFNUJCODU2Qjk2Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+u/+i7gAAACRJREFUeNpidD34mwEMLn1kYIKzgIAFQgGBHj9MBsgCAoAAAwAVeQfO2h1NhwAAAABJRU5ErkJggg==);
		}

		.controls_bar{
			border-top:1px solid #bababa;
			border-bottom:1px solid #bababa;
			clear:both;
			margin-top:-10px;
			height:28px;
			background:#f1f1f1;
			color:#494949;
			font-family:Arial, sans-serif;
			font-size:13px;
			padding-left:10px;
			line-height:25px;

		}
.gantt_task .gantt_task_scale .gantt_scale_cell{
	font-size: 11px;
}

.gantt_grid_scale{
	height: 20px;
	font-size: 11px;
}
.gantt_cell{
	font-size: 11px;
}
.gantt_task_content{
	font-size: 11px;
}

	</style>
</head>
<body onresize="modSampleHeight()">
<!--[if lte IE 7]>
<style type="text/css">div{display:none;}</style>
<h4 style='text-align:center; font-family:Arial; margin-top:50px;'>Unfortunately dhtmlxGantt 2.0 doesn't support IE6 and IE7 browsers.<br>Please open these demos in different browser or in IE8+.</h3>
<![endif]-->
	<script>
		function modSampleHeight(){
			var headHeight = 122;

			var sch = document.getElementById("gantt_here");
			sch.style.height = (parseInt(document.body.offsetHeight)-headHeight)+"px";
			var contbox = document.getElementById("contbox");
			contbox.style.width = (parseInt(document.body.offsetWidth)-300)+"px";

			gantt.setSizes();
		}
	</script>
		<div id="contbox" style="float:left;color:white;margin:22px 75px 0 75px; overflow:hidden;font: 17px Arial,Helvetica;color:white">
		</div>
		</div>
		<div class='controls_bar'>
			<strong> Filtering: &nbsp; </strong>
			<label>
				<input name='filter' onclick='filter_tasks(this);' type='radio' value='' checked='true'>
				<span>All tasks</span></label>
			<label>
				<input name='filter' onclick='filter_tasks(this);' type='radio' value='1'>
				<span>Low priority</span></label>
			<label>
				<input name='filter' onclick='filter_tasks(this);' type='radio' value='2'>
				<span>High priority</span></label>
			<span>&nbsp; &nbsp; | &nbsp; &nbsp; </span>
			<strong> Zooming: &nbsp; </strong>
			<label>
				<input name='scales' onclick='zoom_tasks(this)' type='radio' value='week'>
				<span>Hours</span></label>
			<label>
				<input name='scales' onclick='zoom_tasks(this)' type='radio' value='trplweek'  checked='true'>
				<span>Days</span></label>
			<label>
				<input name='scales' onclick='zoom_tasks(this)' type='radio' value='year'>
				<span>Months</span></label>
			<label>

			<div id="filter_hours">

				<span>&nbsp; &nbsp; | &nbsp; &nbsp; </span>
				<strong> Display: &nbsp; </strong>
				<label>
					<input name='scales_filter' onclick='set_scale_units(this)' type='radio' value='full_day'>
					<span>Full day</span>
				</label>
				<label>
					<input name='scales_filter' onclick='set_scale_units(this)' type='radio' value='work_hours'>
					<span>Office hours</span>
				</label>
			</div>
			<div id="filter_days">

				<span>&nbsp; &nbsp; | &nbsp; &nbsp; </span>
				<strong> Display: &nbsp; </strong>
				<label>
					<input name='scales_filter' onclick='set_scale_units(this)' type='radio' value='full_week'>
					<span>Full week</span>
				</label>
				<label>
					<input name='scales_filter' onclick='set_scale_units(this)' type='radio' value='work_week'>
					<span>Workdays</span>
				</label>
			</div>
		</div>
	</div>

	<div id="gantt_here" style='width:100%; height:100%;'></div>
	<script type="text/javascript">
var demo_tasks = {
	data:[
	@forEach($projectData as $key => $elementdata)
		{"id":{{$elementdata->id_project}}, "id_project_pop":"{{$elementdata->id_project}}","label":"No Label", "status":"{{$elementdata->status_project}}","prioritys":"{{$elementdata->priority}}","type":"{{$elementdata->nama_type_projects}}","due_date":"{{$elementdata->due_date}}", "text":"{{$elementdata->name_projects}}","assigned_to":"{{$elementdata->assigned_to}}","created_at":"{{$elementdata->created_at}}", "created_by":"{{$elementdata->created_by}}", "order":"10", progress: {{$elementdata->progress?$elementdata->id_priority:'100'}}, open: false, priority:{{$elementdata->id_priority?$elementdata->id_priority:'100'}}, project:1},
		{"id":{{$elementdata->id_tasks}}12, "id_project_pop":"{{$elementdata->id_tasks}}","label":"{{$elementdata->label}}", "status":"{{$elementdata->task_status}}","prioritys":"{{$elementdata->priority}}","type":"{{$elementdata->name_type}}","due_date":"{{$elementdata->due_date}}", "text":"{{$elementdata->name_projects}}","assigned_to":"{{$elementdata->assigned_to}}","created_at":"{{$elementdata->created_at}}", "created_by":"{{$elementdata->created_by}}", "text":"{{$elementdata->name}}", "start_date":"{{$elementdata->start_date}}", "duration":"{{$elementdata->lama}}","deskripsi":"{{$elementdata->deskripsi}}", progress:0.5, "order":"10", progress: 0.6, "parent":"{{$elementdata->id_project}}", open: true, priority:{{$elementdata->id_priority?$elementdata->id_priority:'100'}} },
	@endforeach
	],	
	links:[
	@forEach($projectData as $elementdatalink)
		{id:"{{$elementdatalink->id_tasks}}100",source:"{{$elementdatalink->id_project}}",target:"{{$elementdatalink->id_tasks}}12",type:"1"},
	@endforeach
	]
};

		gantt.attachEvent("onBeforeTaskDisplay", function(id, task){
			if (gantt_filter)
				if (task.priority != gantt_filter)
					return false;
			
			return true;
		});

		gantt.templates.scale_cell_class = function(date){
		    if(date.getDay()==0||date.getDay()==6){
		        return "weekend";
		    }
		};
		gantt.templates.task_cell_class = function(item,date){
		    if(date.getDay()==0||date.getDay()==6){ 
		        return "weekend" ;
		    }
		};

		var gantt_filter = 0;
		function filter_tasks(node){
			gantt_filter = node.value;
			gantt.refreshData();
		}


		function show_scale_options(mode){
			var hourConf = document.getElementById("filter_hours"),
				dayConf = document.getElementById("filter_days");
			if(mode == 'day'){
				hourConf.style.display = "none";
				dayConf.style.display = "";
				dayConf.getElementsByTagName("input")[0].checked = true;
			}else if(mode == "hour"){
				hourConf.style.display = "";
				dayConf.style.display = "none";
				hourConf.getElementsByTagName("input")[0].checked = true;
			}else{
				hourConf.style.display = "none";
				dayConf.style.display = "none";
			}
		}
		function set_scale_units(mode){
			if(mode && mode.getAttribute){
				mode = mode.getAttribute("value");
			}

			switch (mode){
				case "work_hours":
					gantt.config.subscales = [
						{unit:"hour", step:1, date:"%H"}
					];
					gantt.ignore_time = function(date){
						if(date.getHours() < 9 || date.getHours() > 16){
							return true;
						}else{
							return false;
						}
					};

					break;
				case "full_day":
					gantt.config.subscales = [
						{unit:"hour", step:3, date:"%H"}
					];
					gantt.ignore_time = null;
					break;
				case "work_week":
					gantt.ignore_time = function(date){
						if(date.getDay() == 0 || date.getDay() == 6){
							return true;
						}else{
							return false;
						}
					};

					break;
				default:
					gantt.ignore_time = null;
					break;
			}
			gantt.render();
		}


		function zoom_tasks(node){
			switch(node.value){
				case "week":
					gantt.config.scale_unit = "day"; 
					gantt.config.date_scale = "%d %M"; 

					gantt.config.scale_height = 60;
					gantt.config.min_column_width = 30;
					gantt.config.subscales = [
  						  {unit:"hour", step:1, date:"%H"}
					];
					show_scale_options("hour");
				break;
				case "trplweek":
					gantt.config.min_column_width = 70;
					gantt.config.scale_unit = "day"; 
					gantt.config.date_scale = "%d %M"; 
					gantt.config.subscales = [ ];
					gantt.config.scale_height = 35;
					show_scale_options("day");
				break;
				case "month":
					gantt.config.min_column_width = 70;
					gantt.config.scale_unit = "week"; 
					gantt.config.date_scale = "Week #%W"; 
					gantt.config.subscales = [
  						  {unit:"day", step:1, date:"%D"}
					];
					show_scale_options();
					gantt.config.scale_height = 60;
				break;
				case "year":
					gantt.config.min_column_width = 70;
					gantt.config.scale_unit = "month"; 
					gantt.config.date_scale = "%M"; 
					gantt.config.scale_height = 60;
					show_scale_options();
					gantt.config.subscales = [
  						  {unit:"month", step:1, date:"#%W"}
					];
				break;
			}
			set_scale_units();
			gantt.render();
		}

		show_scale_options("day");
		gantt.config.details_on_create = true;

		gantt.templates.task_class = function(start, end, obj){
			return obj.project ? "project" : "";
		}

		gantt.config.columns = [
		    {name:"text",       label:"Task name",  width:"*", tree:true },
		    {name:"progress",   label:"Progress",  template:function(obj){
				return Math.round(obj.progress*1)+"%";
		    }, align: "center", width:60 },
		    {name:"priority",   label:"Priority",  template:function(obj){
				return gantt.getLabel("priority", obj.priority);
		    }, align: "center", width:60 },
		    // {name:"add",        label:"",           width:44 }
		];
		gantt.config.grid_width = 390;

		gantt.attachEvent("onTaskCreated", function(obj){
			obj.duration = 4;
			obj.progress = 0.25;
		})

		gantt.locale.labels["section_priority"] = "Priority";
	    gantt.config.lightbox.sections = [
	        {name: "description", height: 38, map_to: "text", type: "textarea", focus: true},
	        {name: "priority", height: 22, map_to: "priority", type: "select", options: [
	        	{key:"1", label: "Urgent"}, 
	        	{key:"2", label: "Hight"}, 
	        	{key:"3", label: "Low"}, 
	        	{key:"4", label: "Unknown"}, 
	        	{key:"5", label: "Medium"}, 
	        	{key:"100", label: ""} ]},
	        {name: "time", type: "duration", map_to: "auto", time_format:["%d","%m","%Y","%H:%i"]}
	    ];

		gantt.init("gantt_here");
		gantt.templates.tooltip_text = function(start,end,task){
		    return "<h2>Task "+task.text+"</h2><div class=kotak>"+task.deskripsi+"</div><table border=1 class='table-border-popup'><tr><td colspan= 2></td</tr><tr><td>ID </td><td>"+task.id_project_pop+" </td></tr><tr><td>Label </td><td>"+task.label+" </td></tr><tr><td>Status </td><td>"+task.status+" </td></tr><tr><td>Priority </td><td>"+task.prioritys+" </td></tr><tr><td>type </td><td>"+task.type+" </td></tr><tr><td>Start Date </td><td>"+task.start_date+" </td></tr><tr><td>Due Date </td><td>"+task.due_date+"</td></tr><tr><td>Progress</td><td>"+task.progress+"%</td></tr><tr><td>Assigned To </td><td>"+task.assigned_to+" </td></tr><tr><td>Created At </td><td>"+task.created_at+"</td></tr><tr><td>Created By </td><td>"+task.created_by+"</td></tr></table>";
		    // "<b>Task:</b> "+task.text+"<br/><b>Duration:</b> "+task.duration+"</br><b>Status :</b>"+task.priority+"</br><b>progress :</b>"+task.progress+"</br><b>Status :</b>"+task.id+"</br><b>Status :</b>"+task.status+"</br><b>Status :</b>"+task.status;
		};

		modSampleHeight();
		gantt.parse(demo_tasks);

</script>
<style type="text/css">
.kotak{
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-box-orient: vertical;
   -webkit-line-clamp: N; /* number of lines to show */
   line-height: X;        /* fallback */
   max-height: X*N;       /* fallback */	
}

h2{
	padding: 1px;
}
table {
/*    font-family: arial, sans-serif;
*/    border-collapse: collapse;
	  width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 2px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

	<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-11031269-1', 'auto');
		ga('send', 'pageview');
	</script>
	<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 959416068;
		var google_custom_params = window.google_tag_params;
		var google_remarketing_only = true;
		/* ]]> */
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
	<noscript>
		<div style="display:inline;">
			<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/959416068/?guid=ON&amp;script=0"/>
		</div>
	</noscript>

	</body>