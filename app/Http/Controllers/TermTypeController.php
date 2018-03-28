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
        return view('termtypes.new', compact('payment_term'));
    }

    public function create()
    {
    	//dd( request()->input('typev') );
        /*
        Recibir datos con el metodo request
        validar datos con el metodo validate
        */
    	$data = request()->validate([
            'payment_terms_id' => 'required',
            'type' => 'required|in:P,B,M',
            'typev' => 'required|in:typedays,typeid,typeem,typenm',
            'day' => 'between:0,2|required_if:typev,typedays',
            'fixed_amount' => 'required_if:type,M|between:0,10',
            'percentage' => 'required_if:type,P|between:0,3',
            'daydxpp' => "between:0,2",
            'percentdxpp' => 'required_with:daydxpp|between:0,2'
        ],[
            'type.required' => 'The type is mandatory',
            'type.in' => 'The values of the type must be in the list of options',
            'typev.required' => 'The type expiration is mandatory',
            'typev.in' => 'The expiration type values must be in the list of options',
            'day.required_if' => 'If I select the expiration type "days", you must indicate how many days',
            'day.between' => 'The day should be between 0 to 99',
            'fixed_amount.required_if' => 'If I select the type "fixed amount", you must specify the amount',
            'fixed_amount.between' => 'Indicate the fixed amount',
            'percentage.required_if' => 'If I select the type "percentage", you must specify the percentage',
            'percentage.between' => 'The percentage should be between 0 to 100',
            'daydxpp.between' => 'The discount days must be between 0 and 99',
            'percentdxpp.required_with' => 'Indicate the discount days, indicate the discount percentage',
            'percentdxpp.between' => 'The discount percentage must be between 0 and 99'
        ]);

        if ( $data['typev'] == 'typedays' ) {
            
            $data['typeid'] = 0;
            $data['typeem'] = 0;
            $data['typenm'] = 0;

        }   elseif ( $data['typev'] == 'typeid' ) {

            $data['typeid'] = 1;
            $data['typeem'] = 0;
            $data['typenm'] = 0;

        }   elseif ( $data['typev'] == 'typeem' ) {

            $data['typeid'] = 0;
            $data['typeem'] = 1;
            $data['typenm'] = 0;

        }   elseif ( $data['typev'] == 'typenm' ) {

            $data['typeid'] = 0;
            $data['typeem'] = 0;
            $data['typenm'] = 1;

        }

    	$term_type = TermType::create([
            'payment_terms_id' => $data['payment_terms_id'],
            'type' => $data['type'],
            'day' => $data['day'],
            'typeid' => $data['typeid'],
            'typeem' => $data['typeem'],
            'typenm' => $data['typenm'],
            'fixed_amount' => $data['fixed_amount'],
            'percentage' => $data['percentage'],
            'daydxpp' => $data['daydxpp'],
            'percentdxpp' => $data['percentdxpp']
        ]);

    	return redirect()->route('payment_terms.show', $term_type->payment_terms_id);
    }

    public function edit(PaymentTerm $payment_term, TermType $term_type)
    {

        return view('termtypes.edit', compact('payment_term', 'term_type'));

    }

    public function update(TermType $term_type)
    {
        $data = request()->validate([
            'payment_terms_id' => 'required',
            'type' => 'required|in:P,B,M',
            'typev' => 'required|in:typedays,typeid,typeem,typenm',
            'day' => 'between:0,2|required_if:typev,typedays',
            'fixed_amount' => 'required_if:type,M|between:0,10',
            'percentage' => 'required_if:type,P|between:0,3',
            'daydxpp' => "between:0,2",
            'percentdxpp' => 'required_with:daydxpp|between:0,2'
        ],[
            'type.required' => 'The type is mandatory',
            'type.in' => 'The values of the type must be in the list of options',
            'typev.required' => 'The type expiration is mandatory',
            'typev.in' => 'The expiration type values must be in the list of options',
            'day.required_if' => 'If I select the expiration type "days", you must indicate how many days',
            'day.between' => 'The day should be between 0 to 99',
            'fixed_amount.required_if' => 'If I select the type "fixed amount", you must specify the amount',
            'fixed_amount.between' => 'Indicate the fixed amount',
            'percentage.required_if' => 'If I select the type "percentage", you must specify the percentage',
            'percentage.between' => 'The percentage should be between 0 to 100',
            'daydxpp.between' => 'The discount days must be between 0 and 99',
            'percentdxpp.required_with' => 'Indicate the discount days, indicate the discount percentage',
            'percentdxpp.between' => 'The discount percentage must be between 0 and 99'
        ]);

        if ( $data['typev'] == 'typedays' ) {
            
            $data['typeid'] = 0;
            $data['typeem'] = 0;
            $data['typenm'] = 0;

        }   elseif ( $data['typev'] == 'typeid' ) {

            $data['typeid'] = 1;
            $data['typeem'] = 0;
            $data['typenm'] = 0;

        }   elseif ( $data['typev'] == 'typeem' ) {

            $data['typeid'] = 0;
            $data['typeem'] = 1;
            $data['typenm'] = 0;

        }   elseif ( $data['typev'] == 'typenm' ) {

            $data['typeid'] = 0;
            $data['typeem'] = 0;
            $data['typenm'] = 1;

        }

        $term_type->update($data);

        return redirect()->route('payment_terms.show', $term_type->payment_terms_id);
    }

    public function destroy(TermType $term_type)
    {
        $term_type->delete();

        return redirect()->route('payment_terms.show', $term_type->payment_terms_id);

    }
}
