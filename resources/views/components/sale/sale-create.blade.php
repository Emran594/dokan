<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between">
                    <div class="col align-items-center">
                        <h4>Sale Form</h4>
                    </div>
                </div>
                <hr class="bg-secondary"/>
                <div class="table-responsive">
                    <form id="saleForm" onsubmit="return saveSale(event)">
                        @csrf
                        <div class="container">
                            <div class="row align-items-end">
                                <div class="col-12 col-md-6 col-lg-3 p-1">
                                    <label class="form-label">Date *</label>
                                    <input type="date" class="form-control" id="sale_date" name="sale_date" required>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 p-1">
                                    <label class="form-label">Shift *</label>
                                    <select class="form-control" id="shift_id" name="shift_id" required>
                                        @foreach($shifts as $shift)
                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 p-1">
                                    <label class="form-label">Tank *</label>
                                    <select class="form-control" id="tank_id" name="tank_id" required>
                                        @foreach($tanks as $tank)
                                            <option value="{{ $tank->id }}">{{ $tank->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 p-1 d-flex align-items-end">
                                    <a href="javascript:void(0);" class="float-end btn m-0 bg-dark text-white w-100" onclick="fetchNozzles()" id="search-btn">Search</a>
                                </div>
                            </div>
                            <div id="nozzlesContainer" class="row col-12 mt-4">
                                <div class="col-12 p-0">
                                    <table class="table table-bordered text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Meter Unit Name</th>
                                                <th>Opening Reading</th>
                                                <th>Cash Sale Qty</th>
                                                <th>Closing Reading</th>
                                                <th>Total Sale (LTR)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="nozzlesTableBody">
                                            <!-- Content will be dynamically inserted here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row justify-content-end mt-4">
                                <div class="col-12 col-md-6 col-lg-3 p-1">
                                    <button type="submit" class="float-end btn m-0 bg-dark text-white w-100">Submit Sale</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function fetchNozzles() {
    let tankId = document.getElementById('tank_id').value;
    if (!tankId) {
        errorToast("Please select a tank!");
        return;
    }

    fetch(`/api/nozzles/${tankId}`)
        .then(response => response.json())
        .then(data => {
            let nozzlesTableBody = document.getElementById('nozzlesTableBody');
            nozzlesTableBody.innerHTML = '';
            data.nozzles.forEach(nozzle => {
                nozzlesTableBody.innerHTML += `
                    <tr>
                        <td>${nozzle.nozzle_name}</td>
                        <td>
                            <input type="text" class="form-control" id="opening_reading_${nozzle.id}" name="opening_reading[${nozzle.id}]" value="${nozzle.current_meter_reading}" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control cash-sale-qty" id="cash_sale_qty_${nozzle.id}" name="sale_qty[${nozzle.id}]" oninput="calculateClosingReading(${nozzle.id})">
                        </td>
                        <td>
                            <input type="text" class="form-control closing-reading" id="closing_reading_${nozzle.id}" name="closing_reading[${nozzle.id}]" oninput="calculateSaleQty(${nozzle.id})">
                        </td>
                        <td>
                            <input type="text" class="form-control total-sale" id="total_sale_${nozzle.id}" name="total_sale[${nozzle.id}]" value="0.00" readonly>
                        </td>
                    </tr>
                `;
            });
        });
}

function calculateClosingReading(nozzleId) {
    let openingReading = parseFloat(document.getElementById(`opening_reading_${nozzleId}`).value) || 0;
    let cashSaleQty = parseFloat(document.getElementById(`cash_sale_qty_${nozzleId}`).value) || 0;
    let closingReading = openingReading + cashSaleQty;
    document.getElementById(`closing_reading_${nozzleId}`).value = closingReading.toFixed(4);
    document.getElementById(`total_sale_${nozzleId}`).value = cashSaleQty.toFixed(4);
}

function calculateSaleQty(nozzleId) {
    let openingReading = parseFloat(document.getElementById(`opening_reading_${nozzleId}`).value) || 0;
    let closingReading = parseFloat(document.getElementById(`closing_reading_${nozzleId}`).value) || 0;
    let cashSaleQty = closingReading - openingReading;
    document.getElementById(`cash_sale_qty_${nozzleId}`).value = cashSaleQty.toFixed(4);
    document.getElementById(`total_sale_${nozzleId}`).value = cashSaleQty.toFixed(4);
}

async function saveSale(event) {
    event.preventDefault();

    let saleDate = document.getElementById('sale_date').value;
    let shiftId = document.getElementById('shift_id').value;
    let tankId = document.getElementById('tank_id').value;
    let formData = new FormData(document.getElementById('saleForm'));

    if (!saleDate || !shiftId || !tankId) {
        errorToast("All fields are required!");
        return;
    }

    try {
        showLoader();

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let res = await axios.post("/sales", formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        hideLoader();
        if (res.status === 201) {
            successToast('Sales recorded successfully');
            document.getElementById("saleForm").reset();
            window.location.href = "/salePage";
        } else {
            errorToast("Failed to record sales");
        }
    } catch (error) {
        hideLoader();
        if (error.response) {
            console.error('Error response:', error.response);
            errorToast(`Request failed: ${error.response.data.message || error.response.statusText}`);
        } else if (error.request) {
            console.error('Error request:', error.request);
            errorToast("Request failed: No response from server");
        } else {
            console.error('Error message:', error.message);
            errorToast(`Request failed: ${error.message}`);
        }
    }
}
</script>
