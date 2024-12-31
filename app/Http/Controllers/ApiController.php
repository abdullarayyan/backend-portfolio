<?php
namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Experience;
use App\Models\Homepage;
use App\Models\MarqueeItem;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SkillsSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getWebsiteData(): JsonResponse
    {
        $homepage = Homepage::with('images')->first();
        $about = About::first();
        $experiences = Experience::all();
        $skills = SkillsSection::with(['skills.projects.sections.images'])->get();
        $marque = MarqueeItem::all();
        $projects = Project::with(['sections.images'])->orderBy('sort')->get();

        $websiteData = [
            "homepage" => [
                "roleLine1" => $homepage ? $homepage->role_line_1 : null,
                "roleLine2" => $homepage ? $homepage->role_line_2 : null,
                "flipRole" => $homepage ? $homepage->flip_role : null,
                "images" => [
                    "profile" => optional($homepage)->images->where('type', 'profile')->first()
                        ? asset('storage/' . $homepage->images->where('type', 'profile')->first()->path)
                        : null,
                    "click" => optional($homepage)->images->where('type', 'click')->first()
                        ? asset('storage/' . $homepage->images->where('type', 'click')->first()->path)
                        : null,
                    "angles" => optional($homepage)->images->where('type', 'angle')->sortBy('sort')->pluck('path')->map(function ($path) {
                        return asset('storage/' . $path);
                    })
                ]
            ],
            "aboutSection" => $about ? [
                "title" => $about->title,
                "name1" => $about->name_1,
                "name2" => $about->name_2,
                "description" => $about->description
            ] : null,
            "experiences" => $experiences,
            "Marquee" => $marque,
            "skillsSections" => $skills->mapWithKeys(function ($skillSection) {
                return [
                        "title" => $skillSection->title,
                        "subtitle" => $skillSection->subtitle,
                        "description" => $skillSection->description,
                        "skills" => $skillSection->skills->map(function ($skill) {
                            return [
                                "id" => $skill->id,
                                "title" => $skill->title,
                                "is_active" => $skill->is_active,
                                "projects" => $skill->projects->map(function ($project) {
                                    $firstImage = $project->sections->pluck('images')->flatten()->first();
                                    return [
                                        "id" => $project->id,
                                        "name" => $project->title,
                                        "type" => $project->subtitle,
                                        "imageSrc" => $firstImage ? asset('storage/' . $firstImage->path) : null,
                                        "sections" => $project->sections->sortBy('sort')->map(function ($section) {
                                            return [
                                                "type" => $section->type,
                                                "title" => $section->title,
                                                "description" => $section->description,
                                                "hasImages" => $section->has_images,
                                                "images" => $section->images->sortBy('sort')->pluck('path')->map(function ($path) {
                                                    return asset('storage/' . $path);
                                                }),
                                                "hasGridImages" => $section->has_grid_images,
                                                "gridImages" => $section->images->where('type', 'grid')->sortBy('sort')->pluck('path')->map(function ($path) {
                                                    return asset('storage/' . $path);
                                                }),
                                            ];
                                        })
                                    ];
                                }),
                            ];
                        }),
                ];
            }),
            "projects"=> $projects->map(function ($project) {
                $firstImage = $project->sections->pluck('images')->flatten()->first();
                return [
                    "id" => $project->id,
                    "name" => $project->title,
                    "type" => $project->subtitle,
                    "imageSrc" => $firstImage ? asset('storage/' . $firstImage->path) : null,
                    "sections" => $project->sections->sortBy('sort')->map(function ($section) {
                        return [
                            "type" => $section->type,
                            "title" => $section->title,
                            "description" => $section->description,
                            "hasImages" => $section->has_images,
                            "images" => $section->images->sortBy('sort')->pluck('path')->map(function ($path) {
                                return asset('storage/' . $path);
                            }),
                            "hasGridImages" => $section->has_grid_images,
                            "gridImages" => $section->images->where('type', 'grid')->sortBy('sort')->pluck('path')->map(function ($path) {
                                return asset('storage/' . $path);
                            }),
                        ];
                    })
                ];
            })
        ];

        return response()->json(["WebsiteData" => $websiteData], 200);
    }
    public function getProjectsData(): JsonResponse
    {
        $projects = Project::with(['sections.images'])->orderBy('sort')->get();

        $projectData = $projects->map(function ($project) {
            $firstImage = $project->sections->pluck('images')->flatten()->first();
            return [
                "id" => $project->id,
                "name" => $project->title,
                "type" => $project->subtitle,
                "imageSrc" => $firstImage ? asset('storage/' . $firstImage->path) : null,
                "sections" => $project->sections->sortBy('sort')->map(function ($section) {
                    return [
                        "type" => $section->type,
                        "title" => $section->title,
                        "description" => $section->description,
                        "hasImages" => $section->has_images,
                        "images" => $section->images->sortBy('sort')->pluck('path')->map(function ($path) {
                            return asset('storage/' . $path);
                        }),
                        "hasGridImages" => $section->has_grid_images,
                        "gridImages" => $section->images->where('type', 'grid')->sortBy('sort')->pluck('path')->map(function ($path) {
                            return asset('storage/' . $path);
                        }),
                    ];
                })
            ];
        });

        return response()->json(["Projects" => $projectData], 200);
    }

    public function getProjectsBySkill(Request $request): JsonResponse
    {
        $projects = \App\Models\Project::query()
            ->where('skill_id', 1)
            ->with('sections.images')
            ->get()
            ->map(function ($project) {
                return [
                    'id' => (string)$project->id,
                    'name' => $project->title,
                    'type' => $project->type,
                    'imageSrc' => "/images/" . basename($project->image_src),
                    'sections' => $project->sections->map(function ($section) {
                        return [
                            'type' => $section->type,
                            'title' => $section->title,
                            'description' => $section->description,
                            'hasImages' => (bool)$section->has_images,
                            'images' => $section->images->map(function ($image) {
                                return "/images/" . basename($image->path);
                            })->toArray(),
                            'hasGridImages' => (bool)$section->has_grid_images,
                            'gridImages' => $section->images
                                ->filter(function ($image) {
                                    return $image->type === 'grid';
                                })
                                ->map(function ($image) {
                                    return "/images/" . basename($image->path);
                                })
                                ->toArray(),
                        ];
                    })->toArray()
                ];
            })->toArray();

        $response = [
            'Projects' => [
                'id' => '1',
                'title' => 'UI/UX',
                'subtitle' => 'PROJECTS',
                'description1' => 'A seasoned graphic design professional',
                'description2' => 'with over five years of experience across',
                'list' => $projects
            ]
        ];


        return response()->json($response,200);

    }

//    public function getWebsiteData(): JsonResponse
//    {
//        $websiteData = [
//            "homepage" => [
//                "roleLine1" => "GRAPHIC",
//                "roleLine2" => "& UI/UX",
//                "flipRole" => "DESIGNER",
//                "images" => [
//                    "profile" => "images/angles/Main_result.webp",
//                    "click" => "images/angles/click.webp",
//                    "angles" => [
//                        "images/angles/0.webp",
//                        "images/angles/1.webp",
//                        "images/angles/2.webp",
//                        // Additional angle images...
//                    ]
//                ]
//            ],
//            "aboutSection" => [
//                "title" => "About",
//                "name1" => "Mezher",
//                "name2" => "Jeebat",
//                "description" => "A seasoned graphic design professional..."
//            ],
//            "Marquee" => [
//                "USER INTERFACE",
//                "GRAPHIC DESIGN",
//                "PRODUCT DEVELOPMENT",
//                "USER EXPERIENCE",
//                "BRANDING"
//            ],
//            "experience" => [
//                "title" => "EXPERIENCE",
//                "subtitle" => "HISTORY",
//                "description" => "With a proven track record...",
//                "experiences" => [
//                    [
//                        "title" => "Senior Graphic & UX/UI Designer",
//                        "company" => "OOREDOO PALESTINE",
//                        "date" => "2020-08-01",
//                        "endDate" => "2020-06-01",
//                        "isStillWorking" => true
//                    ],
//                    // Additional experiences...
//                ]
//            ],
//            "skills_sections" => [
//                "title" => "SKILLS &",
//                "subTitle" => "PROJECTS",
//                "description" => "Explore Mezher Jeebat’s portfolio...",
//                "skills" => [
//                    ["id" => 1, "title" => "UI/UX"],
//                    ["id" => 2, "title" => "BRANDING"],
//                    // Additional skills...
//                ]
//            ],
//            "linkedIn" => "",
//            "email" => ""
//        ];
//
//        return response()->json(["WebsiteData" => $websiteData], 200);
//    }
//
//
//    public function getProjectsData(): JsonResponse
//    {
//        $projectData = [
//            "id" => "1",
//            "title" => "UI/UX",
//            "subtitle" => "PROJECTS",
//            "description1" => "A seasoned graphic design professional",
//            "description2" => "with over five years of experience across",
//            "list" => [
//                [
//                    "id" => "1",
//                    "name" => "OOREDOO APP1",
//                    "type" => "UI/UX",
//                    "imageSrc" => "/images/slide1.jpg",
//                    "sections" => [
//                        [
//                            "type" => "0",
//                            "title" => "Intro",
//                            "description" => "A seasoned graphic design professional..."
//                        ],
//                        [
//                            "type" => "1",
//                            "title" => "Work Process",
//                            "description" => "We started with very little...",
//                            "hasImages" => true,
//                            "images" => [
//                                "/images/slide1.jpg",
//                                "/images/slide2.jpg",
//                                "/images/slide3.jpg"
//                            ]
//                        ],
//                        [
//                            "type" => "2",
//                            "title" => "Outcomes",
//                            "description" => "This endeavor helped us test...",
//                            "hasGridImages" => true,
//                            "gridImages" => [
//                                "/images/slide1.jpg",
//                                "/images/slide2.jpg",
//                                "/images/slide3.jpg"
//                            ]
//                        ]
//                    ]
//                ],
//                // Additional projects...
//            ]
//        ];
//
//        return response()->json(["Projects" => $projectData], 200);
//    }
}
