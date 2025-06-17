<?php
// app/Http/Controllers/EvaluationController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = [
            [
                'id' => 1,
                'employee' => [
                    'name' => 'Budi Santoso',
                    'avatar' => '/placeholder.svg',
                    'department' => 'IT',
                ],
                'period' => 'Q1 2023',
                'evaluator' => 'Joko Widodo',
                'score' => 87,
                'status' => 'completed',
                'date' => '31 Mar 2023',
            ],
            [
                'id' => 2,
                'employee' => [
                    'name' => 'Siti Rahayu',
                    'avatar' => '/placeholder.svg',
                    'department' => 'HR',
                ],
                'period' => 'Q1 2023',
                'evaluator' => 'Megawati Soekarno',
                'score' => 92,
                'status' => 'completed',
                'date' => '30 Mar 2023',
            ],
        ];

        return view('evaluations.index', compact('evaluations'));
    }
}
