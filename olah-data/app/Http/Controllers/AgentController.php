<?php

namespace App\Http\Controllers;

use App\Agent;

class AgentController extends Controller
{
    public function index()
    {
        $data['item'] = Agent::with(['orders' => function ($query) {
            return $query->select('id', 'customer_id', 'agent_id')->distinct()->count('id');
        }])->withCount('orders')->orderBy('orders_count','desc')->get();

        return view('agent', $data);
    }
}
