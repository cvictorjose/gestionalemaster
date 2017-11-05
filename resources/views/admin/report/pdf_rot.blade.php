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
        switch ($d->type) {
            case 'protein_rout':
                $protein_ref_labcode = $d->lab_code;
                $protein_ref_x100    = $d->percent;
                $protein_ref_dev     = number_format($d->dev,3);
                $protein_ref_sdev    = number_format($d->s_dev,3);
                $protein_ref_dist    = number_format($d->dist,3);
                $protein_ref_m       = $d->method;
                if ($d->method=="A")$protein_ref_m="ISO 1211?IDF 1"; elseif($d->method=="B")$protein_ref_m="ISO
                2446?IDF 226";
                break;
            case 'fat_rout':
                $fat_ref_labcode = $d->lab_code;
                $fat_ref_x100    = $d->percent;
                $fat_ref_dev     = number_format($d->dev,3);
                $fat_ref_sdev    = number_format($d->s_dev,3);
                $fat_ref_dist    = number_format($d->dist,3);
                $fat_ref_m       = $d->method;
                if ($d->method=="A")$fat_ref_m="ISO 1211?IDF 1"; elseif($d->method=="B")$fat_ref_m="ISO
                2446?IDF 226";
                break;
            case 'lactose_rout':
                $lactose_ref_labcode = $d->lab_code;
                $lactose_ref_x100    = $d->percent;
                $lactose_ref_dev     = number_format($d->dev,3);
                $lactose_ref_sdev    = number_format($d->s_dev,3);
                $lactose_ref_dist    = number_format($d->dist,3);
                $lactose_ref_m       = $d->method;
                if ($d->method=="A")$lactose_ref_m="ISO 1211?IDF 1"; elseif($d->method=="B")$lactose_ref_m="ISO
                2446?IDF 226";
                break;
            case 'urea_rout':
                $urea_ref_labcode = $d->lab_code;
                $urea_ref_x100    = $d->percent;
                $urea_ref_dev     = number_format($d->dev,3);
                $urea_ref_sdev    = number_format($d->s_dev,3);
                $urea_ref_dist    = number_format($d->dist,3);
                $urea_ref_m       = $d->method;
                if ($d->method=="A")$urea_ref_m="ISO 1211?IDF 1"; elseif($d->method=="B")$urea_ref_m="ISO
                2446?IDF 226";
                break;
            case 'bhb':
                $bhb_ref_labcode = $d->lab_code;
                $bhb_ref_x100    = $d->percent;
                $bhb_ref_dev     = number_format($d->dev,3)*100;
                $bhb_ref_sdev    = number_format($d->s_dev,3)*100;
                $bhb_ref_dist    = number_format($d->dist,3)*100;
                $bhb_ref_m       = $d->method;
                if ($d->method=="A")$scc_ref_m="ISO 1211?IDF 1"; elseif($d->method=="B")$scc_ref_m="ISO
                2446?IDF 226";
                break;
            case 'pag':
                $pag_labcode = $d->lab_code;
                $pag_x100    = $d->percent;
                $pag_dev     = number_format($d->dev,3)*100;
                $pag_sdev    = number_format($d->s_dev,3)*100;
                $pag_dist    = number_format($d->dist,3)*100;
                $pag_m       = $d->method;
                if ($d->method=="A")$scc_ref_m="ISO 1211?IDF 1"; elseif($d->method=="B")$scc_ref_m="ISO
                2446?IDF 226";
                break;

        }
    }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Report</title>

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
        <td class="logo"><img src="data:image/png;base64,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" class="logo" /></td>
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
        <td class=@if ($fat_ref_sub=='Yes') {{$class}} @endif>{{$fat_ref_sub}}</td>
        <td class=@if ($p_ref_sub=='Yes') {{$class}} @endif>{{$p_ref_sub}}</td>
        <td class=@if ($lac_ref_sub=='Yes') {{$class}} @endif>{{$lac_ref_sub}}</td>
        <td class=@if ($u_ref_sub=='Yes') {{$class}} @endif>{{$u_ref_sub}}</td>
        <td class=@if ($bhb_ref_sub=='Yes') {{$class}} @endif>{{$bhb_ref_sub}}</td>
        <td class=@if ($bhb_ref_sub=='Yes') {{$class}} @endif>{{$bhb_ref_sub}}</td>
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
        <td class=@if ($fat_ref_sample=='Yes') {{$class}} @endif>{{$fat_ref_sample}}</td>
        <td class=@if ($p_ref_sample=='Yes') {{$class}} @endif>{{$p_ref_sample}}</td>
        <td class=@if ($lac_ref_sample=='Yes') {{$class}} @endif>{{$lac_ref_sample}}</td>
        <td class=@if ($u_ref_sample=='Yes') {{$class}} @endif>{{$u_ref_sample}}</td>
        <td class=@if ($bhb_ref_sample=='Yes') {{$class}} @endif>{{$bhb_ref_sample}}</td>
        <td class=@if ($pag_sample=='Yes') {{$class}} @endif>{{$pag_sample}}</td>
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
        <td style="width:614px;">Deadline: {{$results_received_date}}</td> <!-- prendo la data dal db -->
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
        <td class=@if ($fat_ref_q2=='Yes') {{$class}}  @elseif ($fat_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif>{{$fat_ref_q2}}</td>

        <td class=@if ($p_ref_q2=='Yes') {{$class}}  @elseif ($p_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif>{{$p_ref_q2}}</td>

        <td class=@if ($lac_ref_q2=='Yes') {{$class}}  @elseif ($lac_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif>{{$lac_ref_q2}}</td>

        <td class=@if ($u_ref_q2=='Yes') {{$class}}  @elseif ($u_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif>{{$u_ref_q2}}</td>

        <td class=@if ($bhb_ref_q2=='Yes') {{$class}}  @elseif ($bhb_ref_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif>{{$bhb_ref_q2}}</td>

        <td class=@if ($pag_q2=='Yes') {{$class}}  @elseif ($pag_q2=='No'){{$class_red}} @else
            {{$class_no}}@endif>{{$pag_q2}}</td>
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
        <td class="bold">d</td>			<!-- stampo valore di dev per ogni type -->
        <!--  se il valore nella cella è all'interno del range, la cella è verde; se è al di fuori, la cella è rossa  -->
        <td class=
        @if ($fat_ref_dev == '&nbsp;') {{''}} @elseif (('-0,020' <= $fat_ref_dev) && ($fat_ref_dev <= '0,020')) {{$class}}
                @else {{$class_red}} @endif>{{$fat_ref_dev}}
        </td>
        <td class=
        @if ($protein_ref_dev == '&nbsp;') {{''}} @elseif (('-0,025' <= $protein_ref_dev) && ($protein_ref_dev <= '0,025')) {{$class}}
                @else {{$class_red}} @endif>{{$protein_ref_dev}}
        </td>
        <td class=
        @if ($lactose_ref_dev == '&nbsp;') {{''}} @elseif (('-0,10' <= $lactose_ref_dev) && ($lactose_ref_dev <= '0,10')) {{$class}}
                @else {{$class_red}} @endif>{{$lactose_ref_dev}}
        </td>
        <td class=
        @if ($urea_ref_dev == '&nbsp;') {{''}} @elseif (('-2,5' <= $urea_ref_dev) && ($urea_ref_dev <= '2,5')) {{$class}}
                @else {{$class_red}} @endif>{{$urea_ref_dev}}
        </td>
        <td class=
        @if ($bhb_ref_dev == '&nbsp;') {{''}} @elseif (('-10' <= $bhb_ref_dev) && ($bhb_ref_dev <= '10')) {{$class}}
                @else {{$class_red}} @endif>{{$bhb_ref_dev}}
        </td>
        <td class=
        @if ($pag_dev == '&nbsp;') {{''}} @elseif (('-0,045' <= $pag_dev) && ($pag_dev <= '0,045')) {{$class}}
                @else {{$class_red}} @endif>{{$pag_dev}}
        </td>
    </tr>
    <tr>
        <td class="bold">Sd</td>		<!-- stampo valore di s_dev per ogni type -->
        <!-- se il valore è superiore al limite, la cella è rossa; se è inferiore, la cella è verde; se è uguale, è bianca -->

        <td class=
        @if ($fat_ref_sdev == '0,030' || $fat_ref_sdev == '&nbsp;') {{''}} @elseif ($fat_ref_sdev >'0,030') {{$class_red}}
                @elseif($fat_ref_sdev < '0,030'){{$class}} @endif>{{$fat_ref_sdev}}</td>

        <!-- limite: 0,020 -->
        <td class=
        @if ($protein_ref_sdev == '0,020' || $protein_ref_sdev == '&nbsp;') {{''}} @elseif ($protein_ref_sdev >'0,020') {{$class_red}}
                @elseif($protein_ref_sdev < '0,020'){{$class}} @endif>{{$protein_ref_sdev}}</td>

        <!-- limite: 0,010 -->
        <td class=
        @if ($lactose_ref_sdev == '0,010' || $lactose_ref_sdev == '&nbsp;') {{''}} @elseif ($lactose_ref_sdev >'0,010') {{$class_red}}
                @elseif($lactose_ref_sdev < '0,010'){{$class}} @endif>{{$lactose_ref_sdev}}</td>

        <!-- limite: 1,5 -->
        <td class=
        @if ($urea_ref_sdev == '1,5' || $urea_ref_sdev == '&nbsp;') {{''}} @elseif ($urea_ref_sdev >'1,5') {{$class_red}}
                @elseif($urea_ref_sdev < '1,5'){{$class}} @endif>{{$urea_ref_sdev}}</td>

        <!-- limite: 10 -->
        <td class=
        @if ($bhb_ref_sdev == '10' || $bhb_ref_sdev == '&nbsp;') {{''}} @elseif ($bhb_ref_sdev >'10') {{$class_red}}
                @elseif($scc_ref_sdev < '10'){{$class}} @endif>{{$bhb_ref_sdev}}</td>

        <td class=
        @if ($pag_sdev == '0,045' || $pag_sdev == '&nbsp;') {{''}} @elseif ($pag_sdev >'0,045') {{$class_red}}
                @elseif($pag_sdev < '0,020'){{$class}} @endif>{{$pag_sdev}}</td>
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
        <td>0,045</td>
        <td>&nbsp;</td>
    </tr>
    <tr class="grey">
        <td class="bold">Sd</td>
        <td>0,030</td>
        <td>0,020</td>
        <td>0,10</td>
        <td>1,5</td>
        <td>0,045</td>
        <td>&nbsp;</td>
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
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php
            $class_f=$class_p=$class_l=$class_u=$class_s=$class_pag="";

            if (isset($outlier[$v])){
                if ($outlier[$v]->fat_rout!="" && $f_a==1)  $class_f="red"; elseif($outlier[$v]->fat_rout=="" && $f_a==1) $class_f="green"; else $class_f="";
                if ($outlier[$v]->protein_rout!="" && $p_a==1)  $class_p="red"; elseif($outlier[$v]->protein_rout=="" && $p_a==1) $class_p="green"; else $class_p="";
                if ($outlier[$v]->lactose_rout!="" && $l_a==1)  $class_l="red"; elseif($outlier[$v]->lactose_rout=="" && $l_a==1) $class_l="green"; else $class_l="";
                if ($outlier[$v]->urea_rout!="" && $u_a==1)  $class_u="red"; elseif($outlier[$v]->urea_rout==""&& $u_a==1) $class_u="green"; else $class_u="";

                if ($outlier[$v]->bhb!="" && $b_a==1)  $class_s="red"; elseif($outlier[$v]->bhb==""&& $b_a==1)
                    $class_s="green"; else $class_s="";

                if ($outlier[$v]->pag!="" && $b_a==1)  $class_pag="red"; elseif($outlier[$v]->pag==""&& $b_a==1)
                    $class_pag="green"; else $class_pag="";

                echo "<td  class=".$class_f.">".$outlier[$v]->fat_rout."</td>";
                echo "<td  class=".$class_p.">".$outlier[$v]->protein_rout."</td>";
                echo "<td  class=".$class_l.">".$outlier[$v]->lactose_rout."</td>";
                echo "<td  class=".$class_u.">".$outlier[$v]->urea_rout."</td>";
                echo "<td  class=".$class_s.">".$outlier[$v]->bhb."</td>";
                echo "<td  class=".$class_pag.">".$outlier[$v]->pag."</td>";

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
        <td class="bold">SCC</td>
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
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php

            $fat_pt=$pro_pt=$lac_pt=$ure_pt=$scc_pt="";
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

            echo "<td class=".$class1.">".$fat_pt."</td>";
            echo "<td class=".$class2.">".$pro_pt."</td>";
            echo "<td class=".$class3.">".$lac_pt."</td>";
            echo "<td class=".$class4.">".$ure_pt."</td>";
            echo "<td></td>";
            ?>
        </tr>
        <?php
        $numsample++;
        ?>
    @endfor

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


    <!-- identica cosa di zscore-pt ma questa volta su tabella zscore-fix-->
    <?php
    //print_r($arr_sp1);
    $numsample=1;
    ?>
    @for($v=1; $v<11; $v++)
        <tr>
            <td>Sample {{$numsample}}</td>
            <?php

            $fat_fx=$pro_fx=$lac_fx=$ure_fx=$scc_fx="";
            $class1=$class2=$class3=$class4=$class5="";

            if (isset($zscorept['fat_rout'])){
                $fat_fx=$zscorept['fat_rout']['sp'.$v];
                if ($fat_fx!=""){
                    if ($fat_fx <'-3') $class1="red";
                    if ($fat_fx >'-3' && $fat_fx<'-2')$class1="yellow";
                    if ($fat_fx >'-2' && $fat_fx<'2')$class1="green";
                    if ($fat_fx >'2'  && $fat_fx<'3')$class1="yellow";
                    if ($fat_fx >'3') $class1="red";
                }
            }

            if (isset($zscorept['protein_rout'])){
                $pro_fx=$zscorept['protein_rout']['sp'.$v];
                if ($pro_fx!=""){
                    if ($pro_fx <'-3') $class2="red";
                    if ($pro_fx >'-3' && $pro_fx<'-2')$class2="yellow";
                    if ($pro_fx >'-2' && $pro_fx<'2')$class2="green";
                    if ($pro_fx >'2'  && $pro_fx<'3')$class2="yellow";
                    if ($pro_fx >'3') $class2="red";
                }
            }

            if (isset($zscorept['lactose_rout'])){
                $lac_fx=$zscorept['lactose_rout']['sp'.$v];
                if ($lac_fx!=""){
                    if ($lac_fx <'-3') $class3="red";
                    if ($lac_fx >'-3' && $lac_fx<'-2')$class3="yellow";
                    if ($lac_fx >'-2' && $lac_fx<'2')$class3="green";
                    if ($lac_fx >'2'  && $lac_fx<'3')$class3="yellow";
                    if ($lac_fx >'3') $class3="red";
                }
            }

            if (isset($zscorept['urea_rout'])){
                $ure_fx=$zscorept['urea_rout']['sp'.$v];
                if ($ure_fx!=""){
                    if ($ure_fx <'-3') $class4="red";
                    if ($ure_fx >'-3' && $ure_fx<'-2')$class4="yellow";
                    if ($ure_fx >'-2' && $ure_fx<'2')$class4="green";
                    if ($ure_fx >'2'  && $ure_fx<'3')$class4="yellow";
                    if ($ure_fx >'3') $class4="red";
                }
            }

            if (isset($zscorept['scc_rout'])){
                $scc_fx=$zscorept['scc_rout']['sp'.$v];
                if ($scc_fx!=""){
                    if ($scc_fx <'-3') $class5="red";
                    if ($scc_fx >'-3' && $scc_fx<'-2')$class5="yellow";
                    if ($scc_fx >'-2' && $scc_fx<'2')$class5="green";
                    if ($scc_fx >'2'  && $scc_fx<'3')$class5="yellow";
                    if ($scc_fx >'3') $class5="red";
                }
            }

            echo "<td class=".$class1.">".$fat_fx."</td>";
            echo "<td class=".$class2.">".$pro_fx."</td>";
            echo "<td class=".$class3.">".$lac_fx."</td>";
            echo "<td class=".$class4.">".$ure_fx."</td>";
            echo "<td></td>";
            ?>
        </tr>
        <?php
        $numsample++;
        ?>
    @endfor

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

@if($pag_a==1)
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
        $class="";
        $chi=array(
                'method'    =>'Method',
                'results'   =>'Presence of PAG',
                'accuracy'  =>'Laboratory accuracy',
                'lactation' =>'Strains',
                'date'      =>'Date',
                'Y'=>'Yes','T'=>'True','F'=>'False','N'=>'No'
        );
        for($v=0; $v<5; $v++){
            $a=$pag[$v]->sample01;
            $b=$pag[$v]->sample02;
            $c=$pag[$v]->sample03;
            $d=$pag[$v]->sample04;
            $e=$pag[$v]->sample05;
            if ($pag[$v]->row =="results" || $pag[$v]->row =="accuracy" ){
                $a=$chi[$pag[$v]->sample01];
                $b=$chi[$pag[$v]->sample02];
                $c=$chi[$pag[$v]->sample03];
                $d=$chi[$pag[$v]->sample04];
                $e=$chi[$pag[$v]->sample05];
            }
            if ($pag[$v]->row =="date" ){
                $a=($a)? date("d-m-Y", strtotime($a)):"";
                $b=($b)? date("d-m-Y", strtotime($b)):"";
                $c=($c)? date("d-m-Y", strtotime($c)):"";
                $d=($d)? date("d-m-Y", strtotime($d)):"";
                $e=($e)? date("d-m-Y", strtotime($e)):"";
            }
            echo "<tr>";
            echo "<td  class=".$class." bold>".$chi[$pag[$v]->row]."</td>";
            echo "<td  class=".$class.">".$a."</td>";
            echo "<td  class=".$class.">".$b."</td>";
            echo "<td  class=".$class.">".$c."</td>";
            echo "<td  class=".$class.">".$d."</td>";
            echo "<td  class=".$class.">".$e."</td>";
            echo "</tr>";
        }
        ?>
    </table>
@endif


<table>
    {!! Charts::scripts() !!}
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
                                {!! $chart['zscorept'][$who]->html() !!}
                            </center>
                        </div>

                        {!! $chart['zscorept'][$who]->script() !!}
                    </div>
                </div>
            </td>
            <td style="width: 50%;">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">ZSCORE-FX - {{$who}}</h3>

                    </div>
                    <div class="box-body">
                        <div class="app">
                            <center>
                                {!! $chartfx['zscorefix'][$who]->html() !!}
                            </center>
                        </div>

                        {!! $chartfx['zscorefix'][$who]->script() !!}
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
</table>


</body>
</html>







