<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ClientVerificationDocument extends Model
{
    protected $fillable = [
        'client_id',
        'full_name',
        'document_type_id',
        'document_path',
        'status',
        'remark',
        'verified_at',
    ];

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function documentType()
    {
        return $this->belongsTo(VerificationDocument::class);
    }

    public function uplaodVerificationDocument($client_id,$full_name,$file, $documentTypeId)
    {
        $filePath = $file->store('verification_documents', 'public');

        return self::create([
            'client_id' => $client_id,
            'full_name' => $full_name,
            'document_type_id' => $documentTypeId,
            'document_path' => $filePath,
            'status' => 0,
            'remark' => "N/A",
        ]);
    }

    public function getClientVerificationDocuments($clientId)
    {
        return self::with('documentType')->where('client_id', $clientId)->get();
    }

    public function deleteVerificationDocument($documentId, $clientId)
    {
        $document = self::where('id', $documentId)->where('client_id', $clientId)->firstOrFail();

        Storage::disk('public')->delete($document->document_path);

        return $document->delete();
    }
}
