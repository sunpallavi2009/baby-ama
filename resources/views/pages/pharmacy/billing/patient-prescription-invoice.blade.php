@extends('base.pharmacy-dashboard')
@section('pharmacy-content')
<style type="text/css">
        
    #pdf_export tr th{
        padding: 5px!important;
        text-align: center;
        color: #670e36!important;
        font-weight: bold;
    }
    #pdf_export tr td{
        /*font-weight: bold!important;*/
        padding: 5px!important;
        line-height: 1;

    }
    div#kt_content {
        background: white;
    }
    div#kt_footer {
        display: none!important;
    }
    
    @media print {
      .p-dis-row , #kt_aside,#kt_header,#kt_toolbar, #sidebar-wrapper, header, .navbar {
        display: none;
      }
      .footer,#kt_footer,#pdf_print {
            display: none;
      }

      .footer,#kt_footer,#back_btn {
            display: none;
      }
      
      body {-webkit-print-color-adjust: exact;}

      .page-footer {
            /* position: fixed; */
            bottom: 0;
            width: 100%;
            background-color: #6A1B9A;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .inv-logo {
        max-width: 150px;
        }
    }

    @print {
        @page :footer {
            /* display: none */
        }
      
        @page :header {
            /* display: none */
        }
    }
    .pdf-txt-color{
           color: #670e36;
           font-weight: bold;
    }
    .pdf-bg-color{
       background-color: #670e36;
       font-weight: bold;
       color: white;
    }
    #footer {
     height: 20px;
     border-top:3px solid black;
    }
#page {
    height: calc(85vh - 30px); */
    viewport height - footer height
}
.medicine_dot_line{
    border-bottom:1px dotted #000;
}

.inv-logo {
  max-width: 150px;
}
        .header-info p, .header-info .col {
            margin: 0;
        }
        .header-info .col {
            padding: 0 15px;
        }
        .page-footer {
            background-color: #6A1B9A;
            color: white;
            padding: 10px 0;
            text-align: center;
            
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


 <div class="container justify-content-center align-items-center" >
    <div class="pharmacy medicine-stacklist p-5" style="margin-top: 30px;">
        
            <div class="col-md-12 mb-5 text-center">
                <img src="{{ asset('media/logos/baby-ama-logo.png') }}" alt="Babyama"
                    class="img-fluid object-fit-contain inv-logo mx-auto">
            </div>
            <div class="row mb-3">
                <div class="col-md-6 text-right">
                    <i class="fas fa-phone-alt text-primary"></i> 78967 84329 &nbsp;<br>
                    <i class="fas fa-globe text-primary"></i> babyama.in
                </div>
                <div class="col-lg-6 text-right">
                    <span class="text-primary" style="margin-left: 50%;">Invoice No : </span> {{ $invoice->invoice_number }}<br>
                    <span class="text-primary" style="margin-left: 50%;">Invoice Date : </span>{{ Date('d/M/Y') }}
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-12">
                    <h5>Patient Details</h5>
                    <div class="row patient-detail">
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
            </div>
            <hr>
            <h5>Medicine Charges</h5>
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
                        <td colspan="6"> {{ $total }}</td>
                    </tr>
                </tfoot>
            </table>
        
        <div class="page-footer">
            Address: Babyama Women Wellness & Paediatric Centre, New Siddha Pudur, Coimbatore - 638 933.
        </div>

        <div class="mt-5 pt-5">
            <div class="d-flex px-2 justify-content-start align-items-center gap-4 my-5">
                <button id="pdf_print" onclick="printDiv('printableArea')" class="baby-primary-btn" >Print</button>
                <a href="{{ URL::previous() }}" id ="back_btn" class="baby-secondary-btn border-1 text-center">Back</a>
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