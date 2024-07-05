@extends('base.pharmacy-dashboard')

@section('pharmacy-content')
<div class="pharmacy medicine-stacklist pt-5" style="margin-top: 50px;">
    <div class="row mx-0 align-items-center justify-content-between">
        <div class="col-12 col-sm-4 col-md-3 col-lg-3 px-0">
            <h3 class="text-baby-v2 font-medium mb-md-0">Prescription List</h3>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-6">
            <div class="row mx-0 justify-content-end">
                <div class="med-search-container col-8 col-md-8">
                    <form method="GET" id="searchForm">
                        <div class="med-search rounded-2">
                            <div class="search-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"
                                    fill="none">
                                    <path
                                        d="M13.6667 13.6667L10.676 10.6707M12.3333 6.66667C12.3333 8.16956 11.7363 9.6109 10.6736 10.6736C9.6109 11.7363 8.16956 12.3333 6.66667 12.3333C5.16377 12.3333 3.72243 11.7363 2.65973 10.6736C1.59702 9.6109 1 8.16956 1 6.66667C1 5.16377 1.59702 3.72243 2.65973 2.65973C3.72243 1.59702 5.16377 1 6.66667 1C8.16956 1 9.6109 1.59702 10.6736 2.65973C11.7363 3.72243 12.3333 5.16377 12.3333 6.66667Z"
                                        stroke="#7B7A7C" stroke-linecap="round"></path>
                                </svg>
                            </div>
                            <div class="search-field-wrap w-100">
                                <input type="search" name="search" placeholder="Search by name, UMR no."
                                    id="filterpharmaMedicine" class="form-control" value="{{ request()->input('search') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="medicine-list px-0">
        <div class="prescription-table py-3">
            <div class="table-responsive py-3">
                <table class="table">
                    <thead class="table-light bg-color-v1">
                        <tr>
                            <th scope="col" class="text-center">S.No</th>
                            <th scope="col" class="bg-color-v1 p-name">Baby Name</th>
                            <th scope="col" class="bg-color-v1 text-center">Age</th>
                            <th scope="col" class="bg-color-v1 text-center">UMR No.</th>
                            <th scope="col" class="bg-color-v1 text-center">O/P No.</th>
                            <th scope="col" class="bg-color-v1 text-center">Appointment Date</th>
                            <th scope="col" class="bg-color-v1 text-center">Status</th>
                            <th scope="col" class="bg-color-v1 text-center action-btn w-100">Action</th>
                        </tr>
                    </thead>
                    <tbody id="prescriptionTableBody">
                        @php $i = 1; @endphp
                        @foreach($patients as $key => $details)
                        <tr>
                            <th scope="row" class="text-center">{{ $i }}</th>
                            <td>
                                <span class="patient-avtr">
                                    {{ isset($details->user->first_name[0]) ? strtoupper($details->user->first_name[0]) : '' }}
                                    {{ isset($details->user->last_name[0]) ? strtoupper($details->user->last_name[0]) : '' }}
                                </span>
                                {{ isset($details->user->first_name) ? ucfirst($details->user->first_name).' '.ucfirst($details->user->last_name) : '' }}
                            </td>
                            <td class="text-center">
                                {{ isset($details->user->age) ? $details->user->age : '' }}
                            </td>
                            <td class="text-center">
                                {{ isset($details->user->umr_no) ? $details->user->umr_no : '' }}
                            </td>
                            <td class="text-center">
                                {{ isset($details->user->op_no) ? $details->user->op_no : '' }}
                            </td>
                            <td class="text-center">
                                {{ isset($details->appointment->appoinment_date) ? $details->appointment->appoinment_date : '' }}
                            </td>
                            <td class="text-center">
                                @if(isset($details->prescription_status))
                                @if($details->prescription_status == 'ignored')
                                Declined
                                @elseif($details->prescription_status == 'delivered')
                                Completed
                                @else
                                {{-- Display other status --}}
                                @endif
                                @else
                                {{-- Handle missing status --}}
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="action-btn-group d-flex justify-content-evenly align-items-center">
                                    <a class="act-btn warning" href="#"
                                        onclick="prescription_declined('{{ $details->prescription_id }}')">Decline</a>
                                    @if(isset($details->prescription_id) && isset($details->appointment_id))
                                    <a class="act-btn success"
                                        href="{{ route('pharmacy.billing.patient.prescription', ['prescription_id' => $details->prescription_id, 'appointment' => $details->appointment_id]) }}">Proceed</a>
                                    @else
                                    <span class="text-danger">Missing data</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $patients->links('pagination::v1') }}
        </div>
    </div>
</div>

<script>
    // Function to remove search query parameter from URL
    function removeSearchParam() {
        var url = new URL(window.location.href);
        url.searchParams.delete('search');
        history.replaceState(null, null, url.toString());
    }

    // Call removeSearchParam function when the document is ready
    document.addEventListener('DOMContentLoaded', function () {
        removeSearchParam();
    });

    // Update URL without search params on form submit
    function handleSubmit(event) {
        event.preventDefault();
        var searchValue = document.getElementById('filterpharmaMedicine').value.trim();
        var currentUrl = new URL(window.location.href);
        
        if (searchValue) {
            currentUrl.searchParams.set('search', searchValue);
        } else {
            currentUrl.searchParams.delete('search');
        }
        
        history.pushState(null, null, currentUrl.toString());
        // Implement your search logic here if needed
    }

    // Function to handle declining prescriptions
    function prescription_declined(id) {
        var delid = id;
        var actionUrl = "{{ route('pharmacy.billing.delete.medicine') }}" + "?delid=" + delid;
        if (confirm('Are you sure to decline this record?')) {
            jQuery.ajax({
                url: actionUrl,
                type: 'GET',
                dataType: 'json',
                error: function () {
                    alert('Something is wrong');
                },
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
</script>


@endsection
