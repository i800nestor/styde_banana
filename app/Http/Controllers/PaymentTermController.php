<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentTerm;
use App\TermType;
use Illuminate\Validation\Rule;

class PaymentTermController extends Controller
{
    public function index()
    {
    	$payment_terms = PaymentTerm::orderBy('name')->paginate(4);

    	if ( isset( $_GET['e'] ) && $_GET['e'] == 'true' ) {
            
            $error_message = 'The payment term you are trying to eliminate has types of associated terms.';

        }

    	return view('paymentterms.index', compact(
    		'payment_terms',
    		'error_message'
    	));
    }

    public function show(PaymentTerm $payment_term)
    {
        $term_type = TermType::where('payment_terms_id', '=', $payment_term->id)
            ->orderBy('id')
            ->paginate(4);

    	return view('paymentterms.show', compact('payment_term', 'term_type'));
    }

    public function new()
    {
    	
    	return view('paymentterms.new');

    }

    public function create()
    {
        /*
        Recibir datos con el metodo request
        validar datos con el metodo validate
        */
    	$data = request()->validate([
            'name' => 'required|min:5|max:45',
            'notes' => ''
        ], [
        	'name.required' => 'The name is mandatory',
            'name.max' => 'This name maximum 45 characters',
            'name.min' => 'This name minimum 5 characters'
        ]);

    	PaymentTerm::create([
    		'name' => $data['name'],
        	'notes' => $data['notes']
    	]);

    	return redirect()->route('payment_terms.index');
    }

    public function edit(PaymentTerm $payment_term)
    {    

        return view('paymentterms.edit', ['payment_term' => $payment_term]);

    }

    public function update(PaymentTerm $payment_term)
    {
        $data = request()->validate([
            'name' => 'required|min:5|max:45',
            'notes' => ''
        ], [
        	'name.required' => 'The name is mandatory',
            'name.max' => 'This name maximum 45 characters',
            'name.min' => 'This name minimum 5 characters'
        ]);

        $payment_term->update($data);

        return redirect()->route('payment_terms.index');
    }

    public function destroy(PaymentTerm $payment_term)
    {

        try {
            
            $payment_term->delete();

            return redirect()->route('payment_terms.index');

        } catch (\Illuminate\Database\QueryException $e) {
            
            return redirect()->route('payment_terms.index', ['e' => 'true']);

        }
    }
}
