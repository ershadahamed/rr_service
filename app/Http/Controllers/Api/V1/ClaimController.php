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
        $user = request()->user();
        $claims = $user->claims()->paginate();
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
        abort_if($user->id !== $claim->pic_id,403, 'You are not authorized to view this claim');
        return new ClaimResource($claim);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClaimRequest $request, Claim $claim)
    {
        $claim->update($request->validated());
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
