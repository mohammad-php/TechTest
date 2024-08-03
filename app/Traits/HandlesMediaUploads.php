<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait HandlesMediaUploads
{

    /**
     * @param Model $model
     * @param Request $request
     * @param string $mediaCollection
     *
     * @return void
     * @throws Exception
     */
    public function handleMediaUpload(
        Model $model,
        Request $request,
        string $mediaCollection
    ): void {
        try {
            if ($request->hasFile('image')) {
                $model->clearMediaCollection($mediaCollection);

                $model->addMediaFromRequest('image')
                    ->toMediaCollection($mediaCollection);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
