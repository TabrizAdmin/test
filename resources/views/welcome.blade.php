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
                <div class="card-body" id="jquery_row">
                    <div class="row" id="row_inner">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Quantity in stuck</th>
                                    <th class="text-center">Price per item</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">Pompeius René</td>
                                    <td class="text-center">2012/01/01</td>
                                    <td class="text-center">Member</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    $("#jquery_row").load("{{ route('home') }} #row_inner");
                }
            });
        });
    });
</script>
@endsection
