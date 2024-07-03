@extends('base.pharmacy-dashboard')
@section('pharmacy-content')
@php
use App\Models\Medicine;
@endphp
    <style type="text/css">
        .error-div {
            color: red;
        }
        .error-input {
            border: 1px solid red !important;
        }
    </style>
    <div class="pharmacy medicine-stacklist baby-border p-5" style="margin-top: 50px;">
        {{-- head --}}
        <div class="row mx-0 align-items-center justify-content-between py-4">
            {{-- <h1>Single User Details</h1> --}}

            {{-- <a href="{{ route('pharmacy.billing.patient.invoice','20') }}"
                                class="ps-0 inline-block sidebar-link">Get Invoice</a> --}}
            <div class="head baby-shadow py-3 px-5">
                <div class="row px-5 py-4 align-items-center justify-content-between">
                    <div class="col-12 col-md-5 col-lg-3 col-xl-2">
                        <div class="patient-img d-flex justify-content-center align-items-center mx-auto">
                            @php
                                $f = substr($user->first_name,0,1);
                                $l = substr($user->last_name,0,1);
                            @endphp
                            <p class="name mb-0">
                            {{  strtoupper($f.$l) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-5 col-xl-6">
                        <div class="patient-info">
                            <p class="name"><b>{{ ucfirst($user->first_name)." ".ucfirst($user->last_name) }}</b> </p>
                            <p class="doctor-patinet-app-list-color">UMR NO. {{ $user->umr_no  }}</p>
                            <p class="doctor-patinet-app-list-color"><span class="fw-normal"> Age: </span> {{ $user->age  }}</p>
                            <p class="doctor-patinet-app-list-color">
                                <span class="fw-normal"> Blood Group: </span> {{ isset($user->blood_group) ?  $user->blood_group : "Not Mentioned"  }}
                            </p>
                            <p class="doctor-patinet-app-list-color">
                                <span class="fw-normal"> O/P No: </span> {{ $user->op_no  }}
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                        <div class="text-center">
                            <a class="pharma-btn primary"
                                href="{{ route('pharmacy.billing.patient.invoice', ['prid'=>$prescription_id, 'userid'=>$user->user_id, 'appointment_id'=>$appointment]) }}" contenteditable="false"
                                style="cursor: pointer;">Get Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0">
            <div class="col-12 col-md-11 col-lg-10  baby-border p-3 rounded-1  mb-3">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-sm-4 col-md-6 col-lg-6 ">
                        <h4 class="text-baby-v2 font-medium mb-md-0">Drug and Prescription </h4>
                    </div>
                    <div class="col-12 col-sm-8 col-md-9 col-lg-6 text-end">
                        <a class="baby-primary-btn" data-bs-toggle="modal" data-bs-target="#pharmaAddMed"
                            href="http://babyama.test/doctor/appointment/26/patient/202/medicine/40">+
                            Add/Modify Prescriptions</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- precriptions --}}
        <div class="row mx-0 ">

            <div class="medicine-list px-0 col-12 col-md-11 col-lg-10">
                <div class="prescription-table baby-border border-bottom-0 my-3 rounded-1">
                    <div class="table-responsive ">
                        <table class="table mb-0">
                            <thead class="table-light bg-color-v1">
                                <tr>
                                    <th scope="col" class="text-center">S.No</th>
                                    <th scope="col" class="bg-color-v1 p-name">MEDICINE</th>
                                    <th scope="col" class="bg-color-v1 text-center">DOSAGE</th>
                                    <th scope="col" class="bg-color-v1 text-center">TIMING</th>
                                    <th scope="col" class="bg-color-v1 text-center ">RELATION TO FOOD</th>
                                    <th scope="col" class="bg-color-v1 text-center">FOLLOW UP DAYS</th>
                                    <th scope="col" class="bg-color-v1 text-center">QTY</th>
                                    {{-- <th scope="col" class="bg-color-v1 text-center">PRESCRIPTION BY</th> --}}
                                    <th scope="col" class="bg-color-v1 text-center">Action</th>

                                   {{--
                                   <th scope="col" class="bg-color-v1 text-center">PRESCRIPTION BY</th>
                                   --}}
                                </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            @foreach($listpm as $key => $val)
                            @php
                            $list_med = Medicine::find($val->medicine_id);
                            @endphp
                                <tr>
                                    <th scope="row" class="text-center">{{ $i }}</th>
                                    <td class="text-center">{{ $list_med ? $list_med->name : ' ' }}</td>
                                    <td class="text-center">{{$val->intake_qty.' '.$val->dosage}}</td>
                                    <td class="text-center">{{$val->timing_when}}</td>
                                    <td class="text-center">{{$val->timing_how}}</td>
                                    <td class="text-center">{{$val->duration}} </td>
                                    <td class="text-center">{{$val->total_qty}}</td>
                                   {{-- <td class="text-center">{{ ($val->prescription_by == '1') ? "Doctor" : "Pharmacy" }}</td> --}}

                                    <td class="text-center"><button class="action-btn" data-bs-toggle="modal" data-bs-target="#EditMedicine<?php echo $val->id; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 16 16" fill="none">
                                        <path d="M10.9921 2.49662C11.1496 2.33917 11.3365 2.21428 11.5422 2.12907C11.7479 2.04386 11.9684 2 12.1911 2C12.4138 2 12.6342 2.04386 12.84 2.12907C13.0457 2.21428 13.2326 2.33917 13.39 2.49662C13.5475 2.65407 13.6724 2.84099 13.7576 3.04671C13.8428 3.25242 13.8867 3.47291 13.8867 3.69557C13.8867 3.91824 13.8428 4.13873 13.7576 4.34444C13.6724 4.55016 13.5475 4.73708 13.39 4.89453L5.29712 12.9875L2 13.8867L2.89921 10.5895L10.9921 2.49662Z"  stroke="#667085" stroke-width="1.11111"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button></td>
                                   {{-- <td class="text-center">{{ ($val->prescription_by == '1') ? "Doctor" : "Pharmacy" }}</td> --}}
                                </tr>
                            @php $i++; @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <div class="row mx-0 py-3 align-items-center">

                <div class="col-12 d-flex gap-2 align-items-center">
                    <a href="{{ route('pharmacy.billing.prescription.list') }}" class="baby-btn-v1">Back</a>
                    <a href="{{ route('pharmacy.billing.complete.medicine', $prescription_id) }}" class="act-btn success">Completed</a>
                </div>
            </div>


            @include('pages.pharmacy.billing._add-modify-prescriptions');

   <!-- medicine properties modal  -->
            @foreach ($medicines as $medicine1)
                @php
                    $getType = $medicine1->dosage ? ' (' . $medicine1->dosage . ')' : '';
                    $fullName = helperFormatMedicinePrefix($medicine1->type) . ' ' . $medicine1->name . $getType;
                @endphp
                    <form action="{{ route('pharmacy.billing.prescription.medicine.post', ['prid' => $prescription_id ]) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->user_id }}">
                    <input type="hidden" name="pr_add_edit" id="pr_add_edit" value="add">
                    <input type="hidden" name="medicine_id" id="medicine_id" value="{{ $medicine1->id }}">

                    <div class="col-12">
                        <div class="modal fade med-data-modal" id="MedPopModal{{ $medicine1->id }}" tabindex="-1"
                            aria-labelledby="MedPopModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-4">
                                        <h3 class="modal-title fs-5 text-center med-name w-100" id=" MedPopModalLabel">
                                            <span
                                                class="me-2">({{ helperFormatMedicinePrefix($medicine1->type) }})</span>
                                            {{ $medicine1->name }}
                                            <span class="ms-2">({{ $medicine1->dosage }})</span>
                                        </h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <!-- Dosage -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Dosage
                                                </div>
                                                <div class="col-8">
                                                    <div class="row justify-content-between align-items-center mx-0">
                                                        <div class="col-6 form-fl px-1">

                                                            <input type="number" class="form-control rounded-0"
                                                                placeholder="0" id="intake_dosage_{{ $medicine1->id }}"
                                                                name="intake_qty" value=""
                                                                onchange="dosage_incnt(this.value,'{{ $medicine1->id }}')"
                                                                step="0.01" min="0.01" required>
                                                        </div>
                                                        <div class="col-6 form-fl px-1">
                                                            {{-- <input type="text" class="form-control rounded-0"
                                                                placeholder="Tab" id="insReportName" name="tab_name"
                                                                value="" disabled> --}}
                                                            <select class="form-control rounded-0" name="dosage"
                                                                id="dosage_{{ $medicine1->id }}"
                                                                onchange="dosagein(this.value,'{{ $medicine1->id }}')">
                                                                <option value="Tablet">Tablet</option>
                                                                <option value="Ml"> ML</option>
                                                                 <option value="Drop"> Drop</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Timing -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative"
                                                    id="timing_chkbox_{{ $medicine1->id }}">
                                                    Timing
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0" id="add_chkbox_{{ $medicine1->id }}">
                                                        <div class="col-4 px-1">
                                                            <div class="select-chk">
                                                                <input type="checkbox" id="TMorning_{{ $medicine1->id }}"
                                                                    name="timing_when[]" value="Morning"
                                                                    class="add_chkbox_{{ $medicine1->id }}"
                                                                    onClick="chkcnt({{ $medicine1->id }})">
                                                                <label for="TMorning">Morning</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <div class="select-chk">
                                                                <input type="checkbox"
                                                                    id="Tafternoon_{{ $medicine1->id }}"
                                                                    name="timing_when[]" value="Noon"
                                                                    class="add_chkbox_{{ $medicine1->id }}"
                                                                    onClick="chkcnt({{ $medicine1->id }})">
                                                                <label for="Tafternoon">Noon</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <div class="select-chk">
                                                                <input type="checkbox" id="Tevening_{{ $medicine1->id }}"
                                                                    name="timing_when[]" value="Night"
                                                                    class="add_chkbox_{{ $medicine1->id }}"
                                                                    onClick="chkcnt({{ $medicine1->id }})">
                                                                <label for="Tevening">Night</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Relation to food -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Relation to food
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0">
                                                        <div class="col-6 px-1">
                                                            <div class="select-chk">
                                                                <input type="radio" id="timing_how" name="timing_how[]"
                                                                    value="beforefood">
                                                                <label for="bfood">Before Food</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-1">
                                                            <div class="select-chk">
                                                                <input type="radio" id="timing_how" name="timing_how[]"
                                                                    value="afterfood" checked>
                                                                <label for="food">After Food</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Follow-up days -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Follow-up days
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0 align-items-center">
                                                        <div class="col-6 px-1 form-fl">

                                                            <input type="number" class="form-control rounded-0"
                                                                placeholder="0" id="totaldays_{{ $medicine1->id }}"
                                                                name="tab_count_days" step="1" min="1" pattern="[0-9]" onkeypress="return !(event.charCode == 46)"
                                                                onchange="followUpDays(this.value,'{{ $medicine1->id }}')"
                                                                required>
                                                        </div>
                                                        <div class="col-6 px-1">
                                                            <label for="FollowUpDays">Days</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Total Count days -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Total count
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0 align-items-center">
                                                        <div class="col-6 px-1 form-fld">
                                                            <span class="me-2"
                                                                id="total_cnt_{{ $medicine1->id }}">0</span>
                                                            <span id="total_dg_{{ $medicine1->id }}"></span>
                                                            <input type="hidden" name="total_qty"
                                                                id="total_qty_{{ $medicine1->id }}" value="5">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="baby-secondary-btn border-1"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="baby-primary-btn border-1"
                                            id="btn_{{ $medicine1->id }}"
                                            onClick="valthis({{ $medicine1->id }})">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
            <!-- medicine property modal -->

 <!-- Start Edit Medicine Modal -VG -->
            @foreach ($pharmacy as $list_pres1)
                @php
                    $list_medicine1 = Medicine::find($list_pres1->medicine_id);
                    $getType = $list_medicine1->dosage ? ' (' . $list_medicine1->dosage . ')' : '';
                    $fullName = helperFormatMedicinePrefix($list_medicine1->type) . '' . $list_medicine1->name . $getType;

                    $row_values = explode(',', $list_pres1->timing_when);

                @endphp

               <form action="{{ route('pharmacy.billing.prescription.medicine.post', ['prid' => $prescription_id ]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->user_id }}">
                    <input type="hidden" name="pr_add_edit" id="pr_add_edit" value="update">
                    <input type="hidden" name="medicine_id" id="medicine_id" value="{{ $list_pres1->medicine_id }}">
                    <input type="hidden" name="id" id="edit_id" value="{{ $list_pres1->id }}">
                    <div class="col-12">
                        <div class="modal fade med-data-modal" id="EditMedPopModal{{ $list_pres1->id }}" tabindex="-1"
                            aria-labelledby="MedPopModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-4">
                                        <h3 class="modal-title fs-5 text-center med-name w-100" id=" MedPopModalLabel">
                                            <span
                                                class="me-2">({{ helperFormatMedicinePrefix($list_medicine1->type) }})</span>
                                            {{ $list_medicine1->name }}
                                            <span class="ms-2">({{ $medicine1->dosage }})</span>
                                        </h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <!-- Dosage -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">Dosage</div>
                                                <div class="col-8">
                                                    <div class="row justify-content-between align-items-center mx-0">
                                                        <div class="col-6 form-fl px-1">
                                                            <input type="number" class="form-control rounded-0"
                                                                placeholder="0" id="intake_dosage_{{ $list_pres1->id }}"
                                                                name="intake_qty" value="{{ $list_pres1->intake_qty }}"
                                                                onchange="dosage_incnt(this.value,'{{ $list_pres1->id }}')"
                                                                step="0.01" min="0.01">
                                                        </div>
                                                        <div class="col-5 form-fl px-1">
                                                            <!-- <input type="text" class="form-control rounded-0" placeholder="Tab"
                                                                    id="insReportName" name="tab_name" value="" disabled> -->
                                                            <select class="form-control rounded-0" name="dosage"
                                                                id="dosage_{{ $list_pres1->id }}"
                                                                onchange="dosagein(this.value,'{{ $list_pres1->id }}')">
                                                                <option value="Tablet">Tablet</option>
                                                                <option value="Ml">ML</option>
                                                                <option value="Drop">Drop</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Timing -->

                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative"
                                                    id="timing_chkbox_{{ $list_pres1->id }}">
                                                    Timing
                                                </div>

                                                <div class="col-8">
                                                    <div class="row mx-0" id="edit_chkbox_{{ $list_pres1->id }}">
                                                        <div class="col-4 px-1">
                                                            <div class="select-chk">
                                                                <input type="checkbox"
                                                                    id="TMorning_{{ $list_pres1->id }}"
                                                                    name="timing_when[]" value="Morning"
                                                                    <?php echo in_array('Morning', $row_values) ? 'checked' : ''; ?>
                                                                    class="edit_chkbox_{{ $list_pres1->id }}"
                                                                    onClick="chkcnt({{ $list_pres1->id }})">
                                                                <label for="TMorning">Morning</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 px-1">
                                                            <div class="select-chk">
                                                                <input type="checkbox"
                                                                    id="Tafternoon_{{ $list_pres1->id }}"
                                                                    name="timing_when[]" value="Noon"
                                                                    <?php echo in_array('Noon', $row_values) ? 'checked' : ''; ?>
                                                                    class="edit_chkbox_{{ $list_pres1->id }}"
                                                                    onClick="chkcnt({{ $list_pres1->id }})">
                                                                <label for="Tafternoon">Noon</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 px-1">
                                                            <div class="select-chk">
                                                                <input type="checkbox"
                                                                    id="Tevening_{{ $list_pres1->id }}"
                                                                    name="timing_when[]" value="Night"
                                                                    <?php echo in_array('Night', $row_values) ? 'checked' : ''; ?>
                                                                    class="edit_chkbox_{{ $list_pres1->id }}"
                                                                    onClick="chkcnt({{ $list_pres1->id }})">
                                                                <label for="Tevening">Night</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Relation to food -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Relation to food
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0">
                                                        <div class="col-6 px-1">
                                                            <div class="select-chk">
                                                                <input type="radio" id="timing_how" name="timing_how[]"
                                                                    value="beforefood"
                                                                    {{ $list_pres1->timing_how == 'beforefood' ? 'checked' : '' }}>
                                                                <label for="bfood">Before Food</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-1">
                                                            <div class="select-chk">
                                                                <input type="radio" id="timing_how" name="timing_how[]"
                                                                    value="afterfood"
                                                                    {{ $list_pres1->timing_how == 'afterfood' ? 'checked' : '' }}>
                                                                <label for="food">After Food</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Follow-up days -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Follow-up days
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0 align-items-center">
                                                        <div class="col-6 px-1 form-fl">
                                                            <!--   <input type="number" class="form-control rounded-0" placeholder="0"
                                                                    id="followUpDays" name="tab_count_days" value="" step="1" min="0"
                                                                    oninput="validity.valid||(value='');" onKeyup="followUpDays(this.value)">
                                                      -->
                                                            <input type="number" class="form-control rounded-0"
                                                                placeholder="0" id="totaldays_{{ $list_pres1->id }}"
                                                                name="tab_count_days" step="1" min="1" pattern="[0-9]" onkeypress="return !(event.charCode == 46)"
                                                                onchange="followUpDays(this.value,'{{ $list_pres1->id }}')"
                                                                value="{{ $list_pres1->duration }}">
                                                        </div>
                                                        <div class="col-6 px-1">
                                                            <label for="FollowUpDays">Days</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Total Count days -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Total count
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0 align-items-center">
                                                        <div class="col-6 px-1 form-fld">
                                                            <span class="me-2"
                                                                id="total_cnt_{{ $list_pres1->id }}">{{ $list_pres1->total_qty }}</span>
                                                            <span
                                                                id="total_dg_{{ $list_pres1->id }}">{{ $list_pres1->dosage }}</span>
                                                            <input type="hidden" name="total_qty"
                                                                id="total_qty_{{ $list_pres1->id }}" value="5">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="baby-secondary-btn border-1"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="baby-primary-btn border-1"
                                            id="edit_btn_{{ $list_pres1->id }}"
                                            onClick="update_valthis({{ $list_pres1->id }})">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach


            @foreach ($listpm as $list_pres2)
                @php
                    $list_medicine2 = Medicine::find($list_pres2->medicine_id);
                    $getType = $list_medicine2->dosage ? ' (' . $list_medicine2->dosage . ')' : '';
                    $fullName = helperFormatMedicinePrefix($list_medicine2->type) . '' . $list_medicine2->name . $getType;

                    $row_values = explode(',', $list_pres2->timing_when);

                @endphp

               <form action="{{ route('pharmacy.billing.prescription.medicine.post', ['prid' => $prescription_id ]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->user_id }}">
                    <input type="hidden" name="pr_add_edit" id="pr_add_edit" value="update">
                    <input type="hidden" name="medicine_id" id="medicine_id" value="{{ $list_pres2->medicine_id }}">
                    <input type="hidden" name="id" id="edit_id" value="{{ $list_pres2->id }}">
                    <div class="col-12">
                        <div class="modal fade med-data-modal" id="EditMedicine{{ $list_pres2->id }}" tabindex="-1"
                            aria-labelledby="MedPopModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-4">
                                        <h3 class="modal-title fs-5 text-center med-name w-100" id=" MedPopModalLabel">
                                            <span
                                                class="me-2">({{ helperFormatMedicinePrefix($list_medicine2->type) }})</span>
                                            {{ $list_medicine2->name }}
                                            <span class="ms-2">({{ $medicine1->dosage }})</span>
                                        </h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <!-- Dosage -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">Dosage</div>
                                                <div class="col-8">
                                                    <div class="row justify-content-between align-items-center mx-0">
                                                        <div class="col-6 form-fl px-1">
                                                            <input type="number" class="form-control rounded-0"
                                                                placeholder="0" id="intake_dosage_{{ $list_pres2->id }}"
                                                                name="intake_qty" value="{{ $list_pres2->intake_qty }}"
                                                                onchange="dosage_incnt(this.value,'{{ $list_pres2->id }}')"
                                                                step="0.01" min="0.01">
                                                        </div>
                                                        <div class="col-5 form-fl px-1">
                                                            <!-- <input type="text" class="form-control rounded-0" placeholder="Tab"
                                                                    id="insReportName" name="tab_name" value="" disabled> -->
                                                            <select class="form-control rounded-0" name="dosage"
                                                                id="dosage_{{ $list_pres2->id }}"
                                                                onchange="dosagein(this.value,'{{ $list_pres2->id }}')">
                                                                <option value="Tablet">Tablet</option>
                                                                <option value="Ml">ML</option>
                                                                <option value="Drop">Drop</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Timing -->

                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative"
                                                    id="timing_chkbox_{{ $list_pres2->id }}">
                                                    Timing
                                                </div>

                                                <div class="col-8">
                                                    <div class="row mx-0" id="edit_chkbox_{{ $list_pres2->id }}">
                                                        <div class="col-4 px-1">
                                                            <div class="select-chk">
                                                                <input type="checkbox"
                                                                    id="TMorning_{{ $list_pres2->id }}"
                                                                    name="timing_when[]" value="Morning"
                                                                    <?php echo in_array('Morning', $row_values) ? 'checked' : ''; ?>
                                                                    class="edit_chkbox_{{ $list_pres2->id }}"
                                                                    onClick="chkcnt({{ $list_pres2->id }})">
                                                                <label for="TMorning">Morning</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 px-1">
                                                            <div class="select-chk">
                                                                <input type="checkbox"
                                                                    id="Tafternoon_{{ $list_pres2->id }}"
                                                                    name="timing_when[]" value="Noon"
                                                                    <?php echo in_array('Noon', $row_values) ? 'checked' : ''; ?>
                                                                    class="edit_chkbox_{{ $list_pres2->id }}"
                                                                    onClick="chkcnt({{ $list_pres2->id }})">
                                                                <label for="Tafternoon">Noon</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 px-1">
                                                            <div class="select-chk">
                                                                <input type="checkbox"
                                                                    id="Tevening_{{ $list_pres2->id }}"
                                                                    name="timing_when[]" value="Night"
                                                                    <?php echo in_array('Night', $row_values) ? 'checked' : ''; ?>
                                                                    class="edit_chkbox_{{ $list_pres2->id }}"
                                                                    onClick="chkcnt({{ $list_pres2->id }})">
                                                                <label for="Tevening">Night</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Relation to food -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Relation to food
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0">
                                                        <div class="col-6 px-1">
                                                            <div class="select-chk">
                                                                <input type="radio" id="timing_how" name="timing_how[]"
                                                                    value="beforefood"
                                                                    {{ $list_pres2->timing_how == 'beforefood' ? 'checked' : '' }}>
                                                                <label for="bfood">Before Food</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-1">
                                                            <div class="select-chk">
                                                                <input type="radio" id="timing_how" name="timing_how[]"
                                                                    value="afterfood"
                                                                    {{ $list_pres2->timing_how == 'afterfood' ? 'checked' : '' }}>
                                                                <label for="food">After Food</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Follow-up days -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Follow-up days
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0 align-items-center">
                                                        <div class="col-6 px-1 form-fl">
                                                            <!--   <input type="number" class="form-control rounded-0" placeholder="0"
                                                                    id="followUpDays" name="tab_count_days" value="" step="1" min="0"
                                                                    oninput="validity.valid||(value='');" onKeyup="followUpDays(this.value)">
                                                      -->
                                                            <input type="number" class="form-control rounded-0"
                                                                placeholder="0" id="totaldays_{{ $list_pres2->id }}"
                                                                name="tab_count_days" step="1" min="1" pattern="[0-9]" onkeypress="return !(event.charCode == 46)"
                                                                onchange="followUpDays(this.value,'{{ $list_pres2->id }}')"
                                                                value="{{ $list_pres2->duration }}">
                                                        </div>
                                                        <div class="col-6 px-1">
                                                            <label for="FollowUpDays">Days</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Total Count days -->
                                            <div class="row mx-0 mb-4 align-items-center">
                                                <div class="col-4 med-prop position-relative">
                                                    Total count
                                                </div>
                                                <div class="col-8">
                                                    <div class="row mx-0 align-items-center">
                                                        <div class="col-6 px-1 form-fld">
                                                            <span class="me-2"
                                                                id="total_cnt_{{ $list_pres2->id }}">{{ $list_pres2->total_qty }}</span>
                                                            <span
                                                                id="total_dg_{{ $list_pres2->id }}">{{ $list_pres2->dosage }}</span>
                                                            <input type="hidden" name="total_qty"
                                                                id="total_qty_{{ $list_pres2->id }}" value="5">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="baby-secondary-btn border-1"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="baby-primary-btn border-1"
                                            id="edit_btn_{{ $list_pres2->id }}"
                                            onClick="update_valthis2({{ $list_pres2->id }})">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
@endsection

<script type="text/javascript">
     function delete_medicine(id) {
        var delid = id;
        var actionUrl = "{{ route('pharmacy.billing.delete.medicine') }}" + "?remid=" + delid;
        if (confirm('Are you sure to delete this record ?')) {
            jQuery.ajax({
                url: actionUrl,
                type: 'GET',
                dataType: 'json', // added data type
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    //alert("Record deleted successfully");
                    $("#mydiv").load(location.href + " #mydiv");
                }
            });
        }
    }
     function editMedicine(id) {
        var editid = id;
        var actionUrl = "{{ route('doctor.edit.medicine') }}" + "?edit=" + editid;

        jQuery.ajax({
            url: actionUrl,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                var data = res.data;
                var chk = (data.timing_when).split(',');
                console.log(data);
                console.log(chk[0]);
                if (data.total_qty > 1) {
                    var dos = data.dosage + 's';
                } else {
                    var dos = data.dosage;
                }
                if (data.timing_when == "Morning,Noon") {
                    $("#edit_TMorning").attr("checked", "checked");
                    $("#edit_Tafternoon").attr("checked", "checked");
                }
                if (data.timing_how == "beforefood") {
                    $("#edit_timing_how_bf").attr("checked", "checked");
                    $("#edit_timing_how_af").removeAttr('checked');
                } else if (data.timing_how == "afterfood") {
                    //if(data.timing_how == 'afterfood')
                    $("#edit_timing_how_af").attr("checked", "checked");
                    $("#edit_timing_how_bf").removeAttr('checked');
                }

                $("#edit_id").val(data.id);
                $("#edit_pr_id").val(data.prescription_id);
                $("#edit_medicine_id").val(data.medicine_id);
                $("#edit_intake_dosage").val(data.intake_qty);
                $("#edit_dosage").val(data.dosage).change();
                $("#edit_total_qty").val(data.total_qty);
                $("#edit_totaldays").val(data.duration);
                $("#edit_total_cnt").text(data.total_qty);
                $("#edit_total_dg").text(dos);
            }
        });
    }



    function valthis(id) {
        var intake_dosage = document.getElementById('intake_dosage_' + id).value;
        var totaldays = document.getElementById('totaldays_' + id).value;
        var checkBoxes = document.getElementsByClassName('add_chkbox_' + id);
        var isChecked = false;
        for (var i = 0; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
                isChecked = true;
            };
        };
        var error = 0;
        if (intake_dosage == '') {
            $("#intake_dosage_" + id).attr("class", "form-control rounded-0 error-input");
            error = 0;
        } else {
            $("#intake_dosage_" + id).attr("class", "form-control rounded-0");
            error = 1;
        }
        if (totaldays == '') {
            $("#totaldays_" + id).attr("class", "form-control rounded-0 error-input");
            error = 0;
        } else {
            $("#totaldays_" + id).attr("class", "form-control rounded-0");
            error = 1;
        }
        if (isChecked) {
            $("#add_chkbox_" + id).attr("class", "row mx-0");
            error = 1;
        } else {
            $("#add_chkbox_" + id).attr("class", "row mx-0 error-input");
            error = 0;
        }
        if (error == 1) {
            var x = document.getElementById("btn_" + id).type = "submit";
        }
    }

    function update_valthis(id) {
        var intake_dosage = document.getElementById('intake_dosage_' + id).value;
        var totaldays = document.getElementById('totaldays_' + id).value;
        var checkBoxes = document.getElementsByClassName('edit_chkbox_' + id);
        var isChecked = false;

        for (var i = 0; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
                isChecked = true;
            };
        };
        var error = 0;
        if (intake_dosage == '') {
            $("#intake_dosage_" + id).attr("class", "form-control rounded-0 error-input");
            error = 0;
        } else {
            $("#intake_dosage_" + id).attr("class", "form-control rounded-0");
            error = 1;
        }
        if (totaldays == '') {
            $("#totaldays_" + id).attr("class", "form-control rounded-0 error-input");
            error = 0;
        } else {
            $("#totaldays_" + id).attr("class", "form-control rounded-0");
            error = 1;
        }
        if (isChecked) {
            $("#edit_chkbox_" + id).attr("class", "row mx-0");
            error = 1;
        } else {
            $("#edit_chkbox_" + id).attr("class", "row mx-0 error-input");
            error = 0;
        }
        if (error == 1) {
            var x = document.getElementById("edit_btn_" + id).type = "submit";
        }

    }

    function update_valthis2(id) {
        var intake_dosage = document.getElementById('intake_dosage_' + id).value;
        var totaldays = document.getElementById('totaldays_' + id).value;
        var checkBoxes = document.getElementsByClassName('edit_chkbox_' + id);
        var isChecked = false;

        for (var i = 0; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
                isChecked = true;
            };
        };
        var error = 0;
        if (intake_dosage == '') {
            $("#intake_dosage_" + id).attr("class", "form-control rounded-0 error-input");
            error = 0;
        } else {
            $("#intake_dosage_" + id).attr("class", "form-control rounded-0");
            error = 1;
        }
        if (totaldays == '') {
            $("#totaldays_" + id).attr("class", "form-control rounded-0 error-input");
            error = 0;
        } else {
            $("#totaldays_" + id).attr("class", "form-control rounded-0");
            error = 1;
        }
        if (isChecked) {
            $("#edit_chkbox_" + id).attr("class", "row mx-0");
            error = 1;
        } else {
            $("#edit_chkbox_" + id).attr("class", "row mx-0 error-input");
            error = 0;
        }
        if (error == 1) {
            var x = document.getElementById("edit_btn_" + id).type = "submit";
        }

    }


</script>

<script type="text/javascript">
    function chkcnt(id) {
        var days = $("#totaldays_" + id).val();
        var dosage = $("#dosage_" + id).val();
        var in_dosage = $("#intake_dosage_" + id).val();

        var noon = $("#Tafternoon_" + id).is(":checked");
        var mrng = $("#TMorning_" + id).is(":checked");
        var evng = $("#Tevening_" + id).is(":checked");
        var m_val = n_val = e_val = 0;

        if (noon) {
            n_val = 1;
        }
        if (mrng) {
            m_val = 1;
        }
        if (evng) {
            e_val = 1;
        }

        var total = in_dosage * days * (m_val + n_val + e_val);

        $("#total_qty_" + id).val(total);
        $("#total_cnt_" + id).text(total);
        if (total > 1)
            $("#total_dg_" + id).text(dosage + 's');
        else
            $("#total_dg_" + id).text(dosage);

    }

    function followUpDays(days, id) {
        var days = days;
        var dosage = $("#dosage_" + id).val();
        var in_dosage = $("#intake_dosage_" + id).val();
        var noon = $("#Tafternoon_" + id).is(":checked");
        var mrng = $("#TMorning_" + id).is(":checked");
        var evng = $("#Tevening_" + id).is(":checked");
        var m_val = n_val = e_val = 0;

        if (noon) {
            n_val = 1;
        }
        if (mrng) {
            m_val = 1;
        }
        if (evng) {
            e_val = 1;
        }

        var total = in_dosage * days * (m_val + n_val + e_val);

        $("#total_qty_" + id).val(total);
        $("#total_cnt_" + id).text(total);
        if (total > 1)
            $("#total_dg_" + id).text(dosage + 's');
        else
            $("#total_dg_" + id).text(dosage);

    }

    function dosage_incnt(intake, id) {
        var in_dosage = intake;
        var dosage = $("#dosage_" + id).val();
        var days = $("#totaldays_" + id).val();
        var noon = $("#Tafternoon_" + id).is(":checked");
        var mrng = $("#TMorning_" + id).is(":checked");
        var evng = $("#Tevening_" + id).is(":checked");
        var m_val = n_val = e_val = 0;

        if (noon) {
            n_val = 1;
        }
        if (mrng) {
            m_val = 1;
        }
        if (evng) {
            e_val = 1;
        }
        var total = in_dosage * days * (m_val + n_val + e_val);
        $("#total_qty_" + id).val(total);
        $("#total_cnt_" + id).text(total);
        if (total > 1)
            $("#total_dg_" + id).text(dosage + 's');
        else
            $("#total_dg_" + id).text(dosage);

    }

    function dosagein(dos, id) {
        var dosage = dos;
        var in_dosage = $("#intake_dosage_" + id).val();
        var days = $("#totaldays_" + id).val();

        var noon = $("#Tafternoon_" + id).is(":checked");
        var mrng = $("#TMorning_" + id).is(":checked");
        var evng = $("#Tevening_" + id).is(":checked");
        var m_val = n_val = e_val = 0;

        if (noon) {
            n_val = 1;
        }
        if (mrng) {
            m_val = 1;
        }
        if (evng) {
            e_val = 1;
        }
        var total = in_dosage * days * (m_val + n_val + e_val);
        $("#total_qty_" + id).val(total);
        $("#total_cnt_" + id).text(total);
        if (total > 1)
            $("#total_dg_" + id).text(dosage + 's');
        else
            $("#total_dg_" + id).text(dosage);

    }
</script>
<script>
    window.addEventListener("DOMContentLoaded", (event) => {

    jQuery("input[name=intake_qty]").on('click', function() {
    jQuery("input[name=intake_qty]").prop('checked', false)
    var $box = jQuery(this);
    $box.prop("checked", true);

    });
    // openDosageModel();
    });

    function openDosageModel() {

    jQuery('#dosageModel').removeClass('d-none');
    jQuery('#dosageModel').modal('show');

    }

    function closeDosageModel() {
    jQuery('#dosageModel').modal('hide');

    toastr.warning('The data not yet saved, once you finished kindly scroll down and hit save!');

    }

    function searchMedicine() {

    var search = jQuery("#search").val();
    // var form = $(this);
    var actionUrl = "{{ route('doctor.search.medicine') }}" + "?search=" + search;

    jQuery.ajax({
    url: actionUrl,
    type: 'GET',
    dataType: 'json', // added data type
    success: function(res) {
    jQuery('#MedicineButtons').html('');
    jQuery('#MedicineButtons').append('
    <hr>');
    jQuery('#MedicineButtons').append('<h2>Select the Medicines</h3>');
        jQuery.each(res.data, function(index, itemData) {
        var getDose = (itemData.dosage) ? '(' + itemData.dosage + ')' : '';
        var name = '"' + itemData.name + '"';
        jQuery("#MedicineButtons").append("<button id=" + itemData.id +
                            " type='button' onclick='addMedicineToList(" + itemData.id + "," +
                            name +
                            ")' class='btn btn-medicine-tag'>" + itemData.name + getDose +
            "</button>");
        })
        }
        });


        }

</script>
