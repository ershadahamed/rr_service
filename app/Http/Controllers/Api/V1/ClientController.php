<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate();
        return ClientResource::collection($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $client = $request->validated();
        $client['created_by'] = $request->user()->id;
        $client['updated_by'] = $request->user()->id;
        $client = Client::create($client);
        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return new ClientResource(
            $client->with('created_by')->with('updated_by'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client)
    {
        abort_if(
            !Auth::user()->is_admin || Auth::id() !== $client->created_by,
            403,
            'You are not authorized to update this client');

        $client->update($request->validated());
        $client['updated_by'] = Auth::id();
        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        abort_if(
            !Auth::user()->is_admin || Auth::id() !== $client->created_by,
            403,
            'You are not authorized to delete this client');

        $client->delete();
        return response()->noContent();
    }
}
