<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Mockery\Matcher\Any;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'image',
        'area_id' ,
        'address' ,
        'phone',
        'area_id',
        'bank_account',
        'id_number',

        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
//    public function setBankAccountAttribute($val):void
//    {
//        $this->attributes = strip_tags($val);
//    }
//    public function setIDNumberAttribute($val):void
//    {
//        $this->attributes = strip_tags($val);
//    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function area():BelongsTo
    {
        return $this->belongsTo(Country::class , 'area_id','id');
    }
    public function createdProductsInThisArea($area_id):Collection
    {
        return $this->hasMany(Barcode::class , 'seller_id','id')->where('country_id',$area_id)
            ->where('status','created')->get();

    }
    public function ScopeSellers($query)
    {
        return $query->where('type','seller');
    }
    public function ScopeCouriers($query)
    {
        return $query->where('type','courier');
    }
//    public function ScopeCouriers($query)
//    {
//        return $query->where('id',Auth()->user()->id)->first()->where('type','courier');
//    }
    public function isAdmin()
    {
        return $this->type=='admin';
    }
    public function isOperator()
    {
        return $this->type=='operator';
    }
    public function isSeller()
    {
        return $this->type=='seller';
    }
    public function isCourier()
    {
        return $this->type=='courier';
    }
    public function isAccountant()
    {
        return $this->type=='accountant';
    }
    public function sellerBarcodes()
    {
        return $this->hasMany(Barcode::class , 'seller_id','id');
    }
    public  function barcodesToClient()
    {
        return $this->belongsToMany(Barcode::class, 'barcode_couriers', 'courier_id', 'barcode_number'
        ,'id','barcode_number')->where('status','out to deliver');
    }
    public function barcodes()
    {
        return $this->belongsToMany(Barcode::class, 'barcode_couriers', 'courier_id', 'barcode_number'
            ,'id','barcode_number');
    }
    public function barcodesToReturn():BelongsToMany
    {
        return $this->belongsToMany(Barcode::class, 'barcode_couriers', 'courier_id', 'barcode_number'
            ,'id','barcode_number')->where('status','Return to seller');
    }

    public function barcodesReturned():BelongsToMany
    {
        return $this->belongsToMany(Barcode::class, 'barcode_couriers', 'courier_id', 'barcode_number'
            ,'id','barcode_number')->where('status','Returned');
    }
    public function unDebriefed()
    {
        return $this->barcode ;
     //   return $this->barcodesDelivered()->where('end_courier_debrief',false)->get()->merge($this->barcodesReturned()->where('end_courier_debrief',false)->where('status','!=','pending')->get());
    }
    public  function barcodesDelivered():BelongsToMany
    {
        return $this->belongsToMany(Barcode::class, 'barcode_couriers', 'courier_id', 'barcode_number'
            ,'id','barcode_number')->where('status','delivered');
    }
    public function changeProfilePassword($request):array
    {
        if (!($request->new_password === $request->confirm_new_password))
            return [
                'fail'=>'notConfirmed'
            ];
        else if (!Hash::check($request->old_password, $this->password))
            return [
                'fail'=>'old password not Matched !'
            ];
        else{
            $this->update([
                'password' => Hash::make($request->new_password)
            ]);
            return [
                'success'=>'password has been edited'
            ];
        }
    }
    public function EditAccount($request)
    {
        $this->update([
            'first_name'=>$request->first_name ,
            'last_name'=>$request->last_name,
            'job'=>$request->job,
            'email'=>$request->email ,
        ]);
    }
    public function ChangeProfileImage($request)
    {
        $this->update([
            'image'=>$request->image->store('profile','public')
        ]);
    }
//    public function courierInvoices():hasMany
//    {
//        return $this->hasMany(Invoice::class , 'courier_id','id');
//    }
    public function sellerInvoices():hasMany
    {
        return $this->hasMany(Invoice::class , 'seller_id','id');
    }
    public function addNewInvoice( $request, $invoice )
    {
        return $invoice->create([
            'seller_id'=>$this->id ,
            'payment_method'=>$request->paymentMethod ,
            'discount'=>$request->discount,
            'main_price'=>$request->mainPrice ,
            'total'=>$request->mainPrice + $request->discount
            ]);
    }

}
