<x-base-layout>
    <section>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha384-jLKHWM+grD3v4s/ZjXc+oa5RjZoRJcAcCO1h4p8f0jCbYXebO1IQgQUK2RAkOo98" crossorigin="anonymous">
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
            .landline-icon {
            position: relative;
            display: inline-block;
            margin-right: 5px;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            }

            .landline-icon:before {
            content: "\f67d"; /* Font Awesome "phone-office" icon unicode */
            color: #0d6efd; /* Primary color */
            }
        </style>


        <div class="container" id="printableArea">
            <div class="row mt-1">


                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-3 mb-5 pb-4 text-left">
                            <img src="{{ asset('media/logos/baby-ama-logo.png') }}" alt="Babyama"
                                class="img-fluid object-fit-contain inv-logo mx-auto">
                        </div>
                        <div class="col-md-5 mb-5 pb-4 text-left" style="padding-top: 30px;">
                            <p><i class="fas fa-phone-alt text-primary" aria-hidden="true"></i> 78967 84329</p>
                            <p><i class="fas fa-phone-alt text-primary" aria-hidden="true"></i> 0422- 3502606, 350260607</p>
                            <p><i class="fa fa-envelope text-primary" aria-hidden="true"></i> babyamaclinic@gmail.com</p>
                            <p><i class="fa fa-globe text-primary" aria-hidden="true"></i> www.babyama.in</p>
                        </div>
                        <div class="col-md-4 text-end align-self-center">
                            <div class="patient-info">
                                <p>
                                    <span style="color:#714B9D;"><b>Invoice No</b></span>
                                    <span class="separator">:</span>
                                    <span>{{ $appointment->invoice_number }}</span>
                                </p>
                                <p>
                                    <span style="color:#714B9D;"><b>Invoice Date</b></span>
                                    <span class="separator">:</span>
                                    <span>{{ $appointment->appoinment_date }}</span>
                                </p>
                                <p>
                                    <span style="color:#714B9D;"><b>GST No.</b></span>
                                    <span class="separator">:</span>
                                    <span>33AAJCB9659A1ZO</span>
                                </p>
                            </div>
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
                                @if($patient->gender)
                                <p>
                                    <span style="color:#714B9D;"><b>Sex</b></span>
                                    <span class="separator">:</span>
                                    <span>{{$patient->gender}}</span>
                                </p>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="col-lg-6">
                            <div class="patient-info">
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
                </div>

                <p class="text-end">This bill generated by computer doesn't need signature.</p>
                <span style="border: 2px solid #714B9D;"></span>
                <div class="text-center" style="color: #714B9D;text-algn:center;">
                    MP Creations, No 77, 4th floor, NVN Layout VKK Menon Road, New Siddhapudhur, Coimbatore - 641 044.
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
