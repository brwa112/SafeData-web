<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\Hosting;
use App\Http\Controllers\Controller;
use App\Http\Requests\HostingRequest;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Hosting::class);

        $filters = $this->getFilters($request);

        $hostings = Hosting::query()->with('user')
            ->search($filters['search'])
            ->orderBy($filters['sort_by'], $filters['sort_direction'])
            ->paginate($filters['number_rows']);

        return inertia('Pages/Hostings', [
            'hostings' => $hostings,
            'filter' => $filters,
        ]);
    }

    protected function getFilters(Request $request)
    {
        return collect([
            'search' => $request->query('filter')['search'] ?? '',
            'number_rows' => $request->query('filter')['number_rows'] ?? 10,
            'sort_by' => $request->query('filter')['sort_by'] ?? 'id',
            'sort_direction' => $request->query('filter')['sort_direction'] ?? 'desc',
        ]);
    }

    public function store(HostingRequest $request)
    {
        $this->authorize('create', Hosting::class);

        Hosting::create($request->validated());
    }

    public function update(HostingRequest $request, Hosting $hosting)
    {
        $this->authorize('update', $hosting);

        $hosting->update($request->validated());
    }

    public function destroy(Hosting $hosting)
    {
        $this->authorize('delete', $hosting);

        $hosting->delete();
    }
}
