@extends('layouts.app')
@section('content')

<!-- table-->
<br>
<br>
<br>
<div class="box-body table-responsive panel panel-default">
    {!! Form::open(['action' => 'ProjectSummaryController@picSummary', 'method' => 'get', 'id' => 'select-project-form']) !!}
    <select id="project_select" name="project-id" class="form-group form-control-lg col-md-4">
    <option value="">Select Project</option>
        @foreach($projects as $project)
            <option value={{ $project->id }} @if(isset($selectedProject))@if($selectedProject->id == $project->id) selected @endIf @endIf>
            {{ $project->name }}
    </option>
        @endforeach
    </select>
    {!! Form::close() !!}
    {!! Form::open(['action' => 'ProjectSummaryController@exportPicSummary', 'method' => 'get']) !!}

    {{ Form::hidden('project-id', $selectedProject->id, ['id' => 'project-id']) }}
        <span class="btn-responsive col-md-4">
        {{ Form::submit('Export', ['class' => 'right  btn btn-md btn-primary']) }}
        </span>
    {!! Form::close() !!}

<div class="col-md-12">
<div class="box-body table-responsive panel panel-default">
        @include('charts.bar')
</div>
</div>

 <div class="col-md-12">
         <table border="1" id="table1" class="table-striped" width="100%">
            <thead>
                <tr>
                    <th width="2%">Username</th>
                    <th width="5%">Phase Name</th>
                    <th width="1%">Opened</th>
                    <th width="1%">Suspended</th>
                    <th width="2%">Re-Open</th>
                    <th width="1%">Done</th>
                    <th width="1%">Completed</th>
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
                @foreach($picSummary as $element)
                <tr>
                    <th style="font-weight: normal;">{{$element->name_user_summary}}</th>
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
                    <th colspan="2" style="font-weight: normal;"><center>Subtotal :</center></th>
                    <th style="font-weight: normal;">{{$jumlah_opened}}</th>
                    <th style="font-weight: normal;">{{$jumlah_suspended}}</th>
                    <th style="font-weight: normal;">{{$jumlah_reOpened}}</th>
                    <th style="font-weight: normal;">{{$jumlah_done}}</th>
                    <th style="font-weight: normal;">{{$jumlah_completed}}</th>
                </tr>
                <tr>
                    <th colspan="2" style="font-weight: normal;"><center>Total :</center></th>
                    <th colspan="5" style="font-weight: normal;"><center><?php echo $total; ?></center></th>
                </tr>
            </tbody>
		</table>
        <br>
        <style type="text/css">
            #table1{
                font-size: 11px;
            }
             #table1 thead th {
                background-color:#3d3e40;
                color: #FFFFFF;
                text-transform: capitalize;
                font-size: 12px;
            }
        </style>        
    </div>
	</br>
     <div class="col-md-12 panel panel-default">
    <span><h3>Tester</h3></span>
    <table border="1" id="table3" class="table-striped" width="100%">
      <thead>
        <th width="25%">Username</th>
        <th width="2%">Total Test</th>
      </thead>
      <tbody>
        <?php
            $totalTest = 0;
        ?>
        @foreach($tester as $testers)
        <tr>
          <th style="font-weight: normal;">{{$testers->name}}</th>
          <th style="font-weight: normal;">{{$testers->total_completed}}</th>
          <?php $totalTest += $testers->total_completed; ?>
        </tr>
        @endforeach
      </tbody>
      <tbody>
          <tr>
              <th style="font-weight: normal;"><center>Total :</center></th>
              <th style="font-weight: normal;"><?php echo $totalTest; ?></th>
          </tr>
      </tbody>
    </table>
    <style type="text/css">
        #table3{
            font-size: 11px;
        }
        #table3 thead th {
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
         <table border="1" id="table2" class="table-striped" width="100%">
            <thead>
                <tr>
                    <th width="1%">Id</th>
                    <th width="15%">Name</th>
                    <th width="13%">Description</th>
                    <th width="2%">Assigned To</th>
                </tr>
            </thead>
            <tbody>
                @foreach($takspicSummary as $takspicSummarys)
                <tr>
                    <th style="font-weight: normal;">{{$takspicSummarys->id}}</th>
                    <th style="font-weight: normal;">{{$takspicSummarys->name}}</th>
                  	<th style="font-weight: normal;">{!!$takspicSummarys->description!!}</th>
                    <th style="font-weight: normal;">{{$takspicSummarys->assigned_to}}</th>
                </tr>
                @endforeach
            </tbody>
		  </table>
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

    </div>

<!-- script -->
<script src={{asset("js/bootstrap.min.js")}}></script>
<script src={{asset("js/dataTables.bootstrap.js")}}></script>
<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="javascript" src="http://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function() {
     $('#table1').dataTable();
    });

    $(function() {
     $('#table2').dataTable();
    });

    $(function() {
      $('#table3').dataTable();
    });

    $(document).ready(function() {
        $('#project_select').change(function() {
            $('#select-project-form').submit();
        });
    });
</script>
@stop
