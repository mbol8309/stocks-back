<?php
namespace App\GraphQL\Exceptions;

use GraphQL\Error\Error;

class StocksErrorFormatter {
    /**
     * @see \GraphQL\Executor\ExecutionResult::setErrorFormatter
     */
    public static function formatError(Error $e): array
    {
        

        $previous = $e->getPrevious();

        if (!$previous instanceof StocksExceptions){
            return \Rebing\GraphQL\GraphQL::formatError($e);
        }

        return [
            'message' => $previous->getMessage()
        ];
    }
}