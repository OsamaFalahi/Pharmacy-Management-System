@extends('layouts.dash')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">Add Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="../dashboard"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('inc.msg')

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <!-- Basic Information -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">Basic Information</h5>
                            <hr>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Medicine Name</label>
                                    <input type="text" class="form-control" name="product_name" placeholder="Enter Medicine Name" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="4" name="description" placeholder="Enter product description"></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Product Image</label>
                                    <input id="image-uploadify" type="file" class="form-control" name="product_img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <h6 class="section-title">Product Details</h6>
                            <hr>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Brand</label>
                                    <input type="text" class="form-control" name="brand" placeholder="Enter Product Brand">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Selling Price</label>
                                    <input type="number" class="form-control" name="price" placeholder="00.00">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Supplier Price</label>
                                    <input type="number" class="form-control" name="supplierprice" placeholder="00.00">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" placeholder="00.00">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Stock Alert</label>
                                    <input type="number" name="stock_alert" class="form-control" placeholder="00.00">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Expire Date</label>
                                    <input type="date" name="expiredate" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Form</label>
                                    <select name="form" class="form-select">
                                        <option value="">Select Form</option>
                                        <option value="Tablet">Tablet</option>
                                        <option value="Capsules">Capsule</option>
                                        <option value="Injection">Injection</option>
                                        <option value="Eye Drop">Eye Drop</option>
                                        <option value="Suspension">Suspension</option>
                                        <option value="Cream">Cream</option>
                                        <option value="Saline">Saline</option>
                                        <option value="Inhaler">Inhaler</option>
                                        <option value="Powder">Powder</option>
                                        <option value="Spray">Spray</option>
                                        <option value="Paediatric Drop">Paediatric Drop</option>
                                        <option value="Nebuliser Solution">Nebuliser Solution</option>
                                        <option value="Powder for Suspension">Powder for Suspension</option>
                                        <option value="Nasal Drops">Nasal Drops</option>
                                        <option value="Eye Ointment">Eye Ointment</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.index') }}" class="btn btn-light flex-fill">Cancel</a>
                                        <button type="submit" class="btn btn-primary flex-fill">
                                            <i class="bx bx-save me-2"></i>Register Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
