@inject('request', 'Illuminate\Http\Request')

<?php
if (count($round) > 0){
    //class TD
    $class="green";
    $class_red="red";
    $class_no="";

    //attivato test?
    $p_ref_sub=$fat_ref_sub=$lac_ref_sub=$u_ref_sub=$scc_ref_sub=$bhb_ref_sub="No";

    //question 1 e 2
    $p_ref_sample=$fat_ref_sample=$lac_ref_sample=$u_ref_sample=$scc_ref_sample=$bhb_ref_sample="No";
    $p_ref_q2=$fat_ref_q2=$lac_ref_q2=$u_ref_q2=$scc_ref_q2=$bhb_ref_q2="";

    //tutti non spuntati
    $p_a=$f_a=$l_a=$u_a=$s_a=0;


    $protein_ref_labcode=$fat_ref_labcode=$lactose_ref_labcode=$urea_ref_labcode=$scc_ref_labcode=$bhb_ref_labcode="&nbsp;";
    $protein_ref_x100=$fat_ref_x100=$lactose_ref_x100=$urea_ref_x100=$scc_ref_x100=$bhb_ref_x100="&nbsp;";
    $protein_ref_dev=$fat_ref_dev=$lactose_ref_dev=$urea_ref_dev=$scc_ref_dev=$bhb_ref_dev="&nbsp;";
    $protein_ref_sdev=$fat_ref_sdev=$lactose_ref_sdev=$urea_ref_sdev=$scc_ref_sdev=$bhb_ref_sdev="&nbsp;";
    $protein_ref_dist=$fat_ref_dist=$lactose_ref_dist=$urea_ref_dist=$scc_ref_dist=$bhb_ref_dist="&nbsp;";
    $protein_ref_m=$fat_ref_m=$lactose_ref_m=$urea_ref_m=$scc_ref_m=$bhb_ref_m="&nbsp;";

    foreach ($round as $r){
        $code_round             = $r->code_round;

        $results_received       = ($r->results_received)?"Yes":"No";
        $results_received_date  = ($r->results_received_date)? date("d-m-Y", strtotime($r->results_received_date)):"";
        switch ($r->code_test) {
            case 'protein_ref':
                $p_ref_sub     = "Yes";
                $p_ref_sample  = ($r->question1)?"Yes":"No";
                $p_ref_q2      = ($r->question2)?"Yes":"No";
                $p_a=1;
                break;
            case 'fat_ref':
                $fat_ref_sub     = "Yes";
                $fat_ref_sample  = ($r->question1)?"Yes":"No";
                $fat_ref_q2      = ($r->question2)?"Yes":"No";
                $f_a=1;
                break;
            case 'lactose_ref':
                $lac_ref_sub     = "Yes";
                $lac_ref_sample  = ($r->question1)?"Yes":"No";
                $lac_ref_q2      = ($r->question2)?"Yes":"No";
                $l_a=1;
                break;

            case 'urea_ref':
                $u_ref_sub     = "Yes";
                $u_ref_sample  = ($r->question1)?"Yes":"No";
                $u_ref_q2      = ($r->question2)?"Yes":"No";
                $u_a=1;
                break;

            case 'scc_ref':
                $scc_ref_sub     = "Yes";
                $scc_ref_sample  = ($r->question1)?"Yes":"No";
                $scc_ref_q2      = ($r->question2)?"Yes":"No";
                $s_a=1;
                break;
        }
    }
}

if (count($data) > 0){
    foreach ($data as $d){
        $icar_code              = $d->icar_code;
        switch ($d->type) {
            case 'protein_ref':
                $protein_ref_labcode = $d->lab_code;
                $protein_ref_x100    = $d->percent;
                $protein_ref_dev     = number_format($d->dev,3);
                $protein_ref_sdev    = number_format($d->s_dev,3);
                $protein_ref_dist    = number_format($d->dist,3);
                $protein_ref_m       = $d->method;
                if ($d->method=="A")$protein_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$protein_ref_m="ISO
                2446|IDF 226";
                break;
            case 'fat_ref':
                $fat_ref_labcode = $d->lab_code;
                $fat_ref_x100    = $d->percent;
                $fat_ref_dev     = number_format($d->dev,3);
                $fat_ref_sdev    = number_format($d->s_dev,3);
                $fat_ref_dist    = number_format($d->dist,3);
                $fat_ref_m       = $d->method;
                if ($d->method=="A")$fat_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$fat_ref_m="ISO
                2446|IDF 226";
                break;
            case 'lactose_ref':
                $lactose_ref_labcode = $d->lab_code;
                $lactose_ref_x100    = $d->percent;
                $lactose_ref_dev     = number_format($d->dev,3);
                $lactose_ref_sdev    = number_format($d->s_dev,3);
                $lactose_ref_dist    = number_format($d->dist,3);
                $lactose_ref_m       = $d->method;
                if ($d->method=="A")$lactose_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$lactose_ref_m="ISO
                2446|IDF 226";
                break;
            case 'urea_ref':
                $urea_ref_labcode = $d->lab_code;
                $urea_ref_x100    = $d->percent;
                $urea_ref_dev     = number_format($d->dev,3);
                $urea_ref_sdev    = number_format($d->s_dev,3);
                $urea_ref_dist    = number_format($d->dist,3);
                $urea_ref_m       = $d->method;
                if ($d->method=="A")$urea_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$urea_ref_m="ISO
                2446|IDF 226";
                break;
            case 'scc_ref':
                $scc_ref_labcode = $d->lab_code;
                $scc_ref_x100    = $d->percent;
                $scc_ref_dev     = number_format($d->dev,2)*100;
                $scc_ref_sdev    = number_format($d->s_dev,2)*100;
                $scc_ref_dist    = number_format($d->dist,2)*100;
                $scc_ref_m       = $d->method;
                if ($d->method=="A")$scc_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$scc_ref_m="ISO
                2446|IDF 226";
                break;

        }
    }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$icar_code}} - Report {{$code_round}} - {{$lab->lab_name}}</title>
    <style>
        @page {
            size: A4;
        }
        body { font-family: Arial, Helvetica, sans-serif; font-size:12px; margin-top:0; padding-top:0;}
        table { margin-top: 3px; width:775px; border: 1px solid #000; }
        table#info { width: 100% !important; border:none; }
        td { text-align:center; padding: 2px; border:1px solid #ccc; width:94px; font-size: 10px;
            vertical-align:middle; }
        span.half_r { width:49%; padding:0; display:inline-block;float:left;}
        span.half_l { width:49%; padding:0; display:inline-block;float:left; border-right:1px solid #000;}
        .double { }
        .left {text-align:left;}
        .right {text-align:right;}
        .tabcode { font-size: 20px; font-weight: bold; width:35px !important; background-color:#e8e8e8; }
        .bold { font-weight: bold; }
        .grey { background-color: #E8E8E8; }
        .red { background-color: #F00; }
        .yellow {background-color:#FF0; }
        .green { background-color:#92D050;}
        .title { font-size: 14px; background-color:#e8e8e8; }
        .note { font-style:italic; }
        #labname { height: 20px; }
        #g td { width: 112px; }
        #header { border: none; width: 775px; margin-top:0; }
        #header .logo { width: 100px; border:none;}
        #header .title { width: 575px; color: #06C; font-size: 18px; font-weight:bold; border: none; background-color: #fff; }
        #header .box { border: 1px solid #ccc; width: 100px; font-size:14px; font-weight:bold;}

        @media print {
            div.newpage {page-break-after: always;}
        }
    </style>
</head>

<body>
<table id="header">
    <tr>
        <td class="logo"><img src="assets/img/logo.png" class="logo" /></td>
        <td class="title">Chemical Reference Methods<br />Laboratory participation codes and Performance analyses</td>
        <td class="box">ICAR PT <br />{{$code_round}}</td>
    </tr>
</table>
{{--<button onclick="call_pdf()">Click me</button>--}}
<table cellspacing="0" id="labname">
    <tr>
        <td style="width:140px" class="bold">Laboratory Name</td>
        <td style="width:615px">{{$lab->lab_name}}</td>
    </tr>
</table>

<table cellspacing="0" id="a">
    <tr>
        <td rowspan="7" class="tabcode">A</td>
        <td colspan="7" class="bold title2">Your participation Codes</td>
    </tr>
    <tr>
        <td rowspan="2" class="left bold">Subscription</td>
        <td class="bold">Fat<sub>ref</sub></td>
        <td class="bold">Protein<sub>ref</sub></td>
        <td class="bold">Lactose<sub>ref</sub></td>
        <td class="bold">Urea<sub>ref</sub></td>
        <td class="bold">SCC<sub>ref/alt</sub></td>
        {{--<td class="bold">BHB</td>--}}
    </tr>
    <tr>
        <td class="@if ($fat_ref_sub=='Yes'){{$class}}@endif">{{$fat_ref_sub}}</td>
        <td class="@if ($p_ref_sub=='Yes') {{$class}} @endif">{{$p_ref_sub}}</td>
        <td class="@if ($lac_ref_sub=='Yes') {{$class}} @endif">{{$lac_ref_sub}}</td>
        <td class="@if ($u_ref_sub=='Yes') {{$class}} @endif">{{$u_ref_sub}}</td>
        <td class="@if ($scc_ref_sub=='Yes') {{$class}} @endif">{{$scc_ref_sub}}</td>
    </tr>
    <tr>
        <td class="left bold">Participation Codes</td>
        <td>{{$fat_ref_labcode}}</td>
        <td>{{$protein_ref_labcode}}</td>
        <td>{{$lactose_ref_labcode}}</td>
        <td>{{$urea_ref_labcode}}</td>
        <td>{{$scc_ref_labcode}}</td>

    </tr>
    <tr> </tr>
    <tr> </tr>
    <tr>
        <td class="left bold">Are all the sample results received?</td>

        <td class="@if ($fat_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$fat_ref_sample}}</td>
        <td class="@if ($p_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$p_ref_sample}}</td>
        <td class="@if ($lac_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$lac_ref_sample}}</td>
        <td class="@if ($u_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$u_ref_sample}}</td>
        <td class="@if ($scc_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$scc_ref_sample}}</td>
    </tr>
</table>

<table cellspacing="0" id="b">
    <tr>
        <td rowspan="2" class="tabcode">B</td>
        <td colspan="2" class="bold title2">Data results received on time</td>
    </tr>
    <tr>
        <!-- la riga seguente può essere No con classe "red" o Yes con classe "green" -->
        <td class="@if ($results_received=='Yes') {{$class}} @else {{$class_red}} @endif">{{$results_received}}</td>
        <td style="width:614px;"> {{$results_received_date}}</td> <!-- prendo la data dal db -->
    </tr>
</table>

<table cellspacing="0" id="c">
    <tr>
        <td rowspan="5" class="tabcode">C</td>
        <td colspan="7" class="bold title2">Have you sent the data with the correct units of measurements?</td>
    </tr>
    <tr>
        <td rowspan="3">&nbsp;</td>
        <td class="bold">Fat<sub>ref</sub></td>
        <td class="bold">Protein*<sub>ref</sub></td>
        <td class="bold">Lactose<sub>ref</sub></td>
        <td class="bold">Urea<sub>ref</sub></td>
        <td class="bold">SCC<sub>ref/alt</sub></td>
        {{--<td class="bold">BHB</td>--}}
    </tr>
    <tr>
        <td>g/100g</td>
        <td>nitrogen g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>SCC*1000/ml</td>
    </tr>
    <tr>
        <!-- può essere Yes con classe "green", No con classe "red", vuoto senza classe -->

        <td class="@if ($fat_ref_q2=='Yes') {{$class}}  @elseif ($fat_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif">{{$fat_ref_q2}}</td>

        <td class="@if ($p_ref_q2=='Yes') {{$class}}  @elseif ($p_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif">{{$p_ref_q2}}</td>

        <td class="@if ($lac_ref_q2=='Yes') {{$class}}  @elseif ($lac_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif">{{$lac_ref_q2}}</td>

        <td class="@if ($u_ref_q2=='Yes') {{$class}}  @elseif ($u_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif">{{$u_ref_q2}}</td>

        <td class="@if ($scc_ref_q2=='Yes') {{$class}}  @elseif ($scc_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif">{{$scc_ref_q2}}</td>

        {{--<td class="@if ($bhb_ref_q2=='Yes') {{$class}}  @elseif ($bhb_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif>{{$bhb_ref_q2}}</td>--}}
    </tr>
    <tr>
        <td colspan="7" class="note grey">* It was requested to report the value in total nitrogen</td>
    </tr>
</table>


<table cellspacing="0" id="d">
    <tr>
        <td rowspan="12" class="tabcode">D</td>
        <td colspan="9" class="bold title2">Ranking of your lab</td>
    </tr>
    <tr>
        <td rowspan="2">&nbsp;</td>
        <td class="bold">Fat<sub>ref</sub></td>
        <td class="bold">Protein*<sub>ref</sub></td>
        <td class="bold">Lactose<sub>ref</sub></td>
        <td class="bold">Urea<sub>ref</sub></td>
        <td class="bold">SCC<sub>ref/alt</sub></td>
    </tr>
    <tr>
        <td>g/100g</td>
        <td>nitrogen g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>SCC*1000/ml</td>
    </tr>

    <tr>
        <td class="bold">Code</td> 		<!-- stampo valore di rank per ogni type; le celle sempre bianche -->
        <td>{{ $fat_ref_labcode }}</td>
        <td>{{ $protein_ref_labcode }}</td>
        <td>{{ $lactose_ref_labcode }}</td>
        <td>{{ $urea_ref_labcode }}</td>
        <td>{{ $scc_ref_labcode }}</td>
    </tr>
    <tr>
        <td class="bold">%</td>			<!-- stampo valore di percent per ogni type; le celle sempre bianche -->
        <td>{{ $fat_ref_x100 }}</td>
        <td>{{ $protein_ref_x100 }}</td>
        <td>{{ $lactose_ref_x100 }}</td>
        <td>{{ $urea_ref_x100 }}</td>
        <td>{{ $scc_ref_x100 }}@if ($s_a>0 && $scc_ref_x100!="")% @endif</td>
    </tr>
    <tr>
        <td class="bold">d</td>
        <!--  se il valore nella cella è all'interno del range, la cella è verde; se è al di fuori, la cella è rossa  -->

        <!-- range: tra -0,020 e +0,020  -->
        <?php
        $class_sd="";
        $class="green";
        if ($fat_ref_dev == '&nbsp;') $class_sd="";
        elseif ($fat_ref_dev > -0.020 &&  $fat_ref_dev < 0.020) $class_sd=$class; else $class_sd=$class_red;
        ?>
        <td class= {{$class_sd}}> {{$fat_ref_dev}}</td>

        <!-- range: tra -0,025 e +0,025  -->
        <?php
        $class_sd="";
        $class="green";
        if ($protein_ref_dev == '&nbsp;') $class_sd="";
        elseif ($protein_ref_dev > -0.025 &&  $protein_ref_dev < 0.025) $class_sd=$class; else $class_sd=$class_red;
        ?>
        <td class= {{$class_sd}}> {{$protein_ref_dev}}</td>


        <!-- range: tra -0.10 e +0.10  -->
        <?php
        $class_sd="";
        $class="green";
        if ($lactose_ref_dev == '&nbsp;') $class_sd="";
        elseif ($lactose_ref_dev > -0.10 &&  $lactose_ref_dev < 0.10) $class_sd=$class; else $class_sd=$class_red;
        ?>
        <td class= {{$class_sd}}> {{$lactose_ref_dev}}</td>

        <!-- range: tra -2,5 e +2,5  -->
        <?php
        $class_sd="";
        $class="green";
        if ($urea_ref_dev == '&nbsp;') $class_sd="";
        elseif ($urea_ref_dev > -2.5 &&  $urea_ref_dev < 2.5) $class_sd=$class; else $class_sd=$class_red;
        ?>
        <td class= {{$class_sd}}> {{$urea_ref_dev}}</td>


        <!-- range: tra -10% e +10%  -->
        <?php
        $class_sd=$xx="";
        $class="green";
        if ($scc_ref_dev!="" && $s_a>0 ) {
            $xx="%";
            if ( $scc_ref_dev > -10 &&  $scc_ref_dev < 10) $class_sd=$class; else $class_sd=$class_red;
        }

        ?>
        <td class= {{$class_sd}}> {{$scc_ref_dev}}{{$xx}}</td>
    </tr>
    <tr>
        <td class="bold">Sd</td>
        <!-- se il valore è superiore al limite, la cella è rossa; se è inferiore, la cella è verde; se è uguale, è bianca -->
        <!-- limite: 0.030 -->
        <?php
        $class_sd="";
        if ($fat_ref_sdev!="" && $f_a>0 ) {
            if ($fat_ref_sdev < 0.030) $class_sd=$class; elseif ($fat_ref_sdev > 0.030) $class_sd=$class_red;
        }
        ?>
        <td class= {{$class_sd}}> {{$fat_ref_sdev}}</td>

        <!-- limite: 0.020 -->
        <?php
        $class_sd="";
        if ($protein_ref_sdev!="" && $p_a>0 ) {
            if ($protein_ref_sdev < 0.020) $class_sd=$class; elseif ($protein_ref_sdev > 0.020) $class_sd=$class_red;
        }
        ?>
        <td class= {{$class_sd}}> {{$protein_ref_sdev}}</td>

        <!-- limite: 0.010 -->
        <?php
        $class_sd="";
        if ($lactose_ref_sdev!="" && $l_a>0 ) {
            if ($lactose_ref_sdev < 0.10) $class_sd=$class; elseif ($lactose_ref_sdev > 0.10) $class_sd=$class_red;
        }
        ?>
        <td class= {{$class_sd}}> {{$lactose_ref_sdev}}</td>

        <!-- limite: 1,5 -->
        <?php
        $class_sd="";
        if ($urea_ref_sdev!="" && $u_a>0 ) {
            if ($urea_ref_sdev < 1.5) $class_sd=$class; elseif ($urea_ref_sdev > 1.5) $class_sd=$class_red;
        }
        ?>
        <td class= {{$class_sd}}> {{$urea_ref_sdev}}</td>

        <!-- limite: 10 -->
        <?php
        $class_sd="";
        $xx="";
        if ($scc_ref_sdev!="" && $s_a>0 ) {
            $xx="%";
            if ($scc_ref_sdev < 10) $class_sd=$class; elseif ($scc_ref_sdev > 10) $class_sd=$class_red;
        }
        ?>
        <td class= {{$class_sd}}> {{$scc_ref_sdev}}{{$xx}}</td>
    </tr>
    <tr>
        <td class="bold">D</td>			<!-- stampo valore di dist per ogni type; le celle sempre bianche -->
        <td>{{ $fat_ref_dist }}</td>
        <td>{{ $protein_ref_dist }}</td>
        <td>{{ $lactose_ref_dist }}</td>
        <td>{{ $urea_ref_dist }}</td>
        <td>{{ $scc_ref_dist }}@if ($s_a>0 && $scc_ref_dist!="")% @endif</td>
    </tr>
    <tr>
        <td class="bold">Method</td>	<!-- stampo valore di method per ogni type; le celle sempre bianche -->
        <td>{{ $fat_ref_m }}</td>
        <td>{{ $protein_ref_m }}</td>
        <td>{{ $lactose_ref_m }}</td>
        <td>{{ $urea_ref_m }}</td>
        <td>{{ $scc_ref_m }}</td>
    </tr>


    <tr class="grey">
        <td colspan="13" height="30" valign="bottom" class="bold">Limits</td>
    </tr>
    <tr class="grey">
        <td class="bold">d</td>
        <td>0,020</td>
        <td>0,025</td>
        <td>0,10</td>
        <td>2,5</td>
        <td>10%</td>
    </tr>
    <tr class="grey">
        <td class="bold">Sd</td>
        <td>0,030</td>
        <td>0,020</td>
        <td>0,10</td>
        <td>1,5</td>
        <td>10%</td>
    </tr>
</table>



<table cellspacing="0" id="e">
    <tr>
        <td rowspan="13" class="tabcode">E</td>
        <td colspan="8" class="bold title2">Outliers</td>
    </tr>
    <tr>
        <td rowspan="2">&nbsp;</td>
        <td class="bold">Fat<sub>ref</sub></td>
        <td class="bold">Protein*<sub>ref</sub></td>
        <td class="bold">Lactose<sub>ref</sub></td>
        <td class="bold">Urea<sub>ref</sub></td>
        <td class="bold">SCC<sub>ref/alt</sub></td>
    </tr>
    <tr>
        <td>g/100g</td>
        <td>nitrogen g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>SCC*1000/ml</td>
    </tr>

    <?php
    //print_r($arr_sp1);
    $numsample=1;
    $class_f=$class_p=$class_l=$class_u=$class_s="";
    if (count($outlier) > 0){
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php

            $class_f=$class_p=$class_l=$class_u=$class_s="";
            if (isset($outlier[$v])){

                $fat_ref=(isset($outlier[$v]['fat_ref']))?$outlier[$v]['fat_ref']:"";
                $protein_ref=(isset($outlier[$v]['protein_ref']))?$outlier[$v]['protein_ref']:"";
                $lactose_ref=(isset($outlier[$v]['lactose_ref']))?$outlier[$v]['lactose_ref']:"";
                $urea_ref=(isset($outlier[$v]['urea_ref']))?$outlier[$v]['urea_ref']:"";
                $scc_ref=(isset($outlier[$v]['scc_ref']))?$outlier[$v]['scc_ref']:"";

                if ($fat_ref!="" && $f_a==1)  $class_f="red"; elseif($fat_ref=="" && $f_a==1) $class_f="green"; else $class_f="";
                if ($protein_ref!="" && $p_a==1)  $class_p="red"; elseif($protein_ref=="" && $p_a==1) $class_p="green"; else $class_p="";
                if ($lactose_ref!="" && $l_a==1)  $class_l="red"; elseif($lactose_ref=="" && $l_a==1) $class_l="green"; else $class_l="";
                if ($urea_ref!="" && $u_a==1)  $class_u="red"; elseif($urea_ref==""&& $u_a==1) $class_u="green"; else $class_u="";
                if ($scc_ref!="" && $s_a==1)  $class_s="red"; elseif($scc_ref==""&& $s_a==1) $class_s="green"; else $class_s="";


                echo "<td  class=".$class_f.">".$fat_ref."</td>";
                echo "<td  class=".$class_p.">".$protein_ref."</td>";
                echo "<td  class=".$class_l.">".$lactose_ref."</td>";
                echo "<td  class=".$class_u.">".$urea_ref."</td>";
                echo "<td  class=".$class_s.">".$scc_ref."</td>";

            }else{
                if ($f_a==1)  $class_f="green";
                if ($p_a==1)  $class_p="green";
                if ($l_a==1)  $class_l="green";
                if ($u_a==1)  $class_u="green";
                if ($s_a==1)  $class_s="green";

                echo "<td  class=".$class_f."></td>";
                echo "<td  class=".$class_p."></td>";
                echo "<td  class=".$class_l."></td>";
                echo "<td  class=".$class_u."></td>";
                echo "<td  class=".$class_s."></td>";
            }
            ?>
        </tr>
        <?php
        $numsample++;

        ?>
    @endfor
    <?php

    }else{
        $class_f=$class_p=$class_l=$class_u=$class_s="";
        for ($x = 1; $x <= 10; $x++) {
            if ($f_a==1)  $class_f="green";
            if ($p_a==1)  $class_p="green";
            if ($l_a==1)  $class_l="green";
            if ($u_a==1)  $class_u="green";
            if ($s_a==1)  $class_s="green";
            echo "<tr>";
                echo "<td>Sample $x</td>";
                echo "<td  class=".$class_f."> </td>";
                echo "<td  class=".$class_p."> </td>";
                echo "<td  class=".$class_l."> </td>";
                echo "<td  class=".$class_u."> </td>";
                echo "<td  class=".$class_s."> </td>";
            echo "</tr>";
        }
    }
    ?>
</table>

<div class="html2pdf__page-break"></div>

<table cellspacing="0" id="f">
    <tr>
        <td rowspan="26" class="tabcode">F</td>
        <td colspan="7" class="bold title2">Repeatability</td>
    </tr>
    <tr>
        <td colspan="7" class="bold">Your &quot;r&quot; performance</td>
    </tr>
    <tr>
        <td rowspan="2">&nbsp;</td>
        <td class="bold">Fat</td>
        <td class="bold">Protein</td>
        <td class="bold">Lactose</td>
        <td class="bold">Urea</td>
        <td class="bold">SCC</td>
    </tr>
    <tr>
        <td>g/100g</td>
        <td>nitrogen g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>SCC*1000/ml</td>
    </tr>

    <?php
    //print_r($arr_sp1);
    $numsample=1;
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php
            $r_fat=$r_pro=$r_lac=$r_ure=$r_scc="";
            $class1=$class2=$class3=$class4="";

            if (isset($repeat['fat_ref'])){
                $r_fat=$repeat['fat_ref']['sp'.$v];
                if ($r_fat>'0.043')  $class1="red";
                elseif ($r_fat=="") $class1="";
                elseif($r_fat<'0.043') $class1="green"; else $class1="";
            }

            if (isset($repeat['protein_ref'])){
                $r_pro=$repeat['protein_ref']['sp'.$v];
                if ($r_pro>'0.038')  $class2="red";
                elseif ($r_pro=="") $class2="";
                elseif($r_pro<'0.038') $class2="green"; else $class2="";
            }

            if (isset($repeat['lactose_ref'])){
                $r_lac=$repeat['lactose_ref']['sp'.$v];
                if ($r_lac>'0.06')  $class3="red";
                elseif ($r_lac=="") $class3="";
                elseif($r_lac<'0.06') $class3="green"; else $class3="";
            }

            if (isset($repeat['urea_ref'])){
                $r_ure=$repeat['urea_ref']['sp'.$v];
                if ($r_ure>'1.52')   $class4="red";
                elseif ($r_ure=="") $class4="";
                elseif($r_ure<'1.52') $class4="green"; else $class4="";
            }

            if (isset($repeat['scc_ref'])){
                $r_scc=$repeat['scc_ref']['sp'.$v];
            }

            echo "<td class=".$class1.">".$r_fat."</td>";
            echo "<td class=".$class2.">".$r_pro."</td>";
            echo "<td class=".$class3.">".$r_lac."</td>";
            echo "<td class=".$class4.">".$r_ure."</td>";
            echo "<td>".$r_scc."</td>";
            ?>
        </tr>
        <?php
        $numsample++;
        ?>
    @endfor

    <tr class="grey">
        <td colspan="7" class="note">If the repeatability in smaller than the limit the cell is in green if there is a sample with a &quot;r&quot; bigger than the limit the cell is in red.    Please check table II in correspondence of the parameter and your lab code.</td>
    </tr>
    <tr class="grey">
        <td colspan="7" class="bold">Limits</td>
    </tr>
    <tr class="grey">
        <td rowspan="9">&nbsp;</td>
        <td class="bold">Fat</td>
        <td class="bold">Protein</td>
        <td class="bold">Lactose</td>
        <td class="bold">Urea</td>
        <td class="bold">SCC</td>
    </tr>
    <tr class="grey">
        <td>g/100g</td>
        <td>g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>SCC*1000/ml</td>
    </tr>
    <tr class="grey">
        <td>ISO 1211<br />IDF 1D</td>
        <td>ISO 8968<br />IDF 20</td>
        <td>ISO 22662<br />IDF 198</td>
        <td>ISO 14637<br />IDF 195</td>
        <td>ISO 13366-2<br />IDF 148-2</td>
    </tr>
    <tr class="grey">
        <td>0,043</td>
        <td>0,038</td>
        <td>0,06</td>
        <td>1,52</td>
        <td>
            <span class="half_l">Level</span>
            <span class="half_r">r</span>
        </td>
    </tr>
    <tr class="grey">
        <td rowspan="5" class="grey">&nbsp;</td>
        <td rowspan="5" class="grey">&nbsp;</td>
        <td rowspan="5" class="grey">&nbsp;</td>
        <td rowspan="5" class="grey">&nbsp;</td>
        <td>
            <span class="half_l">150</span>
            <span class="half_r">25</span>
        </td>
    </tr>
    <tr class="grey">
        <td>
            <span class="half_l">300</span>
            <span class="half_r">42</span>
        </td>
    </tr>
    <tr class="grey">
        <td>
            <span class="half_l">450</span>
            <span class="half_r">51</span>
        </td>
    </tr>
    <tr class="grey">
        <td>
            <span class="half_l">750</span>
            <span class="half_r">64</span>
        </td>
    </tr>
    <tr class="grey">
        <td>
            <span class="half_l">1500</span>
            <span class="half_r">126</span>
        </td>
    </tr>
</table>


<table cellspacing="0" id="g">
    <tr>
        <td rowspan="25" class="tabcode">G</td>
        <td colspan="6" class="bold title">Your Z-Score PT</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td class="bold">Fat</td>
        <td class="bold">Protein</td>
        <td class="bold">Lactose</td>
        <td class="bold">Urea</td>
        <td class="bold">SCC</td>
    </tr>


    <?php
    //print_r($arr_sp1);
    $numsample=1;
    if (count($zscorept) > 0){
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php

            $fat_pt=$pro_pt=$lac_pt=$ure_pt=$scc_pt="";
            $class1=$class2=$class3=$class4=$class5="";

            if (isset($zscorept['fat_ref'])){
                $fat_pt=$zscorept['fat_ref']['sp'.$v];
                if ($fat_pt!=""){
                    if ($fat_pt <'-3') $class1="red";
                    if ($fat_pt >'-3' && $fat_pt<'-2')$class1="yellow";
                    if ($fat_pt >'-2' && $fat_pt<'2')$class1="green";
                    if ($fat_pt >'2'  && $fat_pt<'3')$class1="yellow";
                    if ($fat_pt >'3') $class1="red";
                }
            }

            if (isset($zscorept['protein_ref'])){
                $pro_pt=$zscorept['protein_ref']['sp'.$v];
                if ($pro_pt!=""){
                    if ($pro_pt <'-3') $class2="red";
                    if ($pro_pt >'-3' && $pro_pt<'-2')$class2="yellow";
                    if ($pro_pt >'-2' && $pro_pt<'2')$class2="green";
                    if ($pro_pt >'2'  && $pro_pt<'3')$class2="yellow";
                    if ($pro_pt >'3') $class2="red";
                }
            }

            if (isset($zscorept['lactose_ref'])){
                $lac_pt=$zscorept['lactose_ref']['sp'.$v];
                if ($lac_pt!=""){
                    if ($lac_pt <'-3') $class3="red";
                    if ($lac_pt >'-3' && $lac_pt<'-2')$class3="yellow";
                    if ($lac_pt >'-2' && $lac_pt<'2')$class3="green";
                    if ($lac_pt >'2'  && $lac_pt<'3')$class3="yellow";
                    if ($lac_pt >'3') $class3="red";
                }
            }

            if (isset($zscorept['urea_ref'])){
                $ure_pt=$zscorept['urea_ref']['sp'.$v];
                if ($ure_pt!=""){
                    if ($ure_pt <'-3') $class4="red";
                    if ($ure_pt >'-3' && $ure_pt<'-2')$class4="yellow";
                    if ($ure_pt >'-2' && $ure_pt<'2')$class4="green";
                    if ($ure_pt >'2'  && $ure_pt<'3')$class4="yellow";
                    if ($ure_pt >'3') $class4="red";
                }
            }

            if (isset($zscorept['scc_ref'])){
                $scc_pt=$zscorept['scc_ref']['sp'.$v];
                if ($scc_pt!=""){
                    if ($scc_pt <'-3') $class5="red";
                    if ($scc_pt >'-3' && $scc_pt<'-2')$class5="yellow";
                    if ($scc_pt >'-2' && $scc_pt<'2')$class5="green";
                    if ($scc_pt >'2'  && $scc_pt<'3')$class5="yellow";
                    if ($scc_pt >'3') $class5="red";

                    $scc_pt=number_format($scc_pt,2);
                }
            }

            echo "<td class=".$class1.">".$fat_pt."</td>";
            echo "<td class=".$class2.">".$pro_pt."</td>";
            echo "<td class=".$class3.">".$lac_pt."</td>";
            echo "<td class=".$class4.">".$ure_pt."</td>";
            echo "<td class=".$class5.">".$scc_pt."</td>";

            ?>
        </tr>
        <?php
        $numsample++;
        ?>
    @endfor
    <?php
    }else{
        for ($x = 1; $x <= 10; $x++) {
            echo "<tr>";
                echo "<td>Sample $x</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
            echo "</tr>";
        }
    }
    ?>
    <tr>
        <td colspan="6" class="bold title">Your Z-Score Fix</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td class="bold">Fat</td>
        <td class="bold">Protein</td>
        <td class="bold">Lactose</td>
        <td class="bold">Urea</td>
        <td class="bold">SCC</td>
    </tr>



    <?php
    //print_r($arr_sp1);
    $numsample=1;
    if (count($zscorefix) > 0){
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php

            $fat_fx=$pro_fx=$lac_fx=$ure_fx=$scc_fx="";
            $class1=$class2=$class3=$class4=$class5="";

            if (isset($zscorefix['fat_ref'])){
                $fat_fx=$zscorefix['fat_ref']['sp'.$v];
                if ($fat_fx!=""){
                    if ($fat_fx <'-3') $class1="red";
                    if ($fat_fx >'-3' && $fat_fx<'-2')$class1="yellow";
                    if ($fat_fx >'-2' && $fat_fx<'2')$class1="green";
                    if ($fat_fx >'2'  && $fat_fx<'3')$class1="yellow";
                    if ($fat_fx >'3') $class1="red";
                }
            }

            if (isset($zscorefix['protein_ref'])){
                $pro_fx=$zscorefix['protein_ref']['sp'.$v];
                if ($pro_fx!=""){
                    if ($pro_fx <'-3') $class2="red";
                    if ($pro_fx >'-3' && $pro_fx<'-2')$class2="yellow";
                    if ($pro_fx >'-2' && $pro_fx<'2')$class2="green";
                    if ($pro_fx >'2'  && $pro_fx<'3')$class2="yellow";
                    if ($pro_fx >'3') $class2="red";
                }
            }

            if (isset($zscorefix['lactose_ref'])){
                $lac_fx=$zscorefix['lactose_ref']['sp'.$v];
                if ($lac_fx!=""){
                    if ($lac_fx <'-3') $class3="red";
                    if ($lac_fx >'-3' && $lac_fx<'-2')$class3="yellow";
                    if ($lac_fx >'-2' && $lac_fx<'2')$class3="green";
                    if ($lac_fx >'2'  && $lac_fx<'3')$class3="yellow";
                    if ($lac_fx >'3') $class3="red";
                }
            }

            if (isset($zscorefix['urea_ref'])){
                $ure_fx=$zscorefix['urea_ref']['sp'.$v];
                if ($ure_fx!=""){
                    if ($ure_fx <'-3') $class4="red";
                    if ($ure_fx >'-3' && $ure_fx<'-2')$class4="yellow";
                    if ($ure_fx >'-2' && $ure_fx<'2')$class4="green";
                    if ($ure_fx >'2'  && $ure_fx<'3')$class4="yellow";
                    if ($ure_fx >'3') $class4="red";
                }
            }

            if (isset($zscorefix['scc_ref'])){
                $scc_fx=$zscorefix['scc_ref']['sp'.$v];
                if ($scc_fx!=""){
                    if ($scc_fx <'-3') $class5="red";
                    if ($scc_fx >'-3' && $scc_fx<'-2')$class5="yellow";
                    if ($scc_fx >'-2' && $scc_fx<'2')$class5="green";
                    if ($scc_fx >'2'  && $scc_fx<'3')$class5="yellow";
                    if ($scc_fx >'3') $class5="red";

                    $scc_fx=number_format($scc_fx,2);
                }
            }

            echo "<td class=".$class1.">".$fat_fx."</td>";
            echo "<td class=".$class2.">".$pro_fx."</td>";
            echo "<td class=".$class3.">".$lac_fx."</td>";
            echo "<td class=".$class4.">".$ure_fx."</td>";
            echo "<td class=".$class5.">".$scc_fx."</td>";
            ?>
        </tr>
        <?php
        $numsample++;
        ?>
    @endfor
    <?php
    }else{
        for ($x = 1; $x <= 10; $x++) {
            echo "<tr>";
            echo "<td>Sample $x</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";
        }
    }
    ?>
    <tr class="grey">
        <td colspan="6">
            <p class="note">If there is a sample with a &quot;z-score&quot; in the yellow or red area please check table VI and VII in correspondence of your lab code.</p>
            <table cellspacing="0" id="info">
                <tr>
                    <td colspan="5">Interpretation Z-Score</td>
                </tr>
                <tr>
                    <td>Z-Score&lt;-3</td>
                    <td>-3&lt;Z-Score&lt;-2</td>
                    <td>-2&lt;Z-Score&lt;2</td>
                    <td>2&lt;Z-Score&lt;3</td>
                    <td>Z-Score&gt;3</td>
                </tr>
                <tr>
                    <td class="red">Poor</td>
                    <td class="yellow">Moderate</td>
                    <td class="green">Good</td>
                    <td class="yellow">Moderate</td>
                    <td class="red">Poor</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div class="html2pdf__page-break"></div>
<table>
    {!! Charts::scripts() !!}
    <?php $ch=1; 
	$numItems = count($code_arr);
	$i = 0;
	?>
    @foreach($code_arr as $who)
        <tr>
            <td style="width: 50%;">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">ZSCORE-PT - {{$who}}</h3>
                    </div>
                    <div class="box-body">
                        <div class="app">
                            <center>
                                {!! $chart[$who]->html() !!}
                            </center>
                        </div>

                        {!! $chart[$who]->script() !!}
                    </div>
                </div>
            </td>

            <td style="width: 50%;">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">ZSCORE-FIX - {{$who}}</h3>

                    </div>
                    <div class="box-body">
                        <div class="app">
                            <center>
                                {!! $chartfx[$who]->html() !!}
                            </center>
                        </div>

                        {!! $chartfx[$who]->script() !!}
                    </div>
                </div>
            </td>
        </tr>

    @endforeach

</table>
</body>
</html>


<script>
    setTimeout(call_pdf, 2000);

    function call_pdf(){
        $.LoadingOverlaySetup({
            color           : "rgba(0, 0, 0, 0.4)",
            image           : "../assets/img/loading.gif",
            maxSize         : "50px",
            minSize         : "20px",
            resizeInterval  : 0,
            size            : "50%"
        });

        var progress = new LoadingOverlayProgress();
        $.LoadingOverlay("show", {
            custom  : progress.Init()
        });

        // Simulate some action:
        var count     = 1;
        var interval  = setInterval(function(){
            if (count >= 100) {
                clearInterval(interval);
                delete progress;
                $.LoadingOverlay("hide");
                //window.open('','_self').close();
                return;
            }
            count=count+4;
            progress.Update(count);
        }, 100)

        var element = document.body;
        html2pdf(element, {
            margin:       0.1,
            filename:     '{{$icar_code}} - Report {{$code_round}}-report.pdf',
            image:        { type: 'jpeg', quality: 0.99 },
            html2canvas:  { dpi: 192, letterRendering: true },
            jsPDF:        { unit: 'in', format: 'c4', orientation: 'portrait' }

        });
        // $('.loadingoverlay').remove();
    }
</script>


