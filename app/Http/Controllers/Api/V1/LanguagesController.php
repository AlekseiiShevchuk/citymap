<?php

namespace App\Http\Controllers\Api\V1;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguagesRequest;
use App\Http\Requests\UpdateLanguagesRequest;

class LanguagesController extends Controller
{
    public function index()
    {
        return Language::all();
    }

    public function show($id)
    {
        return Language::findOrFail($id);
    }

    public function update(UpdateLanguagesRequest $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->update($request->all());

        return $language;
    }

    public function store(StoreLanguagesRequest $request)
    {
        $language = Language::create($request->all());

        return $language;
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();
        return '';
    }
}
