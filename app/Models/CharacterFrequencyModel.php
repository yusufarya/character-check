<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterFrequencyModel extends Model
{
    use HasFactory;

    protected $table = 'character_frequency';
    protected $fillable = [
        'character_check_id',
        'notes',
    ];

    static function storeCharacterFrequency($data) {
        // Simpan ke database
        $characterFrequency = self::create([
            'character_check_id' => $data['character_check_id'],
            'notes' => $data['notes'],
        ]);

        if($characterFrequency) {
            return ['status' => 'success', 'data' => $characterFrequency];
        } else {
            return ['status' => 'failed', 'data' => null];
        }
    }

    static function updateCharacterFrequency($data, $id) {
        // Simpan ke database
        $characterFrequency = self::find($id);
        if($characterFrequency) {
            $characterFrequency->update([
                'character_check_id' => $data['character_check_id'],
                'notes' => $data['notes'],
            ]);
        }

        if($characterFrequency) {
            return ['status' => 'success', 'data' => $characterFrequency];
        } else {
            return ['status' => 'failed', 'data' => null];
        }
    }

    static function calculateCharacterFrequency($input1, $input2) {
        // Konversi kedua input ke array karakter
        $characters1 = str_split($input1);
        $characters2 = str_split($input2);
        // dd($characters2);
        // Array untuk menyimpan hasil
        $frequency = [];

        // Nested loop untuk menghitung kemunculan karakter
        foreach ($characters1 as $char1) {
            $count = 0;

            foreach ($characters2 as $char2) {
                // Jika karakter cocok, tambahkan hitungan
                    if (strtoupper($char1) === strtoupper($char2)) {
                    $count++;
                }
            }

            // Simpan hasil ke dalam array
            $frequency[$char1] = $count;
        }

        // Kembalikan hasil
        return $frequency;
    }
}
