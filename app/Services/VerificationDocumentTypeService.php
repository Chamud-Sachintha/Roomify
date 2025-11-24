<?php 

namespace App\Services;

use App\Models\VerificationDocument;

class VerificationDocumentTypeService
{

    private $VerificationDocumentModel;

    public function __construct() {
        $this->VerificationDocumentModel = new VerificationDocument();
    }

    public function getAllverificationDocumentTypes() {
        try {
            return $this->VerificationDocumentModel->get_all_documents();
        } catch (\Exception $e) {
            return [];
        }
    }
}

?>