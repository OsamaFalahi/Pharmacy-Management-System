@extends('layouts.dash')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">Orders</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="../dashboard"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div class="position-relative">
                <input type="text" class="form-control ps-5 radius-30" placeholder="Search orders...">
                <span class="position-absolute top-50 translate-middle-y" style="left:16px; color: var(--pms-muted);">
                    <i class="bx bx-search"></i>
                </span>
            </div>
            <a href="{{ route('orders.index') }}" class="btn btn-primary radius-30">
                <i class="bx bx-plus me-2"></i>New Order
            </a>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Mobile</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Method</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td class="fw-semibold text-muted">#{{ $order->id }}</td>
                                <td class="fw-semibold">{{ $order->name }}</td>
                                <td class="text-muted">{{ $order->mobile }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $order->orderDetails->count() }} items
                                    </span>
                                </td>
                                <td class="fw-bold text-primary">
                                    #{{ number_format($order->orderDetails->sum('amount'), 2) }}
                                </td>
                                <td class="text-muted">
                                    #{{ number_format($order->transactions->first()->paid_amount ?? 0, 2) }}
                                </td>
                                <td>
                                    @php
                                        $method = $order->transactions->first()->payment_method ?? 'N/A';
                                        $methodClass = match($method) {
                                            'Cash' => 'success',
                                            'BankTransfer' => 'info',
                                            'CreditCard' => 'primary',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $methodClass }} bg-opacity-10 text-{{ $methodClass }} border border-{{ $methodClass }} border-opacity-25">
                                        {{ $method }}
                                    </span>
                                </td>
                                <td class="text-muted">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#viewOrder{{ $order->id }}" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Order Modal -->
                            <div class="modal fade" id="viewOrder{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Order #{{ $order->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted small">Customer</p>
                                                    <p class="fw-semibold mb-0">{{ $order->name }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted small">Mobile</p>
                                                    <p class="fw-semibold mb-0">{{ $order->mobile }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <h6 class="fw-bold mb-3">Items</h6>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                            <th>Discount</th>
                                                            <th class="text-end">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->orderDetails as $detail)
                                                        <tr>
                                                            <td>{{ $detail->product->product_name ?? 'N/A' }}</td>
                                                            <td>{{ $detail->quantity }}</td>
                                                            <td>#{{ number_format($detail->unitprice, 2) }}</td>
                                                            <td>{{ $detail->discount }}%</td>
                                                            <td class="text-end fw-semibold">#{{ number_format($detail->amount, 2) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="table-active">
                                                            <td colspan="4" class="text-end fw-bold">Total</td>
                                                            <td class="text-end fw-bold text-primary">
                                                                #{{ number_format($order->orderDetails->sum('amount'), 2) }}
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="bx bx-inbox fs-1 d-block mb-2"></i>
                                    No orders found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-top">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
