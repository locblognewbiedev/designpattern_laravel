<?php

/**
 * một ví dụ phức tạp về hệ thống quản lý tài liệu trong một công ty.
 *  Giả sử chúng ta có nhiều loại tài liệu khác nhau như báo cáo (Report),
 *  tài liệu hướng dẫn (Manual), và tài liệu hợp đồng (Contract). 
 * Mỗi loại tài liệu có cách xử lý và định dạng riêng.
 *  Không sử dụng Factory Pattern, việc quản lý và mở rộng các loại tài 
 * liệu này sẽ rất phức tạp.
 */



class Report
{
    public function generate()
    {
        echo "Generating report document\n";
    }
}

class Manual
{
    public function generate()
    {
        echo "Generating manual document\n";
    }
}

class Contract
{
    public function generate()
    {
        echo "Generating contract document\n";
    }
}

// Main
function createDocument($type)
{
    if ($type == 'report') {
        return new Report();
    } else if ($type == 'manual') {
        return new Manual();
    } else if ($type == 'contract') {
        return new Contract();
    }
    return null;
}

$documents = ['report', 'manual', 'contract'];
foreach ($documents as $docType) {
    $document = createDocument($docType);
    if ($document) {
        $document->generate();
    }
}


