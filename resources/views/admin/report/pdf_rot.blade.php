@inject('request', 'Illuminate\Http\Request')

<?php
if (count($round) > 0){
    //class TD
    $class="green";
    $class_red="red";
    $class_no="";

    //attivato test?
    $p_ref_sub=$fat_ref_sub=$lac_ref_sub=$u_ref_sub=$bhb_ref_sub=$pag_sub="No";

    //question 1 e 2
    $p_ref_sample=$fat_ref_sample=$lac_ref_sample=$u_ref_sample=$bhb_ref_sample=$pag_sample="No";
    $p_ref_q2=$fat_ref_q2=$lac_ref_q2=$u_ref_q2=$bhb_ref_q2=$pag_q2="";

    //tutti non spuntati
    $p_a=$f_a=$l_a=$u_a=$b_a=$pag_a=0;


    $protein_ref_labcode=$fat_ref_labcode=$lactose_ref_labcode=$urea_ref_labcode=$bhb_ref_labcode=$pag_labcode="&nbsp;";
    $protein_ref_x100=$fat_ref_x100=$lactose_ref_x100=$urea_ref_x100=$bhb_ref_x100=$pag_x100="&nbsp;";
    $protein_ref_dev=$fat_ref_dev=$lactose_ref_dev=$urea_ref_dev=$bhb_ref_dev=$pag_dev="&nbsp;";
    $protein_ref_sdev=$fat_ref_sdev=$lactose_ref_sdev=$urea_ref_sdev=$bhb_ref_sdev=$pag_sdev="&nbsp;";
    $protein_ref_dist=$fat_ref_dist=$lactose_ref_dist=$urea_ref_dist=$bhb_ref_dist=$pag_dist="&nbsp;";
    $protein_ref_m=$fat_ref_m=$lactose_ref_m=$urea_ref_m=$bhb_ref_m=$pag_m="&nbsp;";

    foreach ($round as $r){
        $code_round             = $r->code_round;
        $results_received       = ($r->results_received)?"Yes":"No";
        $results_received_date  = ($r->results_received_date)? date("d-m-Y", strtotime($r->results_received_date)):"";
        switch ($r->code_test) {
            case 'protein_rout':
                $p_ref_sub     = "Yes";
                $p_ref_sample  = ($r->question1)?"Yes":"No";
                $p_ref_q2      = ($r->question2)?"Yes":"No";
                $p_a=1;
                break;
            case 'fat_rout':
                $fat_ref_sub     = "Yes";
                $fat_ref_sample  = ($r->question1)?"Yes":"No";
                $fat_ref_q2      = ($r->question2)?"Yes":"No";
                $f_a=1;
                break;
            case 'lactose_rout':
                $lac_ref_sub     = "Yes";
                $lac_ref_sample  = ($r->question1)?"Yes":"No";
                $lac_ref_q2      = ($r->question2)?"Yes":"No";
                $l_a=1;
                break;

            case 'urea_rout':
                $u_ref_sub     = "Yes";
                $u_ref_sample  = ($r->question1)?"Yes":"No";
                $u_ref_q2      = ($r->question2)?"Yes":"No";
                $u_a=1;
                break;

            case 'bhb':
                $bhb_ref_sub     = "Yes";
                $bhb_ref_sample  = ($r->question1)?"Yes":"No";
                $bhb_ref_q2      = ($r->question2)?"Yes":"No";
                $b_a=1;
                break;

            case 'pag':
                $pag_sub     = "Yes";
                $pag_sample  = ($r->question1)?"Yes":"No";
                $pag_q2      = ($r->question2)?"Yes":"No";
                $pag_a=1;
                break;
        }
    }
}



if (count($data) > 0){
    foreach ($data as $d){
        $icar_code              = $d->icar_code;
        switch ($d->type) {
            case 'protein_rout':
                $protein_ref_labcode = $d->lab_code;
                $protein_ref_x100    = $d->percent;
                $protein_ref_dev     = number_format($d->dev,3);
                $protein_ref_sdev    = number_format($d->s_dev,3);
                $protein_ref_dist    = number_format($d->dist,3);
                $protein_ref_m       = $d->method;
                if ($d->method=="A")$protein_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$protein_ref_m="ISO
                2446|IDF 226";
                break;
            case 'fat_rout':
                $fat_ref_labcode = $d->lab_code;
                $fat_ref_x100    = $d->percent;
                $fat_ref_dev     = number_format($d->dev,3);
                $fat_ref_sdev    = number_format($d->s_dev,3);
                $fat_ref_dist    = number_format($d->dist,3);
                $fat_ref_m       = $d->method;
                if ($d->method=="A")$fat_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$fat_ref_m="ISO
                2446|IDF 226";
                break;
            case 'lactose_rout':
                $lactose_ref_labcode = $d->lab_code;
                $lactose_ref_x100    = $d->percent;
                $lactose_ref_dev     = number_format($d->dev,3);
                $lactose_ref_sdev    = number_format($d->s_dev,3);
                $lactose_ref_dist    = number_format($d->dist,3);
                $lactose_ref_m       = $d->method;
                if ($d->method=="A")$lactose_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$lactose_ref_m="ISO
                2446|IDF 226";
                break;
            case 'urea_rout':
                $urea_ref_labcode = $d->lab_code;
                $urea_ref_x100    = $d->percent;
                $urea_ref_dev     = number_format($d->dev,3);
                $urea_ref_sdev    = number_format($d->s_dev,3);
                $urea_ref_dist    = number_format($d->dist,3);
                $urea_ref_m       = $d->method;
                if ($d->method=="A")$urea_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$urea_ref_m="ISO
                2446|IDF 226";
                break;
            case 'bhb':
                $bhb_ref_labcode = $d->lab_code;
                $bhb_ref_x100    = $d->percent;
                $bhb_ref_dev     = number_format($d->dev,3)*100;
                $bhb_ref_sdev    = number_format($d->s_dev,3)*100;
                $bhb_ref_dist    = number_format($d->dist,3)*100;
                $bhb_ref_m       = $d->method;
                if ($d->method=="A")$scc_ref_m="ISO 1211|IDF 1"; elseif($d->method=="B")$scc_ref_m="ISO
                2446|IDF 226";
                break;
            case 'pag':
                $pag_labcode = $d->lab_code;
                $pag_x100    = $d->percent;
                $pag_dev     = number_format($d->dev,3)*100;
                $pag_sdev    = number_format($d->s_dev,3)*100;
                $pag_dist    = number_format($d->dist,3)*100;
                $pag_m       = $d->method;
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
    <title>{{$icar}} - Report {{$code_round}} - {{$lab->lab_name}}</title>

    <style>
        @page {
            size: A4;
        }
        body { font-family: Arial, Helvetica, sans-serif; font-size:12px; margin-top:0; padding-top:0; }
        table { margin-top: 20px; width:775px; border: 1px solid #000; }
        table#info { width: 100% !important; border:none; }
        td { text-align:center; padding: 3px; border:1px solid #ccc; width:94px; font-size: 10px; vertical-align:middle; }
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
        #labname { height: 40px; }
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


<div class="box"></div>


<table id="header">
    <tr>
        <td class="logo"><img src="assets/img/logo.png" class="logo" /></td>
        <td class="title">Routine Methods<br />Laboratory participation codes and Performance analyses</td>
        <td class="box">ICAR PT <br />{{$code_round}}</td>
    </tr>
</table>

<table cellspacing="0" id="labname">
    <tr>
        <td style="width:140px" class="bold">Laboratory Name</td>
        <!-- qui va inserito il nome del laboratorio per cui creo il report -->
        <td style="width:615px">{{$lab->lab_name}}</td>
    </tr>
</table>

<table cellspacing="0" id="a">
    <tr>
        <td rowspan="7" class="tabcode">A</td>
        <td colspan="7" class="bold title">Your participation Codes</td>
    </tr>
    <tr>
        <td rowspan="2" class="left bold">Subscription</td>
        <td class="bold">Fat<sub>rout</sub></td>
        <td class="bold">Protein<sub>rout</sub></td>
        <td class="bold">Lactose<sub>rout</sub></td>
        <td class="bold">Urea<sub>rout</sub></td>
        <td class="bold">BHB</td>
        <td class="bold">PAG</td>
    </tr>
    <tr>
        <!--
      Per il laboratorio, in questo round, ho selezionato il test?
      se sì: compare Yes con classe green;
      se no: compare No senza classe
      -->
        <td class="@if ($fat_ref_sub=='Yes') {{$class}} @endif">{{$fat_ref_sub}}</td>
        <td class="@if ($p_ref_sub=='Yes') {{$class}} @endif">{{$p_ref_sub}}</td>
        <td class="@if ($lac_ref_sub=='Yes') {{$class}} @endif">{{$lac_ref_sub}}</td>
        <td class="@if ($u_ref_sub=='Yes') {{$class}} @endif">{{$u_ref_sub}}</td>
        <td class="@if ($bhb_ref_sub=='Yes') {{$class}} @endif">{{$bhb_ref_sub}}</td>
        <td class="@if ($pag_sub=='Yes') {{$class}} @endif">{{$pag_sub}}</td>
    </tr>
    <tr>
        <td class="left bold">Participation Codes</td>
        <!--
        Tabella: data
        Query: cerca id del laboratorio in icar_code e round attuale in round
        memorizzo lab_code in una variabile perché mi serve dopo
        -->
        <td>{{$fat_ref_labcode}}</td>
        <td>{{$protein_ref_labcode}}</td>
        <td>{{$lactose_ref_labcode}}</td>
        <td>{{$urea_ref_labcode}}</td>
        <td>{{$bhb_ref_labcode}}</td>
        <td>{{$pag_labcode}}</td>
    </tr>
    <tr> </tr>
    <tr> </tr>
    <tr>
        <td class="left bold">Are all the sample results received?</td>
        <!--
        Per il laboratorio, in questo round, ho risposto sì alla prima domanda?
        se sì: compare Yes con classe green;
        se no: compare No senza classe
        -->
        <td class="@if ($fat_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$fat_ref_sample}}</td>
        <td class="@if ($p_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$p_ref_sample}}</td>
        <td class="@if ($lac_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$lac_ref_sample}}</td>
        <td class="@if ($u_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$u_ref_sample}}</td>
        <td class="@if ($bhb_ref_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$bhb_ref_sample}}</td>
        <td class="@if ($pag_sample=='Yes') {{$class}} @else {{$class_red}} @endif">{{$pag_sample}}</td>
    </tr>
</table>

<table cellspacing="0" id="b">
    <tr>
        <td rowspan="2" class="tabcode">B</td>
        <td colspan="2" class="bold title">Data results received on time</td>
    </tr>
    <tr>
        <!-- la riga seguente può essere No con classe "red" o Yes con classe "green" -->
        <td class=@if ($results_received=='Yes') {{$class}} @else {{$class_red}} @endif>{{$results_received}}</td>
        <td style="width:614px;"> {{$results_received_date}}</td> <!-- prendo la data dal db -->
    </tr>
</table>

<table cellspacing="0" id="c">
    <tr>
        <td rowspan="5" class="tabcode">C</td>
        <td colspan="7" class="bold title">Have you sent the data with the correct units of measurements?</td>
    </tr>
    <tr>
        <td rowspan="3">&nbsp;</td>
        <td class="bold">Fat<sub>rout</sub></td>
        <td class="bold">Protein*<sub>rout</sub></td>
        <td class="bold">Lactose<sub>rout</sub></td>
        <td class="bold">Urea<sub>rout</sub></td>
        <td class="bold">BHB</td>
        <td class="bold">PAG</td>
    </tr>
    <tr>
        <td>g/100g</td>
        <td>nitrogen g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>mmol/L</td>
        <td>&nbsp;</td>
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

        <td class="@if ($bhb_ref_q2=='Yes') {{$class}}  @elseif ($bhb_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif">{{$bhb_ref_q2}}</td>

        <td class="@if ($pag_q2=='Yes') {{$class}}  @elseif ($pag_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif">{{$pag_q2}}</td>
    </tr>
    <tr>
        <td colspan="7" class="note grey">* It was requested to report the value in total nitrogen</td>
    </tr>
</table>


<table cellspacing="0" id="d">
    <tr>
        <td rowspan="12" class="tabcode">D</td>
        <td colspan="9" class="bold title">Ranking of your lab</td>
    </tr>
    <tr>
        <td rowspan="2">&nbsp;</td>
        <td class="bold">Fat<sub>rout</sub></td>
        <td class="bold">Protein*<sub>rout</sub></td>
        <td class="bold">Lactose<sub>rout</sub></td>
        <td class="bold">Urea<sub>rout</sub></td>
        <td class="bold">BHB</td>
        <td class="bold">PAG</td>
    </tr>
    <tr>
        <td>g/100g</td>
        <td>nitrogen g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>mmol/L</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <!--
        Tabella: data
        Query: cerco lab_code e round
        -->

        <td class="bold">Code</td> 		<!-- stampo valore di rank per ogni type; le celle sempre bianche -->
        <td>{{ $fat_ref_labcode }}</td>
        <td>{{ $protein_ref_labcode }}</td>
        <td>{{ $lactose_ref_labcode }}</td>
        <td>{{ $urea_ref_labcode }}</td>
        <td>{{ $bhb_ref_labcode }}</td>
        <td>{{ $pag_labcode }}</td>
    </tr>
    <tr>
        <td class="bold">%</td>			<!-- stampo valore di percent per ogni type; le celle sempre bianche -->
        <td>{{ $fat_ref_x100 }}</td>
        <td>{{ $protein_ref_x100 }}</td>
        <td>{{ $lactose_ref_x100 }}</td>
        <td>{{ $urea_ref_x100 }}</td>
        <td>{{ $bhb_ref_x100 }}</td>
        <td>{{ $pag_x100 }}</td>
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
        <td class="{{$class_sd}}"> {{$fat_ref_dev}}</td>

        <!-- range: tra -0,025 e +0,025  -->
        <?php
        $class_sd="";
        $class="green";
        if ($protein_ref_dev == '&nbsp;') $class_sd="";
        elseif ($protein_ref_dev > -0.025 &&  $protein_ref_dev < 0.025) $class_sd=$class; else $class_sd=$class_red;
        ?>
        <td class="{{$class_sd}}"> {{$protein_ref_dev}}</td>


        <!-- range: tra -0.10 e +0.10  -->
        <?php
        $class_sd="";
        $class="green";
        if ($lactose_ref_dev == '&nbsp;') $class_sd="";
        elseif ($lactose_ref_dev > -0.10 &&  $lactose_ref_dev < 0.10) $class_sd=$class; else $class_sd=$class_red;
        ?>
        <td class="{{$class_sd}}"> {{$lactose_ref_dev}}</td>

        <!-- range: tra -2,5 e +2,5  -->
        <?php
        $class_sd="";
        $class="green";
        if ($urea_ref_dev == '&nbsp;') $class_sd="";
        elseif ($urea_ref_dev > -2.5 &&  $urea_ref_dev < 2.5) $class_sd=$class; else $class_sd=$class_red;
        ?>
        <td class="{{$class_sd}}"> {{$urea_ref_dev}}</td>


        <!-- range: tra -10% e +10%  -->
        <?php
        $class_sd="";
        $class="green";
        if ( $bhb_ref_dev == '&nbsp;') $class_sd="";
        elseif ( $bhb_ref_dev > -10 &&  $bhb_ref_dev < 10) $class_sd=$class; else
            $class_sd=$class_red;
        ?>
        <td class="{{$class_sd}}"> {{$bhb_ref_dev}}</td>


        <!-- range: tra -10% e +10%  -->
        <?php
        $class_sd="";
        $class="green";
        if ( $pag_dev == "&nbsp;" || $pag_a<1) $class_sd="";
        elseif ( $pag_dev > -10 &&  $pag_dev < 10) $class_sd=$class; else  $class_sd=$class_red;
        ?>
        <td class="{{$class_sd}}"> {{$pag_dev}}</td>

    </tr>
    <tr>
        <td class="bold">Sd</td>
        <!-- se il valore è superiore al limite, la cella è rossa; se è inferiore, la cella è verde; se è uguale, è bianca -->

        <!-- limite: 0.030 -->
        <?php
        $class_sd="";
        if ($fat_ref_sdev!="&nbsp;" && $f_a>0 ) {
            if ($fat_ref_sdev < 0.030) $class_sd=$class; elseif ($fat_ref_sdev > 0.030) $class_sd=$class_red;
        }
        ?>
        <td class="{{$class_sd}}"> {{$fat_ref_sdev}}</td>

        <!-- limite: 0.020 -->
        <?php
        $class_sd="";
        if ($protein_ref_sdev!="&nbsp;" && $p_a>0 ) {
            if ($protein_ref_sdev < 0.020) $class_sd=$class; elseif ($protein_ref_sdev > 0.020) $class_sd=$class_red;
        }
        ?>
        <td class="{{$class_sd}}"> {{$protein_ref_sdev}}</td>

        <!-- limite: 0.010 -->
        <?php
        $class_sd="";
        if ($lactose_ref_sdev!="&nbsp;" && $l_a>0 ) {
            if ($lactose_ref_sdev < 0.10) $class_sd=$class; elseif ($lactose_ref_sdev > 0.10) $class_sd=$class_red;
        }
        ?>
        <td class="{{$class_sd}}"> {{$lactose_ref_sdev}}</td>

        <!-- limite: 1,5 -->
        <?php
        $class_sd="";
        if ($urea_ref_sdev!="&nbsp;" && $u_a>0 ) {
            if ($urea_ref_sdev < 1.5) $class_sd=$class; elseif ($urea_ref_sdev > 1.5) $class_sd=$class_red;
        }
        ?>
        <td class="{{$class_sd}}"> {{$urea_ref_sdev}}</td>

        <!-- limite: 10 -->
        <?php
        $class_sd="";
        if ($bhb_ref_sdev!="&nbsp;" && $b_a>0 ) {
            if ($bhb_ref_sdev < 10) $class_sd=$class; elseif ($bhb_ref_sdev > 10) $class_sd=$class_red;
        }
        ?>
        <td class="{{$class_sd}}"> {{$bhb_ref_sdev}}</td>

        <!-- limite: 045 -->
        <?php
        $class_sd="";

        if ($pag_sdev!="&nbsp;" && $pag_a>0 ) {
            if ($pag_sdev < 0.045) $class_sd=$class; elseif ($pag_sdev > 0.045) $class_sd=$class_red;
        }
        ?>
        <td class="{{$class_sd}}"> {{$pag_sdev}}</td>
    </tr>
    <tr>
        <td class="bold">D</td>			<!-- stampo valore di dist per ogni type; le celle sempre bianche -->
        <td>{{ $fat_ref_dist }}</td>
        <td>{{ $protein_ref_dist }}</td>
        <td>{{ $lactose_ref_dist }}</td>
        <td>{{ $urea_ref_dist }}</td>
        <td>{{ $bhb_ref_dist }}</td>
        <td>{{ $pag_dist }}</td>
    </tr>
    <tr>
        <td class="bold">Method</td>	<!-- stampo valore di method per ogni type; le celle sempre bianche -->
        <td>{{ $fat_ref_m }}</td>
        <td>{{ $protein_ref_m }}</td>
        <td>{{ $lactose_ref_m }}</td>
        <td>{{ $urea_ref_m }}</td>
        <td>{{ $bhb_ref_m }}</td>
        <td>{{ $pag_m }}</td>
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
        <td>10</td>
        <td>0,045</td>
    </tr>
    <tr class="grey">
        <td class="bold">Sd</td>
        <td>0,030</td>
        <td>0,020</td>
        <td>0,10</td>
        <td>1,5</td>
        <td>10</td>
        <td>0,045</td>
    </tr>
</table>

<table cellspacing="0" id="e">
    <tr>
        <td rowspan="13" class="tabcode">E</td>
        <td colspan="8" class="bold title">Outliers</td>
    </tr>
    <tr>
        <td rowspan="2">&nbsp;</td>
        <td class="bold">Fat<sub>rout</sub></td>
        <td class="bold">Protein*<sub>rout</sub></td>
        <td class="bold">Lactose<sub>rout</sub></td>
        <td class="bold">Urea<sub>rout</sub></td>
        <td class="bold">BHB</td>
        <td class="bold">PAG</td>
    </tr>
    <tr>
        <td>g/100g</td>
        <td>nitrogen g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>mmol/L</td>
        <td>&nbsp;</td>
    </tr>
    <!--
    Tabella: outliers
    Query: cerco lab_code e round
	-->
    <?php
    //print_r($arr_sp1);
    $numsample=1;
    $class_f=$class_p=$class_l=$class_u=$class_s=$class_pag="";
    if (count($outlier) > 0){
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php

            if (isset($outlier[$v])){
                $class_f=$class_p=$class_l=$class_u=$class_s=$class_pag="";

                $fat_rout=(isset($outlier[$v]['fat_rout']))?$outlier[$v]['fat_rout']:"";
                $protein_rout=(isset($outlier[$v]['protein_rout']))?$outlier[$v]['protein_rout']:"";
                $lactose_rout=(isset($outlier[$v]['lactose_rout']))?$outlier[$v]['lactose_rout']:"";
                $urea_rout=(isset($outlier[$v]['urea_rout']))?$outlier[$v]['urea_rout']:"";
                $bhb=(isset($outlier[$v]['bhb']))?$outlier[$v]['bhb']:"";
                $pag=(isset($outlier[$v]['pag']))?$outlier[$v]['pag']:"";

                if ($fat_rout!="" && $f_a==1)  $class_f="red"; elseif($fat_rout=="" && $f_a==1) $class_f="green"; else $class_f="";
                if ($protein_rout!="" && $p_a==1)  $class_p="red"; elseif($protein_rout=="" && $p_a==1) $class_p="green"; else $class_p="";
                if ($lactose_rout!="" && $l_a==1)  $class_l="red"; elseif($lactose_rout=="" && $l_a==1) $class_l="green"; else $class_l="";
                if ($urea_rout!="" && $u_a==1)  $class_u="red"; elseif($urea_rout==""&& $u_a==1) $class_u="green"; else $class_u="";
                if ($bhb!="" && $b_a==1)  $class_s="red"; elseif($bhb==""&& $b_a==1) $class_s="green"; else $class_s="";
                if ($pag!="" && $pag_a==1)  $class_pag="red"; elseif($pag==""&& $pag_a==1) $class_pag="green"; else $class_pag="";

                echo "<td  class=".$class_f.">".$fat_rout."</td>";
                echo "<td  class=".$class_p.">".$protein_rout."</td>";
                echo "<td  class=".$class_l.">".$lactose_rout."</td>";
                echo "<td  class=".$class_u.">".$urea_rout."</td>";
                echo "<td  class=".$class_s.">".$bhb."</td>";
                echo "<td  class=".$class_pag.">".$pag."</td>";

            }else{
                if ($f_a==1)  $class_f="green";
                if ($p_a==1)  $class_p="green";
                if ($l_a==1)  $class_l="green";
                if ($u_a==1)  $class_u="green";
                if ($b_a==1)  $class_s="green";
                if ($pag_a==1)$class_pag="green";

                echo "<td  class=".$class_f."></td>";
                echo "<td  class=".$class_p."></td>";
                echo "<td  class=".$class_l."></td>";
                echo "<td  class=".$class_u."></td>";
                echo "<td  class=".$class_s."></td>";
                echo "<td  class=".$class_pag."></td>";
            }
            ?>
        </tr>
        <?php
        $numsample++;
        ?>
    @endfor
    <?php

    }else{
        $class_f=$class_p=$class_l=$class_u=$class_s=$class_pag="#";
        for ($x = 1; $x <= 10; $x++) {
            if ($f_a==1)  $class_f="green";
            if ($p_a==1)  $class_p="green";
            if ($l_a==1)  $class_l="green";
            if ($u_a==1)  $class_u="green";
            if ($b_a==1)  $class_s="green";
            if ($pag_a==1)$class_pag="green";
            echo "<tr>";
                echo "<td>Sample $x</td>";
                echo "<td  class=".$class_f."></td>";
                echo "<td  class=".$class_p."></td>";
                echo "<td  class=".$class_l."></td>";
                echo "<td  class=".$class_u."></td>";
                echo "<td  class=".$class_s."></td>";
                echo "<td  class=".$class_pag."></td>";
            echo "</tr>";
        }
    }
    ?>

</table>

<div class="newpage"></div>

<table cellspacing="0" id="f">
    <tr>
        <td rowspan="26" class="tabcode">F</td>
        <td colspan="7" class="bold title">Repeatability</td>
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
        <td class="bold">BHB</td>
        <td class="bold">PAG</td>
    </tr>
    <tr>
        <td>g/100g</td>
        <td>nitrogen g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>mmol/L</td>
        <td>&nbsp;</td>
    </tr>
    <?php
    //print_r($arr_sp1);
    $numsample=1;
    if (count($repeat) > 0){
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php
            $r_fat=$r_pro=$r_lac=$r_ure=$r_bhb=$r_pag="";
            $class1=$class2=$class3=$class4=$class5="";

            if (isset($repeat['fat_rout'])){
                $r_fat=$repeat['fat_rout']['sp'.$v];
                if ($r_fat>'0.043')  $class1="red";
                elseif ($r_fat=="") $class1="";
                elseif($r_fat<'0.043') $class1="green"; else $class1="";
            }

            if (isset($repeat['protein_rout'])){
                $r_pro=$repeat['protein_rout']['sp'.$v];
                if ($r_pro>'0.038')  $class2="red";
                elseif ($r_pro=="") $class2="";
                elseif($r_pro<'0.038') $class2="green"; else $class2="";
            }

            if (isset($repeat['lactose_rout'])){
                $r_lac=$repeat['lactose_rout']['sp'.$v];
                if ($r_lac>'0.06')  $class3="red";
                elseif ($r_lac=="") $class3="";
                elseif($r_lac<'0.06') $class3="green"; else $class3="";
            }

            if (isset($repeat['urea_rout'])){
                $r_ure=$repeat['urea_rout']['sp'.$v];
                if ($r_ure>'1.52')   $class4="red";
                elseif ($r_ure=="") $class4="";
                elseif($r_ure<'1.52') $class4="green"; else $class4="";
            }

            if (isset($repeat['bhb'])){
                $r_bhb=$repeat['bhb']['sp'.$v];
            }

            if (isset($repeat['pag'])){
                $r_pag=$repeat['pag']['sp'.$v];
                if ($r_pag>'0.03')  $class5="red";
                elseif ($r_pag=="") $class5="";
                elseif($r_pag<'0.03') $class5="green"; else $class5="";
            }

            echo "<td class=".$class1.">".$r_fat."</td>";
            echo "<td class=".$class2.">".$r_pro."</td>";
            echo "<td class=".$class3.">".$r_lac."</td>";
            echo "<td class=".$class4.">".$r_ure."</td>";
            echo "<td>".$r_bhb."</td>";
            echo "<td class=".$class5.">".$r_pag."</td>";
            ?>
        </tr>
        <?php
        $numsample++;
        ?>
    @endfor
    <?php
    }
    ?>

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
        <td class="bold">BHB</td>
        <td class="bold">&nbsp;</td>
    </tr>
    <tr class="grey">
        <td>g/100g</td>
        <td>g/100g</td>
        <td>g/100g</td>
        <td>mg/dl</td>
        <td>mmol/L</td>
        <td>&nbsp;</td>
    </tr>
    <tr class="grey">
        <td>ISO 1211<br />IDF 1D</td>
        <td>ISO 8968<br />IDF 20</td>
        <td>ISO 22662<br />IDF 198</td>
        <td>ISO 14637<br />IDF 195</td>
        <td>Indicative</td>
        <td>&nbsp;</td>
    </tr>
    <tr class="grey">
        <td>0,043</td>
        <td>0,038</td>
        <td>0,06</td>
        <td>1,52</td>
        <td>0,03</td>
        <td>&nbsp;</td>
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
        <td class="bold">BHB</td>
    </tr>

    <!--
    Classi da assegnare alle celle:
    se la cella è vuota, nessuna classe
    se valore minore di -3 : classe red
    se valore tra -3 e -2 : classe yellow
    se valore tra -2 e +2 : classe green
    se valore tra 2 e 3 : classe yellow
    se valore maggiore di 3: classe red

    Tabella: zscore-pt
    Query: cerco lab_code e round

    -->

    <?php
    //print_r($arr_sp1);
    $numsample=1;
    if (count($zscorept) > 0){
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php

            $fat_pt=$pro_pt=$lac_pt=$ure_pt=$bhb_pt="";
            $class1=$class2=$class3=$class4=$class5="";

            if (isset($zscorept['fat_rout'])){
                $fat_pt=$zscorept['fat_rout']['sp'.$v];
                if ($fat_pt!=""){
                    if ($fat_pt <'-3') $class1="red";
                    if ($fat_pt >'-3' && $fat_pt<'-2')$class1="yellow";
                    if ($fat_pt >'-2' && $fat_pt<'2')$class1="green";
                    if ($fat_pt >'2'  && $fat_pt<'3')$class1="yellow";
                    if ($fat_pt >'3') $class1="red";
                }
            }

            if (isset($zscorept['protein_rout'])){
                $pro_pt=$zscorept['protein_rout']['sp'.$v];
                if ($pro_pt!=""){
                    if ($pro_pt <'-3') $class2="red";
                    if ($pro_pt >'-3' && $pro_pt<'-2')$class2="yellow";
                    if ($pro_pt >'-2' && $pro_pt<'2')$class2="green";
                    if ($pro_pt >'2'  && $pro_pt<'3')$class2="yellow";
                    if ($pro_pt >'3') $class2="red";
                }
            }

            if (isset($zscorept['lactose_rout'])){
                $lac_pt=$zscorept['lactose_rout']['sp'.$v];
                if ($lac_pt!=""){
                    if ($lac_pt <'-3') $class3="red";
                    if ($lac_pt >'-3' && $lac_pt<'-2')$class3="yellow";
                    if ($lac_pt >'-2' && $lac_pt<'2')$class3="green";
                    if ($lac_pt >'2'  && $lac_pt<'3')$class3="yellow";
                    if ($lac_pt >'3') $class3="red";
                }
            }

            if (isset($zscorept['urea_rout'])){
                $ure_pt=$zscorept['urea_rout']['sp'.$v];
                if ($ure_pt!=""){
                    if ($ure_pt <'-3') $class4="red";
                    if ($ure_pt >'-3' && $ure_pt<'-2')$class4="yellow";
                    if ($ure_pt >'-2' && $ure_pt<'2')$class4="green";
                    if ($ure_pt >'2'  && $ure_pt<'3')$class4="yellow";
                    if ($ure_pt >'3') $class4="red";
                }
            }

            if (isset($zscorept['bhb'])){
                $bhb_pt=$zscorept['bhb']['sp'.$v];
                if ($bhb_pt!=""){
                    if ($bhb_pt <'-3') $class5="red";
                    if ($bhb_pt >'-3' && $bhb_pt<'-2')$class5="yellow";
                    if ($bhb_pt >'-2' && $bhb_pt<'2')$class5="green";
                    if ($bhb_pt >'2'  && $bhb_pt<'3')$class5="yellow";
                    if ($bhb_pt >'3') $class5="red";
                }
            }

            echo "<td class=".$class1.">".$fat_pt."</td>";
            echo "<td class=".$class2.">".$pro_pt."</td>";
            echo "<td class=".$class3.">".$lac_pt."</td>";
            echo "<td class=".$class4.">".$ure_pt."</td>";
            echo "<td class=".$class5.">".$bhb_pt."</td>";
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
        <td class="bold">BHB</td>
    </tr>


    <!-- identica cosa di zscore-pt ma questa volta su tabella zscore-fix-->
    <?php
    //print_r($arr_sp1);
    $numsample=1;
    if (count($zscorefix) > 0){
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php

            $fat_fx=$pro_fx=$lac_fx=$ure_fx=$bhb_fx="";
            $class1=$class2=$class3=$class4=$class5="";

            if (isset($zscorefix['fat_rout'])){
                $fat_fx=$zscorefix['fat_rout']['sp'.$v];
                if ($fat_fx!=""){
                    if ($fat_fx <'-3') $class1="red";
                    if ($fat_fx >'-3' && $fat_fx<'-2')$class1="yellow";
                    if ($fat_fx >'-2' && $fat_fx<'2')$class1="green";
                    if ($fat_fx >'2'  && $fat_fx<'3')$class1="yellow";
                    if ($fat_fx >'3') $class1="red";
                }
            }

            if (isset($zscorefix['protein_rout'])){
                $pro_fx=$zscorefix['protein_rout']['sp'.$v];
                if ($pro_fx!=""){
                    if ($pro_fx <'-3') $class2="red";
                    if ($pro_fx >'-3' && $pro_fx<'-2')$class2="yellow";
                    if ($pro_fx >'-2' && $pro_fx<'2')$class2="green";
                    if ($pro_fx >'2'  && $pro_fx<'3')$class2="yellow";
                    if ($pro_fx >'3') $class2="red";
                }
            }

            if (isset($zscorefix['lactose_rout'])){
                $lac_fx=$zscorefix['lactose_rout']['sp'.$v];
                if ($lac_fx!=""){
                    if ($lac_fx <'-3') $class3="red";
                    if ($lac_fx >'-3' && $lac_fx<'-2')$class3="yellow";
                    if ($lac_fx >'-2' && $lac_fx<'2')$class3="green";
                    if ($lac_fx >'2'  && $lac_fx<'3')$class3="yellow";
                    if ($lac_fx >'3') $class3="red";
                }
            }

            if (isset($zscorefix['urea_rout'])){
                $ure_fx=$zscorefix['urea_rout']['sp'.$v];
                if ($ure_fx!=""){
                    if ($ure_fx <'-3') $class4="red";
                    if ($ure_fx >'-3' && $ure_fx<'-2')$class4="yellow";
                    if ($ure_fx >'-2' && $ure_fx<'2')$class4="green";
                    if ($ure_fx >'2'  && $ure_fx<'3')$class4="yellow";
                    if ($ure_fx >'3') $class4="red";
                }
            }

            if (isset($zscorefix['scc_rout'])){
                $scc_fx=$zscorefix['scc_rout']['sp'.$v];
                if ($scc_fx!=""){
                    if ($scc_fx <'-3') $class5="red";
                    if ($scc_fx >'-3' && $scc_fx<'-2')$class5="yellow";
                    if ($scc_fx >'-2' && $scc_fx<'2')$class5="green";
                    if ($scc_fx >'2'  && $scc_fx<'3')$class5="yellow";
                    if ($scc_fx >'3') $class5="red";
                }
            }

            if (isset($zscorefix['bhb'])){
                $bhb_fx=$zscorefix['bhb']['sp'.$v];
                if ($bhb_fx!=""){
                    if ($bhb_fx <'-3') $class5="red";
                    if ($bhb_fx >'-3' && $bhb_fx<'-2')$class5="yellow";
                    if ($bhb_fx >'-2' && $bhb_fx<'2')$class5="green";
                    if ($bhb_fx >'2'  && $bhb_fx<'3')$class5="yellow";
                    if ($bhb_fx >'3') $class5="red";
                }
            }

            echo "<td class=".$class1.">".$fat_fx."</td>";
            echo "<td class=".$class2.">".$pro_fx."</td>";
            echo "<td class=".$class3.">".$lac_fx."</td>";
            echo "<td class=".$class4.">".$ure_fx."</td>";
            echo "<td class=".$class5.">".$bhb_fx."</td>";
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

<!-- nuova tabella aggiunta PAG -->



<div class="newpage"></div>

<?php
if (count($pagx) > 0){
 if($pag_a==1){
        ?>

<table cellspacing="0">
    <tr>
        <td colspan="7" class="bold title">PAG</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td class="bold">Sample 1</td>
        <td class="bold">Sample 2</td>
        <td class="bold">Sample 3</td>
        <td class="bold">Sample 4</td>
        <td class="bold">Sample 5</td>
    </tr>

    <?php
    $class="#";
    $chi=array(
            'method'    =>'Method',
            'results'   =>'Presence of PAG',
            'accuracy'  =>'Laboratory accuracy',
            'lactation' =>'Strains',
            'date'      =>'Date',
            'Y'=>'Yes','T'=>'True','F'=>'False','N'=>'No'
    );

    for($v=0; $v<5; $v++){
        $a=$pagx[$v]->sample01;
        $b=$pagx[$v]->sample02;
        $c=$pagx[$v]->sample03;
        $d=$pagx[$v]->sample04;
        $e=$pagx[$v]->sample05;
        if ($pagx[$v]->row =="results" || $pagx[$v]->row =="accuracy" ){
            $a=$chi[$pagx[$v]->sample01];
            $b=$chi[$pagx[$v]->sample02];
            $c=$chi[$pagx[$v]->sample03];
            $d=$chi[$pagx[$v]->sample04];
            $e=$chi[$pagx[$v]->sample05];
        }
        if ($pagx[$v]->row =="date" ){
            $a=($a)? date("d-m-Y", strtotime($a)):"";
            $b=($b)? date("d-m-Y", strtotime($b)):"";
            $c=($c)? date("d-m-Y", strtotime($c)):"";
            $d=($d)? date("d-m-Y", strtotime($d)):"";
            $e=($e)? date("d-m-Y", strtotime($e)):"";
        }
        echo "<tr>";
        echo "<td  class=".$class." bold>".$chi[$pagx[$v]->row]."</td>";
        echo "<td  class=".$class.">".$a."</td>";
        echo "<td  class=".$class.">".$b."</td>";
        echo "<td  class=".$class.">".$c."</td>";
        echo "<td  class=".$class.">".$d."</td>";
        echo "<td  class=".$class.">".$e."</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
}
}
?>

<div class="newpage"></div>


<table>
    {!! Charts::scripts() !!}

    <?php $ch=1;?>

    @foreach($code_arr as $who)
        @if($who!=="pag")
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
                @if($who!=="bhb")
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
                @endif
            </tr>

            <?php
            if ($ch>2 && $ch<4){
                echo "</table><div class=\"newpage\"></div><table>";
            }
            $ch=$ch+1; ?>
			
        @endif
	@endforeach
</table>

</body>
</html>







