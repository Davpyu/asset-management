<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetRequest;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function index()
    {
        $data = Asset::all()->map->output();
        return $this->responseWithData($data);
    }

    public function show(Asset $asset)
    {
        return $this->responseWithData($asset->output());
    }

    public function store(AssetRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $create = $this->format($request);
        $user->assets()->create($create);
        return $this->responseSuccess('Asset Created');
    }

    public function update(AssetRequest $request, Asset $asset)
    {
        $update = $this->format($request);
        $asset->update($update);
        return $this->responseSuccess('Asset Updated');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return $this->responseSuccess('Asset Deleted');
    }

    private function format($request)
    {
        $array = $request->except('_method');
        $search = ['kode_aset', 'nama_aset', 'jumlah', 'merk'];
        $replace = ['code', 'name', 'qty', 'brand'];
        $keys = str_replace($search, $replace, array_keys($array));
        $values = array_values($array);
        $new_array = array_combine($keys, $values);
        return $new_array;
    }
}
