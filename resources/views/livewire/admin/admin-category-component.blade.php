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
                                Add New Category
                            </div><div class="col-md-6">
                                <a href="{{ Route('admin.addcategory') }}" class="btn btn-success pull-right">Add Category</a>
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
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td> {{ $category->id }} </td>
                                    <td> {{ Str::title($category->name) }} </td>
                                    <td> {{ $category->slug }} </td>
                                    <td> 
                                        <a href="{{ Route('admin.editcategory',['category_slug'=>$category->slug]) }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit fa-1x"> </i> Edit </a>

                                        <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteCategory({{ $category->id }})"> <i class="fa fa-trash fa-1x"> </i> Delete </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
