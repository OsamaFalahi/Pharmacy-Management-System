@extends('layouts.dash')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">Products</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Inventory</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('inc.msg')

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div class="position-relative">
                <input type="text" class="form-control ps-5" placeholder="Search products...">
                <span class="position-absolute top-50 translate-middle-y" style="left:14px; color: var(--pms-muted);">
                    <i class="bx bx-search"></i>
                </span>
            </div>
            <div class="d-flex gap-2">
                <a href="grid" class="btn btn-outline-primary">
                    <i class="bx bxs-grid me-2"></i>Grid Mode
                </a>
                <a href="{{ route('addproduct') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-2"></i>Add Product
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="example2" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Supplier</th>
                                <th>Qty</th>
                                <th>Form</th>
                                <th>Expiry</th>
                                <th>Stock</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                            <tr>
                                <td><span class="text-muted fw-semibold">{{ $key + 1 }}</span></td>
                                <td class="fw-semibold">{{ $product->product_name }}</td>
                                <td>
                                    <img src="/storage/products/{{ $product->product_img }}" class="user-img" alt="">
                                </td>
                                <td>{{ $product->brand }}</td>
                                <td class="fw-bold text-primary">#{{ number_format($product->price, 2) }}</td>
                                <td class="text-muted">#{{ number_format($product->supplierprice, 2) }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $product->form }}</span></td>
                                <td class="text-muted">{{ $product->expiredate }}</td>
                                <td>
                                    @if ($product->stock_alert >= $product->quantity)
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                            <i class="bx bx-error-circle me-1"></i>Low Stock
                                        </span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                            {{ $product->stock_alert }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editProduct{{ $product->id }}" title="Edit">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteProduct{{ $product->id }}" title="Delete">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Product Modal -->
                            <div class="modal fade" id="editProduct{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="row g-4">
                                                    <div class="col-lg-6">
                                                        <div class="card border">
                                                            <div class="card-body">
                                                                <h6 class="section-title mb-3">Basic Info</h6>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Medicine Name</label>
                                                                    <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Description</label>
                                                                    <textarea class="form-control" rows="4" name="description">{{ $product->description }}</textarea>
                                                                </div>
                                                                <div class="mb-0">
                                                                    <label class="form-label">Product Image</label>
                                                                    <input id="image-uploadify" type="file" class="form-control" name="product_img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card border">
                                                            <div class="card-body">
                                                                <h6 class="section-title mb-3">Pricing & Inventory</h6>
                                                                <div class="row g-3">
                                                                    <div class="col-12">
                                                                        <label class="form-label">Brand</label>
                                                                        <input type="text" class="form-control" name="brand" value="{{ $product->brand }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Selling Price</label>
                                                                        <input type="number" class="form-control" name="price" value="{{ $product->price }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Supplier Price</label>
                                                                        <input type="number" class="form-control" name="supplierprice" value="{{ $product->supplierprice }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Quantity</label>
                                                                        <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Stock Alert</label>
                                                                        <input type="number" class="form-control" name="stock_alert" value="{{ $product->stock_alert }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Expire Date</label>
                                                                        <input type="date" class="form-control" name="expiredate" value="{{ $product->expiredate }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Form</label>
                                                                        <select name="form" class="form-select">
                                                                            <option value="">Select Form</option>
                                                                            <option value="Tablet" @if($product->form=='Tablet') selected @endif>Tablet</option>
                                                                            <option value="Capsules" @if($product->form=='Capsules') selected @endif>Capsule</option>
                                                                            <option value="Injection" @if($product->form=='Injection') selected @endif>Injection</option>
                                                                            <option value="Eye Drop" @if($product->form=='Eye Drop') selected @endif>Eye Drop</option>
                                                                            <option value="Suspension" @if($product->form=='Suspension') selected @endif>Suspension</option>
                                                                            <option value="Cream" @if($product->form=='Cream') selected @endif>Cream</option>
                                                                            <option value="Saline" @if($product->form=='Saline') selected @endif>Saline</option>
                                                                            <option value="Inhaler" @if($product->form=='Inhaler') selected @endif>Inhaler</option>
                                                                            <option value="Powder" @if($product->form=='Powder') selected @endif>Powder</option>
                                                                            <option value="Spray" @if($product->form=='Spray') selected @endif>Spray</option>
                                                                            <option value="Paediatric Drop" @if($product->form=='Paediatric Drop') selected @endif>Paediatric Drop</option>
                                                                            <option value="Nebuliser Solution" @if($product->form=='Nebuliser Solution') selected @endif>Nebuliser Solution</option>
                                                                            <option value="Powder for Suspension" @if($product->form=='Powder for Suspension') selected @endif>Powder for Suspension</option>
                                                                            <option value="Nasal Drops" @if($product->form=='Nasal Drops') selected @endif>Nasal Drops</option>
                                                                            <option value="Eye Ointment" @if($product->form=='Eye Ointment') selected @endif>Eye Ointment</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="bx bx-save me-2"></i>Update Product
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Product Modal -->
                            <div class="modal fade" id="deleteProduct{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold text-danger">Delete Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 text-center">
                                            <div class="mb-3">
                                                <div class="avatar avatar-lg bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center" style="width:64px;height:64px;">
                                                    <i class="bx bx-trash fs-3"></i>
                                                </div>
                                            </div>
                                            <p class="mb-1 text-muted">Are you sure you want to delete</p>
                                            <h6 class="fw-bold text-danger mb-0">{{ $product->product_name }}</h6>
                                        </div>
                                        <div class="modal-footer border-0 pt-0 justify-content-center gap-2">
                                            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger px-4">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description Modal -->
                            <div class="modal fade" id="description{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Description</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <p class="text-muted mb-0">{{ $product->description }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-top">
                <nav aria-label="Page navigation" class="float-right">
                    <ul class="pagination mb-0">
                        {{ $products->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
