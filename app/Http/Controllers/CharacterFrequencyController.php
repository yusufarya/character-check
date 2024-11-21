<?php

namespace App\Http\Controllers;

use App\Models\CharacterCheckModel;
use App\Models\CharacterFrequencyModel;
use Illuminate\Http\Request;

class CharacterFrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultData = CharacterCheckModel::whereHas('frequency')->with('frequency')->get();
        return view('character_frequency.index', compact('resultData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $charCheck = CharacterCheckModel::get();
        return view('character_frequency.create', compact('charCheck'));
    }

    /**
     * check a newly created resource in storage.
     */
    public function check(Request $request)
    {
        // Validasi input menggunakan Validator
        $request->validate([
            'input1' => 'required|string',
            'input2' => 'required|string',
        ], [
            'input1' => 'Input 1 harus diisi',
            'input2' => 'Input 2 harus diisi',
        ]);

        $input1 = $request->input('input1');
        $input2 = $request->input('input2');

        $input['char_id'] = $request->input('char_id');
        $input['one'] = $request->input('input1');
        $input['two'] = $request->input('input2');

        $result = CharacterFrequencyModel::calculateCharacterFrequency($input1, $input2);

        if($result) {
            return $this->result($input, $result);
        }
    }

    public function generate(int $id) {
        $resultData = CharacterCheckModel::with('frequency')->where('id', $id)->first();
        $frequency = CharacterFrequencyModel::calculateCharacterFrequency($resultData['input_one'], $resultData['input_two']);
        if($frequency) {
            $paramsData['one'] = $resultData['input_one'];
            $paramsData['two'] = $resultData['input_two'];
            return $this->result($paramsData, $frequency);
        }
    }

    /**
     * Display the specified resource.
     */
    public function result($inputParams, $resultData)
    {
        return view('character_frequency.result', compact('inputParams', 'resultData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input1 = $request->input('input1');
        $input2 = $request->input('input2');

        $char_id = $request->input('char_id');
        $dataParams['input1'] = $request->input('input1');
        $dataParams['input2'] = $request->input('input2');
        $dataParams['percentage'] = 0;

        if($char_id) {
            $resultChar = CharacterCheckModel::find($char_id);
        } else {
            $resultChar = CharacterCheckModel::storeCharacter($dataParams);
            $char_id = $resultChar['data']->id;
        }

        if($resultChar) {
            $result = CharacterFrequencyModel::calculateCharacterFrequency($input1, $input2);
            foreach ($result as $char => $count) {
                $paramsFrequency['character_check_id'] = $char_id;
                $paramsFrequency['notes'] = "Karakter ".$char." muncul ".$count." kali di input kedua";
                CharacterFrequencyModel::storeCharacterFrequency($paramsFrequency);
            }
        }
        return redirect('/character-frequency-show/'.$char_id);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $resultData = CharacterCheckModel::with('frequency')->where('id', $id)->first();

        $frequency = CharacterFrequencyModel::calculateCharacterFrequency($resultData['input_one'], $resultData['input_two']);

        return view('character_frequency.show', compact('resultData', 'frequency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $charCheck = CharacterCheckModel::find($id);
        return view('character_frequency.edit', compact('charCheck'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input1 = $request->input('input1');
        $input2 = $request->input('input2');

        $char_id = $id;
        $dataParams['input1'] = $request->input('input1');
        $dataParams['input2'] = $request->input('input2');
        $dataParams['percentage'] = 0;

        $resultChar = CharacterCheckModel::updateCharacter($dataParams, $char_id);

        // if($char_id) {
        //     $resultChar = CharacterCheckModel::find($char_id);
        // } else {
        //     $resultChar = CharacterCheckModel::storeCharacter($dataParams);
        //     $char_id = $resultChar['data']->id;
        // }

        if($resultChar) {
            $result = CharacterFrequencyModel::calculateCharacterFrequency($input1, $input2);
            foreach ($result as $char => $count) {
                $paramsFrequency['character_check_id'] = $char_id;
                $paramsFrequency['notes'] = "Karakter ".$char." muncul ".$count." kali di input kedua";
                CharacterFrequencyModel::updateCharacterFrequency($paramsFrequency, $id);
            }
        }
        return redirect('/character-frequency-show/'.$char_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CharacterFrequencyModel $characterFrequency, Request $request)
    {
        $characterFrequency = $characterFrequency->where('character_check_id', $request->id)->get();
        // dd($characterFrequency);
        foreach ($characterFrequency as $item) {
            $characterFrequency->find($item->id)->delete();
        }

        return redirect('/character-frequency-list');
    }
}
