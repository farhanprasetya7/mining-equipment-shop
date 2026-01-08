<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Category;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of vehicles
     */
    public function index(Request $request)
    {
        $query = Vehicle::with('category');

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by condition
        if ($request->has('condition')) {
            $query->where('condition', $request->condition);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $vehicles = $query->paginate(12);
        $categories = Category::all();

        return view('vehicles.index', compact('vehicles', 'categories'));
    }

    /**
     * Show the form for creating a new vehicle
     */
    public function create()
    {
        $this->authorize('create', Vehicle::class);
        $categories = Category::all();
        return view('vehicles.create', compact('categories'));
    }

    /**
     * Store a newly created vehicle
     */
    public function store(StoreVehicleRequest $request)
    {
        try {
            $data = $request->validated();

            // Handle multiple images upload
            if ($request->hasFile('images')) {
                $images = [];
                foreach ($request->file('images') as $image) {
                    $path = $image->store('vehicles', 'public');
                    $images[] = $path;
                }
                $data['images'] = $images;
            }

            $vehicle = Vehicle::create($data);

            return redirect()
                ->route('vehicles.show', $vehicle)
                ->with('success', 'Kendaraan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan kendaraan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified vehicle
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['category', 'reviews.user']);
        $vehicle->incrementViews();
        
        $relatedVehicles = Vehicle::where('category_id', $vehicle->category_id)
            ->where('id', '!=', $vehicle->id)
            ->limit(4)
            ->get();

        return view('vehicles.show', compact('vehicle', 'relatedVehicles'));
    }

    /**
     * Show the form for editing the specified vehicle
     */
    public function edit(Vehicle $vehicle)
    {
        $this->authorize('update', $vehicle);
        $categories = Category::all();
        return view('vehicles.edit', compact('vehicle', 'categories'));
    }

    /**
     * Update the specified vehicle
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        try {
            $data = $request->validated();

            // Handle new images upload
            if ($request->hasFile('images')) {
                // Delete old images
                if ($vehicle->images) {
                    foreach ($vehicle->images as $oldImage) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }

                // Upload new images
                $images = [];
                foreach ($request->file('images') as $image) {
                    $path = $image->store('vehicles', 'public');
                    $images[] = $path;
                }
                $data['images'] = $images;
            }

            $vehicle->update($data);

            return redirect()
                ->route('vehicles.show', $vehicle)
                ->with('success', 'Kendaraan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui kendaraan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified vehicle
     */
    public function destroy(Vehicle $vehicle)
    {
        $this->authorize('delete', $vehicle);

        try {
            // Delete images
            if ($vehicle->images) {
                foreach ($vehicle->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $vehicle->delete();

            return redirect()
                ->route('vehicles.index')
                ->with('success', 'Kendaraan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus kendaraan: ' . $e->getMessage());
        }
    }

    /**
     * Export vehicles to Excel
     */
    public function export()
    {
        // Will be implemented with Laravel Excel
        return back()->with('info', 'Export feature coming soon');
    }

    /**
     * Import vehicles from Excel
     */
    public function import(Request $request)
    {
        // Will be implemented with Laravel Excel
        return back()->with('info', 'Import feature coming soon');
    }
}
