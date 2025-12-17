<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        $filters = $this->getFilters($request);

        $products = Product::query()->with('user')
            ->search($filters['search'])
            ->orderBy($filters['sort_by'], $filters['sort_direction'])
            ->paginate($filters['number_rows']);


        return inertia('Pages/Products', [
            'products' => $products,
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

    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);

        Product::create($request->validated());
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $product->update($request->validated());
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();
    }
}
