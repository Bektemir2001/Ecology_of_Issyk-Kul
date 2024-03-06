<?php

namespace App\Services;

use App\Http\Resources\ElementResource;
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
            $element->update($data);
            return ['message' => 'success', 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }

    }

    public function getAll($data)
    {
        if(isset($data['tli_index_id']))
        {
            $elements = Element::whereDoesntHave('trophicLevelIndex', function ($query) use ($data) {
                $query->where('t_index_id', $data['tli_index_id']);
            })
                ->where('parent', '=', null)
                ->get();
            return ElementResource::collection($elements);
        }
        if(isset($data['tsi_index_id']))
        {
            $elements = Element::whereDoesntHave('trophicStateIndex', function ($query) use ($data) {
                $query->where('t_index_id', $data['tsi_index_id']);
            })
                ->where('parent', '=', null)
                ->get();
            return ElementResource::collection($elements);
        }
        return ElementResource::collection(Element::where('parent', '=', null)->get());
    }
}
