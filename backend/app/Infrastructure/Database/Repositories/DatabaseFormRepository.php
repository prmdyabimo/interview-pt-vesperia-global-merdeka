<?php

namespace App\Infrastructure\Database\Repositories;

use App\Domain\Form\Entities\FormData;
use App\Domain\Form\Repositories\FormRepositoryInterface;
use App\Infrastructure\External\JsonFeedService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class DatabaseFormRepository implements FormRepositoryInterface
{
    public function getAllForms(): array
    {
        try {
            $forms = DB::table('forms')->get();

            return $forms->map(function ($form) {
                return FormData::fromArray([
                    'id' => $form->id,
                    'name' => $form->name,
                    'payloads' => json_decode($form->payloads, true),
                ]);
            })->toArray();
        } catch (Exception $err) {
            Log::error('Failed to get all forms', [
                'error' => $err->getMessage(),
            ]);

            return [];
        }
    }

    public function getFormDataByType(string $formType): ?FormData
    {
        try {
            $form = DB::table('forms')
                ->where('type', $formType)
                ->first();

            if (!$form) {
                return null;
            }

            return FormData::fromArray([
                'id' => $form->id,
                'name' => $form->name,
                'payloads' => json_decode($form->payloads, true),
            ]);
        } catch (Exception $err) {
            Log::error('Failed to get form data by type', [
                'form_type' => $formType,
                'error' => $err->getMessage(),
            ]);

            return null;
        }
    }
    
    public function saveFormSubmission(string $formId, string $formType, array $values): bool
    {
        try {
            DB::beginTransaction();

            $submissionId = Str::uuid()->toString();

            DB::table('form_submissions')->insert([
                'id' => $submissionId,
                'form_id' => $formId,
                'form_type' => $formType,
                'values' => json_encode($values),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return true;
        } catch (Exception $err) {
            DB::rollBack();

            Log::error('Failed to save form submission', [
                'form_id' => $formId,
                'form_type' => $formType,
                'values' => $values,
                'error' => $err->getMessage(),
            ]);

            return false;
        }
    }

    public function getFormSubmissions(int $limit = 10, int $offset = 0): array
    {
        try {
            $query = DB::table('form_submissions')
                ->orderBy('created_at', 'desc');

            $total = $query->count();

            $submissions = $query
                ->limit($limit)
                ->offset($offset)
                ->get()
                ->map(function ($submission) {
                    return [
                        'id' => $submission->id,
                        'form_id' => $submission->form_id,
                        'form_type' => $submission->form_type,
                        'values' => json_decode($submission->values, true),
                        'created_at' => $submission->created_at,
                        'updated_at' => $submission->updated_at,
                    ];
                })
                ->toArray();

            return [
                'data' => $submissions,
                'total' => $total,
                'limit' => $limit,
                'offset' => $offset,
                'has_more' => ($offset + $limit) < $total,
            ];
        } catch (Exception $err) {
            Log::error('Failed to get form submissions by type', [
                'error' => $err->getMessage(),
            ]);

            return [];
        }
    }
}

?>