<?php

class MyInputFilters
{
    // 文字エンコーディングの検証フィルタ
    public static function check_encoding($value)
    {
        // 配列の場合は再帰的に処理
        if (is_array($value))
        {
            array_map(['MyInputFilters', 'check_encoding'], $value);
            return $value;
        }

        // 文字エンコーディングを検証
        if (mb_check_encoding($value, Fuel::$encoding))
        {
            return $value;
        }
        else
        {
            // エラーの場合はログに記録
            static::log_error('Invalid character encoding', $value);
            // エラーを表示してシュル用
            throw new HttpInvalidInputException('Invalid input data');
        }
    }

    // エラーをログに記録
    public static function log_error($msg, $value)
    {
        Log::error(
            $msg . ': ' . Input::uri() . ' ' . urlencode($value) . ' ' .
            Input::ip() . ' "' . Input::user_agent() . '"'
        );
    }
}