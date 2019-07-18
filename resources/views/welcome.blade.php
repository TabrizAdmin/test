@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Form</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="product_name">Product name</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Enter Product name">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="quantity">Quantity in stock</label>
                                <input type="number" class="form-control" id="quantity" placeholder="Enter Quantity">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="price">Price per item</label>
                                <input type="number" class="form-control" id="price" placeholder="Enter Price">
                            </div>
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="card-footer">
                    <button type="button" id="submit" class="btn btn-primary">Submit</button>
                </div>
            </div><br>
            <div class="card">
                <div class="card-header">
                    <strong>Submitted data</strong>
                </div>
                <div class="card-body">
                    <div class="row" id="jquery_row">
                        <table class="table table-bordered table-striped table-sm" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Quantity in stuck</th>
                                    <th class="text-center">Price per item</th>
                                    <th class="text-center">Datetime submitted</th>
                                    <th class="text-center">Total value number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $product->product_name }}</td>
                                        <td class="text-center">{{ $product->quantity }}</td>
                                        <td class="text-center">{{ $product->price }}</td>
                                        <td class="text-center">{{ $product->created_at }}</td>
                                        <td class="text-center">{{ $product->quantity * $product->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ url('js/jquery-3.4.1.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '#submit', function(e) {
            e.preventDefault();
            var product_name = $("#product_name").val();
            var quantity = $("#quantity").val();
            var price = $("#price").val();
            var _token = "{{ csrf_token() }}";
            var form;
            var formData = new FormData(form);
            formData.append('product_name', product_name);
            formData.append('quantity', quantity);
            formData.append('price', price);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': _token
                },
                url:'{{ route('get.form') }}',
                type:'POST',
                data: formData,
                async: false,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data)
                {
                    $("#jquery_row").load("{{ route('index') }} #table");
                }
            });
        });
    });
</script>
@endsection
