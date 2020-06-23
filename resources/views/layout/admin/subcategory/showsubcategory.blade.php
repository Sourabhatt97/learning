@extends('layout.admin.app')

@section('title')
Admin/subcategory/List
@stop

@section('content')

<!-- Start content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">subcategory</h4>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                @include('layout.admin.alert')

                <div class="breadcrumb float-right">
                    <a href = "{{url('admin/subcategory/add')}}"><button type = "submit" class = "btn btn-success"><i class = "fa fa-plus"> Add</i></button></a>

                    <a href = "{{url('admin/subcategory/trash')}}"><button type = "submit" class = "btn btn-danger"><i class = "fa fa-trash"> Trash</i></button></a>
                </div>

                <div class="table-responsive">
                    <table id="datatable-editable" class="table table-striped m-b-0">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        @foreach($subcategories as $subcategory)
                        <thread>
                            <tr>
                                <td>{{$subcategory->name}}</td>
                                <td>{{$subcategory->category_name}}</td>
                                <td> <input class="switch" type="checkbox" data-id="{{$subcategory->id}}" data-plugin="switchery" data-color="#64b0f2"  data-size="small"
                                    @if($subcategory->status == 'y')
                                    checked
                                    @endif
                                    />
    
                                </td>

                                <td>
                                    <a href="{{url('admin/subcategory/delete').'/'. $subcategory->id}}"><i class = "fa fa-trash"></i></a>

                                    &nbsp;&nbsp;
                                    <a href="{{url('admin/subcategory/edit').'/'. $subcategory->id}}"><i class = "fa fa-pencil"></i></a>
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

        $("#datatable-editable").on("change", ".switch",function(){
            var status = $(this).prop('checked') == true ? 'y' : 'n';
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{url('admin/subcategory/switch')}}",
                data: {'id':id, 'status':status},
                success: function(res){
                    console.log(res)
                }
            });
        });

    });
    // $(document).ready(function(){

    // });
</script>
@stop