<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    //
    public function index()
    {
        $loans = Loans::all();

        return response()->json([
            'status' => 200,
            'message' => 'Loans retrieved successfully.',
            'data' => $loans
        ], 200);
    }

    // Menyimpan data pinjaman baru
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'loan_date' => 'required|date',
            'return_date' => 'required|date',
            'status' => 'required|string'
        ]);

        $loan = Loans::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Loan created successfully.',
            'data' => $loan
        ], 201);
    }

    // Menampilkan detail pinjaman berdasarkan ID
    public function show($id)
    {
        $loan = Loans::find($id);

        if (!$loan) {
            return response()->json([
                'status' => 404,
                'message' => 'Loan not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Loan retrieved successfully.',
            'data' => $loan
        ], 200);
    }

    // Memperbarui data pinjaman
    public function update(Request $request, $id)
    {
        $loan = Loans::find($id);

        if (!$loan) {
            return response()->json([
                'status' => 404,
                'message' => 'Loan not found.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'book_id' => 'integer|exists:books,id',
            'user_id' => 'integer|exists:users,id',
            'loan_date' => 'date',
            'return_date' => 'date|after_or_equal:loan_date',
            'status' => 'string|max:255'
        ]);

        $loan->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Loan updated successfully.',
            'data' => $loan
        ], 200);
    }

    // Menghapus data pinjaman
    public function destroy($id)
    {
        $loan = Loans::find($id);

        if (!$loan) {
            return response()->json([
                'status' => 404,
                'message' => 'Loan not found.',
                'data' => null
            ], 404);
        }

        $loan->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Loan deleted successfully.',
            'data' => $loan
        ], 200);
    }
}
