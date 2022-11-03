<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanCollection;
use App\Repositories\PlanRepository;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * @var PlanRepository
     */
    public PlanRepository $plan_repo;

    /**
     * @param PlanRepository $plan_repo
     */
    public function __construct(PlanRepository $plan_repo)
    {
        $this->plan_repo = $plan_repo;
    }

    /**
     * @return PlanCollection
     */
    public function getAllPlans()
    {
        return new PlanCollection($this->plan_repo->getAll());
    }
}
