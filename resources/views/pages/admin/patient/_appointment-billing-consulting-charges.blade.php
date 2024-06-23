
    <style>
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

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6A1B9A;
        }
    </style>

<form id="billing-form" method="POST" action="{{ route('admin.patients.appointments.billing.save') }}">
    @csrf

    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

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
                    <td><input type="text" class="form-control" name="consulting_charges[{{ $index }}][service]"
                            value="{{ $charge['service'] }}"></td>
                    <td><input type="text" class="form-control" name="consulting_charges[{{ $index }}][consultant_name]"
                            value="{{ $charge['consultant_name'] }}"></td>
                    <td><input type="number" class="form-control" name="consulting_charges[{{ $index }}][fees]"
                            value="{{ $charge['fees'] }}"></td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <button type="button" class="btn btn-link text-center" onclick="addConsultingRow()">Add More +</button>

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
                        <td><input type="text" class="form-control" name="fee_summaries[{{ $index }}][description]"
                                value="{{ $summary['description'] }}"></td>
                        <td><input type="number" class="form-control" name="fee_summaries[{{ $index }}][quantity]"
                                value="{{ $summary['quantity'] }}"></td>
                        <td><input type="number" class="form-control" name="fee_summaries[{{ $index }}][price]"
                                value="{{ $summary['price'] }}"></td>
                        <td><input type="number" class="form-control" name="fee_summaries[{{ $index }}][discount]"
                                value="{{ $summary['discount'] }}"></td>
                        <td><input type="number" class="form-control" name="fee_summaries[{{ $index }}][sgst]"
                                value="{{ $summary['sgst'] }}"></td>
                        <td><input type="number" class="form-control" name="fee_summaries[{{ $index }}][cgst]"
                                value="{{ $summary['cgst'] }}"></td>
                        <td><input type="number" class="form-control" name="fee_summaries[{{ $index }}][total]"
                                value="{{ $summary['total'] }}" readonly></td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" class="totals">Total Amount:</td>
                    <td id="total-amount"></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <button type="button" class="btn btn-link text-center" onclick="addFeesSummaryRow()">Add More +</button>


    <div class="section-title mb-4">Payment Method</div>
    <div class="col-lg-4 mb-3">
        <select class="form-select" id="payment_method" name="payment_method">
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="cheque">Cheque</option>
            <option value="online">Online Transfer</option>
        </select>
    </div>

    <input type="hidden" id="total_amount" name="total_amount" value="0">


    <div class="footer">
        Address: Babyama Women Wellness & Paediatric Centre, New Siddha Pudur, Coimbatore - 638 933.
    </div>

    <div class="col-12 mt-5 text-center">
        <a class="btn btn-secondary" href="{{ route('admin.patients.appointments') }}">Back</a>
        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-danger ms-2"
            href="{{ route('admin.print.appointment.billing', ['appoinment' => $appointment->id]) }}"
            target="_blank">Print Appointment</a>
    </div>
</form>

<script>
    function addConsultingRow() {
        const table = document.getElementById('consulting-charges-table').getElementsByTagName('tbody')[0];
        const rowCount = table.rows.length;
        const row = table.insertRow();

        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);

        cell1.textContent = rowCount < 9 ? '0' + (rowCount + 1) : (rowCount + 1);
        cell2.innerHTML = `<input type="text" class="form-control" name="consulting_charges[${rowCount}][service]" placeholder="Service">`;
        cell3.innerHTML = `<input type="text" class="form-control" name="consulting_charges[${rowCount}][consultant_name]" placeholder="Consultant Name">`;
        cell4.innerHTML = `<input type="number" class="form-control" name="consulting_charges[${rowCount}][fees]" min="0" placeholder="Fees">`;
    }

    function addFeesSummaryRow() {
        const table = document.getElementById('fees-summary-table').getElementsByTagName('tbody')[0];
        const rowCount = table.rows.length;
        const row = table.insertRow();

        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        const cell5 = row.insertCell(4);
        const cell6 = row.insertCell(5);
        const cell7 = row.insertCell(6);
        const cell8 = row.insertCell(7);

        cell1.textContent = rowCount < 9 ? '0' + (rowCount + 1) : (rowCount + 1);
        cell2.innerHTML = `<input type="text" class="form-control" name="fee_summaries[${rowCount}][description]" placeholder="Description">`;
        cell3.innerHTML = `<input type="number" class="form-control" name="fee_summaries[${rowCount}][quantity]" min="1" placeholder="Qty.">`;
        cell4.innerHTML = `<input type="number" class="form-control" name="fee_summaries[${rowCount}][price]" min="0" placeholder="Price">`;
        cell5.innerHTML = `<input type="number" class="form-control" name="fee_summaries[${rowCount}][discount]" min="0" placeholder="Discount">`;
        cell6.innerHTML = `<input type="number" class="form-control" name="fee_summaries[${rowCount}][sgst]" min="0" placeholder="SGST">`;
        cell7.innerHTML = `<input type="number" class="form-control" name="fee_summaries[${rowCount}][cgst]" min="0" placeholder="CGST">`;
        cell8.innerHTML = `<input type="number" class="form-control" name="fee_summaries[${rowCount}][total]" min="0" placeholder="Total" readonly>`;

        const inputs = row.getElementsByTagName('input');
        for (let i = 2; i < inputs.length; i++) {
            inputs[i].addEventListener('input', updateTotalAmount);
        }
    }

    function updateTotalAmount() {
        let totalAmount = 0;
        const rows = document.getElementById('fees-summary-table').getElementsByTagName('tbody')[0].rows;

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].cells;
            const quantity = parseFloat(cells[2].firstChild.value) || 0;
            const price = parseFloat(cells[3].firstChild.value) || 0;
            const discount = parseFloat(cells[4].firstChild.value) || 0;
            const sgst = parseFloat(cells[5].firstChild.value) || 0;
            const cgst = parseFloat(cells[6].firstChild.value) || 0;

            const total = (quantity * price) * (1 - (discount / 100)) * (1 + (sgst / 100) + (cgst / 100));
            cells[7].firstChild.value = total.toFixed(2);
            totalAmount += total;
        }

        const totalAmountDisplay = document.getElementById('total-amount');
        totalAmountDisplay.innerText = `₹ ${totalAmount.toFixed(2)}`;

        // Update hidden input for total amount
        document.getElementById('total_amount').value = totalAmount.toFixed(2);
    }

    function handleFormSubmit(event) {
        event.preventDefault();

        const form = document.getElementById('billing-form');
        const formData = new FormData(form);

        fetch("{{ route('admin.patients.appointments.billing.save') }}", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    document.getElementById('billing-form').addEventListener('submit', handleFormSubmit);
</script>
