<?php

namespace App\Http\Controllers;

use App\Events\TransferLogged;
use App\Http\Requests\TransferRequest;
use App\Models\Transfer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransferController extends Controller
{
    public function index(Request $request): View
    {
        $transfers = Transfer::query()->with(['player', 'fromTeam', 'toTeam', 'season'])->latest()->paginate(12);

        return view('transfers.index', compact('transfers'));
    }

    public function store(TransferRequest $request): RedirectResponse
    {
        $transfer = Transfer::query()->create($request->validated());
        $transfer->load(['player', 'fromTeam', 'toTeam']);

        event(new TransferLogged($transfer));

        return back()->with('success', 'Transfer recorded successfully.');
    }

    public function update(TransferRequest $request, Transfer $transfer): RedirectResponse
    {
        $transfer->update($request->validated());
        $transfer->load(['player', 'fromTeam', 'toTeam']);

        event(new TransferLogged($transfer));

        return back()->with('success', 'Transfer updated successfully.');
    }

    public function destroy(Transfer $transfer): RedirectResponse
    {
        $transfer->delete();

        return back()->with('success', 'Transfer removed successfully.');
    }
}