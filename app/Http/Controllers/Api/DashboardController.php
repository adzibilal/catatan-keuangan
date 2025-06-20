<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Get dashboard overview
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get date range (default: current month)
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());
        
        // Overall totals (all time)
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->sum('amount');
            
        $totalExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->sum('amount');
            
        $balance = $totalIncome - $totalExpense;
        
        // Period totals
        $periodIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
            
        $periodExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
            
        $periodBalance = $periodIncome - $periodExpense;
        
        // Recent transactions
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Monthly trend (last 6 months)
        $monthlyTrend = Transaction::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw('
                YEAR(created_at) as year,
                MONTH(created_at) as month,
                type,
                SUM(amount) as total_amount
            ')
            ->groupBy('year', 'month', 'type')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        
        // Top categories
        $topCategories = Transaction::where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('
                description as category,
                type,
                SUM(amount) as total_amount,
                COUNT(*) as count
            ')
            ->groupBy('description', 'type')
            ->orderBy('total_amount', 'desc')
            ->limit(5)
            ->get();
        
        // Transaction count by type
        $transactionCounts = Transaction::where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'period' => [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ],
                'overview' => [
                    'total_income' => $totalIncome,
                    'total_expense' => $totalExpense,
                    'balance' => $balance,
                ],
                'period_summary' => [
                    'income' => $periodIncome,
                    'expense' => $periodExpense,
                    'balance' => $periodBalance,
                ],
                'recent_transactions' => $recentTransactions->map(function ($transaction) {
                    return [
                        'id' => $transaction->id,
                        'description' => $transaction->description,
                        'amount' => $transaction->amount,
                        'type' => $transaction->type,
                        'created_at' => $transaction->created_at,
                    ];
                }),
                'monthly_trend' => $monthlyTrend,
                'top_categories' => $topCategories,
                'transaction_counts' => $transactionCounts,
            ]
        ]);
    }

    /**
     * Get financial summary
     */
    public function summary(Request $request)
    {
        $user = Auth::user();
        
        // Get date range
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());
        
        // Calculate totals
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
            
        $totalExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
            
        $balance = $totalIncome - $totalExpense;
        
        // Calculate savings rate
        $savingsRate = $totalIncome > 0 ? ($balance / $totalIncome) * 100 : 0;
        
        // Get transaction count
        $transactionCount = Transaction::where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        
        // Get average transaction amount
        $avgTransactionAmount = Transaction::where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->avg('amount');
        
        return response()->json([
            'success' => true,
            'data' => [
                'period' => [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ],
                'summary' => [
                    'total_income' => $totalIncome,
                    'total_expense' => $totalExpense,
                    'balance' => $balance,
                    'savings_rate' => round($savingsRate, 2),
                    'transaction_count' => $transactionCount,
                    'average_transaction_amount' => round($avgTransactionAmount, 2),
                ]
            ]
        ]);
    }

    /**
     * Get insights and recommendations
     */
    public function insights(Request $request)
    {
        $user = Auth::user();
        
        // Get date range
        $startDate = $request->get('start_date', now()->subMonths(1));
        $endDate = $request->get('end_date', now());
        
        // Get spending patterns
        $spendingPatterns = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('
                description,
                SUM(amount) as total_spent,
                COUNT(*) as frequency
            ')
            ->groupBy('description')
            ->orderBy('total_spent', 'desc')
            ->limit(10)
            ->get();
        
        // Get income sources
        $incomeSources = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('
                description,
                SUM(amount) as total_earned,
                COUNT(*) as frequency
            ')
            ->groupBy('description')
            ->orderBy('total_earned', 'desc')
            ->limit(10)
            ->get();
        
        // Calculate insights
        $totalExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
            
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
        
        $insights = [];
        
        // Spending insights
        if ($spendingPatterns->isNotEmpty()) {
            $topSpending = $spendingPatterns->first();
            $insights[] = "Pengeluaran terbesar Anda adalah {$topSpending->description} dengan total Rp " . number_format($topSpending->total_spent);
        }
        
        // Income insights
        if ($incomeSources->isNotEmpty()) {
            $topIncome = $incomeSources->first();
            $insights[] = "Sumber pendapatan terbesar Anda adalah {$topIncome->description} dengan total Rp " . number_format($topIncome->total_earned);
        }
        
        // Balance insights
        if ($totalIncome > 0 && $totalExpense > 0) {
            $savingsRate = (($totalIncome - $totalExpense) / $totalIncome) * 100;
            if ($savingsRate > 20) {
                $insights[] = "Excellent! Anda berhasil menabung " . round($savingsRate, 1) . "% dari pendapatan";
            } elseif ($savingsRate > 0) {
                $insights[] = "Bagus! Anda menabung " . round($savingsRate, 1) . "% dari pendapatan";
            } else {
                $insights[] = "Perlu perhatian: Pengeluaran melebihi pendapatan";
            }
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'period' => [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ],
                'spending_patterns' => $spendingPatterns,
                'income_sources' => $incomeSources,
                'insights' => $insights,
                'summary' => [
                    'total_income' => $totalIncome,
                    'total_expense' => $totalExpense,
                    'balance' => $totalIncome - $totalExpense,
                ]
            ]
        ]);
    }
} 