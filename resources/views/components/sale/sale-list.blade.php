<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between">
                    <div class="align-items-center col">
                        <h4>Sale List</h4>
                    </div>
                    <div class="align-items-center col">
                        <a href="{{ url('/sales/create') }}" class="float-end btn m-0 bg-dark text-white">Shift Closing</a>
                    </div>
                </div>
                <hr class="bg-secondary"/>
                <div class="table-responsive">
                    @if($sales->isNotEmpty())
                        <table class="table" id="tableData">
                            <thead>
                                <tr class="bg-light">
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Shift</th>
                                    <th>Fuel Name</th>
                                    <th>Sale Quantity</th>
                                    <th>Sale Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableList">
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->sale_date }}</td>
                                        <td>{{ $sale->shift->shift_name }}</td>
                                        <td>{{ $sale->nozzle->nozzle_name }}</td>
                                        <td>{{ $sale->sale_qty }}</td>
                                        <td>{{ $sale->sale_amount }}</td>
                                        <td>
                                            <a href="{{ url('/sales/' . $sale->id . '/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ url('/sales/' . $sale->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info" role="alert">
                            No sales available.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new DataTable('#tableData',{
        order:[[0,'desc']],
        lengthMenu:[5,10,15,20,30]
        });
</script>
