<?php
namespace App\View\Helper;

use Cake\View\Helper;

class ErrorHelper extends Helper
{
    /**
     * Display Error
     */
    public function first($errors)
    {
        $error = '';
        if (!empty($errors)) {
            foreach ($errors as $value) {
                $error = $value;
                break;
            }
        }

        return $error;
    }
}