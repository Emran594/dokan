<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 p-2">
            <div class="card card-custom h-100 bg-gradient-dark text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0 font-weight-bold">
                                <span id="product"></span>
                            </h5>
                            <p class="mb-0">Product</p>
                        </div>
                        <div class="col-4 text-right">
                            <div class="icon-custom">
                                <img class="w-100" src="{{asset('images/product.svg')}}" alt="Product Icon"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 p-2">
            <div class="card card-custom h-100 bg-gradient-success text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0 font-weight-bold">
                                <span id="category"></span>
                            </h5>
                            <p class="mb-0">Category</p>
                        </div>
                        <div class="col-4 text-right">
                            <div class="icon-custom">
                                <img class="w-100" src="{{asset('images/category.svg')}}" alt="Category Icon"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 p-2">
            <div class="card card-custom h-100 bg-gradient-dark text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0 font-weight-bold">
                                <span id="customer"></span>
                            </h5>
                            <p class="mb-0">Customer</p>
                        </div>
                        <div class="col-4 text-right">
                            <div class="icon-custom">
                                <img class="w-100" src="{{asset('images/customer.svg')}}" alt="Customer Icon"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 p-2">
            <div class="card card-custom h-100 bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0 font-weight-bold">
                                <span id="invoice"></span>
                            </h5>
                            <p class="mb-0">Invoice</p>
                        </div>
                        <div class="col-4 text-right">
                            <div class="icon-custom">
                                <img class="w-100" src="{{asset('images/invoice.svg')}}" alt="Invoice Icon"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 p-2">
            <div class="card card-custom h-100 bg-gradient-warning text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0 font-weight-bold">
                                $ <span id="total"></span>
                            </h5>
                            <p class="mb-0">Total Sale</p>
                        </div>
                        <div class="col-4 text-right">
                            <div class="icon-custom">
                                <img class="w-100" src="{{asset('images/sale.svg')}}" alt="Total Sale Icon"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 p-2">
            <div class="card card-custom h-100 bg-gradient-dark text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0 font-weight-bold">
                                $ <span id="vat"></span>
                            </h5>
                            <p class="mb-0">Vat Collection</p>
                        </div>
                        <div class="col-4 text-right">
                            <div class="icon-custom">
                                <img class="w-100" src="{{asset('images/tax.svg')}}" alt="Vat Collection Icon"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 p-2">
            <div class="card card-custom h-100 bg-gradient-danger text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0 font-weight-bold">
                                $ <span id="payable"></span>
                            </h5>
                            <p class="mb-0">Total Collection</p>
                        </div>
                        <div class="col-4 text-right">
                            <div class="icon-custom">
                                <img class="w-100" src="{{asset('images/money.svg')}}" alt="Total Collection Icon"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- <script>
    getList();
    async function getList() {
        showLoader();
        let res=await axios.get("/summary");

        document.getElementById('product').innerText=res.data['product']
        document.getElementById('category').innerText=res.data['category']
        document.getElementById('customer').innerText=res.data['customer']
        document.getElementById('invoice').innerText=res.data['invoice']
        document.getElementById('total').innerText=res.data['total']
        document.getElementById('vat').innerText=res.data['vat']
        document.getElementById('payable').innerText=res.data['payable']


        hideLoader();
    }
</script> --}}
