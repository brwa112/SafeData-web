<?php

namespace App\Http\Middleware;

use App\Models\Pages\About\AboutTouch;
use App\Models\Pages\Branch;
use App\Models\Pages\Home\HomeKnow;
use App\Models\System\Settings\Settings\Language;
use App\Models\System\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'locale' => App::getLocale(),
            'route' => [
                'name' => $request->route()->getName(),
                'params' => $request->route()->parameters(),
            ],
            'auth' => [
            'user' => fn() => $request->user()
                ? User::where('id', $request->user()->id)
                    ->with([
                        'font',
                        'roles',
                        'permissions',
                        'settings.language',
                    ])
                    ->first()
                : null,
            ],
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
                'route' => $request->route()->getName(),
                'params' => $request->route()->parameters(),
                'query' => $request->query(),
            ],
            'lang' => fn() => $request->user()
                ? ($request->user()->settings()->with('language')->first()?->language?->name ?? 'en')
                : 'en',

            'languages' => Language::query()->select('id', 'name', 'slug', 'direction')->get(),
            'branches' => Branch::query()
                ->active()
                ->with('media')
                ->select('id', 'slug', 'name', 'color')
                ->get(),

            'info' => fn() => AboutTouch::where('is_active', true)
                ->when(session('selected_branch_id'), function ($query) {
                    $query->where('branch_id', session('selected_branch_id'));
                })
                ->select('contact_phone', 'contact_email', 'contact_address', 'map_iframe')
                ->first(),
            'social' => fn() => HomeKnow::where('is_active', true)
                ->when(session('selected_branch_id'), function ($query) {
                    $query->where('branch_id', session('selected_branch_id'));
                })
                ->select('metadata')
                ->first(),
        ]);
    }
}
