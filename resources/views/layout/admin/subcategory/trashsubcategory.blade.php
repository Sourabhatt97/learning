@extends('layout.admin.app')

@section('title')
Admin/subcategory/Trash
@stop

@section('content')

<!-- Start content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">subcategory/Trash</h4>
                <div class="breadcrumb float-right">
                    <a href = "{{url('admin/subcategory/show')}}"><button type = "submit" class = "btn btn-default"><i class = "fa fa-arrow-left"> Back</i></button></a>
                </div>


                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                @include('layout.admin.alert')
                <div class="table-responsive">
                    <table id="datatable-editable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        @foreach($trashsubcategories as $trashsubcategory)
                        <thread>
                            <tr>
                                <td>{{$trashsubcategory->name}}</td>
                                <td>{{$trashsubcategory->category_name}}</td>
                                <td>Trash</td>
                                <td>
                                    <a href="{{url('admin/subcategory/restore').'/'. $trashsubcategory->id}}"><input type = "submit" value = "Restore" class="btn btn-warning"></a>
                                </td>
                            </tr>
                        </thread>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section("scripts")
<script type="text/javascript">
    setTimeout(function() {
        $('#success').fadeOut('fast');
    }, 5000);

    $(function() {
        $('#datatable-editable').DataTable();
    });
</script>
@stop