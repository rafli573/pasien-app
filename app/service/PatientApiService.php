<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PatientApiService
{
    private string $baseUrl;
    private array $headers;

    public function __construct()
    {
        $this->baseUrl = 'https://mockapi.pkuwsb.id/api';
        $this->headers = [
            'X-username' => 'admin',
            'X-password' => 'secret',
            'Accept'     => 'application/json',
        ];
    }

    public function list(array $query = [])
    {
        return Http::withHeaders($this->headers)
                   ->get("{$this->baseUrl}/patient", $query);
    }

    public function find($id)
    {
        return Http::withHeaders($this->headers)
                   ->get("{$this->baseUrl}/patient/{$id}");
    }

    public function create(array $data)
    {
        return Http::withHeaders($this->headers)
                   ->post("{$this->baseUrl}/patient", $data);
    }

    public function update($id, array $data)
    {
        return Http::withHeaders($this->headers)
                   ->put("{$this->baseUrl}/patient/{$id}", $data);
    }

    public function delete($id)
    {
        return Http::withHeaders($this->headers)
                   ->delete("{$this->baseUrl}/patient/{$id}");
    }
}
