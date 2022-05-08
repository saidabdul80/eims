<?php



$session_id = session('selected_invoice_session_id') ?? session('current_session')->id;
$institution_id = session('selected_invoice_institution_id') ?? 1;
$invoices = json_decode(json_encode(DB::table('tiship_inventories')->selectRaw('count(*) as count, payment_reference as ref')->groupBy('payment_reference')->where(['session' => $session_id, 'institution_id' => $institution_id])->paginate(500)));
?>
<div id="invoiceApp" class="w-100" style="height: 68vh;">
    @include('layouts.Formsearch',['routename'=>'invoice_search','dataList'=>$invoices, 'sel_session_id'=>$session_id,'sel_institution_id'=>$institution_id])
    <table class="table w-100" id="datatableX2">
        <thead>

            <tr>
                <td>Reference Number</td>
                <td>total Student</td>                
            </tr>
        </thead>
        <tbody>
            @foreach($invoices->data as $invoice)
            <tr>
                <td>{{$invoice->ref}}</td>
                <td>{{$invoice->count}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
