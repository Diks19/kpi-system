<?php

namespace App\Support;

use App\Models\PerformanceCategory;
use Illuminate\Validation\ValidationException;

class PerformanceCategoryValidator
{
  public static function validate(
    array $data,
    ?PerformanceCategory $record = null
  ): void {
    $min = $data['minimum_score'] ?? null;
    $max = $data['maximum_score'] ?? null;

    if ($min === null || $max === null) {
      return;
    }

    if ((float) $min > (float) $max) {
      throw ValidationException::withMessages([
        'data.minimum_score' =>
        'Nilai minimum tidak boleh lebih besar dari nilai maksimum.',
      ]);
    }

    $minimumOverlap = PerformanceCategory::query()
      ->when(
        $record,
        fn($query) => $query->where(
          'id_category',
          '!=',
          $record->id_category
        )
      )
      ->where('minimum_score', '<=', $min)
      ->where('maximum_score', '>=', $min)
      ->exists();

    $maximumOverlap = PerformanceCategory::query()
      ->when(
        $record,
        fn($query) => $query->where(
          'id_category',
          '!=',
          $record->id_category
        )
      )
      ->where('minimum_score', '<=', $max)
      ->where('maximum_score', '>=', $max)
      ->exists();

    $errors = [];

    if ($minimumOverlap) {
      $errors['data.minimum_score'] =
        'Nilai minimum bertabrakan dengan rentang kategori lain.';
    }

    if ($maximumOverlap) {
      $errors['data.maximum_score'] =
        'Nilai maksimum bertabrakan dengan rentang kategori lain.';
    }

    if ($errors) {
      throw ValidationException::withMessages($errors);
    }
  }
}
