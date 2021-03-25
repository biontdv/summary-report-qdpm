@extends('layouts.app')
@section('content')
<br>
<br>
<br>
<div class="col-md-12 panel panel-default">
<br>
	<style>
		#table1 tbody #td {
			cursor: pointer;
		}
	</style>
	<div class="row">
	<div class="col-md-6">
	<table border="1" id="table1" class="table-striped" width="99%">
		<thead>
			<tr>
				<th width="12%">PIC</th>
				<th hidden="hidden">ID</th>
				<th width="5%">Idle Date</th>
			</tr>
		</thead>
		<tbody>
			@foreach($idle as $element)
			<tr>
				<td id="td" title="Click to see the detail below" class="pic"><div style="color: blue;">{{$element->assignee_name}}</div></td>
				<td id="id" hidden="hidden">{{$element->assignee_id}}</td>
			    {{-- <td>{{$element->projects_name}}</td> 
				<td>{{$element->start_date ? $element->start_date : 'Undefined'}}</td>
				<td>{{$element->due_date ? $element->due_date : 'Undefined'}}</td> --}}
				<td>{{$element->max_idle ? $element->max_idle : 'Undefined'}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-md-6" style="margin:2.6rem auto; position: relative;">
	<table border="1" id="table2" class="table-striped" width="100%">
		<thead>
			<th width="3%">PIC</th>
			<th width="2%">Project</th>
			<th width="2%">Start Date</th>
			<th width="2%">Due Date</th>
			<th width="2%">Idle Date</th>
		</thead>
		{{-- <tbody>
		@foreach($data as $element2)
		<tr>
			<td>{{$element2->assignee_name}}</td>
			<td>{{$element2->projects_name}}</td>
			<td>{{$element2->start_date ? $element2->start_date : "Undefined"}}</td>
			<td>{{$element2->due_date ? $element2->due_date : "Undefined"}}</td>
			<td>{{$element2->idle_date ? $element2->idle_date : "Undefined" }}</td>
		</tr>
		@endforeach --}}	
	</tbody>
</table>
</div>
</div>
	<style type="text/css">
		    #table1{
                font-size: 11px;
                margin-left: 5px;
            }
            #table1 thead th {
                background-color:#3d3e40;
                color: #FFFFFF;
                text-transform: capitalize;
                font-size: 12px;
            }
	</style>	
<!-- 	<span><h3>Detail</h3></span> -->
</div>
	<style type="text/css">
		    #table2{
                font-size: 11px;
            }
            #table2 thead th {
                background-color:#3d3e40;
                color: #FFFFFF;
                text-transform: capitalize;
                font-size: 12px;
            }
	</style>
<script src={{asset("/js/bootstrap.min.js")}}></script>
<script src={{asset("/js/dataTables.bootstrap.js")}}></script>
<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="javascript" src="http://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script>
	$(function() {
		$('#table2').hide();
		$('#table1').dataTable().off('click','tr').on('click', 'tr', function(e){ 
			$(this).addClass('selected').siblings().removeClass('selected');    
			var value=$(this).find('#id').html();
			$('#table2').show();
			$('#table2').dataTable({
				"processing" : true,
				"bFilter": false,
				"bPaginate": false,
				"ajax" : {
					"url" : 'picDurations/'+value,
					dataSrc : ''
				},
				"columns" : [{
					"data" : "assignee_name"
				},{
					"data" : "projects_name"
				},{
					"data" : "start_date"
				},{
					"data" : "due_date"
				},{
					"data" : "idle_date"
				}],

				"bDestroy" : true
			});
		});   
	});
		// var table = document.getElementById("table1");
		// if (table != null) {
		// 	for (var i = 0; i < table.rows.length; i++) {
		// 		for (var j = 0; j < table.rows[i].cells.length; j++)
		// 			table.rows[i].cells[j].onclick = function () {
		// 				tableText(this);
		// 			};
		// 		}
		// 	}


		  //  	$.ajax({
				// 	url: 'picDurations/'+value,
				// 	type: 'GET',
				// 	dataSrc : '',
				// 	success: function(response)
				// 	{
				// 		console.log(response[0]);
				// 	}
				// });
			</script>
			@stop