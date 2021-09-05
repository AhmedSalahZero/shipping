@extends('layouts.admin')

@section('css')
    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    @include('layouts.toaster')
    <span id="our_token" style="display: none" value="{{csrf_token()}}"></span>
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
                                            <i class="fa fa-gift"></i>@lang('lang.Search Page') </div>
                                    </div>
                                    <div class="portlet-body form assign_to_courier_data">
                                        <div style="width: 50%; margin: auto ; text-align: center;display: none"  id="excel_btn_form">

                                        </div>

                                        <!-- BEGIN FORM-->
                                        <form class="form-horizontal" >
                                            @csrf
                                            <div class="form-body">
                                                <!--country_id-->
                                                <div class="row">
                                                    <div class="col-xs-3" style="text-align: center;">
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                    <input type="text" name="barcode_number" placeholder="@lang('lang.Tracking Number')" class="search_field barcode_number_changed form-control input-circle">
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <select class="search_field area_changed form-control input-circle" name="country_id">
                                                                    <option value="0"> @lang('lang.Select Area') </option>
                                                                    @foreach($areas as $area)
                                                                        <option  value="{{$area->id}}">{{$area->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <select class="search_field current_status_changed form-control input-circle" name="status">
                                                                    <option value="0"> @lang('lang.Select Current Status') </option>
                                                                    @foreach($status as $stat)
                                                                        <option  value="{{$stat}}">{{trans('lang.'.$stat)}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <select class="search_field previous_status_changed form-control input-circle" name="previous_status">
                                                                    <option value="0"> @lang('lang.Select Previous Status') </option>
                                                                    @foreach($previous_status as $prev)
                                                                        <option  value="{{$prev}}">{{trans('lang.'.$prev)}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                        </div>

                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <select class="search_field seller_changed form-control input-circle" name="seller_id">
                                                                    <option value="0"> @lang('lang.Select Seller') </option>
                                                                    @foreach($sellers as $seller)
                                                                        <option  value="{{$seller->id}}">{{$seller->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <select class="search_field seller_changed form-control input-circle" name="deliver_courier_id">
                                                                    <option value="0"> @lang('lang.Select Deliver Courier') </option>
                                                                    @foreach($couriers as $courier)
                                                                        <option  value="{{$courier->id}}">{{$courier->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <select class="search_field seller_changed form-control input-circle" name="return_courier_id">
                                                                    <option value="0"> @lang('lang.Select Return Courier') </option>
                                                                    @foreach($couriers as $courier)
                                                                        <option  value="{{$courier->id}}">{{$courier->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <input type="text" name="client_name" placeholder="@lang('lang.Client Name')" class="search_field client_name_changed form-control input-circle">
                                                            </div>

                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <input type="date" name="date_from"  class="search_field date_from_changed form-control input-circle">
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <input type="date" name="date_to"  class="search_field date_to_changed form-control input-circle">
                                                            </div>

                                                        </div>

                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <button class="btn green search_btn"> @lang('lang.Search') </button>
                                                            </div>

                                                        </div>

                                                    </div>
                                                 <div class="col-xs-9">
                                                     <div class="form_search_result" style="display: none">
                                                         <table class="table table-striped table-bordered table-hover table-header-fixed" >
                                                             <thead>
                                                             <tr>
                                                                 <th class="text-center">#</th>
                                                                 <th class="text-center"> @lang('lang.Tracking Number') </th>
                                                                 <th class="text-center"> @lang('lang.Previous Status') </th>
                                                                 <th class="text-center"> @lang('lang.Current Status') </th>
                                                                 <th class="text-center"> @lang('lang.Client Name') </th>
                                                                 <th class="text-center"> @lang('lang.Address') </th>
                                                                 <th class="text-center"> @lang('lang.Phone') </th>
                                                                 <th class="text-center"> @lang('lang.Price') </th>
                                                                 <th class="text-center"> @lang('lang.Area') </th>
                                                                 <th class="text-center"> @lang('lang.Seller') </th>
                                                                 <th class="text-center"> @lang('lang.courier') </th>
                                                                 <th class="text-center"> @lang('lang.Date') </th>
                                                             </tr>
                                                             </thead>
                                                             <tbody class="body_for_search_result">

                                                             </tbody>
                                                         </table>




                                                         <div style="width: 50%; margin: auto ; text-align: center" id="excel_btn_div">

                                                         </div>

                                                     </div>

                                                     <div class="no_result_found alert alert-success" style="display: none;text-align: center;color: #fff">
                                                         <h3 style="text-align: center">@lang('lang.No Result Found') </h3>
                                                         <img width="500px" height="290px" src="{{asset('backend/assets/new/no_result_image.png')}}">
                                                     </div>
                                                 </div>
                                                </div>
                                            </div>
                                            <!--button-->

                                        </form>


                                    {{-- Courier data here --}}

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

    <script>
        $('.search_btn').on('click',(event)=>{
            event.preventDefault();
            // var tracking_number = $('.barcode_number_changed').val();
            // var area_id = $('.area_changed').val();
            // var current_status =$('.current_status_changed').val();
            // var previous_status =$('.previous_status_changed').val();
            // var client_name = $('.client_name_changed').val() ;
            // console.log(typeof(client_name))
            // var data_from = $('.date_from_changed').val()
            // var date_to = $('.date_to_changed').val();
            var search_fields = [];
             $('.search_field').each(function(index,val)
            {
                var field = $(val).val();

                if( field!=0)
                {
                    var obj ={
                        name:$(val).attr('name'),
                        val:$(val).val(),
                    }
                    search_fields.push(obj);
                }


            });
             if(search_fields.length)
             {

                 $.ajax({
                     type:'get',
                     url:'/admin/search',
                     data:{
                         '_token':"{{csrf_token()}}" ,
                         'search_fields':search_fields
                     },
                     success:function(data)
                     {


                         if(data.no_search_result)
                         {
                             var result_table = $('.body_for_search_result');
                             var search_result= data.search_result ;
                             $('.no_result_found').hide();
//                             $(data.search_result)

                             var order = 0 ;
                             result_table.empty()
                             let excel_ids = '';
                             for(const key in search_result )
                             {

                                 result_table.append(`
                                  <tr class="tracking_tr_excel"  data-barcodes_id="${excel_ids += search_result[key].id + ','}  " >
                                     <td> ${++order} </td>
                                     <td>${search_result[key].barcode_number} </td>
                                     <td> ${search_result[key].transPrevStatus}</td>
                                     <td>${search_result[key].transStatus} </td>
                                     <td>${search_result[key].client_name} </td>
                                      <td>${search_result[key].address} </td>
                                <td>${search_result[key].phone} </td>
                                      <td>${search_result[key].price} </td>
                                     <td>${search_result[key].area_name} </td>
                                       <td>${search_result[key].barcode_seller_name} </td>
                                      <td>${search_result[key].courier_name}  </td>
                                     <td>${search_result[key].created_at}  </td>
                                 </tr>
                                 `);
                             }
                             $('#excel_btn_form').html(`<form method="post" id="excel_form_form" action="{{Route('filter.all.excel')}}">
                             <input value="${excel_ids}" name="barcodes_ids" >
                             <input type="hidden" name="_token" value="${$('#our_token').attr('value')}">
                             </form>`);
                             $('#excel_btn_div').html(`<button  class="btn green-dark" id="excel_btn"> @lang("lang.Export As Excel") </button>`)

                             $('.form_search_result').slideDown();

                         }
                         else{
                             $('.form_search_result').hide();
                             $('.no_result_found').slideDown();
                         }
                     }

                 });
             }
             else{
                 $('.form_search_result').slideUp(400 ,()=>{
                     $('.no_result_found').slideUp(400,()=>{
                         alert('@lang('lang.no search field are selected')')
                     });

                 });
             }
        })
    </script>
    <script>
        $(document).on('click','#excel_btn',function(e){
            e.preventDefault();
            $('#excel_form_form').submit();
        });
    </script>
    {{--<script src="{{asset('backend/assets/new/custom_js.js')}}"></script>--}}
@endsection
