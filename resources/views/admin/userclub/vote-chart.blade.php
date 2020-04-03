<div>
    <ul class="nav nav-tabs">
        <li class="nav active"><a data-toggle="tab" href="#circle" id="bars" aria-expanded="true">نمودار</a></li>
    </ul>
    <?php $titles=array();?>
    @if(isset($votes) && count($votes) > 0)
        @foreach($votes as $vote)
            <?php
            if (!isset($titles[$vote->ansTitle])){
                $titles[$vote->ansTitle] = $vote->ansTitle;
                $title[] = $vote->ansTitle;
                $data[$vote->ansTitle] = $vote->voteSum;
            }else{
                $data[$vote->ansTitle] += $vote->voteSum;
            }
            ?>
        @endforeach
        <div class="tab-content">
            <div id="circle">
                <?php echo highCharts('سوال',$title,'تعداد','qans','pie',$data,true)?>
                <div id="qans"></div>
            </div>
        </div>
    @else
        <p>موردی یافت نشد.</p>
    @endif
</div>