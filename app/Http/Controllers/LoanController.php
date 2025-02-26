<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return response()->json(Loan::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date',
            'status' => 'required|string',
        ]);
        $loan = Loan::create($request->all());
        return response()->json($loan, 201);
    }

    public function show($id)
    {
        $loan = Loan::find($id);
        return $loan ? response()->json($loan, 200) : response()->json(['message' => 'Loan not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);
        if (!$loan) return response()->json(['message' => 'Loan not found'], 404);
        $loan->update($request->all());
        return response()->json($loan, 200);
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);
        if (!$loan) return response()->json(['message' => 'Loan not found'], 404);
        $loan->delete();
        return response()->json(['message' => 'Loan deleted'], 200);
    }
}
