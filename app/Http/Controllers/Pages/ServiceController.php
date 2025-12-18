<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Service::class);

        $filters = $this->getFilters($request);

        $services = Service::query()->with('user')
            ->search($filters['search'])
            ->orderBy($filters['sort_by'], $filters['sort_direction'])
            ->paginate($filters['number_rows']);

        return inertia('Pages/Services', [
            'services' => $services,
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

    public function store(ServiceRequest $request)
    {
        $this->authorize('create', Service::class);

        $service = Service::create($request->validated());

        if ($request->hasFile('logo')) {
            $service->clearMediaCollection('logo');
            $service->addMediaFromRequest('logo')->preservingOriginal()->toMediaCollection('logo');
        } elseif ($request->input('remove_logo')) {
            $service->clearMediaCollection('logo');
        }
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $this->authorize('update', $service);

        $service->update($request->validated());

        if ($request->hasFile('logo')) {
            $service->clearMediaCollection('logo');
            $service->addMediaFromRequest('logo')->preservingOriginal()->toMediaCollection('logo');
        } elseif ($request->input('remove_logo')) {
            $service->clearMediaCollection('logo');
        }
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();
    }
}
