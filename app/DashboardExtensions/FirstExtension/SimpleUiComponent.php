<?php


namespace App\DashboardExtensions\FirstExtension;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Jackdaw\Contracts\EntityContract;
use Jackdaw\Contracts\UiComponentContract;

class SimpleUiComponent implements UiComponentContract
{

    public function render(?EntityContract $entityContract, ?Model $object): View
    {
        return view('dashboard.firstExtension.component')
            ->with('counter', $object->meta('counter'))
            ->with('updateDatetime', $object->meta('updateDatetime'));
    }

    public function handle(Request $request, Model $object)
    {
        $counter = $object->meta('counter') ?? 0;
        $counter++;

        $object->updateMeta('counter', $counter);
        $object->updateMeta('updateDatetime', now());
    }

}
