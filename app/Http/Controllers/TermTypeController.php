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
}
