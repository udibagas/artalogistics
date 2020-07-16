<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Portfolio::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfolioRequest $request)
    {
        $portfolio = Portfolio::create(array_merge(
            $request->all(),
            ['user_id' => $request->user()->id]
        ));

        $portfolio->attachment()->create($request->attachment);
        return ['message' => 'Data has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
        $portfolio->update($request->all());

        // jika ada file baru
        if (!isset($request->attachment['id'])) {
            if (Storage::exists($portfolio->attachment->path)) {
                Storage::delete([$portfolio->attachment->path]);
            }

            $portfolio->attachment->delete();
            $portfolio->attachment()->create($request->attachment);
        }

        return ['message' => 'Data has been saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        if ($portfolio->attachment) {
            if (Storage::exists($portfolio->attachment->path)) {
                Storage::delete([$portfolio->attachment->path]);
            }

            $portfolio->attachment->delete();
        }

        return ['message' => 'Data has been deleted'];
    }
}
