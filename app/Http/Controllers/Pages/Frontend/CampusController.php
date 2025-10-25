<?php

namespace App\Http\Controllers\Pages\Frontend;

use App\Models\Pages\Client;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;
use App\Models\Pages\Campus;
use App\Models\Pages\Classroom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function index(Request $request)
    {
        // Get selected branch from request/session
        $selectedBranchId = $request->input('branch_id') ?? session('selected_branch_id');

        // Get campuses filtered by branch
        $campuses = Campus::query()
            ->active()
            ->ofBranch($selectedBranchId)
            ->with(['category', 'branch'])
            ->latest()
            ->paginate(12);

        return inertia('Frontend/Pages/Campus/Index', [
            'campuses' => $campuses,
        ]);
    }

    public function show($slug)
    {
        return inertia('Frontend/Pages/Campus/Show', [
            'detail' => (object)[
                'id' => 1,
                'title' => 'Kurd Genius Educational Communities',
                'description' => 'Kurd Genius Educational Communities is a premier educational institution dedicated to providing high-quality education and fostering a nurturing learning environment. Established in 2013, our campus is equipped with state-of-the-art facilities, modern classrooms, and a team of experienced educators committed to the academic and personal growth of our students. We offer a comprehensive curriculum that emphasizes critical thinking, creativity, and global awareness, preparing our students to excel in an ever-changing world.',
                'date' => '2025-05-17',
                'image' => '/img/campus/1.jpg',
            ],
        ]);
    }

    public function showClass($slug)
    {
        return inertia('Frontend/Pages/Campus/Show', [
            'detail' => (object)[
                'id' => 1,
                'title' => 'Science Lab',
                'description' => 'Our Science Lab is a cutting-edge facility designed to provide students with hands-on learning experiences in various scientific disciplines. Equipped with modern instruments and safety features, the lab encourages experimentation, critical thinking, and collaboration among students. Our dedicated science educators guide students through practical experiments, fostering a deep understanding of scientific concepts and principles. The Science Lab is an integral part of our commitment to delivering a comprehensive and engaging education.',
                'date' => '2025-05-17',
                'image' => '/img/class/1.jpg',
            ],
        ]);
    }
}

