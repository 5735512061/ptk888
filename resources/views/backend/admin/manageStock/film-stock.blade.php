@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
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
                                            <div class="table-data__info">
                                                <h6>
                                                    @if($value->amount == 0)
                                                    <div class="flex-container">
                                                        <div class="col-sm-1">
                                                            <button type="button" data-toggle="modal" data-target="#delete" data-id="{{$value->id}}">
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="dont_have_amount" style="color: red;">หมด</div> 
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="button" data-toggle="modal" data-target="#add" data-id="{{$value->id}}"><i class="fa fa-plus-circle" style="color:blue;"></i></button>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="flex-container">
                                                        <div class="col-sm-1">
                                                            <button type="button" data-toggle="modal" data-target="#delete" data-id="{{$value->id}}"><i class="fa fa-minus-circle" style="color:red;"></i></button>
                                                        </div>
                                                        <div class="col-sm-1 have_amount">
                                                            {{$value->amount}}
                                                        </div> 
                                                        <div class="col-sm-1">
                                                            <button type="button" data-toggle="modal" data-target="#add" data-id="{{$value->id}}"><i class="fa fa-plus-circle" style="color:blue;"></i></button>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </h6>
                                            </div>
                                        </td>
                                        
                                        <td>{{$value->comment}}</td>
                                        <td>       
                                            <a href="{{url('/admin/edit-product')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-product/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$stock_films->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
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