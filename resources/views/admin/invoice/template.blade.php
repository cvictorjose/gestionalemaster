

<head>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: 0;
            padding: 2px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 12px;
            line-height: 14px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            max-width: 800px;
        }

        .invoice-box table td {
            padding: 2px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 2px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 10px;
            line-height: 10px;
            color: #333;
        }



        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #757575 ;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 2px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
            font-size: 9px;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="assets/img/logo_pdf.png" width="200">
                        </td>
                    </tr>
                    <tr>
                        <td width="380">
                            <div class="table border">
                                <div class="table-row ">
                                    <div><b  class="title">Place</b> Rome</div>
                                    <div><b  class="title">Date</b> {{$date}}</div>
                                    <div><b  class="title">Invoice No.</b> {{$invoice}}</div>
                                    <div><b  class="title">VAT No.</b> @if($lab->invoicetype!="NOUE"){{$lab->vat_number}}@endif</div>
                                    <div><b  class="title">TAX No.</b> @if($lab->invoicetype=="NOUE"){{$lab->vat_number}}@endif</div>
                                </div>
                            </div>
                        </td>
                        <td width="140">
                            @if($lab->invoicetype=="IT")
                                {{$lab->lab_name}}<br>
                                Att.{{$lab->contatto_amministrativo}}<br>
                                {{$lab->invoice_address}}<br>
                                {{$lab->invoice_cap}} {{$lab->invoice_city}}
                                {{$lab->invoice_country}}
                            @else
                                {{$lab->lab_name}}<br>
                                {{$lab->invoice_address}}<br>
                                {{$lab->invoice_city}} {{$lab->invoice_cap}}<br>
                                {{$lab->invoice_country}}<br>
                                Att.{{$lab->contatto_amministrativo}}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td colspan="2">
                ACTIVITIES
            </td>
        </tr>

        <tr class="details">
            <td colspan="2" style="padding: 5px;">
                {{$activities}} <br>
            </td>
        </tr>

        <tr class="heading">
            <td>
                ICAR PT fee
            </td>
            <td>
                {{$lab->participation_fee}}
            </td>
        </tr>

        @if($lab->total_ref>0)
            <tr class="heading">
                <td colspan="2">
                    Reference Method
                </td>
            </tr>
            @if($lab->fat_ref>0)
            <tr class="item">
                <td>Fat_ref</td>
                <td>{{$lab->fat_ref}}</td>
            </tr>
            @endif


            @if($lab->protein_ref>0)
                <tr class="item">
                    <td>Protein_ref</td>
                    <td>{{$lab->protein_ref}}</td>
                </tr>
            @endif

            @if($lab->lactose_ref>0)
                <tr class="item">
                    <td>Lactose_ref</td>
                    <td>{{$lab->lactose_ref}}</td>
                </tr>
            @endif



            @if($lab->urea_ref>0)
                <tr class="item">
                    <td>Urea_ref</td>
                    <td>{{$lab->urea_ref}}</td>
                </tr>
            @endif

            @if($lab->scc_ref>0)
                <tr class="item">
                    <td>Scc_ref</td>
                    <td>{{$lab->scc_ref}}</td>
                </tr>
            @endif
        @endif

        @if($lab->total_rout>0)
            <tr class="heading">
                <td colspan="2">
                    Alternative Method
                </td>
            </tr>

            @if($lab->fat_rout>0)
                <tr class="item">
                    <td>Fat_rout</td>
                    <td>{{$lab->fat_rout}}</td>
                </tr>
            @endif


            @if($lab->protein_rout>0)
                <tr class="item">
                    <td>Protein_rout</td>
                    <td>{{$lab->protein_rout}}</td>
                </tr>
            @endif

            @if($lab->lactose_rout>0)
                <tr class="item">
                    <td>Lactose_rout</td>
                    <td>{{$lab->lactose_rout}}</td>
                </tr>
            @endif

            @if($lab->urea_rout>0)
                <tr class="item">
                    <td>Urea_rout</td>
                    <td>{{$lab->urea_rout}}</td>
                </tr>
            @endif

            @if($lab->bhb>0)
                <tr class="item">
                    <td>BHB</td>
                    <td>{{$lab->bhb}}</td>
                </tr>
            @endif

            @if($lab->pag>0)
                <tr class="item">
                    <td>PAG</td>
                    <td>{{$lab->pag}}</td>
                </tr>
            @endif

            @if($lab->dna>0)
                <tr class="item">
                    <td>DNA</td>
                    <td>{{$lab->dna}}</td>
                </tr>
            @endif
        @endif


        <tr class="heading">
            <td>
                Shipment cost
            </td>
            <td>
                {{$lab->shipment_cost}}
            </td>
        </tr>

        <tr class="heading">
            <td>
                @if($lab->invoicetype=="IT")IVA 22% @endif

                @if($lab->invoicetype=="UE")Non soggette ad I.V.A per carenza del requisito territoriale ai sensi dell'art. 7 ter DPR 633/72
                    INVERSIONE CONTABILE.@endif

                @if($lab->invoicetype=="NOUE")F.C.I.<br>OPERAZIONE NON SOGGETTA @endif
            </td>
            <td>
                @if($lab->invoicetype=="IT"){{$lab->iva}} @endif
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                Totale dovuto (total due): EURO {{$lab->total}}
            </td>
        </tr>

        <tr>
            <td colspan="2"><br><br>
                Il pagamento potr&agrave; essere effettuato a mezzo bonifico bancario (vedere estremi in calce)<br>
                The payment must be made directly to our account (see bank instructions below)<br><br>
            </td>
        </tr>
    </table>


    <table cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <img src="assets/img/tmp_footer.png">
            </td>
        </tr>
    </table>

</div>
</body>
