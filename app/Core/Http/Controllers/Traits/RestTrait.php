<?php

namespace App\Core\Http\Controllers\Traits;

trait RestTrait
{
    use RestApiTrait {
        RestApiTrait::index as indexApi;
    }

    use RestHtmlTrait {
        RestHtmlTrait::index as indexHtml;
    }

    public function index()
    {
        return $this->request->wantsJson() ? $this->indexApi() : $this->indexHtml();
    }
}