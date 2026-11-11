<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Database\Eloquent\Model;

class EmployeesImport implements
  ToModel,
  WithHeadingRow,
  WithValidation,
  SkipsOnFailure,
  SkipsEmptyRows
{
  use Importable, SkipsFailures;

  public function model(array $row): ?Model
  {
    $department = Department::where(
      'department',
      $row['departemen']
    )->first();

    $position = Position::where(
      'position',
      $row['jabatan']
    )->first();

    return new Employee([
      'nik' => (string) $row['nik'],
      'name' => $row['nama_karyawan'],
      'department_id' => $department->id_department,
      'position_id' => $position->id_position,
    ]);
  }

  public function rules(): array
  {
    return [
      'nik' => [
        'required',
        'string',
        'unique:employees,nik',
      ],
      'nama_karyawan' => [
        'required',
        'string',
        'max:255',
      ],
      'departemen' => [
        'required',
        Rule::exists('departments', 'department'),
      ],
      'jabatan' => [
        'required',
        Rule::exists('positions', 'position'),
      ],
    ];
  }

  public function customValidationMessages(): array
  {
    return [
      'nik.unique' => 'NIK sudah terdaftar.',
      'nik.required' => 'NIK wajib diisi.',
      'nama_karyawan.required' => 'Nama karyawan wajib diisi.',
      'departemen.exists' => 'Departemen tidak ditemukan.',
      'jabatan.exists' => 'Jabatan tidak ditemukan.',
    ];
  }
}
