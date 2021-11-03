<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'nama'     => $row['nama'],
            'nip'    => $row['nip'],
            'username' => $row['username'],
            'password' => Hash::make($row['password']),
            'role' => $row['role']
        ]);
    }
    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
