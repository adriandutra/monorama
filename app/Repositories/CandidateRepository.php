<?php

namespace App\Repositories;

use App\Models\Candidate;

class CandidateRepository
{

    protected $model;

    public function __construct(Candidate $model)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        return Candidate::findOrFail($id);
    }

    public function getMine($id, $userId)
    {
        return Candidate::where('id', $id)
                ->where('owner', $userId)->first();
        
    }

    public function getAll()
    {
        return Candidate::all();
    }

    public function getAllMine($userId)
    {
        return Candidate::where('owner', $userId)->get();
        
    }

    public function create($data)
    {
        return Candidate::create($data);
    }

    public function update($id, $data)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->update($data);
        return $candidate;
    }

    public function delete($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();
    }
}