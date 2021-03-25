<h1>{{ $selectedProject->name or '' }}</h1>

        <table id="example1" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Phase Name</th>
                    <th>Opened</th>
                    <th>Suspended</th>
                    <th>Re-Open</th>
                    <th>Done</th>
                    <th>Completed</th>
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
                @foreach($tableSummary as $element)
                <tr>
                    <th>{{$element->phase_name}}</th>
                    <th>{{$element->opened}}</th>
                    <?php $jumlah_opened += $element->opened; ?>
                    <th>{{$element->suspended}}</th>
                    <?php $jumlah_suspended += $element->suspended; ?>
                    <th>{{$element->reOpened}}</th>
                    <?php $jumlah_reOpened += $element->reOpened; ?>
                    <th>{{$element->done}}</th>
                    <?php $jumlah_done += $element->done; ?>
                    <th>{{$element->completed}}</th>
                    <?php $jumlah_completed += $element->completed; ?>
                 </tr>
                 @endforeach
            </tbody>
            <?php
                $total = $jumlah_opened + $jumlah_suspended + $jumlah_reOpened + $jumlah_done + $jumlah_completed;
            ?>
            <tfoot>
                <tr>
                    <th><center>Subtotal :</center></th>
                    <th>{{$jumlah_opened}}</th>
                    <th>{{$jumlah_suspended}}</th>
                    <th>{{$jumlah_reOpened}}</th>
                    <th>{{$jumlah_done}}</th>
                    <th>{{$jumlah_completed}}</th>
                </tr>
                <tr>
                    <th><center>Total :</center></th>
                    <th colspan="5"><center><?php echo $total; ?></center></th>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
    <div class="col-md-12 panel panel-default">
    <span><h3>Query Open Task</h3></span>
        <br>
        <table id="example2" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Assigned To</th>
               </tr>
            </thead>
            <tbody>
                @foreach($tabletasksSummary as $data)
                <tr>
                    <th>{{$data->id}}</th>
                    <th>{{$data->name}}</th>
                    <th>{{$data->description}}</th>
                    <th>{{$data->assigned_to}}</th>
                 </tr>
                 @endforeach
            </tbody>
        </table>

<br>
{!! $tabletasksSummary->render() !!}