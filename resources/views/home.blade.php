<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Follow-up Skills Test V2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100 p-4 bg-light shadow-sm rounded">
            <h2 class="mb-4 text-center">Laravel Follow-up Skills Test V2</h2>
            <div class="mb-4">
                <form id="productForm" class="">
                    <div class="mb-3">
                        <label for="productName" class="form-label"><b>Product name</b> <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="productName" placeholder="Input product name"
                            name="name" required>
                        <small id="product_name_error" class="text-danger fw-light"></small>

                    </div>
                    <div class="mb-3">
                        <label for="quantityInStock" class="form-label"><b>Quantity in stock<b><span
                                        class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="quantityInStock"
                            placeholder="Input quantity instock" name="quantity_in_stock" min="1" required>
                        <small id="quantity_error" class="text-danger fw-light"></small>
                    </div>
                    <div class="mb-3">
                        <label for="pricePerItem" class="form-label"><b>Price per item</b><span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="pricePerItem" placeholder="Input price per item"
                            name="price_per_item" min="1" required>
                        <small id="price_error" class="text-danger fw-light"></small>
                    </div>
                    <div class="mt-3">
                        <button id="submit_btn" type="button" class="btn btn-primary"
                            data-create-url="{{ route('store') }}">Submit</button>
                        <button id="editBtn" type="button" class="btn btn-primary d-none">Edit</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-uppercase">Product name</th>
                            <th scope="col" class="text-uppercase">Quantity in stock</th>
                            <th scope="col" class="text-uppercase">Price per item</th>
                            <th scope="col" class="text-uppercase">Datetime submitted</th>
                            <th scope="col" class="text-uppercase">Total value number</th>
                            <th scope="col" class="text-uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        @if (!$products->isEmpty())
                            @foreach ($products as $product)
                                <tr class="fw-semibold">
                                    <td scope="row">{{ $product->name }}</td>
                                    <td>{{ $product->quantity_in_stock }}</td>
                                    <td>{{ $product->price_per_item }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->quantity_in_stock * $product->price_per_item }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info edit_btn"
                                            data-id="{{ $product->id }}"
                                            data-edit-url="{{ route('edit', $product->id) }}"
                                            data-update-url="{{ route('update', $product->id)  }}">
                                            Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="fw-bold">
                                <td colspan="4" class="text-end">Total:</td>
                                <td>{{ $totalValue }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="4" class="text-center">No produccts found.</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>
