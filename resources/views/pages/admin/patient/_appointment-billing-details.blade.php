<style>
    .inv-logo {
    max-width: 150px;
    }
    .header-info p, .header-info .col {
    margin: 0;
    }
    .header-info .col {
    padding: 0 15px;
    }
</style>
<div class="row p-2">

    <div class="col-md-12 mb-5 pb-4 text-center">
        <img src="{{ asset('media/logos/baby-ama-logo.png') }}" alt="Babyama"
            class="img-fluid object-fit-contain inv-logo mx-auto">
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>ADDRESS:</h3>
            <p>Babyama Women Wellness & Paediatric Centre<br>
                New Siddha Pudur,<br>
                Coimbatore - 638 933.</p>
        </div>
        <div class="col-md-6 text-end align-self-center">
            <i class="fas fa-phone-alt text-primary"></i> 78967 84329 &nbsp;
            <i class="fas fa-globe text-primary"></i> babyama.in
        </div>
    </div>

    <hr>

    <div class="row col-md-12 mb-3 mt-4">
        <div class="col-md-6">
            <h3>Patient Details</h3>
        </div>
        <div class="col-lg-6 text-end">
            {{-- <span class="text-primary">Invoice No : </span> 472 &nbsp;
            <span class="text-primary">Invoice Date : </span> 12/03/2023 --}}
        </div>
    </div>

@if($appointment->user->patient)

<div class="row col-lg-12 p-8" style="background-color: #F9F7FB;">

    @php
    $patient = $appointment->user->patient;
    @endphp
        <div class="col-md-4 pt-4">
            <div class="patient-info">
                @if($patient->first_name && $patient->last_name)
                    <p>
                        <span style="color:#714B9D;"><b>Patient Name</b></span>
                        <span class="separator">:</span>
                        <span>{{$patient->first_name}} {{$patient->last_name}}</span>
                    </p>
                @endif
                @if($patient->father_name)
                    <p>
                        <span style="color:#714B9D;"><b>Father Name</b></span>
                        <span class="separator">:</span>
                        <span>{{$patient->father_name}}</span>
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
            </div>
        </div>
    @endif

    <div class="col-md-4 pt-4">
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
    </div>

    <div class="col-md-4 pt-4">
        <div class="patient-info">
            @if($doctor->first_name)
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
            @endif
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
        </div>
    </div>

</div>
</div>
