<?php
namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ResponseTrait
{
    static $VALIDATOR_ERROR = 'validator_error';

    static $RESPONSE_VALIDATOR_FAIL = 422;
    static $RESPONSE_AUTHORIZE = 401;
    static $RESPONSE_CREATED = 201;
    static $RESPONSE_SUCCESS = 200;

    static $CREATE_SUCCESS = 'create data success';
    static $UPDATE_SUCCESS = 'update data success';
    static $RESOURCE_NOT_FOUND = 'resource not found';
    static $REQUEST_SUCCESS = 'request success';

    public function sendResponse(int $statusCode,string $mgs, $data) {
        return response($this->toResponse($statusCode, $mgs, $data), $statusCode);
    }

    public function toResponse(int $statusCode,string $mgs, $data){
        return [
            'data' => $data,
            'mgs' => $mgs,
            'status' => $statusCode
        ];
    }

    public function parseValidatorToResponse(Validator $validator)
    {
        $changeValidator = [];

        foreach ($validator->errors()->toArray() as $attribute => $errorMgs)
        {
            $changeValidator[][$attribute] = $errorMgs[0];
        }
        throw new HttpResponseException($this->sendResponse(
            self::$RESPONSE_VALIDATOR_FAIL,
            self::$VALIDATOR_ERROR,
            $changeValidator
        ));
    }
}
