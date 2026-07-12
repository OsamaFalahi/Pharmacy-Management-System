@extends('layouts.dash')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">Point of Sale</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="../dashboard"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Order</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('inc.msg')

        <!-- Print Modal -->
        <div class="modal fade" id="printMode" tabindex="-1" aria-hidden="true">
            @include('reports.receipt')
        </div>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <!-- Products Section -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                                <h5 class="card-title mb-0">Order Items</h5>
                                <button type="button" class="btn btn-primary add_more">
                                    <i class="bx bx-plus me-1"></i>Add Item
                                </button>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width:60px;">#</th>
                                            <th>Product</th>
                                            <th style="width:100px;">Qty</th>
                                            <th style="width:120px;">Price</th>
                                            <th style="width:100px;">Disc %</th>
                                            <th style="width:120px;">Total</th>
                                            <th style="width:80px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="addMoreProduct">
                                        <tr>
                                            <td class="text-muted fw-semibold">1</td>
                                            <td>
                                                <select name="product_id[]" class="form-select product_id single-select" required>
                                                    <option value="">Select product</option>
                                                    @foreach ($products as $product)
                                                        <option data-price="{{ $product->price }}" value="{{ $product->id }}">
                                                            {{ $product->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[]" class="form-control quantity" placeholder="0" required>
                                            </td>
                                            <td>
                                                <input type="number" name="price[]" class="form-control price" placeholder="0.00" required>
                                            </td>
                                            <td>
                                                <input type="number" name="discount[]" class="form-control discount" placeholder="0" value="0">
                                            </td>
                                            <td>
                                                <input type="number" name="total_amount[]" class="form-control total_amount" placeholder="0.00" readonly>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-outline-danger delete"><i class="bx bx-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Payment</h5>
                            <hr>

                            <!-- Total -->
                            <div class="total-display">
                                <div class="opacity-75 small mb-1">Total Amount</div>
                                <div>#<span class="total">0.00</span></div>
                                <input type="hidden" name="total" value="0">
                            </div>

                            <!-- Customer Info -->
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <label class="form-label">Customer Name</label>
                                    <input type="text" name="customerName" class="form-control customerName" placeholder="Enter name">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Customer Mobile</label>
                                    <input type="number" name="customerMobile" class="form-control customerMobile" placeholder="Enter mobile">
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <select class="form-select" name="paymentMethod" id="paymentMethod" required>
                                    <option value="">Select method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="BankTransfer">Bank Transfer</option>
                                    <option value="CreditCard">Credit Card</option>
                                </select>
                            </div>

                            <!-- Paid & Balance -->
                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <label class="form-label">Payment Received</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">#</span>
                                        <input class="form-control border-start-0" name="paidAmount" id="paidAmount" type="number" placeholder="0.00" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Change</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">#</span>
                                        <input class="form-control border-start-0 bg-light" name="balance" id="balance" type="number" placeholder="0.00" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bx bx-save me-2"></i>Save Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Floating Action Buttons -->
<div class="position-fixed bottom-0 end-0 p-4" style="z-index: 1030;">
    <div class="d-flex flex-column gap-2">
        <button onclick="ReceiptContent('printMode')" class="btn btn-dark btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#printMode" title="Print">
            <i class="bx bxs-printer"></i>
        </button>
        <button class="btn btn-primary btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#printMode" title="History">
            <i class="bx bx-history"></i>
        </button>
        <button class="btn btn-danger btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#printMode" title="Report">
            <i class="bx bxs-report"></i>
        </button>
    </div>
</div>

@endsection

@section('script')
<script>
    $('.add_more').on('click', function() {
        var product = $('.product_id').html();
        var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
        var tr = '<tr><td>' + numberofrow + '</td>' +
            '<td> <select class="product_id form-select single-select" name="product_id[]">' + product +
            ' </select></td>' +
            '<td> <input type="number" name="quantity[]" class="form-control quantity"></td>' +
            '<td> <input type="number" name="price[]" class="form-control price"></td>' +
            '<td> <input type="number" name="discount[]" class="form-control discount"></td>' +
            '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>' +
            '<td><a class="btn btn-sm btn-outline-danger delete"><i class="bx bx-trash"></i></a></td>';
        $('.addMoreProduct').append(tr);
        
        $('.single-select').last().select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Select product',
            allowClear: true,
        });
    });

    $('.addMoreProduct').delegate('.delete', 'click', function() {
        $(this).parent().parent().remove();
        updateRowNumbers();
        TotalAmount();
    });

    function updateRowNumbers() {
        $('.addMoreProduct tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    }

    function TotalAmount() {
        var total = 0;
        $('.total_amount').each(function(i, e) {
            var amount = $(this).val() - 0;
            total += amount;
        });
        $('.total').html(total.toFixed(2));
        $('input[name="total"]').val(total);
    }

    $('.addMoreProduct').delegate('.product_id', 'change', function() {
        var tr = $(this).parent().parent();
        var price = tr.find('.product_id option:selected').attr('data-price');
        tr.find('.price').val(price);
        calculateRowTotal(tr);
    });

    $('.addMoreProduct').delegate('.quantity, .discount', 'keyup', function() {
        var tr = $(this).parent().parent();
        calculateRowTotal(tr);
    });

    function calculateRowTotal(tr) {
        var qty = tr.find('.quantity').val() - 0;
        var disc = tr.find('.discount').val() - 0;
        var price = tr.find('.price').val() - 0;
        var total_amount = (qty * price) - ((qty * price * disc) / 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount();
    }

    $('#paidAmount').keyup(function(){
        var total = parseFloat($('.total').html()) || 0;
        var paidAmount = parseFloat($(this).val()) || 0;
        var amount = paidAmount - total;
        $('#balance').val(amount.toFixed(2));
    });

    function ReceiptContent(el){
        var data = '<input type="button" id="PrintReceiptButton" class="PrintReceiptButton" style="display: block; bottom: 10px; width: 100%; border: none; background-color: #000; background-repeat: no-repeat; color: #fff; padding: 14px 28px; font-size: 16px; cursor:pointer; text-align: center" value="Print Receipt" onClick="window.printMode()">';
        data += document.getElementById(el).innerHTML
        Receipt = window.open("", "myWin", "left=450, top=130, width=400, height=500");
        Receipt.screnX = 0;
        Receipt.screnY = 0;
        Receipt.document.write(data);
        Receipt.document.title = "Print Receipt"
        Receipt.focus();
        setTimeout(() => {
            Receipt.close();
        }, 8000);
    }
</script>
@endsection
