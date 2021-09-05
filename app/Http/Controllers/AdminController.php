<?php

namespace App\Http\Controllers;

use App\Events\BarcodeCreated;
use App\Events\BarcodeReceived;
use App\Exports\CourierDebriefExport;
use App\Exports\TrackingExport;
use App\Exports\TrackingUsingBarcodesExport;
use App\Models\Barcode;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminController extends Controller
{

    public function index():view
    {
        return view('backend.index');
    }


    public function checkbox(Request $request)
    {
        if(isset($request->barcodes_id))
        {
            foreach($request->barcodes_id as $item)
            {

                $items[]= Barcode::where('id',$item)->first();

            }
            foreach($items as $item)
            {
                    Event(new BarcodeCreated($item , Auth()->user()));
                   // Event(new BarcodeInWayToStockFromSeller($items, Auth()->user()));
                    $item->update([
                        'status'=>'created',
                        'previous_status'=>'pending',
                        'created_at'=>now() ,
                        'shipping_price'=>$item->sub_area->deliver_price  ,
                    ]);
            }
            return view('backend.barcodes.print')->with('barcodes',$items);
        }
        return redirect()->back();
    }
    public function getSellerBackAccount(User $seller):JsonResponse
    {
       return response()->json([
           'bank_account'=>($seller->bank_account) ,
           'id_number'=>$seller->id_number ,
       ]);

    }
    public function exportExcel(Request $request):BinaryFileResponse
    {
        return Excel::download( new TrackingExport($request->barcodes_ids) , "shipmentsFilter.xlsx");
    }
    public function exportFilteredExcel(Request $request):BinaryFileResponse
    {
        return Excel::download( new TrackingUsingBarcodesExport($request->barcodes_ids) , "shipmentsFilter.xlsx");
    }

}
