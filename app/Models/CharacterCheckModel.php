<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacterCheckModel extends Model
{
    use HasFactory;

    protected $table = 'character_check';
    protected $fillable = [
        'input_one',
        'input_two',
        'result_percentage',
    ];

    public function frequency(): BelongsTo
    {
        return $this->belongsTo(CharacterFrequencyModel::class, 'id', 'character_check_id');
    }

    static function storeCharacter($data) {
        // Simpan ke database
        $characterCheck = self::create([
            'input_one' => $data['input1'],
            'input_two' => $data['input2'],
            'result_percentage' => $data['percentage'],
        ]);

        if($characterCheck) {
            return ['status' => 'success', 'data' => $characterCheck];
        } else {
            return ['status' => 'failed', 'data' => null];
        }
    }

    static function updateCharacter($data, $id) {
        // Simpan ke database
        $characterCheck = self::find($id);
        if($characterCheck) {
            $characterCheck->update([
                'input_one' => $data['input1'],
                'input_two' => $data['input2'],
                'result_percentage' => $data['percentage'],
            ]);
        }

        if($characterCheck) {
            return ['status' => 'success', 'data' => $characterCheck];
        } else {
            return ['status' => 'failed', 'data' => null];
        }
    }

}
