<x-base-layout>
    <section>


        <style type="text/css">
            #pdf_export tr th {
                padding: 5px !important;
                text-align: center;
                color: #670e36 !important;
                font-weight: bold;
            }

            #pdf_export tr td {
                /*font-weight: bold!important;*/
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
                .navbar {
                    display: none;
                }

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
            }

            @print {
                @page :footer {
                    /* display: none; */
                }

                @page :header {
                    display: none;
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
                max-width: 100px;
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
                font-size: 18px;
                color: #ffffff;
                background-color: #6A1B9A;
            }
        </style>

        <div class="container" id="page">
            <div class="row mt-1">
                <div class="col-md-12 mb-5 text-center">
                    <img src="{{ asset('media/logos/baby-ama-logo.png') }}" alt="Babyama"
                        class="img-fluid object-fit-contain inv-logo mx-auto">
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 text-right">
                        <i class="fas fa-phone-alt text-primary"></i> 78967 84329 &nbsp;<br>
                        <i class="fas fa-globe text-primary"></i> babyama.in
                    </div>
                    <div class="col-lg-6 text-end">
                        <span class="text-primary">Invoice No : </span> &nbsp;<br>
                        <span class="text-primary">Invoice Date : </span>{{Date('d-M-Y')}}
                    </div>
                </div>

                <hr>

                <div class="row col-md-12 mb-3 mt-4">
                    <div class="col-md-6">
                        <h3>Patient Details</h3>
                    </div>
                </div>


                <div class="col-lg-12 p-4" style="background-color: #F9F7FB;overflow-x:auto">
                    <div class="row ">
                        @if($appointment->user->patient)
                        @php
                        $patient = $appointment->user->patient;
                        @endphp
                        <div class="col-lg-6">
                            <div class="patient-info">
                                @if($patient->first_name && $patient->last_name)
                                <p>
                                    <span style="color:#714B9D;"><b>Patient Name</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->first_name}} {{$patient->last_name}}</span>
                                </p>
                                @endif
                                {{-- @if($patient->father_name)
                                <p>
                                    <span style="color:#714B9D;"><b>Father Name</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->father_name}}</span>
                                </p>
                                @endif --}}
                                @if($patient->blood_group)
                                <p>
                                    <span style="color:#714B9D;"><b>Blood Group</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->blood_group}}</span>
                                </p>
                                @endif
                                @if($patient->d_o_b)
                                <p>
                                    <span style="color:#714B9D;"><b>DOB</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->d_o_b}}</span>
                                </p>
                                @endif
                                @if($patient->age)
                                <p>
                                    <span style="color:#714B9D;"><b>Age</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->age}}</span>
                                </p>
                                @endif
                            </div>
                        </div>
                        @endif

                        {{-- <div class="col-md-4">
                            <div class="patient-info">
                                @if($appointment->appoinment_date)
                                <p>
                                    <span style="color:#714B9D;"><b>Appoinment Date</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$appointment->appoinment_date}}</span>
                                </p>
                                @endif
                                @if($appointment->appoinment_session)
                                <p>
                                    <span style="color:#714B9D;"><b>Session</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$appointment->appoinment_session}}</span>
                                </p>
                                @endif
                                @if($appointment->appoinment_time)
                                <p>
                                    <span style="color:#714B9D;"><b>Time</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$appointment->appoinment_time}}</span>
                                </p>
                                @endif
                            </div>
                        </div> --}}

                        <div class="col-lg-6">
                            <div class="patient-info">
                                {{-- @if($doctor->first_name)
                                <p>
                                    <span style="color:#714B9D;"><b>Doctor Name</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$doctor->first_name}} {{$doctor->last_name}}</span>
                                </p>
                                @endif
                                @if($appointment->specialists)
                                <p>
                                    <span style="color:#714B9D;"><b>Specialist</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$appointment->specialists}}</span>
                                </p>
                                @endif
                                @if($userInfo->reg_no)
                                <p>
                                    <span style="color:#714B9D;"><b>Reg No</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$userInfo->reg_no}}</span>
                                </p>
                                @endif --}}
                                @if($patient->umr_no)
                                <p>
                                    <span style="color:#714B9D;"><b>UMR No</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->umr_no}}</span>
                                </p>
                                @endif
                                @if($patient->op_no)
                                <p>
                                    <span style="color:#714B9D;"><b>OP No</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->op_no}}</span>
                                </p>
                                @endif
                                @if($patient->father_phone)
                                <p>
                                    <span style="color:#714B9D;"><b>Phone Number</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->father_phone}}</span>
                                </p>
                                @endif
                                @if($patient->address)
                                <p>
                                    <span style="color:#714B9D;"><b>Address</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->address}}</span>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="section-title mb-4">Consulting Charges</div>
                <table class="charges-table" id="consulting-charges-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Service</th>
                            <th>Consultant Name</th>
                            <th>Fees</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($consultingCharges))
                        @foreach ($consultingCharges as $index => $charge)
                        <tr>
                            <td>{{ sprintf('%02d', $index + 1) }}</td>
                            <td>{{ $charge['service'] }}</td>
                            <td>{{ $charge['consultant_name'] }}</td>
                            <td>{{ $charge['fees'] }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>


                <div class="section-title mb-4">Fees Summary</div>
                <div style="overflow-x: auto;">
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
                                <td colspan="7" class="totals">Total Amount:</td>
                                <td id="total-amount">{{ isset($appointment['total_amount']) ?
                                    $appointment['total_amount'] : '0.00' }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="print-footer-line">
                    Address: Babyama Women Wellness & Paediatric Centre, New Siddha Pudur, Coimbatore - 638 933.
                </div>
            </div>

            <div class="row my-5 pt-5">
                <div class="col-md-12">
                    <div class="text-center">
                        <button id="pdf_print" onclick="printDiv('printableArea')"
                            class="btn btn-secondary">PRINT</button>
                    </div>
                </div>
            </div>
    </section>
</x-base-layout>

<script type="text/javascript">
    function printDiv(divName) {
        var today = new Date();
        var timesheetdate = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();
        var patientName = '';
        patientName = patientName.replace(" ", "_");
        document.title = "patient_" + patientName + "_prescription_" + timesheetdate;
        window.print();
    }
</script>
