<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use App\Models\Category;
use App\Http\Requests\StoreSparePartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SparePartController extends Controller
{
    /**
     * Display a listing of spare parts
     */
    public function index(Request $request)
    {
        $query = SparePart::with('category');

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('part_number', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by availability
        if ($request->has('is_available')) {
            $query->where('is_available', $request->is_available);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $spareParts = $query->paginate(12);
        $categories = Category::all();

        return view('spare-parts.index', compact('spareParts', 'categories'));
    }

    /**
     * Show the form for creating a new spare part
     */
    public function create()
    {
        $categories = Category::all();
        return view('spare-parts.create', compact('categories'));
    }

    /**
     * Store a newly created spare part
     */
    public function store(StoreSparePartRequest $request)
    {
        try {
            $data = $request->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('spare-parts', 'public');
            }

            $sparePart = SparePart::create($data);

            return redirect()
                ->route('spare-parts.show', $sparePart)
                ->with('success', 'Spare part berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan spare part: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified spare part
     */
    public function show(SparePart $sparePart)
    {
        $sparePart->load(['category', 'reviews.user']);
        
        $relatedParts = SparePart::where('category_id', $sparePart->category_id)
            ->where('id', '!=', $sparePart->id)
            ->limit(4)
            ->get();

        return view('spare-parts.show', compact('sparePart', 'relatedParts'));
    }

    /**
     * Show the form for editing the specified spare part
     */
    public function edit(SparePart $sparePart)
    {
        $categories = Category::all();
        return view('spare-parts.edit', compact('sparePart', 'categories'));
    }

    /**
     * Update the specified spare part
     */
    public function update(StoreSparePartRequest $request, SparePart $sparePart)
    {
        try {
            $data = $request->validated();

            // Handle new image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($sparePart->image) {
                    Storage::disk('public')->delete($sparePart->image);
                }

                $data['image'] = $request->file('image')->store('spare-parts', 'public');
            }

            $sparePart->update($data);

            return redirect()
                ->route('spare-parts.show', $sparePart)
                ->with('success', 'Spare part berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui spare part: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified spare part
     */
    public function destroy(SparePart $sparePart)
    {
        try {
            // Delete image
            if ($sparePart->image) {
                Storage::disk('public')->delete($sparePart->image);
            }

            $sparePart->delete();

            return redirect()
                ->route('spare-parts.index')
                ->with('success', 'Spare part berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus spare part: ' . $e->getMessage());
        }
    }
}
