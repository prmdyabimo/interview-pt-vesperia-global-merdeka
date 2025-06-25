<?php

namespace App\Presentation\Api;

use App\Domain\Form\Services\FormService;
use App\Domain\Shared\Exceptions\FormNotFoundException;
use App\Domain\Shared\Exceptions\InvalidFormDataException;
use App\Helpers\ResponseFormatter;
use App\Presentation\Api\Requests\SubmitFormRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function __construct(
        private readonly FormService $formService
    ) {
    }

    public function getForms(): JsonResponse
    {
        try {
            $forms = $this->formService->getForms();

            return ResponseFormatter::success(
                $forms,
                'Form types retrieved successfully'
            );
        } catch (Exception $err) {
            Log::error('Failed to get form types', [
                'error' => $err->getMessage(),
                'trace' => $err->getTraceAsString()
            ]);

            return ResponseFormatter::error(
                null,
                $err->getMessage(),
                500
            );
        }

    }

    public function getFormByType(string $formType): JsonResponse
    {
        try {
            $formData = $this->formService->getFormByType($formType);

            return ResponseFormatter::success(
                $formData,
                'Form structure retrieved successfully'
            );
        } catch (FormNotFoundException $err) {
            return ResponseFormatter::error(
                null,
                $err->getMessage(),
                404
            );
        } catch (Exception $err) {
            return ResponseFormatter::error(
                null,
                $err->getMessage(),
                500
            );
        }
    }

    public function submitForm(SubmitFormRequest $request, string $formType): JsonResponse
    {
        try {
            $result = $this->formService->submitForm(
                formType: $formType,
                values: $request->validated()['values']
            );

            return ResponseFormatter::success(
                $result,
                'Form submitted successfully'
            );
        } catch (FormNotFoundException $err) {
            return ResponseFormatter::error(
                null,
                $err->getMessage(),
                404
            );
        } catch (InvalidFormDataException $err) {
            return ResponseFormatter::error(
                null,
                $err->getMessage(),
                422,
            );
        } catch (Exception $err) {
            Log::error('Form submission error', [
                'form_type' => $formType,
                'error' => $err->getMessage(),
                'trace' => $err->getTraceAsString()
            ]);

            return ResponseFormatter::error(
                null,
                $err->getMessage(),
                500
            );
        }
    }

    public function getFormSubmissions(Request $request): JsonResponse
    {
        try {
            $page = (int) $request->get('page', 1);
            $perPage = (int) $request->get('per_page', 10);

            $page = max(1, $page);
            $perPage = min(100, max(1, $perPage));

            $submissions = $this->formService->getFormSubmissions(
                page: $page,
                perPage: $perPage
            );

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Form submissions retrieved successfully'
                ],
                'data' => $submissions['data'],
                'pagination' => [
                    'total' => $submissions['total'],
                    'per_page' => $perPage,
                    'current_page' => $page,
                    'last_page' => ceil($submissions['total'] / $perPage),
                    'has_more' => $submissions['has_more']
                ]
            ]);
        } catch (Exception $err) {
            Log::error('Failed to get form submissions', [
                'error' => $err->getMessage(),
                'trace' => $err->getTraceAsString()
            ]);

            return ResponseFormatter::error(
                null,
                $err->getMessage(),
                500
            );
        }
    }
}

?>