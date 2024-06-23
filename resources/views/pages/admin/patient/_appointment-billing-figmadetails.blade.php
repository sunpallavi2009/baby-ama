<style>
    .dropdown-container {
        position: relative;
        display: inline-block;
        width: 100%;
        margin-bottom: 20px;
        /* Add margin for spacing between dropdowns */
    }

    .dropdown-btn {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        text-align: left;
        cursor: pointer;
    }

    .dropdown-btn:after {
        content: '\25BC';
        float: right;
        margin-left: 10px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 100%;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content.show {
        display: block;
    }

    .dropdown-content table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    .dropdown-content th,
    .dropdown-content td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    .dropdown-content th {
        background-color: #f2f2f2;
    }
    .table th, .table td {
    text-align: center;
    vertical-align: middle;
    }

    .table th {
    background-color: #f2f2f2;
    }

    .table tfoot tr {
    border-top: 2px solid #000;
    }

    .table tfoot td {
    font-weight: bold;
    }
</style>

@php
use App\Models\Medicine;
@endphp


<div class="dropdown-container pt-4">
    <button class="dropdown-btn form-control" onclick="toggleDropdown('pharmacy-bill-table-container')">Pharmacy
        Bill</button>
    <div class="dropdown-content" id="pharmacy-bill-table-container">
        <div class="table-responsive py-3 w-5 p-4" id="mydiv">
            <table class="table table-bordered" id="pharmacy-bill-table">
                <thead class="table-light bg-color-v1">
                    <tr>
                        <th>S.No</th>
                        <th>Medicine</th>
                        <th>Qty.</th>
                        <th>Price</th>
                        <th>SGST</th>
                        <th>CGST</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; $total = 0; $tax = 0; @endphp
                    @foreach($invoice_details as $key => $val)
                    @php
                    $list_med = Medicine::find($val->medicine_id);
                    $taxval = isset($list_med) && isset($list_med->selling_tax) ? $list_med->selling_tax : 0;
                    $tot = $list_med ? $list_med->selling_price * $val->total_qty : 0;
                    @endphp
                    <tr>
                        <td scope="row">{{ $i }}</td>
                        <td>{{ $list_med ? $list_med->name . ' (' . helperFormatMedicinePrefix($list_med->type) . ')' : 'Medicine
                            not found' }}</td>
                        <td>{{ $val->total_qty }}</td>
                        <td>&#x20B9; {{ $list_med ? $list_med->selling_price : 'N/A' }}</td>
                        <td>{{ $list_med ? $list_med->buying_tax : 'N/A' }}</td>
                        <td>{{ $list_med ? $list_med->selling_tax : 'N/A' }}</td>
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
                        <td colspan="6" style="text-align: right;"><strong>Total Amount:</strong></td>
                        <td>&#x20B9; {{ $total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleDropdown(containerId) {
        const tableContainer = document.getElementById(containerId);
        tableContainer.classList.toggle('show');
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-btn')) {
            const dropdowns = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < dropdowns.length; i++) {
                const openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
