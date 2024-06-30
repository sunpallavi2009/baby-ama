@extends('base.pharmacy-dashboard')
@section('pharmacy-content')

<style type="text/css">
    #pdf_export tr th {
        padding: 5px !important;
        text-align: center;
        color: #670e36 !important;
        font-weight: bold;
    }

    #pdf_export tr td {
        padding: 5px !important;
        line-height: 1;
    }

    div#kt_content {
        background: white;
    }

    div#kt_footer {
        display: none !important;
    }

    @media print {
        .p-dis-row,
        #kt_aside,
        #kt_header,
        #kt_toolbar,
        #sidebar-wrapper,
        header,
        .navbar,
        .footer,
        #kt_footer,
        #pdf_print {
            display: none;
        }

        body {
            -webkit-print-color-adjust: exact;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 0;
        }

        .charges-table th {
            background-color: #6A1B9A !important;
            color: #fff !important;
        }

        .details-table,
        .charges-table {
            width: 100% !important;
        }

        .details-table th,
        .details-table td,
        .charges-table th,
        .charges-table td {
            padding: 8px !important;
        }

        .inv-logo {
            max-width: 150px;
            max-height: 130px;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            color: #6A1B9A;
        }

        .details-table,
        .charges-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details-table th,
        .details-table td,
        .charges-table th,
        .charges-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .charges-table th,
        .charges-table td {
            text-align: center;
        }

        .charges-table th {
            background-color: #6A1B9A;
            color: #fff;
        }

        .charges-table tfoot tr {
            border-top: 2px solid #6A1B9A;
        }

        .charges-table .totals {
            font-weight: bold;
            text-align: right;
            background-color: #f2f2f2;
        }

        .total-amount {
            text-align: right;
            font-weight: bold;
            color: #6A1B9A;
        }

        .print-footer-line {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            height: 22px;
            line-height: 1.5;
            color: #ffffff;
            background-color: #6A1B9A;
        }

        .row {
            margin-bottom: 10px;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .col-lg-6 {
            width: 50%;
            float: left;
        }

        .col-lg-12,
        .col-md-3,
        .col-md-4,
        .col-md-5 {
            float: left;
        }

        .col-lg-12 {
            width: 100%;
        }

        .col-md-3 {
            width: 26.6667%;
        }

        .col-md-4 {
            width: 33.3333%;
        }

        .col-md-5 {
            width: 40%;
        }
    }

    .pdf-txt-color {
        color: #670e36;
        font-weight: bold;
    }

    .pdf-bg-color {
        background-color: #670e36;
        font-weight: bold;
        color: white;
    }

    #footer {
        height: 20px;
        border-top: 3px solid black;
    }

    .medicine_dot_line {
        border-bottom: 1px dotted #000;
    }

    .inv-logo {
        max-width: 150px;
        max-height: 130px;
    }

    .section-title {
        font-weight: bold;
        margin-top: 20px;
        color: #6A1B9A;
    }

    .details-table,
    .charges-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .details-table th,
    .details-table td,
    .charges-table th,
    .charges-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .charges-table th,
    .charges-table td {
        text-align: center;
    }

    .charges-table th {
        background-color: #6A1B9A;
        color: #fff;
    }

    .charges-table tfoot tr {
        border-top: 2px solid #6A1B9A;
    }

    .charges-table .totals {
        font-weight: bold;
        text-align: right;
        background-color: #f2f2f2;
    }

    .total-amount {
        text-align: right;
        font-weight: bold;
        color: #6A1B9A;
    }

    .print-footer-line {
        text-align: center;
        margin-top: 20px;
        font-size: 12px;
        height: 22px;
        line-height: 1.5;
        color: #ffffff;
        background-color: #6A1B9A;
    }

    .row {
        margin-bottom: 10px;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    .text-center {
        text-align: center;
    }

    .col-lg-6 {
        width: 50%;
        float: left;
    }

    .text-primary {
        color: #6A1B9A !important;
    }
    .patient-detail p {
        margin-bottom: 5px;
    }
    .patient-detail .row > div {
        padding-bottom: 10px;
    }
    table.table th {
        background-color: #6A1B9A;
        color: white;
        font-weight: bold;
        text-align: center; 
        border: 1px solid #ddd;
        padding: 10px; 
    }
    table.table td {
        text-align: center; 
        padding: 10px; 
        border: 1px solid #ddd;
    }
    table.table tfoot {
        text-align: center; 
        padding: 10px; 
        border: 1px solid #ddd;
    }
</style>


<div class="container" id="printableArea" >
    <div class="row mt-1" >


        <div class="col-lg-12" style="margin-top: 30px;">
            <div class="row">
                <div class="col-md-3 mt-5 pb-4">
                    <img src="{{ asset('media/logos/baby-ama-logo.png') }}" alt="Babyama" class="img-fluid object-fit-contain inv-logo">

                </div>
                <div class="col-md-5 mb-5 pb-4 text-left" style="padding-top: 30px;">
                    <p><i class="fas fa-phone-alt text-primary" aria-hidden="true"></i> 78967 84329</p>
                    <p><i class="fas fa-phone text-primary"></i> 0422- 3502606, 350260607</p>
                    <p><i class="fa fa-envelope text-primary" aria-hidden="true"></i> babyamaclinic@gmail.com</p>
                    <p><i class="fa fa-globe text-primary" aria-hidden="true"></i> www.babyama.in</p>
                </div>
                <div class="col-md-4 align-self-center">
                    <p><span class="text-primary">Invoice No  </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;{{ $invoice->invoice_number }}</p>
                    <p><span class="text-primary">Invoice Date  </span>&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;{{ $appointment->appoinment_date }}</p>
                    <p><span class="text-primary">GST No.</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;  33AAJCB9659A1ZO</span></p>
                </div>
            </div>
        </div>

        <span style="border: 2px solid #714B9D;"></span>

        <div class="row col-md-12 mb-3" style="margin-top: 30px;">
            <div class="col-md-6">
                <h3>Patient Details</h3>
            </div>
        </div>


        <div class="col-lg-12 p-4" style="background-color: #F9F7FB;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
            <div class="row ">
                <div class="col-6">
                    <div class="row">
                        <div class="col-5 text-primary">Patient Name </div>
                        <div class="col-7">{{ ucfirst($user->first_name)." ".ucfirst($user->last_name) }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-primary">Age </div>
                        <div class="col-7">{{ ($user->age) }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-primary">Sex </div>
                        <div class="col-7">{{ ($user->gender) }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-primary">Father's name </div>
                        <div class="col-7">{{ ($user->father_name) }}</div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <div class="col-5 text-primary">UMR No </div>
                        <div class="col-7">{{ ($user->umr_no) }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-primary">OP No </div>
                        <div class="col-7">{{ ($user->op_no) }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-primary">Phone Number </div>
                        <div class="col-7">{{ ($user->father_phone)." ".($user->mother_phone) }}.</div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-primary">Address </div>
                        <div class="col-7">{{ ($user->address)}}</div>
                    </div>
                </div>
            </div>
        </div>

        <hr />

        <h5>Medicine Charges</h5>
          <div style="overflow-x: auto;margin-bottom:250px;">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>S.No</th>
                        <th>Medicine</th>
                        <th>Qty.</th>
                        <th>Price</th>
                        {{-- <th>Discount</th> --}}
                        <th>SGST</th>
                        <th>CGST</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; $total = 0; $tax = 0; @endphp
                    @foreach($invoice_details as $key => $val)
                        @php
                            $list_med = App\Models\Medicine::find($val->medicine_id);
                            $taxval = isset($list_med) && isset($list_med->selling_tax) ? $list_med->selling_tax : 0;
                            $tot = $list_med ? $list_med->selling_price * $val->total_qty * (1+($list_med->buying_tax/100))+($list_med->selling_tax/100): 0;
                        @endphp
                        <tr>
                            <td scope="row">{{ $i }} </td>
                            <td>{{ $list_med ? $list_med->name . ' (' . helperFormatMedicinePrefix($list_med->type) . ')' : 'Medicine not found' }}</td>
                            <td>{{ $val->total_qty }}</td>
                            <td>&#x20B9; {{ $list_med ? $list_med->selling_price : 'N/A' }}</td>
                            {{-- <td>&#x20B9; {{ $list_med ? $list_med->selling_price : 'N/A' }}</td> --}}
                            {{-- <td>{{ $list_med->buying_tax }}</td> --}}
                            <td>{{ $list_med->buying_tax }}</td>
                            <td>{{ $list_med->selling_tax }}</td>
                            
                            <td>&#x20B9; {{ $tot }}</td> 
                        </tr>
                        @php
                            $i++;
                            $total += $tot;
                            $tax += $taxval;
                        @endphp
                    @endforeach  
                </tbody>
                <tfoot>
                    <tr>
                        
                        <td colspan="6" style="text-align: right; "><strong>Total Amount:</strong></td>
                        <td id="total-amount" style="background-color: #6A1B9A;height:50px;width:auto;margin-left: auto;color:#ffffff;">₹ {{ $total }}</td>
                        {{-- <td colspan="6"> {{ $total }}</td> --}}
                    </tr>
                </tfoot>
            </table>
          </div>


        {{-- <div class="section-title mb-4">Fees Summary</div>
        <div style="overflow-x: auto;margin-bottom:150px;">
            <table class="charges-table" id="fees-summary-table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Description</th>
                        <th>Qty.</th>
                        <th>Price</th>
                        <th>Discount (%)</th>
                        <th>SGST (%)</th>
                        <th>CGST (%)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($feeSummaries))
                    @foreach ($feeSummaries as $index => $summary)
                    <tr>
                        <td>{{ sprintf('%02d', $index + 1) }}</td>
                        <td>{{ $summary['description'] }}</td>
                        <td>{{ $summary['quantity'] }}</td>
                        <td>{{ $summary['price'] }}</td>
                        <td>{{ $summary['discount'] }}</td>
                        <td>{{ $summary['sgst'] }}</td>
                        <td>{{ $summary['cgst'] }}</td>
                        <td>{{ $summary['total'] }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td>Paid by : {{ $appointment['payment_method'] }}</td>
                        <td colspan="6" class="totals" style="background-color:#ffffff;color:#714B9D;">Total Amount</td>
                        <td id="total-amount" style="background-color: #6A1B9A;height:50px;width:auto;margin-left: auto;color:#ffffff;">₹ {{ isset($appointment['total_amount']) ?
                            $appointment['overall_total_amount'] : '0.00' }}</td>
                    </tr>
                </tfoot>
            </table>
        </div> --}}

        <p class="text-end">This bill generated by computer doesn't need signature.</p>
        <span style="border: 2px solid #714B9D;"></span>
        <div class="text-center" style="color: #714B9D;text-algn:center;">
            MP Creations, No 77, 4th floor, NVN Layout VKK Menon Road, New Siddhapudhur, Coimbatore - 641 044.
        </div>
    </div>

    <div class="row my-5 pt-5">
        <div class="col-md-12">
            <div class="text-center">
                {{-- <a href="{{ URL::previous() }}" id ="back_btn" class="baby-secondary-btn border-1 text-center">Back</a> --}}
                <button id="pdf_print" onclick="printDiv('printableArea')"
                    class="btn btn-secondary">PRINT</button>
            </div>
        </div>
    </div>

</div>
@endsection


<script type="text/javascript">
    function printDiv(divName) {
           var today = new Date();
           var timesheetdate=today.getDate()+'-'+today.getMonth()+1+'-'+today.getFullYear();
            {{-- var patientName ="{{$patientName}}"; --}}
            patientName = '';
             patientName = patientName.replace(" ", "_");

            // document.title = "patient_"+patientName+"_prescription_"+timesheetdate;
            window.print();
       }
</script>