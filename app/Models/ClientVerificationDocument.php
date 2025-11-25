<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientVerificationDocument extends Model
{
    protected $fillable = [
        'client_id',
        'full_name',
        'document_type_id',
        'document_path',
        'status',
        'verified_at',
    ];

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function uplaodVerificationDocument($client_id,$full_name,$file, $documentTypeId)
    {
        $filePath = $file->store('verification_documents', 'public');

        return self::create([
            'client_id' => $client_id,
            'full_name' => $full_name,
            'document_type_id' => $documentTypeId,
            'document_path' => $filePath,
            'status' => 'pending',
        ]);
    }
}
