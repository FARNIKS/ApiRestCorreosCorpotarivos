<?php

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Http\Resources\Location\BranchResource;


class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::with(['country'])
            ->where('estado', true)
            ->orderBy('code', 'asc')
            ->get();

        return BranchResource::collection($branches);
    }

    public function show(Branch $branch)
    {
        return new BranchResource($branch->load(['country']));
    }
}
