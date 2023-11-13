<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FinanceDataResource;
use App\Models\FinanceData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FinanceController extends Controller
{
    public function getPreviousData() : mixed
    {
        $finData=FinanceData::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        return FinanceDataResource::collection($finData);
    }
    public function calculateHealthScore(Request $request) : mixed
    {
        try {
            $request->validate([
                'monthly_income' => 'required|numeric',
                'monthly_expense' => 'required|numeric',
                'monthly_debt_payment' => 'required|numeric',
                'total_debts' => 'required|numeric',
                'total_assets' => 'required|numeric',
            ]);
            $debtsToIncomeRatio = ($request->monthly_debt_payment / $request->monthly_income)*100;
            $savingsRatio = (($request->monthly_income-$request->monthly_expense) / $request->monthly_income)*100;
            $netWorth = ($request->total_assets - $request->total_debts);
            $healthScore = 0.4*$debtsToIncomeRatio + 0.3*$savingsRatio + 0.3*$netWorth;
            $finData=new FinanceData();
            $finData->monthly_income=$request->monthly_income;
            $finData->monthly_expense=$request->monthly_expense;
            $finData->monthly_debt_payment=$request->monthly_debt_payment;
            $finData->total_debts=$request->total_debts;
            $finData->total_assets=$request->total_assets;
            $finData->debt_to_income_ratio=$debtsToIncomeRatio;
            $finData->savings_ratio=$savingsRatio;
            $finData->net_worth=$netWorth;
            $finData->health_score=$healthScore;
            $finData->user_id=auth()->user()->id;
            $finData->save();
            return  FinanceDataResource::make($finData)->additional(['success' => true, 'message' => 'Health score calculated successfully']);
        }   catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
