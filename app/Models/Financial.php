<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Financial extends Model
{
    use SoftDeletes;

    const TYPE = [
        'Pagar'   => 'Pagar',
        'Receber' => 'Receber'
    ];

    protected $fillable = [
        'type',
        'financial_category_id',
        'financial_account_id',
        'person_id',
        'process_id',
        'description',
        'document',
        'original',
        'discount',
        'fine',
        'rate',
        'credit',
        'payment',
        'competence',
        'due_date',
        'payday',
        'honorary'
    ];

    protected $appends = ['value'];
    protected $cast = ['value' => 'decimal'];

    public function getValueAttribute() 
    {
        return $this->attributes['payment'];
    }

    public function rules($id = '')
    {
        return [
            'type' => 'required|in:Pagar,Receber',
            'document' => 'required|unique:financials,id,{$id},id',
            'original' => 'required',
            'due_date'  => 'required',
            'competence'  => 'required',
            'payment' => 'required',
            'person_id' => "required|exists:people,id",
            'financial_category_id' => "required|exists:financial_categories,id",
            'financial_account_id' => "required|exists:financial_accounts,id",
            'process_id' => "nullable|exists:processes,id",
        ];
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function financialCategory()
    {
        return $this->belongsTo(FinancialCategory::class);
    }

    public function financialAccount()
    {
        return $this->belongsTo(FinancialAccount::class);
    }

    public function getOriginalAttribute($value)
    {
        return Helper::formatDecimal($value, 2);
    }

    public function getDiscountAttribute($value)
    {
        return Helper::formatDecimal($value, 2);
    }

    public function getFineAttribute($value)
    {
        return Helper::formatDecimal($value, 2);
    }

    public function getRateAttribute($value)
    {
        return Helper::formatDecimal($value, 2);
    }

    public function getPaymentAttribute($value)
    {
        return Helper::formatDecimal($value, 2);
    }

}
