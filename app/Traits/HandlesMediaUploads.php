<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait HandlesMediaUploads
{

    public function handleMediaUpload(
        Model $model,
        Request $request,
        string $mediaCollection
    ): void {
        if ($request->hasFile('image')) {
            $model->clearMediaCollection($mediaCollection);
            $model->addMediaFromRequest('image')
                ->toMediaCollection($mediaCollection);
        }
    }

}
