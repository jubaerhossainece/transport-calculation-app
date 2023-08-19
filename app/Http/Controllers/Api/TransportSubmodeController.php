<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransportSubmodeRequest;
use App\Http\Resources\TransportSubmodeResource;
use App\Models\TransportMode;
use App\Models\TransportSubmode;
use Illuminate\Http\Request;

class TransportSubmodeController extends Controller
{
    public function index($id)
    {
        $submodes = TransportMode::findOrFail($id)->submodes;
        return successResponseJson(TransportSubmodeResource::collection($submodes));
    }

    public function show($id, $submode_id)
    {
        $mode = TransportMode::findOrFail($id);
        $submode = $mode->submodes()->findOrFail($submode_id);
        return successResponseJson(new TransportSubmodeResource($submode));
    }

    public function store(TransportSubmodeRequest $request, $id)
    {

        $mode = TransportMode::findOrFail($id);
        $submode = $mode->submodes()->create($request->validated());

        return successResponseJson(new TransportSubmodeResource($submode), 'New transportation submode has been added.');
    }

    public function update(TransportSubmodeRequest $request, $id, $submode_id)
    {
        $mode = TransportMode::findOrFail($id);
        $submode = $mode->submodes()->findOrFail($submode_id);
        $submode->update($request->validated());

        return successResponseJson(new TransportSubmodeResource($submode), 'Transportation submode updated successfully');
    }

    public function destroy($id, $submode_id)
    {
        $mode = TransportMode::findOrFail($id);
        $mode->submodes()->findOrFail($submode_id)->delete();

        return successResponseJson('Transportation submode information deleted');
    }
}
