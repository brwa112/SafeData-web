<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Client::class);

        $filters = $this->getFilters($request);

        $clients = Client::query()->with('user')
            ->search($filters['search'])
            ->orderBy($filters['sort_by'], $filters['sort_direction'])
            ->paginate($filters['number_rows']);

        return inertia('Pages/Clients', [
            'clients' => $clients,
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

    public function store(ClientRequest $request)
    {
        $this->authorize('create', Client::class);

        $data = $request->validated();

        $client = Client::create($data);

        if ($request->hasFile('logo')) {
            $client->clearMediaCollection('logo');
            $client->addMediaFromRequest('logo')->preservingOriginal()->toMediaCollection('logo');
        } elseif ($request->input('remove_logo')) {
            $client->clearMediaCollection('logo');
        }
    }

    public function update(ClientRequest $request, Client $client)
    {
        $this->authorize('update', $client);

        $data = $request->validated();

        $client->update($data);

        if ($request->hasFile('logo')) {
            $client->clearMediaCollection('logo');
            $client->addMediaFromRequest('logo')->preservingOriginal()->toMediaCollection('logo');
        } elseif ($request->input('remove_logo')) {
            $client->clearMediaCollection('logo');
        }
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();
    }
}
