<?php


if (!function_exists('json_success')) {
    /**
     * 成功响应json
     * @param mixed $data
     * @param string $message
     * @return array
     */
    function json_success(mixed $data = [], string $message = 'success'): array
    {
        return [
            'code' => 200,
            'msg'  => is_string($data) ? $data : $message,
            'data' => is_string($data) ? [] : $data
        ];
    }
}

if (!function_exists('json_error')) {
    /**
     * 失败响应json
     * @param mixed $data
     * @param string $message
     * @return array
     */
    function json_error(mixed $data = [], string $message = 'error', int $code = 400): array
    {
        return [
            'code' => $code,
            'msg'  => is_string($data) ? $data : $message,
            'data' => is_string($data) ? [] : $data
        ];
    }
}

if (!function_exists('pageSize')) {

    /**
     * 获取分页大小
     * @return int
     */
    function pageSize(): int
    {
        $pageSize = request(config('admin.pagination.page_size_field')) ?? config('admin.pagination.page_size');
        if ($pageSize > config('admin.pagination.max_page_size')) {
            $pageSize = config('admin.pagination.page_size');
        } else if ($pageSize < 1) {
            $pageSize = config('admin.pagination.page_size');
        }
        return $pageSize;
    }
}

if (!function_exists('getTree')) {
    /**
     * 獲取樹形結構數據
     * @param array $data
     * @param int $pid
     * @param string $childrenKey
     * @param string $primaryKey
     * @return array
     */
    function getTree(array $data, int $pid = 0, string $childrenKey = 'children', string $primaryKey = 'id'): array
    {
        $treeData = [];
        if (empty($data[$pid]) || !is_array($data[$pid])) {
            return $treeData;
        }

        foreach ($data[$pid] as $item) {
            if (!empty($data[$item[$primaryKey]])) {
                $item[$childrenKey] = getTree($data, $item[$primaryKey], $childrenKey, $primaryKey);
            }
            $treeData[] = $item;
        }
        return $treeData;
    }
}
