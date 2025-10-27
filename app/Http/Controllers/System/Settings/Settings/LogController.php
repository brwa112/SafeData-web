<?php

namespace App\Http\Controllers\System\Settings\Settings;

use Illuminate\Http\Request;
use App\Traits\HandlesSorting;
use App\Models\System\Users\User;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    use HandlesSorting;
    
    public function index(Request $request)
    {
        $this->authorize('viewAny', Activity::class);

        $filters = $this->getFilters($request);
        $baseFilters = $this->baseFilter($request);
        $filters = $filters->merge($baseFilters);

        $users = User::query()->select('id', 'email', 'name')->get();

        $query = Activity::query()
            ->with(['causer:id,name,email', 'subject'])
            ->when($filters['user_id'] ?? null, function ($query, $userId) {
                $query->where('causer_id', $userId)->where('causer_type', 'App\\Models\\System\\Users\\User');
            })
            ->when($filters['event'] ?? null, function ($query, $event) {
                $query->where('event', $event);
            })
            ->when($filters['subject_type'] ?? null, function ($query, $subjectType) {
                $query->where('subject_type', $subjectType);
            })
            ->when($filters['start_date'] ?? null, function ($query, $startDate) {
                $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($filters['end_date'] ?? null, function ($query, $endDate) {
                $query->whereDate('created_at', '<=', $endDate);
            })
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', "%{$search}%")
                      ->orWhere('event', 'like', "%{$search}%")
                      ->orWhere('subject_type', 'like', "%{$search}%")
                      ->orWhereHas('causer', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                      });
                });
            });

        $this->applySortingToQuery($query, $filters['sort_by'], $filters['sort_direction'], $this->getSortableFields());

        $paginatedResults = $query->paginate($filters['number_rows']);
        
        // Manually transform items
        $items = collect($paginatedResults->items())->map(function ($log) {
            return [
                'id' => $log->id,
                'users' => [
                    'name' => $log->causer?->name ?? 'System',
                    'email' => $log->causer?->email ?? 'N/A',
                ],
                'action' => $log->description,
                'event' => $log->event,
                'subject_type' => class_basename($log->subject_type ?? 'N/A'),
                'row_id' => $log->subject_id ?? 'N/A',
                'properties' => $log->properties,
                'created_at' => $log->created_at,
                'updated_at' => $log->updated_at,
            ];
        });
        
        // Create new paginator with transformed data
        $logs = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $paginatedResults->total(),
            $paginatedResults->perPage(),
            $paginatedResults->currentPage(),
            ['path' => $paginatedResults->path()]
        );

        // Get unique event types for filtering
        $events = Activity::query()
            ->distinct()
            ->whereNotNull('event')
            ->pluck('event')
            ->filter()
            ->map(fn($event) => [
                'value' => $event,
                'label' => ucfirst($event)
            ])
            ->values();

        // Get unique subject types for filtering
        $subjectTypes = Activity::query()
            ->distinct()
            ->whereNotNull('subject_type')
            ->pluck('subject_type')
            ->map(fn($type) => [
                'value' => $type,
                'label' => class_basename($type)
            ])
            ->values();

        return inertia('System/Settings/Settings/Logs/Index', [
            'users' => $users,
            'logs' => $logs,
            'events' => $events,
            'subjectTypes' => $subjectTypes,
            'filter' => $filters,
        ]);
    }
    
    private function baseFilter(Request $request): array
    {
        return [
            'user_id' => $request->input('filter.user_id'),
            'event' => $request->input('filter.event'),
            'subject_type' => $request->input('filter.subject_type'),
            'start_date' => $request->input('filter.start_date'),
            'end_date' => $request->input('filter.end_date'),
        ];
    }
    
    private function getSortableFields(): array
    {
        return [
            // Simple column sorting for activity_log table
            'id' => $this->simpleSort('activity_log.id'),
            'description' => $this->simpleSort('activity_log.description'),
            'event' => $this->simpleSort('activity_log.event'),
            'created_at' => $this->simpleSort('activity_log.created_at'),
        ];
    }
}

