<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatCollection;
use App\Models\Stat;
use App\Models\Subscription;
use App\Repositories\StatRepository;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;

class StatController extends Controller
{
    /**
     * @var SubscriptionRepository
     */
    public SubscriptionRepository $subscription_repo;
    /**
     * @var StatRepository
     */
    public StatRepository $stat_repo;

    /**
     * @param SubscriptionRepository $subscription_repo
     * @param StatRepository $stat_repo
     */
    public function __construct(SubscriptionRepository $subscription_repo, StatRepository $stat_repo)
    {
        $this->subscription_repo = $subscription_repo;
        $this->stat_repo = $stat_repo;
    }

    /**
     * @return StatCollection
     */
    public function getStats()
    {
        $last_user_subscription = $this->subscription_repo->getLatestRecord([
            'user_id' => auth()->user()->id,
            'status' => Subscription::ACTIVE_SUBSCRIPTION,
        ]);

        if ($last_user_subscription) {
            $data = $this->stat_repo->getAll();
        } else {
            $data = $this->stat_repo->getByAttribute([
                'type' => Stat::FREE
            ]);
        }

        return new StatCollection($data);
    }
}
