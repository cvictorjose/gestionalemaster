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


    {{-- <tr>
         <td class="left bold">Method</td>
         <!-- cerco nella tabella "pag" con queste coordinate:
             round = deve essere il codice round attuale, quello usato in tutto il report finora
             icar_code = per individuare il laboratorio per cui sto facendo il report
             row = deve essere uguale a "method"
             stampa i valori da sample 01 a sample05 nelle celle della riga
         -->
         <td>IDEXX</td>
         <td>IDEXX</td>
         <td>IDEXX</td>
         <td>IDEXX</td>
         <td>IDEXX</td>
     </tr>
     <tr>
         <td class="left bold">Presence of PAG</td>
         <!-- cerco nella tabella "pag" con queste coordinate:
             round = deve essere il codice round attuale, quello usato in tutto il report finora
             icar_code = per individuare il laboratorio per cui sto facendo il report
             row = deve essere uguale a "results"
             stampa i valori da sample 01 a sample05 nelle celle della riga
         -->
         <td>Yes</td>
         <td>No</td>
         <td>No</td>
         <td>No</td>
         <td>Yes</td>
     </tr>--}}
    {{-- <tr>
         <td class="left bold">Strains</td>
         <!-- cerco nella tabella "pag" con queste coordinate:
             round = deve essere il codice round attuale, quello usato in tutto il report finora
             icar_code = deve essere uguale a "all"
             row = deve essere uguale a "lactation"
             stampa i valori da sample 01 a sample05 nelle celle della riga
         -->
         <td>Non pregnant</td>
         <td>Pregnant - Artificial insemination</td>
         <td>Pregnant - Artificial insemination</td>
         <td>Pregnant - Artificial insemination</td>
         <td>Non pregnant</td>
     </tr>
     <tr>
         <td class="left bold">Date</td>
         <!-- cerco nella tabella "pag" con queste coordinate:
             round = deve essere il codice round attuale, quello usato in tutto il report finora
             icar_code = deve essere uguale a "all"
             row = deve essere uguale a "date"
             stampa i valori da sample 01 a sample05 nelle celle della riga
         -->
         <td>&nbsp;</td>
         <td>12/09/2017</td>
         <td>10/10/2017</td>
         <td>09/11/2017</td>
         <td>&nbsp;</td>
     </tr>--}}
    {{-- <tr>
         <td class="left bold">Laboratory accuracy</td>
         <!-- cerco nella tabella "pag" con queste coordinate:
             round = deve essere il codice round attuale, quello usato in tutto il report finora
             icar_code = per individuare il laboratorio per cui sto facendo il report
             row = deve essere uguale a "accuracy"
             stampa i valori da sample 01 a sample05 nelle celle della riga
         -->
         <td>True</td>
         <td>True</td>
         <td>True</td>
         <td>False</td>
         <td>True</td>
     </tr>--}}
</table>