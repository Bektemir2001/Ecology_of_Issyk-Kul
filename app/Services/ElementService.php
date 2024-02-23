<?php

namespace App\Services;

use App\Models\Element;
use Exception;
use Illuminate\Support\Facades\DB;

class ElementService extends Service
{
    public function store(array $data): array
    {
        try {
            if(array_key_exists('image', $data))
            {
                $data['image'] = $this->uploadFileService->upload($data['image'], 'images/elements');
            }
            if($data['TLI_formula'] && $data['TLI_function'] && $data['TLI_argument'])
            {
                $data['TLI_formula'] = $data['TLI_formula'] . "&" . $data['TLI_function'] . "&" . $data['TLI_argument'];
            }
            if($data['TSI_formula'] && $data['TSI_function'] && $data['TSI_argument'])
            {
                $data['TSI_formula'] = $data['TSI_formula'] . "&" . $data['TSI_function'] . "&" . $data['TSI_argument'];
            }
            Element::create($data);
            return ['message' => 'success', 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function update(Element $element, array $data): array
    {

        try {
            if(array_key_exists('image', $data))
            {
                $data['image'] = $this->uploadFileService->upload($data['image'], 'images/elements');
            }
            if($data['TLI_formula'] && $data['TLI_function'] && $data['TLI_argument'])
            {
                $data['TLI_formula'] = $data['TLI_formula'] . "&" . $data['TLI_function'] . "&" . $data['TLI_argument'];
            }
            if($data['TSI_formula'] && $data['TSI_function'] && $data['TSI_argument'])
            {
                $data['TSI_formula'] = $data['TSI_formula'] . "&" . $data['TSI_function'] . "&" . $data['TSI_argument'];
            }
            $element->update($data);
            return ['message' => 'success', 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }

    }
}
