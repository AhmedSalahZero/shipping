@extends('layouts.admin')

@section('css')
    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />

    @endsection
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
                                                    <i class="fa fa-gift"></i>@lang('lang.New Orders')</div>
                                            </div>
                                            <div class="portlet-body form courier_form_data">
                                                <!-- BEGIN FORM-->
                                                <form  class="form-horizontal">

                                                    <div class="form-body">
                                                        <!--country_id-->
                                                        <div class="row">
                                                            <div class="form-group ">
                                                                <div class="col-md-3">
                                                                    <select class="area_changed form-control input-circle" name="status">
                                                                        <option value="0"> @lang('lang.Select Area') </option>
                                                                        @foreach($areas as $area)
                                                                            <option  value="{{$area->id}}">{{$area->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select class="seller_select form-control input-circle" name="courier_id" disabled>

                                                                        <option value="0">@lang('lang.Seller Name') </option>

                                                                       {{-- Ajax Here --}}

                                                                    </select>
                                                                </div>

                                                                <div class="col-md-1">
                                                                    <input type="number" class="number_of_products_in_this_area_to_this_seller form-control" value="0" readonly>
                                                                </div>
                                                                <div class="col-md-3">
                                                                   <button class="button blue btn pull-right show_products_btn" disabled> @lang('lang.show') </button>
                                                                </div>




                                                            </div>
                                                            <table class="table table-striped table-bordered table-hover table-header-fixed table_for_seller_data" style="display: none">
                                                                <thead>
                                                                <tr>

                                                                    <th class="text-center"> @lang('lang.Address') </th>
                                                                    <th class="text-center"> @lang('lang.Phone') </th>



                                                                </tr>
                                                                </thead>
                                                                <tbody class="body_for_seller_info text-center" >

                                                                </tbody>
                                                            </table>



                                                        </div>

                                                    </div>
                                                    <!--button-->
                                                    <div class="form-actions" style="display: none">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn btn-circle green">@lang('lang.Add')</button>
{{--                                                                <a href="{{route('barcodes.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="form_data" style="display: none" >


                                                    <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center"> @lang('lang.Client Name') </th>
                                                            <th class="text-center"> @lang('lang.Tracking Number') </th>
                                                            <th class="text-center"> @lang('lang.Price') </th>
                                                            <th class="text-center"> @lang('lang.Address') </th>


                                                        </tr>
                                                        </thead>
                                                        <tbody class="body_for_products">



                                                        </tbody>
                                                    </table>



                                                </div>

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
        $(document).on('change','.area_changed',function(){
           var areaId = document.querySelector('.area_changed').value ;

           if(parseInt(areaId))
           {
               $('.seller_select').removeAttr('disabled');
               $.ajax({
                   type: 'POST',
                   url: "/admin/getSellerForThisArea/"+areaId,
                   data: {
                       '_token':"{{csrf_token()}}",
                   },
                   success: function (data) {
                          if(data.NoSellers)
                          {
                              $('.seller_select').empty().prepend(` <option value="0">@lang("lang.Seller Name") </option>`)
                              for (var key in data.sellers)
                              {
                                  $('.seller_select').append(`<option  value="${data.sellers[key].id}">${data.sellers[key].name}</option>`)
                              }
                              $('.seller_select').removeAttr('disabled');
                              $('.seller_select option[value="-1"]').remove();
                          }
                          else
                              {
                                  $('.form_data').slideUp();
                                  $('.table_for_seller_data').slideUp();
                              $('.seller_select').attr('disabled','disabled').prepend('<option value="-1" selected>@lang("lang.No sellers In This Area")</option>');
                          }

                   }, error: function (reject) {


                   }
               });


           }
           else{
               $('.form_data').slideUp();
               $('.table_for_seller_data').slideUp();

               $('.seller_select option[value="0"]').attr('selected','selected');
               $('.seller_select option[value="-1"]').remove();
               $('.seller_select').attr('disabled','disabled');
           }$('.show_products_btn').attr('disabled','disabled');
            $('.number_of_products_in_this_area_to_this_seller').val(0)
        });
        $(document).on('change','.seller_select',function(){
            var table = $('#sample_2').DataTable();

//clear datatable
            table.clear().draw();
            // $('.form_data').slideUp();
            var seller_id = document.querySelector('.seller_select').value ;
            var areaId = document.querySelector('.area_changed').value
            $('.body_for_products').empty() ;

            if(parseInt(seller_id))
            {


                $.ajax({
                    type: 'POST',
                    url: "/admin/getProductsForSellerInThisArea/"+areaId+"/"+seller_id,
                    data: {
                        '_token':"{{csrf_token()}}",
                    },
                    success: function (data) {
                        $('.body_for_seller_info').empty().prepend(`<tr> <td> ${data.seller.address} </td> <td>${data.seller.phone}</td> </tr>`);
                        $('.table_for_seller_data').slideDown();
                        if(data.NoProductsInThisArea)
                            {
                                $('.body_for_products').empty() ;
                                for (var key in data.productsInThisArea)
                                {
                                    var table = $('#sample_2').DataTable();
                                    let egp = "{{App()->getLocale() =='ar' ? 'جنية مصري' :' EGP'}} ";

                                    table.row.add([
                                        `${parseInt(key)+1}`,
                                        `${data.productsInThisArea[key].client_name}`,
                                        `${data.productsInThisArea[key].barcode_number}`,
                                        `${data.productsInThisArea[key].price + ' ' + egp} `,
                                       `${data.productsInThisArea[key].address}`,
                                    ]).draw(false);
                                }

                                $('.number_of_products_in_this_area_to_this_seller').val(data.NoProductsInThisArea)
                                $('.show_products_btn').removeAttr('disabled');
                            }
                            else
                            {
                                $('.form_data').slideUp();
                                $('.show_products_btn').attr('disabled','disabled');
                                $('.number_of_products_in_this_area_to_this_seller').val(0)
                            }


                    }, error: function (reject) {


                    }
                });

            }
            else{
                $('.form_data').slideUp();
                $('.table_for_seller_data').slideUp();
                $('.number_of_products_in_this_area_to_this_seller').val(0)
                $('.show_products_btn').attr('disabled','disabled');
            }
        });
        $(document).on('click','.show_products_btn',function(e){
            e.preventDefault();
            $('.form_data').slideDown();
        })

    </script>
{{--<script src="{{asset('backend/assets/new/custom_js.js')}}"></script>--}}
@endsection
