<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransportModeRequest;
use App\Http\Resources\TransportModeResource;
use App\Models\TransportMode;

class TransportModeController extends Controller
{
    public function index()
    {
        $modes = TransportMode::all();
        return successResponseJson(TransportModeResource::collection($modes));
    }

    public function show($id)
    {
        $mode = TransportMode::findOrFail($id);
        return successResponseJson(new TransportModeResource($mode));
    }

    public function store(TransportModeRequest $request)
    {
        $mode = TransportMode::create($request->validated());

        return successResponseJson(new TransportModeResource($mode), 'New transportation mode added.');
    }

    public function update(TransportModeRequest $request, $id)
    {
        $mode = TransportMode::findOrFail($id);
        $mode->update($request->validated());

        return successResponseJson(new TransportModeResource($mode), 'Transportation mode updated successfully');
    }

    public function destroy($id)
    {
        TransportMode::findOrFail($id)->delete();

        return successResponseJson('Transportation mode  information deleted');
    }
}
