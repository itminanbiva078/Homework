@extends('backend.layouts.master')
@section('title')
InventorySetup - {{$title}}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                Inventory Setup </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('inventorySetup.product.index'))
                    <li class="breadcrumb-item"><a href="{{route('inventorySetup.product.index')}}">Product List</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Product</span></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('admin-content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Product List</h3>
                <div class="card-tools">
                @if(helper::roleAccess('inventorySetup.product.create'))
                    <a class="btn btn-default" href="{{ route('inventorySetup.product.create') }}"><i class="fas fa-plus"></i>
                        Add New</a>
                        @endif
                    <span id="buttons"></span>

                    <a class="btn btn-tool btn-default" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </a>
                    <a class="btn btn-tool btn-default" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form class="needs-validation" method="POST"
                    action="{{ route('inventorySetup.product.update',$editInfo->id) }}" novalidate>
                    @csrf
                    @if(!empty($formInput) && is_array($formInput))
                    <div class="form-row">

                        @foreach ($formInput as $key => $eachInput)
                           @php htmlform::formfiled($eachInput, $errors,$editInfo) @endphp
                        @endforeach
                        
                        @foreach ($formInputDetails as $key => $eachInput)
                           @php htmlform::formfiled($eachInput, $errors,$editInfo->ProductDetails) @endphp
                        @endforeach

                        @include('backend.layouts.common.uploadFile',['images' => $editInfo->productImages])

                    </div>
                    <button class="btn btn-info" type="submit"><i class="fa fa-save"></i>&nbsp;Update</button>
                    @else
                    <div class="alert alert-default">
                        <strong>Warning!</strong> Sorry you have no form access !!.
                      </div>
                    @endif
                </form>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
        </div>
    </div>
    <!-- /.col-->
</div>

@endsection


@section('scripts')
    <script>

setTimeout(function(){ 
    $(".product_type").trigger('change');
                    }, 100);



    </script>
@endsection