<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Carbon\Traits\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class CrudController extends Controller
{
    use OfferTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function getOffers(){
        return Offer::select('id','name')->get();
        
    }
    
    public function create(){
        return view('offers.create');
    }
    public function store(OferRequest $request){
        // $file_extension =  $request -> photo -> extension();
        // $file_name = time().'.'.$file_extension;
        // $path ='images/offers';
        // $request->photo->move($path,$file_name);
        
        $file_name = $this ->saveImages($request -> photo,'images/offers');
        Offer::create([
            "photo"=>$file_name,
            "name"=>$request -> name,
            "price"=>$request -> price,
            "details"=>$request -> details,
        ]);
return redirect()->back();
    }
    public function getAll(){
        $offers = Offer::select('id','name','price','details')->get();
        return view('offers.all',compact('offers'));
        
    }
    public function editOffer($offer_id){
        $offer = Offer::find($offer_id);
        if(! $offer){
            return redirect()->back();
        }
        $offer =Offer::select('id','name','price','details') ->find($offer_id);
        return view('offers.edit',compact('offer'));
    }
    public function updateOffer(OferRequest $request,$offer_id){
        $offer =Offer::select('id','name','price','details') ->find($offer_id);
        if(! $offer){
            return redirect()->back();
        }
        $offer -> update($request ->all());
        return redirect()->back();

    }
    public function deleteOffer($offer_id){
        $offer = Offer::find($offer_id);
        if(! $offer){
            return redirect()->back();
        }
        $offer ->delete();
        return redirect()->route('offers.delete',$offer_id)->with(['success' => "Offers Deleted Successfully"]);
    }
    public function getVideo(){
        $video=Video::first();
        event(new VideoViewer($video));
        return view('video')->with('video',$video);
    }
    
}