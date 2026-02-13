<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectContent;

class ProjectContentSeeder extends Seeder
{
    public function run(): void
    {
        ProjectContent::truncate();

        $data = [
            [
                'page_number' => 0,
                'section_title' => 'Global Settings',
                'type' => 'metadata',
                'year_range' => '2024-2025',
                'content' => [
                    'site_title' => 'Western Visayas: Investment and Economic Profile',
                    'browser_tab_title' => 'Western Visayas Region 6 Profile',
                    'logo_text' => 'DTI Region 6'
                ]
            ],
            [
                'page_number' => 1,
                'section_title' => 'Title Page',
                'type' => 'hero',
                'year_range' => '2024-2025',
                'source' => 'Supra Regional Consultations to Improve Logistics Efficiency, Reduce Logistics Costs, and Agri Supply Chain | 08 September 2022 | VIZ Logistics Cluster',
                'content' => [
                    'title' => "Why Invest in\nWestern Visayas?",
                    'subtitle' => 'DEPARTMENT OF TRADE AND INDUSTRY REGION 6',
                    'logo' => 'dti-logo.png',
                    'highlight_stats' => [
                        ['label' => 'GRDP GROWTH (2024)', 'value' => '4.3%'],
                        ['label' => 'GROWING POPULATION', 'value' => '4.9M']
                    ],
                    'modal_details' => [
                        'Why Invest in Visayas Logistics Cluster?' => [
                            'Points' => [
                                'Abundant in Natural Resources',
                                'Agricultural Potential',
                                'Collaborative Environment',
                                'Competitive Human Capital',
                                'Decongestion of other Areas within PH',
                                'Generally Peaceful and Orderly',
                                'High Demand for Logistics',
                                'High Potential for Economic Growth',
                                'Increasing Population',
                                'Lack of Logistics Infrastructure',
                                'Mitigation of Trade & Manufacturing Paralysis',
                                'Presence of Logistics Infrastructure',
                                'Strategic Location',
                                'Sufficient Power Supply'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'page_number' => 2,
                'section_title' => 'Regional Overview',
                'type' => 'stats_grid',
                'year_range' => '2024-2025',
                'content' => [
                    'description' => 'Western Visayas or Region VI is located at the center of the Philippine archipelago and lies between two large bodies of water, the Sibuyan Sea and the Visayan Sea.',
                    'stats' => [
                        ['label' => 'Land Area', 'value' => '20,794 sq. km.'],
                        ['label' => 'Population (2024)', 'value' => '4,861,911'],
                        ['label' => 'Density (2024)', 'value' => '370 / km2'],
                        ['label' => 'Composition', 'value' => '5 Provinces']
                    ],
                    'modal_details' => [
                        'Composition' => [
                            'Provinces' => 'Aklan, Antique, Capiz, Guimaras, & Iloilo',
                            'Cities' => '3',
                            'Municipalities' => '98',
                            'Barangays' => '3,209',
                            'Congressional Districts' => '10'
                        ],
                        'Map Labels' => 'Sibuyan Sea, Visayan Sea, BORACAY, AKLAN, Kalibo, CAPIZ, ROXAS CITY, ANTIQUE, ILOILO, ILOILO CITY, SAN JOSE DE BUENAVISTA, GUIMARAS.'
                    ],
                    'notable_info' => 'Last June 13, 2024, President Bongbong Marcos signed the Republic Act No. 12000 to establish the Negros Island Region (NIR).'
                ],
                'source' => 'Philippine Statistics Authority, Census of Population 2024'
            ],
            [
                'page_number' => 3,
                'section_title' => 'Partner Firms Marquee',
                'type' => 'marquee',
                'year_range' => '2024-2025',
                'content' => [
                    'items' => ['CONCENTRIX', 'TELEPERFORMANCE', 'TRANSCOM', 'TELETECH', 'LEGATO', 'SM RETAIL', 'ROBINSONS', 'PUEBLO DE PANAY', 'MEGAWORLD', 'AYALA LAND']
                ]
            ],
            [
                'page_number' => 4,
                'section_title' => '2024 Gross Regional Domestic Product',
                'type' => 'chart',
                'year_range' => '2024-2025',
                'content' => [
                    'chart_type' => 'bar',
                    'title' => 'GRDP Growth Rates by Region (2023-2024, %)',
                    'categories' => ['CV (VII)', 'Caraga (XIII)', 'CL (III)', 'Davao (XI)', 'EV (VIII)', 'NorMin (X)', 'NIR', 'NCR', 'CALABARZON', 'SOCCSKSARGEN', 'CV (II)', 'Ilocos', 'Bicol', 'CAR', 'MIMAROPA', 'WV (VI)', 'Zamboanga', 'BARMM'],
                    'series' => [
                        ['name' => 'Growth Rate %', 'data' => [7.3, 6.9, 6.5, 6.3, 6.2, 6.0, 5.9, 5.59, 5.56, 5.5, 5.3, 4.94, 4.92, 4.8, 4.4, 4.3, 4.2, 2.7]]
                    ],
                    'modal_text' => 'Western Visayas economy was valued at PhP 641.76 billion (2.9% of the country\'s GDP) at constant 2018 prices.'
                ],
                'source' => 'https://psa.gov.ph/system/files/pad/2024%20GRDP%20Publication.pdf'
            ],
            [
                'page_number' => 6,
                'section_title' => 'Per Capita GDP Growth Rate',
                'type' => 'chart',
                'year_range' => '2024-2025',
                'content' => [
                    'chart_type' => 'bar',
                    'title' => 'Per Capita GDP Growth Rate by Region (2023-2024, %)',
                    'categories' => ['PH', 'NCR', 'CAR', 'I', 'II', 'III', 'IVA', 'MIMAROPA', 'V', 'VI (WV)', 'NIR', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII', 'XIII', 'BARMM'],
                    'series' => [
                        ['name' => 'Growth Rate %', 'data' => [4.8, 5.0, 3.63, 4.7, 4.6, 5.6, 4.3, 3.64, 4.0, 3.62, 5.5, 6.2, 5.4, 3.2, 5.1, 5.3, 4.4, 5.8, 1.0]]
                    ],
                    'modal_text' => 'Figure 10. Per Capita GDP by Region, Growth Rates, 2023-2024 At Constant 2018 Prices.'
                ],
                'source' => 'PSA GRDP Publication 2024'
            ],
            [
                'page_number' => 7,
                'section_title' => 'Growth Rates by Industry',
                'type' => 'chart',
                'year_range' => '2024-2025',
                'content' => [
                    'chart_type' => 'bar',
                    'horizontal' => true,
                    'title' => 'Western Visayas Industry Growth Rates (%)',
                    'categories' => [
                        'Professional & Business Services', 'Electricity, Steam, Water', 'Human Health & Social Work', 
                        'Accommodation & Food', 'Transportation & Storage', 'Financial & Insurance', 'Other Services',
                        'Wholesale & Retail Trade', 'Information & Communication', 'Real Estate', 'Public Administration',
                        'Construction', 'Mining & Quarrying', 'Education', 'Manufacturing', 'Agriculture, Forestry, Fishing'
                    ],
                    'series' => [
                        ['name' => 'Growth Rate %', 'data' => [13.7, 13.52, 13.49, 10.4, 8.6, 8.0, 7.6, 7.3, 6.8, 5.3, 3.6, 3.53, 3.48, 3.4, 2.6, -7.3]]
                    ],
                    'modal_text' => 'Professional & Business Services recorded the fastest growth at 13.7%. Agriculture (AFF) posted a decline of 7.3 percent.'
                ],
                'source' => 'PSA GRDP Publication 2024'
            ],
            [
                'page_number' => 9,
                'section_title' => '12 Economic Drivers',
                'type' => 'grid',
                'year_range' => '2024-2025',
                'content' => [
                    'items' => [
                        [
                            'name' => 'AGRICULTURE', 
                            'details' => 'Major cluster with 25,535 hectares of bamboo planted; 9 Shared Service Facilities; Cacao production: 21,988 kg/year; Coffee: 2,089 MT yield; 5 Anchor Firms including Sugar Valley Coffee.'
                        ],
                        [
                            'name' => 'MARINE & FISHERIES', 
                            'details' => 'Strategic asset with 49 fishing ports; Capiz identified as Aquamarine/Seafood hub; Multi-agency support from BFAR and local SUCs for sustainable yields.'
                        ],
                        [
                            'name' => 'MSMEs & LARGE MANUFACTURING', 
                            'details' => '85,000+ establishments regional total; Micro (92%), Small (8%); Priority Raw Materials: Piña, Abaca, Raffia, Nito, Shells, and Silk across 6 provinces.'
                        ],
                        [
                            'name' => 'IT/BPO/BPMS', 
                            'details' => '200+ leading companies including Concentrix, Teleperformance, Transcom; 50 assisted startups (2021-2024); Iloilo City and Bacolod City as premier hubs.'
                        ],
                        [
                            'name' => 'WHOLESALE AND RETAIL', 
                            'details' => '71,289 annual business registrations; 70.57% online transaction adoption; Massive distribution network across cities and municipalities.'
                        ],
                        [
                            'name' => 'TOURISM', 
                            'details' => 'World-class destinations including Boracay, Aklan; Priority industry for Iloilo and Aklan; Sustainable development programs by DOT and DTI.'
                        ],
                        [
                            'name' => 'PROPERTY DEVELOPMENT', 
                            'details' => 'Rapid urban expansion in Iloilo and Bacolod; 23 Operating PEZA Sites; Integrated residential and commercial high-rise development projects.'
                        ],
                        [
                            'name' => 'CONSTRUCTION', 
                            'details' => 'Active infrastructure projects including roads and bridges; 3.53% current growth rate; Core driver for Visayas Logistics Cluster expansion.'
                        ],
                        [
                            'name' => 'HOUSING', 
                            'details' => 'Massive residential demand driven by 4.86M population; Partnerships between LGUs and National Housing Authority; Focus on resilient urban planning.'
                        ],
                        [
                            'name' => 'FINANCIAL INSTITUTIONS', 
                            'details' => 'Total 239 medium and 223 large establishments; BSP oversight; 8% growth in financial and insurance activities (2024).'
                        ],
                        [
                            'name' => 'PORT OPERATIONS', 
                            'details' => '152 operational ports: 69 private commercial, 23 public commercial, 11 feeder; Hub for Visayas Logistics Cluster and maritime trade.'
                        ],
                        [
                            'name' => 'TRANSPORTATION', 
                            'details' => '9 Airports (6 CAAP, 3 Private); 8.6% growth in transportation and storage; Strategic connectivity via LTFRB and Marina.'
                        ]
                    ]
                ],
                'source' => 'NEDA Region VI'
            ],
            [
                'page_number' => 10,
                'section_title' => 'DTI Business Name Registration',
                'type' => 'stats_grid',
                'year_range' => '2024-2025',
                'content' => [
                    'description' => 'Business Name Registration in Western Visayas (2022 - September 4, 2025). Total: 245,236 registrations.',
                    'stats' => [
                        ['label' => 'Total Registrations', 'value' => '245,236'],
                        ['label' => 'Online Method', 'value' => '70.57%'],
                        ['label' => 'Women-Owned', 'value' => '63.5%'],
                        ['label' => 'Barangay Scope', 'value' => '162,943']
                    ],
                    'modal_details' => [
                        'Yearly Totals' => [
                            '2022' => '56,135',
                            '2024' => '71,289',
                            '2025 (Sept 4)' => '52,187'
                        ],
                        'Methods' => [
                            'Online' => '173,060 (70.57%)',
                            'Hybrid' => '45,188 (18.43%)',
                            'Walk-in' => '26,988 (11%)'
                        ],
                        'Gender' => [
                            'Women' => '155,723 (63.5%)',
                            'Men' => '89,513 (36.5%)'
                        ],
                        'Scope' => [
                            'Barangay' => '162,943',
                            'City/Provincial' => '53,490',
                            'Regional' => '19,096'
                        ]
                    ]
                ],
                'source' => 'https://bnrs.dti.gov.ph/resources/bn-statistics'
            ],
            [
                'page_number' => 11,
                'section_title' => 'Establishments by Province',
                'type' => 'chart',
                'year_range' => '2024-2025',
                'content' => [
                    'chart_type' => 'bar',
                    'title' => 'Numbers of Establishments in Operation (2021-2023)',
                    'categories' => ['Aklan', 'Antique', 'Capiz', 'Guimaras', 'Iloilo (inc City)', 'Negros Occ (inc Bacolod)'],
                    'series' => [
                        ['name' => '2021', 'data' => [6399, 4304, 7958, 1407, 23230, 30417]],
                        ['name' => '2022', 'data' => [6737, 4380, 8220, 1487, 24148, 30776]],
                        ['name' => '2023', 'data' => [8907, 5719, 9533, 1890, 26395, 33200]]
                    ]
                ],
                'source' => 'PSA Region 6 Special Release - Reference No. 2025-SR18'
            ],
            [
                'page_number' => 12,
                'section_title' => 'Establishment Size by Province (2023)',
                'type' => 'grid',
                'year_range' => '2024-2025',
                'content' => [
                    'items' => [
                        ['name' => 'Micro (78,391)', 'details' => 'Negros Occ (24.2%), Iloilo (21.2%), Capiz (11.5%), Aklan (10.2%), Iloilo City (9.4%), Antique (6.9%), Guimaras (2.3%), Bacolod City (14.3%)'],
                        ['name' => 'Small (6,791)', 'details' => 'Bacolod City (24%), Iloilo City (18.7%), Negros Occ (17.3%), Iloilo (14.7%), Aklan (12.3%), Capiz (7.6%), Antique (4%), Guimaras (1.4%)'],
                        ['name' => 'Medium (239)', 'details' => 'Bacolod City (27.6%), Negros Occ (22.2%), Iloilo City (20.5%), Aklan (13.8%), Iloilo (9.6%), Capiz (4.2%), Antique (1.7%), Guimaras (0.4%)'],
                        ['name' => 'Large (223)', 'details' => 'Bacolod City (35.9%), Iloilo City (27.4%), Negros Occ (13.9%), Iloilo (8.1%), Aklan (6.3%), Capiz (5.8%), Antique (2.2%), Guimaras (0.4%)']
                    ]
                ],
                'source' => 'PSA Region 6 Special Release'
            ],
            [
                'page_number' => 13,
                'section_title' => 'Employment by Province',
                'type' => 'chart',
                'year_range' => '2024-2025',
                'content' => [
                    'chart_type' => 'bar',
                    'title' => 'Total Employment of Establishments (2021-2023)',
                    'categories' => ['Aklan', 'Antique', 'Capiz', 'Guimaras', 'Iloilo (inc City)', 'Negros Occ (inc Bacolod)'],
                    'series' => [
                        ['name' => '2021', 'data' => [30841, 20256, 32406, 4828, 146410, 209600]],
                        ['name' => '2022', 'data' => [32996, 19851, 34791, 5201, 150969, 207238]],
                        ['name' => '2023', 'data' => [51452, 25451, 42683, 6951, 165833, 237824]]
                    ]
                ],
                'source' => 'PSA Region 6 Special Release'
            ],
            [
                'page_number' => 16,
                'section_title' => 'Higher Education Institutions (HEIs)',
                'type' => 'stats_grid',
                'year_range' => '2024-2025',
                'content' => [
                    'stats' => [
                        ['label' => 'Total HEIs', 'value' => '102'],
                        ['label' => 'Graduates', 'value' => '20,391'],
                        ['label' => 'State Universities', 'value' => '46'],
                        ['label' => 'Local Universities', 'value' => '7']
                    ],
                    'modal_details' => [
                        'By Province' => [
                            'Iloilo City' => '29 HEIs (28%)',
                            'Iloilo' => '27 HEIs (26%)',
                            'Capiz' => '17 HEIs (17%)',
                            'Aklan' => '16 HEIs (16%)',
                            'Antique' => '9 HEIs (9%)',
                            'Guimaras' => '4 HEIs (4%)'
                        ],
                        'Graduates by Program' => 'Business Admin, Engineering/Tech, IT-Related, Medical/Allied, Mass Comm, Math/Fine/Applied Arts.',
                        'Type Distribution' => [
                            'Public (SUCs/LUCs)' => '53 (51.96%)',
                            'Private' => '49 (48.04%)'
                        ]
                    ]
                ],
                'source' => 'CHED - Statistical Bulletin AY 2024-2025'
            ],
            [
                'page_number' => 3,
                'section_title' => 'Transportation Infrastructure',
                'type' => 'grid',
                'year_range' => '2024-2025',
                'content' => [
                    'items' => [
                        [
                            'name' => '9 Airports', 
                            'details' => '6 CAAP-operated and 3 additional airstrips for private use (Sipalay, Sicogon, Semirara Island).',
                            'modal_details' => [
                                'Map Points' => [
                                    ['label' => 'Iloilo Intl Airport', 'lat' => 10.8327, 'lng' => 122.5451],
                                    ['label' => 'Bacolod-Silay Airport', 'lat' => 10.7788, 'lng' => 123.0126],
                                    ['label' => 'Kalibo Intl Airport', 'lat' => 11.6806, 'lng' => 122.3768],
                                    ['label' => 'Godofredo P. Ramos (Caticlan)', 'lat' => 11.9248, 'lng' => 121.9542],
                                    ['label' => 'Roxas Airport', 'lat' => 11.5979, 'lng' => 122.7534],
                                    ['label' => 'Evelio B. Javier (Antique)', 'lat' => 10.7667, 'lng' => 121.9218],
                                    ['label' => 'Sicogon Airstrip', 'lat' => 11.4583, 'lng' => 123.2333],
                                    ['label' => 'Semirara Airstrip', 'lat' => 12.0667, 'lng' => 121.4000],
                                    ['label' => 'Sipalay Airstrip', 'lat' => 9.8167, 'lng' => 122.4000]
                                ]
                            ]
                        ],
                        [
                            'name' => '152 Ports', 
                            'details' => '49 fishing ports, 69 private commercial ports, 23 public commercial ports, and 11 feeder ports.',
                            'modal_details' => [
                                'Map Points' => [
                                    ['label' => 'Port of Iloilo', 'lat' => 10.6970, 'lng' => 122.5800],
                                    ['label' => 'Port of Dumangas', 'lat' => 10.7925, 'lng' => 122.6880],
                                    ['label' => 'Port of Caticlan', 'lat' => 11.9272, 'lng' => 121.9540],
                                    ['label' => 'Port of Culasi (Roxas)', 'lat' => 11.5977, 'lng' => 122.7230],
                                    ['label' => 'BREDCO Port (Bacolod)', 'lat' => 10.6720, 'lng' => 122.9320],
                                    ['label' => 'Port of Banago', 'lat' => 10.6953, 'lng' => 122.9372],
                                    ['label' => 'Port of San Jose (Antique)', 'lat' => 10.7500, 'lng' => 121.9300],
                                    ['label' => 'Estancia Port', 'lat' => 11.4500, 'lng' => 123.1500]
                                ]
                            ]
                        ]
                    ]
                ],
                'source' => 'CAAP / Wikipedia / WV RSET'
            ],
            [
                'page_number' => 20,
                'section_title' => 'Telecommunications',
                'type' => 'stats_grid',
                'year_range' => '2024-2025',
                'content' => [
                    'stats' => [
                        ['label' => 'Cell Towers', 'value' => '1,027'],
                        ['label' => 'Wi-Fi Hotspots', 'value' => '293'],
                        ['label' => 'Fiber-optic', 'value' => '20']
                    ],
                    'description' => 'Scattered and installed all-over the region to provide fast and stable internet connectivity!'
                ],
                'source' => 'DICT Region VI (2016-2021)'
            ],
            [
                'page_number' => 22,
                'section_title' => 'Operating PEZA Sites',
                'type' => 'stats_grid',
                'year_range' => '2024-2025',
                'content' => [
                    'stats' => [
                        ['label' => 'Total PEZA Sites', 'value' => '23'],
                        ['label' => 'Bacolod City', 'value' => '12'],
                        ['label' => 'Iloilo City', 'value' => '6'],
                        ['label' => 'Negros Occidental', 'value' => '3']
                    ],
                    'modal_details' => [
                        'Breakdown' => [
                            'Aklan' => '1 Site',
                            'Capiz' => '1 Site'
                        ]
                    ]
                ],
                'source' => 'PEZA Registered Special Economic Zone (Feb 2023)'
            ],
            [
                'page_number' => 23,
                'section_title' => 'Visayas Logistics Opportunities',
                'type' => 'grid',
                'year_range' => '2024-2025',
                'content' => [
                    'items' => [
                        ['name' => 'Seaport & Airport', 'details' => 'Large scale cargo and transport hub potential.'],
                        ['name' => 'Warehouse & Storage', 'details' => 'Ready for internal and external logistics views.'],
                        ['name' => 'Agri & Food Terminal', 'details' => 'Dedicated processing plants and bagsakan centers.'],
                        ['name' => 'Public Infrastructure', 'details' => 'Railway, roads, bridges, and ICT Infrastructure.']
                    ]
                ],
                'source' => 'VIZ Logistics Cluster Consultations 2022'
            ],
            [
                'page_number' => 24,
                'section_title' => 'Why Invest in Western Visayas?',
                'type' => 'grid',
                'year_range' => '2024-2025',
                'content' => [
                    'items' => [
                        ['name' => 'Natural Resources', 'details' => 'Abundant in natural resources and agricultural potential.'],
                        ['name' => 'Human Capital', 'details' => 'Competitive and skilled human capital.'],
                        ['name' => 'Strategic Environment', 'details' => 'Collaborative environment, strategic location, and generally peaceful.'],
                        ['name' => 'Economic Potential', 'details' => 'High demand for logistics and high potential for economic growth.'],
                        ['name' => 'Infrastructure', 'details' => 'Presence of logistics infrastructure and sufficient power supply.']
                    ]
                ],
                'source' => 'VIZ Logistics Cluster'
            ],
            [
                'page_number' => 25,
                'section_title' => 'Province Priority Industries',
                'type' => 'grid',
                'year_range' => '2024-2025',
                'content' => [
                    'items' => [
                        ['name' => 'ILOILO', 'details' => 'Tourism, Processed Food, IT-BPM.'],
                        ['name' => 'GUIMARAS', 'details' => 'Fruits (Mangoes), Nuts (Cashews).'],
                        ['name' => 'ANTIQUE', 'details' => 'Bamboo, Processed Food (Kalamay).'],
                        ['name' => 'AKLAN', 'details' => 'Wearables & Homestyle (Piña cloth), Tourism (Boracay), Processed Food.'],
                        ['name' => 'CAPIZ', 'details' => 'Aquamarine (Seafood), IT-BPM.'],
                        ['name' => 'NEGROS OCCIDENTAL', 'details' => 'Sugar Industry, Wearables & Homestyle, IT-BPM, Processed Food.']
                    ]
                ],
                'source' => 'DTI Western Visayas'
            ],
            [
                'page_number' => 26,
                'section_title' => 'DTI 6 Priority Industry Clusters',
                'type' => 'grid',
                'year_range' => '2024-2025',
                'content' => [
                    'items' => [
                        [
                            'name' => 'Coffee', 
                            'details' => 'Area: 9,914.32 ha. Production: 2,089.84 MT (Green Coffee Beans). Yield: 0.42 MT/HA. Anchor firms: Sugar Valley Coffee, Coffee Culture Roastery, Kape Iloilo.'
                        ],
                        [
                            'name' => 'Cacao', 
                            'details' => 'Farm Area: 1,048.48 ha. Bearing Trees: 94,158. Avg Production: 21,988 kg/year. 230 Farmers/Organizations profiled.'
                        ],
                        [
                            'name' => 'Processed Fruits & Nuts', 
                            'details' => 'Priority: Mango, Pineapple, Papaya, Peanut, Banana, Calamansi, Cashew. Mango (179k MT, 11 Processors), Banana (757k MT, 90 Processors).'
                        ],
                        [
                            'name' => 'Coconut', 
                            'details' => 'CFIDP - 31 Food Products (VCO, Vinegar, Oil) and 387 Non-Food Products (Charcoal, Coir, Lumber). Total 3 Oil Millers.'
                        ],
                        [
                            'name' => 'Bamboo', 
                            'details' => '25,535.85 ha planted. 9 Shared Service Facilities (SSF) in Region VI. 5 Major Anchor Firms supported by DTI development programs.'
                        ],
                        [
                            'name' => 'Wearables & Homestyle', 
                            'details' => 'WV raw materials: Aklan (Piña, Abaca), Antique (Buri, Bamboo), Capiz (Shells), Guimaras (Pandan), Iloilo (Abaca), Negros (Silk).'
                        ],
                        [
                            'name' => 'IT-BPM', 
                            'details' => '200+ companies (Concentrix, Teleperformance). 50 Assisted Startups (2021-2024). Programs: Slingshot Region 6, Moonshot TNK.'
                        ]
                    ]
                ],
                'source' => 'DTI Region VI- Annual Report / CoCa data'
            ],
            [
                'page_number' => 35,
                'section_title' => 'Growth Strategies',
                'type' => 'list',
                'year_range' => '2024-2025',
                'content' => [
                    'items' => [
                        'Inclusive and Resilient Tourism Development',
                        'Digital Transformation and MSME Empowerment',
                        'Creative and Service Sector Promotion',
                        'Regional Industrialization and Innovation',
                        'Workforce Upskilling and Technology Adoption'
                    ]
                ],
                'source' => 'DTI Western Visayas'
            ],
            [
                'page_number' => 50,
                'section_title' => 'Closing CTA',
                'type' => 'cta',
                'year_range' => '2024-2025',
                'content' => [
                    'title' => "Ready to Lead in\nWestern Visayas?",
                    'description' => 'Join over 85,000 thriving businesses. DTI Region 6 is ready to provide the collaborative environment and strategic support your expansion needs.'
                ]
            ]
        ];

        foreach ($data as $item) {
            ProjectContent::create($item);
        }
    }
}
