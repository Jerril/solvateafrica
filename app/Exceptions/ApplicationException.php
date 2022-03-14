<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApplicationException extends Exception
{
    //
    private $status = 400;

    public function __construct(string $message, ?int $status = null)
    {
    	parent::__construct($message);
    	if(!empty($status)) $this->status = $status;
    }

    public function render(Request $request)
    {
    	return response()->json([
    		"message" => $this->getMessage(),
    	], $this->status);
    }
}
