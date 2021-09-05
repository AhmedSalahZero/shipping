@extends('layouts.admin')
@section('content')
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_0">
                                        <div class="portlet box green">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>@lang('lang.Add Shipment') </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="{{route('barcodes.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                                    @csrf
                                                    <div class="form-body">
                                                        <!--country_id-->
{{--                                                        <div class="form-group  ">--}}
{{--                                                            <label class="col-md-3 control-label">Your Hub Name</label>--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <select class="form-control input-circle" name="country_id" disabled>--}}
{{--                                                                        <option value="{{Auth()->user()->area_id}}" selected >{{Auth()->user()->area->name}}</option>--}}

{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

                                                        <div class="form-group  ">
                                                            <label class="col-md-3 control-label">@lang('lang.Area Name'):</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control input-circle" name="sub_area_id">
                                                                    <option value="0">@lang('lang.Area Name') </option>
                                                                    @foreach ($subAreas as $sub)
                                                                        <option value="{{$sub->id}}" {{ old('sub_area_id') == $sub->id ? 'selected' : '' }}>{{$sub->name . ' ( ' . trans('lang.Shipping Price'). ' ' . $sub->deliver_price . trans('lang.egp') .'  ) '}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!--client_Name-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">@lang('lang.Client Name'):</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("client_name")}}' type="text" class="form-control input-circle" placeholder="@lang('lang.Name')" name="client_name">
                                                                    @error('client_name')
                                                                    <div >
                                                                        <span class="text-danger my-2">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--address-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">@lang('lang.Address'):</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("address")}}' type="text" class="form-control input-circle" placeholder="@lang('lang.Address')" name="address">
                                                                    @error('address')
                                                                    <div >
                                                                        <span class="text-danger my-2">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--content-->
                                                        <!--Phone-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">@lang('lang.phone'):</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("phone")}}' type="number" class="form-control input-circle" placeholder="@lang('lang.phone')" name="phone">
                                                                    @error('phone')
                                                                    <div >
                                                                        <span class="text-danger my-2">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Price-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">@lang('lang.Price'):</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("price")}}' type="number" class="form-control input-circle" placeholder="@lang('lang.Price')" name="price">
                                                                    @error('price')
                                                                    <div >
                                                                        <span class="text-danger my-2">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">@lang('lang.note') :</label>
                                                            <div class="col-md-6">
                                                                <textarea  name="content" class="form-control" >{{old("content")}}</textarea>

                                                                @error('content')
                                                                <div >
                                                                    <span class="text-danger my-2">{{ $message }}</span>
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        @if(auth()->check() == true && auth()->user()->type == 'admin')
                                                        <!--status-->
                                                        <div class="form-group  ">
                                                            <label class="col-md-3 control-label">@lang('lang.Status') :</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control input-circle" name="status">
                                                                    <option value="" @if (old('status') == '') selected="selected" @endif>@lang('lang.Select Status')</option>
                                                                    <option value="created" @if (old('status') == 'created') selected="selected" @endif>@lang('lang.created')</option>
                                                                    <option value="pending" @if (old('status') == 'pending') selected="selected" @endif>@lang('lang.pending')</option>
                                                                    <option value="recieved hub" @if (old('status') == 'recieved hub') selected="selected" @endif>@lang("lang.received hub")</option>
                                                                    <option value="out to deliver" @if (old('status') == 'out to deliver') selected="selected" @endif>@lang('lang.out to deliver')</option>
                                                                    <option value="delivered" @if (old('status') == 'delivered') selected="selected" @endif>@lang('lang.delivered')</option>
                                                                    <option value="canceled" @if (old('status') == 'canceled') selected="selected" @endif>@lang('lang.canceled')</option>
                                                                    <option value="reschedule" @if (old('status') == 'reschedule') selected="selected" @endif>@lang('lang.reschedule')</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <!--button-->
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn btn-circle green">@lang('lang.create')</button>
                                                                <a href="{{route('barcodes.index')}}" class="btn btn-circle grey-salsa btn-outline">@lang('lang.back')</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>




                                                @if(count($barcodes))

                                                <form method="GET" action="{{route('products.checkbox')}}">
                                                    @csrf
                                                    <table class="table table-striped table-bordered table-hover table-header-fixed" >
                                                        <thead>
                                                        <tr>
{{--                                                            <th class="text-center"> collect </th>--}}
                                                            <th class="text-center"> @lang('lang.Client Name') </th>
                                                            <th class="text-center"> @lang('lang.Price') </th>
                                                            <th class="text-center"> @lang('lang.Tracking Number') </th>
                                                            <th class="text-center"> @lang('lang.Hub') </th>
                                                            <th class="text-center"> @lang('lang.Area') </th>
                                                            <th class="text-center"> @lang('lang.Address') </th>
                                                            <th class="text-center"> @lang('lang.Status') </th>

                                                            @if(auth()->check() == true && auth()->user()->type == 'admin' || auth()->user()->type == 'seller')
                                                                <th class="text-center"> @lang('lang.Action') </th>
                                                            @endif
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($barcodes as $barcode)
                                                            <tr class="delete_feather_row{{$barcode->id}}">
{{--                                                                <td class="text-center">--}}
{{--                                                                    <input id="checkbox" type="checkbox" value="{{$barcode->id}}" name="checkbox[]" class="form-check-input checkbox_class" id="exampleCheck1">--}}
{{--                                                                </td>--}}

{{--                                                                <td class="text-center"><input id="checkbox" type="checkbox" value="{{$barcode->id}}" name="checkbox[]" class="form-check-input checkbox_class" id="exampleCheck1"></td>--}}
                                                                <td class="text-center">{{$barcode->client_name}}
                                                                    <input  type="hidden" value="{{$barcode->id}}" name="barcodes_id[]" class="form-check-input checkbox_class" >

                                                                </td>
                                                                <td class="text-center">{{number_format($barcode->price)}}</td>
                                                                <td class="text-center">
                                                                    <div class="barcode">
                                                                        {!! DNS1D::getBarcodeHTML($barcode->barcode_number, "C128",1.4,22) !!}
                                                                        <p class="pid">{{$barcode->barcode_number}}</p>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">{{$barcode->area->name}}</td>
                                                                <td class="text-center">{{$barcode->sub_area->name}}</td>
                                                                <td class="text-center">{{$barcode->address}}</td>
                                                                <td class="text-center">{{trans('lang.'.$barcode->status)}}</td>
                                                                @if(auth()->check() == true && auth()->user()->type == 'admin')
                                                                    <td class="text-center">
                                                                        <a href="{{route('barcodes.edit', $barcode->id)}}" class="btn btn-circle btn-info btn-md">@lang('lang.Edit')</a>
                                                                        <a id="{{$barcode->id}}" href="" data-id="{{ $barcode->id }}" class="btn btn-circle btn-danger delete_feature_class">@lang('lang.delete')</a>
                                                                    </td>
                                                                @elseif(auth()->check()  && auth()->user()->type == 'seller' && ($barcode->status == 'pending' ) )
                                                                    <td class="text-center">
                                                                        <a href="{{route('barcodes.edit', $barcode->id)}}" class="btn btn-circle btn-info btn-md">@lang('lang.Edit')</a>
                                                                        <a data-barcode_id="{{$barcode->id}}" class="btn btn-circle btn-danger delete_barcode">@lang('lang.delete')</a>


                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                    <div class="" style="width: 50%;margin: auto;text-align: center;padding-bottom: 4px">
                                                        <button type="submit" class="btn btn-circle btn-danger">@lang('lang.confirm')</button>
                                                    </div>

{{--                                                    <button id="select-all"  class="btn btn-circle btn-success">Select All</button>--}}
                                                </form>

                                            @endif

                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
@endsection
@section('js')
{{--    <script>--}}
{{--        $('.checkbox_class').on('click',function (){--}}
{{--            if($(this).prop('checked','checked')) {--}}
{{--                $(this).prop('checked',false);--}}
{{--            }--}}
{{--            else{--}}
{{--                $(this).prop('checked','checked');--}}

{{--            }--}}

{{--        });--}}
{{--    </script>--}}

    <script>
        $('.delete_barcode').on('click',function(event){
            $.ajax({
                type:"delete",
                url:"/admin/barcodes/"+$(event.target).data('barcode_id') ,
                data:{
                    "_token":"{{csrf_token()}}",
                },
                success:function(data){
                    window.location.reload();

                }
            })
        });
    </script>
{{--    <script>--}}
{{--        document.getElementById('select-all').onclick = function(event) {--}}
{{--            event.preventDefault();--}}
{{--            $('.checkbox_class').each(function(index,item){--}}
{{--                if ($(this).attr('checked'))--}}
{{--                {--}}
{{--                    console.log($(this).prop('checked','checked'))--}}
{{--                    $(this).prop('checked',false);--}}
{{--                }--}}
{{--                else{--}}
{{--                    console.log('add');--}}

{{--                    $(this).prop('checked','checked');--}}

{{--                }--}}
{{--            })--}}
{{--            var checkboxes = document.getElementsByClassName('checkbox_class');--}}
{{--            for (const checkbox of checkboxes) {--}}
{{--                $(checkbox).attr('checked','checked');--}}

{{--          //     checkbox.checked = this.checked;--}}
{{--            }--}}
{{--        }--}}

{{--    </script>--}}

@endsection
