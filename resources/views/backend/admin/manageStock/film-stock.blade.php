@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลสินค้า</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ประเภทฟิล์ม</th>
                                    <th>จำนวนแผ่นฟิล์ม</th>
                                    <th>หมายเหตุ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stock_films as $stock_film => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $stock_film+1}}</th>
                                        <td>{{$value->film_type}}</td>
                                        <td>
                                            <h6>
                                                @if($value->amount == 0)
                                                    <div class="row">
                                                        <div class="col-sm-1">
                                                            <div style="color: red;">หมด</div> 
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <a data-toggle="modal" data-target="#add" data-id="{{$value->id}}"><i class="fa fa-plus-circle" style="color:blue;"></i></a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-sm-1">
                                                            <a data-toggle="modal" data-target="#delete" data-id="{{$value->id}}"><i class="fa fa-minus-circle" style="color:red;"></i></a>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            {{$value->amount}}
                                                        </div> 
                                                        <div class="col-sm-1">
                                                            <a data-toggle="modal" data-target="#add" data-id="{{$value->id}}"><i class="fa fa-plus-circle" style="color:blue;"></i></a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </h6>
                                        </td>
                                        
                                        <td>{{$value->comment}}</td>
                                        <td>   
                                            <a href="{{url('/admin/edit-stock-film')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>    
                                            <a href="{{url('/admin/delete-stock-film/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$stock_films->links()}}
                        </table>
                        <!-- modal delete -->                            
                        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p>ลบจำนวนแผ่นฟิล์ม</p>
                                    </div>
                                    <form action="{{url('/admin/film-stock-out')}}" method="POST" enctype="multipart/form-data" autocomplete="off">@csrf
                                    <div class="modal-body">
                                        <input type="text" class="form-control" style="height: calc(1.5rem)" name="amount" placeholder="จำนวนแผ่นฟิล์มที่ต้องการลบ">
                                        <input type="hidden" name="id">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal delete -->
                        <!-- modal add -->
                        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p>เพิ่มจำนวนแผ่นฟิล์ม</p>
                                    </div>
                                    <form action="{{url('/admin/film-stock-add')}}" method="POST" enctype="multipart/form-data" autocomplete="off">@csrf
                                    <div class="modal-body">
                                        <input type="text" class="form-control" style="height: calc(1.5rem)" name="amount" placeholder="จำนวนแผ่นฟิล์มที่ต้องการเพิ่ม">
                                        <input type="hidden" name="id">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-primary btn-sm">เพิ่ม</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal add -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<script>
    $( document ).ready(function() {

        $('#add').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')

            var modal = $(this)

            modal.find('.modal-body input[name="id"]').val(id)
        })
    });
</script> 

<script>
    $( document ).ready(function() {

        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')

            var modal = $(this)

            modal.find('.modal-body input[name="id"]').val(id)
        })
    });
</script>
@endsection