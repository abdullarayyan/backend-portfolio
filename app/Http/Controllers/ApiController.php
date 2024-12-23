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

class ApiController extends Controller
{

    public function getWebsiteData(): JsonResponse
    {
        $homepage = Homepage::with('images')->first();
        $about = About::first();
        $experiences = Experience::all();
        $skills = SkillsSection::with('skills')->get();
        $marque = MarqueeItem::all();

        $websiteData = [
            "homepage" => [
                "roleLine1" => $homepage->role_line_1,
                "roleLine2" => $homepage->role_line_2,
                "flipRole" => $homepage->flip_role,
                "images" => [
                    "profile" => optional($homepage->images->where('type', 'profile')->first())->path
                        ? asset('storage/' . $homepage->images->where('type', 'profile')->first()->path)
                        : null,
                    "click" => optional($homepage->images->where('type', 'click')->first())->path
                        ? asset('storage/' . $homepage->images->where('type', 'click')->first()->path)
                        : null,
                    "angles" => $homepage->images->where('type', 'angle')->sortBy('sort')->pluck('path')->map(function ($path) {
                        return asset('storage/' . $path);
                    })
                ]

            ],
            "aboutSection" => [
                "title" => $about->title,
                "name1" => $about->name_1,
                "name2" => $about->name_2,
                "description" => $about->description
            ],
            "experiences" => $experiences,
            "Marquee" => $marque,
            "skills_sections" => $skills
        ];

        return response()->json(["WebsiteData" => $websiteData], 200);
    }
    public function getProjectsData(): JsonResponse
    {
        $projects = Project::with(['sections.images'])->orderBy('sort')->get(); // Sort projects by 'sort' column

        $projectData = $projects->map(function ($project) {
            return [
                "id" => $project->id,
                "name" => $project->title,
                "type" => $project->subtitle,
                "imageSrc" => optional($project->sections->pluck('images')->flatten()->first())->path
                    ? asset('storage/' . optional($project->sections->pluck('images')->flatten()->first())->path)
                    : null,
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
