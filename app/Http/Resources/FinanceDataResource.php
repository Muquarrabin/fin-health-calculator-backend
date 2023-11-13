<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FinanceDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'monthly_income' => $this->monthly_income,
            'monthly_expense' => $this->monthly_expense,
            'monthly_debt_payment' => $this->monthly_debt_payment,
            'total_debts' => $this->total_debts,
            'total_assets' => $this->total_assets,
            'debt_to_income_ratio' => $this->debt_to_income_ratio,
            'savings_ratio' => $this->savings_ratio,
            'net_worth' => $this->net_worth,
            'health_score' => $this->health_score,
            'user_id' => $this->user_id,
        ];
    }
}
