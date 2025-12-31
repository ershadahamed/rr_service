<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClaimRequest;
use App\Http\Resources\ClaimResource;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ClaimResource::collection(Claim::with('pic')->get());
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
        return new ClaimResource($claim);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClaimRequest $request, Claim $claim)
    {
        return new ClaimResource($claim);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Claim $claim)
    {
        $claim->delete();
        return response()->noContent();
    }
}
