@extends('layouts.app')

@section('content')

<!-- table -->
<br>
<br>
<h2>Dashboard</h2>
<div class="box-body table-responsive panel panel-default">
    {!! Form::open(['action' => 'ProjectSummaryController@index', 'method' => 'get', 'id' => 'select-project-form']) !!}
    <select id="project_select" name="project-id" class="form-group form-control-lg col-md-4">
    <option value="">Select Project</option>
        @foreach($projects as $project)
            <option value={{ $project->id }} @if(isset($selectedProject))@if($selectedProject->id == $project->id) selected @endIf @endIf>
            {{ $project->name }}
    </option>
        @endforeach
    </select>
    {!! Form::close() !!}
    {!! Form::open(['action' => 'ProjectSummaryController@exportProjectSummary', 'method' => 'get']) !!}
    {{ Form::hidden('project-id', $selectedProject->id, ['id' => 'project-id']) }}
    <span class="btn-responsive col-md-4">
    {{ Form::submit('Export', ['class' => 'right  btn btn-md btn-primary']) }}
    </span>
    {!! Form::close() !!}
<hr>

<!-- chart -->
<div class= "col-md-12">
    <div class="col-md-6">
    <div class="box-body table-responsive panel panel-default">
        @include('charts.pie')
    </div>
    </div>
    <div class="col-md-6">
    <div class="box-body table-responsive panel panel-default">
         @include('charts.barChart')
    </div>
    </div>

</div>

<div class="col-md-12 panel panel-default">
		<br>
        <table border="1" id="example1" class="table-striped" width="100%">
            <thead>
                <tr>
                    <th width="20%">Phase Name</th>
                    <th width="3%">Opened</th>
                    <th width="9%">Suspended</th>
                    <th width="8%">Re-Open</th>
                    <th width="6%">Done</th>
                    <th width="4%">Completed</th>
               </tr>
            </thead>
            <tbody>
                <?php
                    $jumlah_opened = 0;
                    $jumlah_suspended = 0;
                    $jumlah_reOpened = 0;
                    $jumlah_done = 0;
                    $jumlah_completed = 0;
                ?>
                @foreach($projectSummary as $element)
                <tr>
                    <th style="font-weight: normal;">{{$element->phase_name}}</th>
                    <th style="font-weight: normal;">{{$element->opened}}</th>
                    <?php $jumlah_opened += $element->opened; ?>
                    <th style="font-weight: normal;">{{$element->suspended}}</th>
                    <?php $jumlah_suspended += $element->suspended; ?>
                    <th style="font-weight: normal;">{{$element->reOpened}}</th>
                    <?php $jumlah_reOpened += $element->reOpened; ?>
                    <th style="font-weight: normal;">{{$element->done}}</th>
                    <?php $jumlah_done += $element->done; ?>
                    <th style="font-weight: normal;">{{$element->completed}}</th>
                    <?php $jumlah_completed += $element->completed; ?>
                 </tr>
                 @endforeach
            </tbody>
            <?php
                $total = $jumlah_opened + $jumlah_suspended + $jumlah_reOpened + $jumlah_done + $jumlah_completed;
            ?>
            <tbody>
                <tr>
                    <th style="font-weight: normal;"><center>Subtotal :</center></th>
                    <th style="font-weight: normal;">{{$jumlah_opened}}</th>
                    <th style="font-weight: normal;">{{$jumlah_suspended}}</th>
                    <th style="font-weight: normal;">{{$jumlah_reOpened}}</th>
                    <th style="font-weight: normal;">{{$jumlah_done}}</th>
                    <th style="font-weight: normal;">{{$jumlah_completed}}</th>
                </tr>
                <tr>
                    <th style="font-weight: normal;"><center>Total :</center></th>
                    <th style="font-weight: normal;" colspan="5"><center><?php echo $total; ?></center></th>
                </tr>
            </tbody>
        </table>
        <style type="text/css">
            #example1{
                font-size: 11px;
            }
            #example1 thead th {
                background-color:#3d3e40;
                color: #FFFFFF;
                text-transform: capitalize;
                font-size: 12px;
            }
        </style>
    </div>
    </div>
    <div class="col-md-12 panel panel-default">
    <span><h3>Tasks Open</h3></span>
        <br>
        <table border="1" id="example2" class="table-striped">
            <thead>
                <tr>
                    <th width="5%">Task ID</th>
                    <th width="30%">Name</th>
                    <th width="20%">Description</th>
                    <th width="9%">Assigned To</th>
               </tr>
            </thead>
            <tbody>
                @foreach($tasksSummary as $data)
                <tr>
                    <th style="font-weight: normal;">{{$data->id}}</th>
                    <th style="font-weight: normal;">{{$data->name}}</th>
                    <th style="font-weight: normal;">{!!$data->description!!}</th>
                    <th style="font-weight: normal;">{{$data->assigned_to}}</th>
                 </tr>
                 @endforeach
            </tbody>
        </table>
                <style type="text/css">
            #example2{

                font-size: 11px;
            }
            #example2 thead th {
                background-color:#3d3e40;
                color: #FFFFFF;
                text-transform: capitalize;
                font-size: 12px;
            }
            /*#example1 th,td {
               width: 10px;
            }*/
        </style>
    </div>
</div>
<!-- script -->
<script src={{asset("js/bootstrap.min.js")}}></script>
<script src={{asset("js/dataTables.bootstrap.js")}}></script>
<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="javascript" src="http://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(function() {
     $('#example1').dataTable();
    });
    $(function() {
     $('#example2').dataTable();
    });
    $(document).ready(function() {
        $('#project_select').change(function() {
            $('#select-project-form').submit();
        });
    });
</script>
@stop
