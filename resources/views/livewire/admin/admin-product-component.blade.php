<div>
    <style>
        nav svg{
            height: 20px ;
        }
        nav .hidden{
            display: block !important ;
        }
    </style>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Product
                            </div><div class="col-md-6">
                                <a href="{{ Route('admin.addproduct') }}" class="btn btn-success pull-right">Add Product</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert"> {{ Session::get('message') }} </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Stock Status</th>
                                    <th>Regular Price</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td> {{ $product->id }} </td>
                                    <td> <img src="{{ asset('assets/images/products')}}/{{$product->image}}" width="60" alt=""> </td>

                                    <td> {{ Str::title($product->name) }} </td>
                                    <td> <button class="btn btn-sm disabled btn-{{ $product->stock_status==="instock"?"success":"danger" }}">{{ $product->stock_status }}</button> </td>
                                    <td> {{ $product->regular_price }} </td>
                                    <td> {{ $product->category->name }} </td>
                                    <td> {{ $product->created_at }} </td>
                                    <td> 
                                        <a href="{{ Route('admin.editcategory',['category_slug'=>$product->slug]) }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit fa-1x"> </i> Edit </a>

                                        <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteCategory({{ $product->id }})"> <i class="fa fa-trash fa-1x"> </i> Delete </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
