<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::orderBy('name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->all());
        $client->attachment()->create($request->attachment);
        return ['message' => 'Data has been saved'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->all());

        // jika ada file baru
        if (!isset($request->attachment['id'])) {
            if (Storage::exists($client->attachment->path)) {
                Storage::delete([$client->attachment->path]);
            }

            $client->attachment->delete();
            $client->attachment()->create($request->attachment);
        }

        return ['message' => 'Data has been saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        if ($client->attachment) {
            if (Storage::exists($client->attachment->path)) {
                Storage::delete([$client->attachment->path]);
            }

            $client->attachment->delete();
        }

        return ['message' => 'Data has been deleted'];
    }
}
