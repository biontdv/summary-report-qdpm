<h1>{{ $selectedProject->name or '' }}</h1>

         <table id="table1" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Username</th>
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
                @foreach($tablePicSummary as $element)
                <tr>
                    <th>{{$element->name_user_summary}}</th>
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
                    <th colspan="2"><center>Subtotal :</center></th>
                    <th>{{$jumlah_opened}}</th>
                    <th>{{$jumlah_suspended}}</th>
                    <th>{{$jumlah_reOpened}}</th>
                    <th>{{$jumlah_done}}</th>
                    <th>{{$jumlah_completed}}</th>
                </tr>
                <tr>
                    <th colspan="2"><center>Total :</center></th>
                    <th colspan="5"><center><?php echo $total; ?></center></th>
                </tr>
            </tfoot>
        </table>
    </br>
<br>
{!! $tabletasksPicSummary->render() !!}