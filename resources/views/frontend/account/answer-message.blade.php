@extends("/frontend/layouts/template/template")
<style>
    .table td {
        padding: 0px !important;
    }
</style>
@section("content")
<div class="container-fluid">
    <center><h2>@lang('answerMessage.history')<hr width="70px;" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>
@if(count($answer_messages) != 0)
<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>@lang('answerMessage.contact_date')</th>
                                    <th>@lang('answerMessage.title')</th>
                                    <th>@lang('answerMessage.contact_message')</th>
                                    <th>@lang('answerMessage.reply')</th>
                                    <th>@lang('answerMessage.status')</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach($answer_messages as $answer_message => $value)
                                <tr>
                                    <th scope="row">{{$NUM_PAGE*($page-1) + $answer_message+1}}</th>
                                    <td>{{ $value->created_at->format('Y-m-d') }}</td>
                                    <td>{{$value->subject}}</td>
                                    <td>
                                        <a type="button" data-toggle="modal" data-target="#ModalMessage{{$value->id}}">
                                            <i class="fa fa-pencil-square-o" style="color:blue; font-family: 'Mitr','FontAwesome';"> @lang('answerMessage.openMessage')</i>
                                        </a>
                                    </td>
                                    <td>
                                        <a type="button" data-toggle="modal" data-target="#ModalAnswer{{$value->id}}">
                                            <i class="fa fa-pencil-square-o" style="color:blue; font-family: 'Mitr','FontAwesome';"> @lang('answerMessage.openReply')</i>
                                        </a>
                                    </td>
                                    @if($value->answer_message == null)
                                        <td style="color:red; font-size:15px;">@lang('answerMessage.waiting')</td> 
                                    @else
                                        <td style="color:green; font-size:15px;">@lang('answerMessage.replied')</td>
                                    @endif
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="ModalMessage{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">@lang('answerMessage.contactMessage')</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <textarea cols="50" rows="5" class="form-control">{{$value->message}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('answerMessage.close')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="ModalAnswer{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">@lang('answerMessage.replyMessage')</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <textarea cols="50" rows="5" class="form-control">{{$value->answer_message}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('answerMessage.close')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                            {{$answer_messages->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@else 
    <div class="cart-page">
        <div class="container-fluid">
            <!-- Cart item -->
            <h5 class="m-text20 p-b-24" style="text-align: center;">
                @lang('answerMessage.noInquiryHistory') !
            </h5><br>
            <center>
                <a href="{{url('/contact-us')}}" class="btn-warranty" style="text-decoration: none;" >
                    @lang('answerMessage.contactUs')
                </a>
            </center>
        </div>
    </div><br>
@endif
@endsection