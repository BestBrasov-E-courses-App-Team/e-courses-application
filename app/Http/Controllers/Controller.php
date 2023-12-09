<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Flash success message in session
     *
     * @param string|null $message
     * @return void
     */
    protected function flashSuccess(string|null $message = null)
    {
        return request()->session()->flash('success', $message);
    }

    /**
     * Flash error message in session
     *
     * @param string|null $message
     * @return void
     */
    protected function flashError(string|null $message = null)
    {
        return request()->session()->flash('error', $message);
    }

    /**
     * Flash warning in session
     *
     * @param string|null $message
     * @return void
     */
    protected function flashWarning(string|null $message = null)
    {
        return request()->session()->flash('warning', $message);
    }

    /**
     * Flash info in session
     *
     * @param string|null $message
     * @return void
     */
    protected function flashInfo(string|null $message = null)
    {
        return request()->session()->flash('info', $message);
    }
}
