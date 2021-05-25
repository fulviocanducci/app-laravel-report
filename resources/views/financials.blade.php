@extends("report")
@section("body")
    <div id="head">
        <div style="width:100%;">
            <div style="float:left;width:80%; text-align:center; height:30px; vertical-align:bottom">
                <h1>Ficha Financeira de Processos (Analíticos)</h1>
            </div>
            <div style="float:left;width:20%; text-align:right; height:30px">
                <p style="margin-top:7px; padding:0;height:20px"></p>
                <p style="margin: 0; padding:0; font-size:9px">{{date("d/m/Y h:i:s")}}</p>
            </div>            
        </div>        
    </div>    
    <div id="footer">
        <div class=""></div>
    </div>    
    <div id="corpo">
        <div style="width: 100%; text-align: center; font-size: 9px;">
            Datas: {{$data_ini}} e {{$data_end}}
        </div>
        <hr style="border:0.01mm solid #333" />        
        <br />
        @php
            $total_global = 0;
        @endphp
        @forelse($datas as $data)        
        <div style="border: 1px solid #333; padding: 5px;margin-bottom:5px;">{{$data->fantasy}} - {{$data->name}}</div>
            @php
                $total = 0;
                $quant = 0;
            @endphp
            @forelse($data->processes as $process)
            @php
                $debito = 0;
                $credito = 0;
            @endphp
            <table>
                <tr>
                    <td colspan="4" style="padding-left:5px;border-bottom:0.01mm solid #333"><strong>Processo: </strong> {{$process->number_process}}</td>
                </tr>
                <tr>
                    <td style="text-align:center;width:10%"><strong>Data</strong></td>
                    <td style="text-align:left"><strong>Descrição</strong></td>
                    <td style="text-align:center;width:10%"><strong>Tipo</strong></td>
                    <td style="text-align:center;width:10%"><strong>Valor</strong></td>
                </tr>
                @forelse($process->financials as $financial)
                @php
                    if ($financial->type === "Receber") $credito += $financial->value;
                    if ($financial->type === "Pagar") $debito += $financial->value;
                @endphp
                <tr>
                    <td style="text-align:center;">{{$financial->competence}}</td>
                    <td style="text-align:left;">{{$financial->description}}</td>
                    <td style="text-align:center;">{{$financial->type === "Receber" ? "Crédito": "Débito"}}</td>
                    <td style="text-align:right;margin-right:2px">{{App\Helpers\Helper::formatDecimal($financial->value,2)}}</td>
                </tr>
                @empty
                @endforelse
                <tr>                    
                    <td colspan="3" style="text-align:right;margin-right:5">SubTotal:</td>
                    <td colspan="1" style="text-align:right;">{{App\Helpers\Helper::formatDecimal($credito - $debito,2)}}</td>
                </tr>
                @php
                    $total += $credito - $debito;
                    $quant ++;
                @endphp
            </table>
            @empty
            <div>nenhumprocesso</div>
            @endforelse
            <table style="margin-top: 10px; margin-bottom:10px">
                <tr>
                    <td style="text-align:right;">Quantidade de processos {{$quant}} no valor Total: {{App\Helpers\Helper::formatDecimal($total, 2)}}</td>
                </tr>
            </table>
            @php
                $total_global += $total;
            @endphp
        @empty            
        @endforelse
        <div style="width:100%; text-align:right; margin-top:20px; border-top:1px solid #111;padding-top:5px;">
            <strong>Total Geral:</strong>{{App\Helpers\Helper::formatDecimal($total_global, 2)}}
        </div>
    </div>
@endsection