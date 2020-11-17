<?php

if (!function_exists('responseError')) {
    function responseError(Exception $error) {
        return [
            'status' => 'error',
            'message' => $error->getMessage()
        ];
    }
}

if (!function_exists('responseSuccess')) {
    function responseSuccess($item) {
        return [
            'status' => 'success',
            'item' => $item
        ];
    }
}

if (!function_exists('responseNotFound')) {
    function responseNotFound() {
        return [
            'status' => 'not_found',
            'message' => 'Item is not found.'
        ];
    }
}

if (!function_exists('responseDelete')) {
    function responseDelete() {
        return [
            'status' => 'success',
            'message' => 'Delete success.'
        ];
    }
}

if (!function_exists('responseList')) {
    function responseList($items) {
        return [
            'status' => 'success',
            'items' => $items
        ];
    }
}
