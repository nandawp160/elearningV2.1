<?php

namespace App\Http\Requests;

use App\Models\Pengaturan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherSslThresholdRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && ($user->isTeacher() || $user->isSuperAdmin());
    }

    protected function prepareForValidation(): void
    {
        if ($this->input('mode') === 'default') {
            $this->merge(['ssl_threshold' => null]);
        }
    }

    public function rules(): array
    {
        $min = (int) config('ssl.teacher_min', 1);
        $max = (int) (Pengaturan::getValue('ssl_teacher_threshold_max') ?? config('ssl.teacher_max', 10));
        if ($max < $min) {
            $max = (int) config('ssl.teacher_max', 10);
        }

        return [
            'mode' => ['required', Rule::in(['default', 'custom'])],
            'ssl_threshold' => [
                Rule::requiredIf($this->input('mode') === 'custom'),
                'nullable',
                'integer',
                "min:{$min}",
                "max:{$max}",
            ],
            'apply_all_classes' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        $min = (int) config('ssl.teacher_min', 1);
        $max = (int) (Pengaturan::getValue('ssl_teacher_threshold_max') ?? config('ssl.teacher_max', 10));
        if ($max < $min) {
            $max = (int) config('ssl.teacher_max', 10);
        }

        return [
            'mode.required' => 'Pilihan mode wajib diisi.',
            'mode.in' => 'Mode harus bernilai default atau custom.',
            'ssl_threshold.required' => 'Batas ambang wajib diisi jika memilih mode custom.',
            'ssl_threshold.integer' => 'Batas ambang harus berupa angka bulat.',
            'ssl_threshold.min' => "Batas ambang minimal adalah {$min} tunggakan.",
            'ssl_threshold.max' => "Batas ambang maksimal adalah {$max} tunggakan.",
        ];
    }
}
