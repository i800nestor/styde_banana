<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentTerm;
use App\TermType;
use Illuminate\Validation\Rule;


class TermTypeController extends Controller
{
    public function new(PaymentTerm $payment_term)
    {
    	$term_type = TermType::where('payment_terms_id', '=', $payment_term->id)
            ->orderBy('id')
            ->get();
    	
    	return view('termtypes.new', compact('payment_term', 'term_type'));

    }

    public function create()
    {
    	//dd( request()->input('typev') );
        /*
        Recibir datos con el metodo request
        validar datos con el metodo validate
        */
        $day = request()->input('day');

    	$data = request()->validate([
    		'payment_terms_id' => 'required',
    		'type' => 'required|in:P,B,M',
    		'typev' => 'in:typeid,typeem,typenm',
    		'day' => 'min:0|required_unless:typev,typeid,typeem,typenm',
    		'fixed_amount' => 'required_if:type,M|min:0',
    		'percentage' => 'required_if:type,P|min:0|max:100',
    		'daydxpp' => "min:0",
    		'percentdxpp' => 'required_with:daydxpp|min:0|max:100'
    	]);

    	dd($data);

    	return redirect()->route('payment_terms.index');
    }
}
