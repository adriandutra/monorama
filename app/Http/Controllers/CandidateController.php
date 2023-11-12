<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateRequest;
use App\Repositories\CandidateRepository;
use App\Repositories\UserRepository;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class CandidateController extends Controller
{
    protected $candidateRepository;
    protected $userRepository;

    public function __construct(CandidateRepository $candidateRepository, UserRepository $userRepository)
    {
        $this->candidateRepository = $candidateRepository;
        $this->userRepository = $userRepository;
    }

    public function create(CandidateRequest $request)
    {

       try { 
       
        $manager =  $this->userRepository->is_Manager(JWTAuth::user()->id);
        if ($manager)
        {
                $candidate = $this->candidateRepository->create([
                    'name' => $request->name,
                    'source' => $request->source,
                    'owner' => $request->owner,
                    'created_by' => JWTAuth::user()->id
                ]);

                $result = [
                    "meta" => array("success" => true, "errors" => []),
                    "data" => $candidate
                ];
                
                return response()->json($result, 201);
        }
        else {

                $result = [
                    "meta" => array("success" => false, 
                                    "errors" => [ "No autorizado" ])
                ];

                return response()->json($result, 401); 
            }
    
        } catch(Exception $e) {

            $result = [
                "meta" => array("success" => false, 
                                "errors" => $e->getMessage())
            ];

            return response()->json($result, 500); 

        }
    }

    public function getCandidate($id)
    {
        try {

            $candidate = $this->candidateRepository->getById($id);
            $manager =  $this->userRepository->is_Manager(JWTAuth::user()->id);
        
            if ($manager) {
                if ($candidate)
                {
                    $result = [
                        "meta" => array("success" => true, "errors" => []),
                        "data" => $candidate
                    ];
            
                    return response()->json($result, 200); 
                } else {

                    $result = [
                        "meta" => array("success" => false, 
                                        "errors" => [ "No lead found" ])
                    ];

                    return response()->json($result, 404); 
                }
            }
            else {

                $candidate = $this->candidateRepository->getMine($id, JWTAuth::user()->id);
                if ($candidate)
                    {
                        $result = [
                            "meta" => array("success" => true, "errors" => []),
                            "data" => $candidate
                        ];
                
                        return response()->json($result, 200); 
                    } else {

                        $result = [
                            "meta" => array("success" => false, 
                                            "errors" => [ "No lead found" ])
                        ];

                        return response()->json($result, 404); 
                    }
            }
        
        } catch(Exception $e) {

            $result = [
                "meta" => array("success" => false, 
                                "errors" => $e->getMessage())
            ];

            return response()->json($result, 500); 

        }
        
    }

    public function getList()
    {
        try {

            $manager =  $this->userRepository->is_Manager(JWTAuth::user()->id);
        
            if ($manager) {

                $candidates = $this->candidateRepository->getAll();

                if (!empty($candidates))
                {
                    $result = [
                        "meta" => array("success" => true, "errors" => []),
                        "data" => $candidates
                    ];
        
                    return response()->json($result, 200); 
                } else {

                    $result = [
                        "meta" => array("success" => false, 
                                        "errors" => [ "No lead found" ])
                    ];

                    return response()->json($result, 404); 
                }
            } else {

                $candidates = $this->candidateRepository->getAllMine(JWTAuth::user()->id);

                if (!empty($candidates))
                {
                    $result = [
                        "meta" => array("success" => true, "errors" => []),
                        "data" => $candidates
                    ];
        
                    return response()->json($result, 200); 
                } else {

                    $result = [
                        "meta" => array("success" => false, 
                                        "errors" => [ "No lead found" ])
                    ];

                    return response()->json($result, 404); 
                }
            }
        } catch(Exception $e) {

            $result = [
                "meta" => array("success" => false, 
                                "errors" => $e->getMessage())
            ];

            return response()->json($result, 500); 

        }

    }
}
