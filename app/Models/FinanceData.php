<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceData extends Model
{
    use HasFactory;
    protected $table='finance_data';
    protected $fillable = [
        'monthly_income',
        'monthly_expense',
        'monthly_debt_payment',
        'total_debts',
        'total_assets',
        'debt_to_income_ratio',
        'savings_ratio',
        'net_worth',
        'health_score',
        'user_id'
    ];
}
