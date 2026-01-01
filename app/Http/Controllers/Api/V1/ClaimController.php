<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClaimRequest;
use App\Http\Resources\ClaimResource;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $claims = $user->claims()->paginate();
        abort_if(
            !$user->is_admin || $user->id !== $claims->created_by,
            403,
            'You are not authorized to view this claims');
        return ClaimResource::collection($claims);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClaimRequest $request)
    {
        $claim = $request->validated();
        $claim['pic_id'] = $request->user()->id;
        $claim = Claim::create($claim);
        return new ClaimResource($claim);
    }

    /**
     * Display the specified resource.
     */
    public function show(Claim $claim)
    {
        $user = request()->user();
        abort_if(
            !$user->is_admin || $user->id !== $claim->created_by,
            403,
            'You are not authorized to view this claim');
        return new ClaimResource($claim);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClaimRequest $request, Claim $claim)
    {
        abort_if(
            !Auth::user()->is_admin || Auth::id() !== $claim->created_by,
            403,
            'You are not authorized to update this claim');

        $claim->update($request->validated());
        $claim['updated_by'] = Auth::id();
        return new ClaimResource($claim);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Claim $claim)
    {
        abort_if(
            !Auth::user()->is_admin || Auth::id() !== $claim->created_by,
            403,
            'You are not authorized to delete this client');

        $claim->delete();
        return response()->noContent();
    }
}
