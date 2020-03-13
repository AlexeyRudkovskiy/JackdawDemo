<?php


namespace App\DashboardExtensions\FirstExtension;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Jackdaw\Contracts\EntityContract;
use Jackdaw\Contracts\UiComponentContract;

class SecondUiComponent implements UiComponentContract
{

    public function render(?EntityContract $entityContract, ?Model $object): View
    {
        return view('dashboard.firstExtension.second');
    }

    public function handle(Request $request, Model $object)
    {

    }

}
