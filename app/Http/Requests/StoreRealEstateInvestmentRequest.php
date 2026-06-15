<?php

namespace App\Http\Requests;

use App\Models\RealEstateProperty;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRealEstateInvestmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'property_id' => ['required', 'integer', 'exists:real_estate_properties,id'],
            'investment_amount' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {
                return;
            }

            $property = RealEstateProperty::find($this->property_id);
            $user = Auth::user();

            if (! $property) {
                $validator->errors()->add('property_id', 'Selected property does not exist.');
                return;
            }

            if ($property->property_status !== 'Active') {
                $validator->errors()->add('property_id', 'This property is not available for investment.');
            }

            if ($this->investment_amount < $property->minimum_investment) {
                $validator->errors()->add('investment_amount', 'Investment amount must be at least the minimum investment.');
            }

            if ($this->investment_amount > $property->maximum_investment) {
                $validator->errors()->add('investment_amount', 'Investment amount cannot exceed the maximum investment.');
            }

            if ($property->token_price <= 0) {
                $validator->errors()->add('property_id', 'The property token price is invalid.');
            }

            if ($property->available_tokens <= 0) {
                $validator->errors()->add('property_id', 'This property is sold out.');
            }

            if ($this->investment_amount > $user->balance) {
                $validator->errors()->add('investment_amount', 'Insufficient balance to complete this investment.');
            }

            if ($property->token_price > 0) {
                $tokensRequested = round($this->investment_amount / $property->token_price, 6);
                if ($tokensRequested > $property->available_tokens) {
                    $validator->errors()->add('investment_amount', 'Investment amount would require more tokens than are available.');
                }
            }
        });
    }
}
