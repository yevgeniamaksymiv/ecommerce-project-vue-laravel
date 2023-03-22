<?php

namespace App\Providers;

 use App\Models\Category;
 use App\Models\Delivery;
 use App\Models\Order;
 use App\Models\Product;
 use App\Models\Role;
 use App\Models\User;
 use App\Policies\CategoryPolicy;
 use App\Policies\DeliveryPolicy;
 use App\Policies\OrderPolicy;
 use App\Policies\ProductPolicy;
 use App\Policies\RolePolicy;
 use App\Policies\UserPolicy;
 use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
         'App\Models\Model\Category' => 'App\Policies\ModelPolicy\CategoryPolicy',
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Delivery::class => DeliveryPolicy::class,
        Order::class => OrderPolicy::class,
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

//        Gate::before(function ($user, $ability) {
//            return $user->hasRole('admin') ? true : null;
//        });
    }
}
