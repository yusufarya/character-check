<?php

namespace App\Http\Controllers;

use App\Models\CharacterCheckModel;
use Illuminate\Http\Request;

class CharacterCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultData = CharacterCheckModel::where('result_percentage', '>', 0)->get();
        return view('character_check.index', compact('resultData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('character_check.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input menggunakan Validator
        $validatedData = $request->validate([
            'input1' => 'required|string',
            'input2' => 'required|string',
        ], [
            'input1' => 'Input 1 harus diisi',
            'input2' => 'Input 2 harus diisi',
        ]);

        $input1 = $validatedData['input1'];
        $input2 = $validatedData['input2'];

        $uniqueCharacters = count(str_split($input1));
        $matchingCharacters = 0;

        foreach (str_split($input1) as $char) {
            if (stripos($input2, $char) !== false) {
                $matchingCharacters++;
            }
        }

        // Hitung persentase
        $percentage = ($uniqueCharacters > 0)
            ? round(($matchingCharacters / $uniqueCharacters) * 100, 2)
            : 0;

        $validatedData['percentage'] = $percentage;

        $result = CharacterCheckModel::storeCharacter($validatedData);

        if($result['status'] = 'success') {
            return redirect('/show-character/'.$result['data']->id);
        } else {
            return redirect()->back()->with('Proses gagal hubungi administrator.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resultData = CharacterCheckModel::find($id);
        return view('character_check.show', compact('resultData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $charCheck = CharacterCheckModel::find($id);
        return view('character_check.edit', compact('charCheck'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CharacterCheckModel $characterCheckModel, $id)
    {
        // Validasi input menggunakan Validator
        $validatedData = $request->validate([
            'input1' => 'required|string',
            'input2' => 'required|string',
        ]);

        $input1 = $validatedData['input1'];
        $input2 = $validatedData['input2'];

        $uniqueCharacters = count(str_split($input1));
        $matchingCharacters = 0;

        foreach (str_split($input1) as $char) {
            if (stripos($input2, $char) !== false) {
                $matchingCharacters++;
            }
        }

        // Hitung persentase
        $percentage = ($uniqueCharacters > 0)
            ? round(($matchingCharacters / $uniqueCharacters) * 100, 2)
            : 0;

        $validatedData['percentage'] = $percentage;

        $result = $characterCheckModel->updateCharacter($validatedData, $id);

        if($result['status'] = 'success') {
            return redirect('/show-character/'.$result['data']->id);
        } else {
            return redirect()->back()->with('Proses gagal hubungi administrator.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CharacterCheckModel $characterCheckModel, Request $request)
    {
        $characterCheck = $characterCheckModel->find($request->id);

        if($characterCheck) {
            $characterCheck->delete();
        }

        return redirect('/character-list');
    }
}
