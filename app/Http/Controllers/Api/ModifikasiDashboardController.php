<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\AssetsTransformer;
use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\Category;
use App\Models\Company;
use App\Models\Manufacturer;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Transformers\PieChartTransformer;

use App\Http\Transformers\ActionlogsTransformer;
use App\Models\Actionlog;

/**
 * Dashboard Modification for MANIA
 * 
 * Theresia R. STIS. 2024
 */
class ModifikasiDashboardController extends Controller
{
    public function getExplore($id = null, $tingkat = null, $unit = null) 
    {
        $datasets = [];
    
        $assetsInfo = Asset::join('models', 'assets.model_id', '=', 'models.id')
            ->join('manufacturers', 'models.manufacturer_id', '=', 'manufacturers.id')
            ->select(
                \DB::raw('COUNT(*) as total'),
                \DB::raw('(SUM(assets.notes LIKE "Baik%") / COUNT(*)) * 100 as good_percentage'),
                \DB::raw('AVG(assets.purchase_cost) AS avg_harga'),
                \DB::raw('manufacturers.name as brand')
            )
            ->where('models.category_id', $id);

            if ($tingkat == 2) {
                $assetsInfo->where('assets.company_id', $unit);
            } 
            $assetsInfo = $assetsInfo->groupBy('manufacturers.name')
                        ->get();
            
        // Hitung total aset dalam kategori
        $total_assets_in_category = Asset::join('models', 'assets.model_id', '=', 'models.id')
            ->where('models.category_id', $id);
            if ($tingkat == 2) {
                $total_assets_in_category->where('assets.company_id', $unit);
            } 
            $total_assets_in_category = $total_assets_in_category->count();
    
        foreach ($assetsInfo as $asset) {
            // persentase jumlah aset untuk tiap merek dalam kategori aset
            $percentage_assets = ($asset->total / $total_assets_in_category) * 100;
            $good_percentage = number_format($asset->good_percentage, 2);

            if ($percentage_assets > 1) { 
                $percentage_assets = number_format($percentage_assets, 2);
                $datasets[] = [
                    'label' => $asset->brand,
                    'title' => $asset->brand,
                    'data' => [
                        [
                            'x' => round($asset->avg_harga, 0),
                            'y' => $good_percentage,
                            'r' => $percentage_assets 
                        ]
                    ],
                    'backgroundColor' => "#EF845F", 
                    'borderColor' => "#EF845F",
                    'hoverBackgroundColor' => "#BADA55",
                    'borderWidth' => 5 
                ];
            }
        }
    
        $result = [
            'datasets' => $datasets
        ];
    
        return $result;
    }
    

    public function getAgeGroup($id = null, $tingkat = null, $unit = null, $merek = null) 
    {
        $assetsCountByAge = Asset::join('models', 'assets.model_id', '=', 'models.id')
            ->select(
                \DB::raw('
                    CASE 
                        WHEN assets.purchase_date > 0 THEN ROUND(DATEDIFF(NOW(), assets.purchase_date) / 365, 2)
                        WHEN assets.created_at > 0 THEN ROUND(DATEDIFF(NOW(), assets.created_at) / 365, 2)
                    END AS age'
                ),
                \DB::raw('SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count'),
                \DB::raw('SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count'),
                \DB::raw('SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count')
            )
            ->where('models.category_id', $id);
            if ($tingkat == 2) {
                $assetsCountByAge->where('assets.company_id', $unit);
            }
            
            if ($merek != 'all') {
                $assetsCountByAge->where('models.manufacturer_id', $merek);
            }

        $assetsCountByAge = $assetsCountByAge
            ->groupBy(\DB::raw('
                CASE 
                    WHEN assets.purchase_date > 0 THEN ROUND(DATEDIFF(NOW(), assets.purchase_date) / 365, 2)
                    WHEN assets.created_at > 0 THEN ROUND(DATEDIFF(NOW(), assets.created_at) / 365, 2)
                END'
            ))
            ->get();
        $maxAge = $assetsCountByAge->max('age');
        $minAge = 0; 
        $interval = 2;
    
        $numGroups = ceil($maxAge / $interval);
    
        $labels = [];
        $datasets = [];
    
        $goodCounts = array_fill(0, $numGroups, 0);
        $worseCounts = array_fill(0, $numGroups, 0);
        $worstCounts = array_fill(0, $numGroups, 0);
    
        foreach ($assetsCountByAge as $asset) {
            $ageGroupIndex = floor($asset->age / $interval);
    
            // Accumulate counts for each condition within the corresponding age group
            $goodCounts[$ageGroupIndex] += $asset->good_count;
            $worseCounts[$ageGroupIndex] += $asset->worse_count;
            $worstCounts[$ageGroupIndex] += $asset->worst_count;
        }
    
        for ($i = 0; $i < $numGroups; $i++) {
            $lowerBound = $minAge + ($interval * $i);
            $upperBound = $minAge + ($interval * ($i + 1));
            $labels[] = "$lowerBound-$upperBound Tahun";
        }
    
        $datasets[] = [
            "label" => "Baik",
            "data" => $goodCounts,
            "backgroundColor" => "#70AB79",
            "stack" => "Stack 1",
        ];
    
        $datasets[] = [
            "label" => "Rusak Ringan",
            "data" => $worseCounts,
            "backgroundColor" => "#F7BD7F",
            "stack" => "Stack 1",
        ];
    
        $datasets[] = [
            "label" => "Rusak Berat",
            "data" => $worstCounts,
            "backgroundColor" => "#EF845F",
            "stack" => "Stack 1",
        ];
    
        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }

    public function getBestRank($tingkat = null, $asetType = 'kelAset', $asetValue = null)
    {
        $companyNamePattern = "BPS Propinsi";
        $companyNamePattern2 = ["BPS Kabupaten%", "BPS Kota%"];
    
        if ($tingkat == 2) {
            $bpsIds = Company::whereIn('name', $companyNamePattern2)->pluck('id')->toArray();
        } elseif ($tingkat == 3) {
            $bpsIds = range(1, 25);
        } else {
            $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();
        }
    
        $labels = [];
        $datasets = [
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
        ];
    
        foreach ($bpsIds as $companyId) {
            $companyName = Company::find($companyId)->name;
    
            $query = Asset::join('models', 'assets.model_id', '=', 'models.id')
                ->where('assets.company_id', $companyId)
                ->whereNotNull('assets.notes');
    
            if ($asetType == 'kelAset') {
                if (!is_null($asetValue)) {
                    if ($asetValue == 1) {
                        // Aset TI
                        $query->whereIn('models.category_id', range(1, 97));
                    } elseif ($asetValue == 2) {
                        // Aset non-TI
                        $query->whereIn('models.category_id', range(118, 210));
                    }
                } else {
                    $query->whereIn('models.category_id', range(1, 210));
                }
            } elseif ($asetType == 'katAset') {
                if (!is_null($asetValue)) {
                    $query->where('models.category_id', $asetValue);
                }
            }
    
            $query->selectRaw('
                COUNT(*) AS total,
                SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count,
                SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count
            ');
    
            $assetCounts = $query->first();
    
            // Calculate percentages
            $total = $assetCounts->total;
            $percentRusakBerat = round(($assetCounts->worst_count / $total) * 100, 2);
            $percentRusakRingan = round(($assetCounts->worse_count / $total) * 100, 2);
            $percentBaik = round(($assetCounts->good_count / $total) * 100, 2);
    
            $companyCounts[] = [
                'company_name' => $companyName,
                'Rusak Ringan' => $percentRusakRingan,
                'Rusak Berat' => $percentRusakBerat,
                'Baik' => $percentBaik
            ];
        }
    
        usort($companyCounts, function ($a, $b) {
            return $b['Baik'] - $a['Baik'];
        });
    
        foreach ($companyCounts as $company) {
            $labels[] = $company['company_name'];
            $datasets[0]["data"][] = $company['Baik'];
            $datasets[1]["data"][] = $company['Rusak Ringan'];
            $datasets[2]["data"][] = $company['Rusak Berat'];
        }
    
        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }



    public function getWorstPercentage($id = null, $tingkat = null, $unit = null, $years = 'all', $status = null)
{
    $companyNamePattern = 'BPS Propinsi';
    $companyNamePattern2 = ['BPS Kabupaten%', 'BPS Kota%'];     

    if ($tingkat == 3) {
        $bpsIds = Company::where(function ($query) use ($companyNamePattern2) {
            foreach ($companyNamePattern2 as $pattern) {
                $query->orWhere('name', 'like', $pattern);
            }
        })->pluck('id')->toArray();
    } elseif ($tingkat == 2) {
        $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();  
    }

    $query = Asset::join('models', 'assets.model_id', '=', 'models.id')
        ->join('categories', 'models.category_id', '=', 'categories.id');

        if ($status == 1) {
            $query->where('assets.status_id', 1);
        } elseif ($status == 2) {
            $query->where('assets.status_id', 2)
                  ->whereNull('assets.assigned_to');
        } elseif ($status == 3) {
            $query->where('assets.status_id', 2)
                  ->whereNotNull('assets.assigned_to');
        } elseif ($status == 4) {
            $query->where('assets.status_id', 4);
        }
        
    if ($tingkat == 2 || $tingkat == 3) {
        $query->whereIn('assets.company_id', $bpsIds);
    } elseif ($tingkat == 4) {
        $query->where('assets.company_id', $unit);
    }

    $query->selectRaw('
            categories.name as category_name,
            COUNT(*) as total_assets,
            SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
            SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
            SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
        ');

    if ($years != 'all') {
        $years = explode(',', $years);
        $query->whereIn(\DB::raw('YEAR(IFNULL(assets.purchase_date, assets.created_at))'), $years);
    }

    $query->groupBy('categories.name');

    if (!is_null($id)) {
        if ($id == 1) {
            $query->whereIn('models.category_id', range(1, 97));
        } elseif ($id == 2) {
            $query->whereIn('models.category_id', range(118, 210));
        }
    }

    $assetsCountByCategory = $query->get();

    // Calculate percentages and store in a new array
    $categoriesWithWorstPercentages = [];
    foreach ($assetsCountByCategory as $assetCounts) {
        $total_assets = $assetCounts->total_assets;
        if ($total_assets > 1) {
            $percentRusakBerat = round(($assetCounts->worst_count / $total_assets) * 100, 2);
            $percentRusakRingan = round(($assetCounts->worse_count / $total_assets) * 100, 2);
            $percentBaik = round(($assetCounts->good_count / $total_assets) * 100, 2);
            $categoriesWithWorstPercentages[] = [
                'category_name' => $assetCounts->category_name,
                'percentRusakBerat' => $percentRusakBerat,
                'percentRusakRingan' => $percentRusakRingan,
                'percentBaik' => $percentBaik,
            ];
        }
    }

    // Sort by percentage of Rusak Berat in descending order
    usort($categoriesWithWorstPercentages, function($a, $b) {
            return ($b['percentRusakRingan']+$b['percentRusakBerat']) - ($a['percentRusakRingan']+$a['percentRusakBerat']);
    });

    // Prepare data for the top 20 categories
    $labels = [];
    $datasets = [
        [
            "label" => "Baik",
            "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
            "data" => [],
            "stack" => "Stack 1",
        ],
        [
            "label" => "Rusak Ringan",
            "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
            "data" => [],
            "stack" => "Stack 1",
        ],
        [
            "label" => "Rusak Berat",
            "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
            "data" => [],
            "stack" => "Stack 1",
        ],
    ];

    $topCategories = array_slice($categoriesWithWorstPercentages, 0, 15);
    foreach ($topCategories as $category) {
        $labels[] = $category['category_name'];
        $datasets[0]["data"][] = $category['percentBaik'];
        $datasets[1]["data"][] = $category['percentRusakRingan'];
        $datasets[2]["data"][] = $category['percentRusakBerat'];
    }

    return [
        "labels" => $labels,
        "datasets" => $datasets,
    ];
}



    public function getUnitRank($tingkat = null, $asetType = 'kelAset', $asetValue = null)
    {
        $companyNamePattern = "BPS Propinsi";
        $companyNamePattern2 = ["BPS Kabupaten%", "BPS Kota%"];
    
        if ($tingkat == 2) {
            $bpsIds = Company::where(function ($query) use ($companyNamePattern2) {
                foreach ($companyNamePattern2 as $pattern) {
                    $query->orWhere('name', 'like', $pattern);
                }
            })->pluck('id')->toArray();
        } elseif ($tingkat == 3) {
            $bpsIds = range(1, 25);
        } else {
            $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();
        }
    
        $labels = [];
        $datasets = [
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Pegawai",
                "backgroundColor" => '#00876C',
                "data" => [],
                "stack" => "Stack 0",
            ],
        ];
    
        $companyCounts = [];
    
        foreach ($bpsIds as $companyId) {
            $query = Asset::join('companies', 'assets.company_id', '=', 'companies.id')
                ->join('models', 'assets.model_id', '=', 'models.id')
                ->join('categories', 'models.category_id', '=', 'categories.id')
                ->selectRaw('
                    companies.name,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                    SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count,
                    SUM(CASE WHEN assets.notes LIKE "%" THEN 1 ELSE 0 END) AS total_count
                ')
                ->where('assets.company_id', $companyId);
    
                if ($asetType == 'kelAset') {
                    if (!is_null($asetValue)) {
                        if ($asetValue == 1) {
                            // Aset TI
                            $query->whereIn('models.category_id', range(1, 97));
                        } elseif ($asetValue == 2) {
                            // Aset non-TI
                            $query->whereIn('models.category_id', range(118, 210));
                        }
                    } else {
                        $query->whereIn('models.category_id', range(1, 210));
                    }
                } elseif ($asetType == 'katAset') {
                    if (!is_null($asetValue)) {
                        $query->where('models.category_id', $asetValue);
                    }
                }
    
            $assetCounts = $query->first();
            $userCount = User::where('company_id', $companyId)->count();
    
            $companyCounts[] = [
                'company_name' => $assetCounts->name,
                'Baik' => $assetCounts->good_count,
                'Rusak Ringan' => $assetCounts->worse_count,
                'Rusak Berat' => $assetCounts->worst_count,
                'Total Aset' => $assetCounts->total_count,
                'Pegawai' => $userCount ?? 0
            ];
        }
    
        usort($companyCounts, function($a, $b) {
            return ($b['Total Aset']) - ($a['Total Aset']);
        });
    
        $topCompanies = array_slice($companyCounts, 0, 8);
    
        foreach ($topCompanies as $company) {
            if (isset($company['company_name']) && $company['company_name'] !== null) {
            $labels[] = $company['company_name'];
            $datasets[0]["data"][] = $company['Baik'];
            $datasets[1]["data"][] = $company['Rusak Ringan'];
            $datasets[2]["data"][] = $company['Rusak Berat'];
            $datasets[3]["data"][] = $company['Pegawai'];
            }
        }
    
        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }


    public function getUnitRankbyProv($id = null, $asetType = 'kelAset', $asetValue = null)
    {
        $kodeWil = Company::where('id', $id)->pluck('kode_wil')->first(); 

        if ($kodeWil) {
            $kodeProv = substr($kodeWil, 0, 2);     

            if ($id == 36) {
                $bpsIds = Company::where('kode_wil', 'like', $kodeProv . '%')->pluck('id')->toArray();
                // $bpsIds = array_merge($bpsIds, range(1, 25));
            } elseif ($id > 25 && $id != 36) {
                $bpsIds = Company::where('kode_wil', 'like', $kodeProv . '%')->pluck('id')->toArray();
            } else {
                $bpsIds = [];
            }
        } else {
            $bpsIds = [];
        }

    
        $labels = [];
        $datasets = [
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Pegawai",
                "backgroundColor" => '#00876C',
                "data" => [],
                "stack" => "Stack 0",
            ],
        ];
    
        $companyCounts = [];
    
        foreach ($bpsIds as $companyId) {
            $query = Asset::join('companies', 'assets.company_id', '=', 'companies.id')
                ->join('models', 'assets.model_id', '=', 'models.id')
                ->join('categories', 'models.category_id', '=', 'categories.id')
                ->selectRaw('
                    companies.name,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                    SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count,
                    SUM(CASE WHEN assets.notes LIKE "%" THEN 1 ELSE 0 END) AS total_count
                ')
                ->where('assets.company_id', $companyId);
    
                if ($asetType == 'kelAset') {
                    if (!is_null($asetValue)) {
                        if ($asetValue == 1) {
                            // Aset TI
                            $query->whereIn('models.category_id', range(1, 97));
                        } elseif ($asetValue == 2) {
                            // Aset non-TI
                            $query->whereIn('models.category_id', range(118, 210));
                        }
                    } else {
                        $query->whereIn('models.category_id', range(1, 210));
                    }
                } elseif ($asetType == 'katAset') {
                    if (!is_null($asetValue)) {
                        $query->where('models.category_id', $asetValue);
                    }
                }
    
            $assetCounts = $query->first();
            $userCount = User::where('company_id', $companyId)->count();
    
            $companyCounts[] = [
                'company_name' => $assetCounts->name,
                'Baik' => $assetCounts->good_count,
                'Rusak Ringan' => $assetCounts->worse_count,
                'Rusak Berat' => $assetCounts->worst_count,
                'Total Aset' => $assetCounts->total_count,
                'Pegawai' => $userCount ?? 0
            ];
        }
    
        usort($companyCounts, function($a, $b) {
            return ($b['Total Aset']) - ($a['Total Aset']);
        });
    
        $topCompanies = array_slice($companyCounts, 0, 8);
    
        foreach ($topCompanies as $company) {
            if (isset($company['company_name']) && $company['company_name'] !== null) {
            $labels[] = $company['company_name'];
            $datasets[0]["data"][] = $company['Baik'];
            $datasets[1]["data"][] = $company['Rusak Ringan'];
            $datasets[2]["data"][] = $company['Rusak Berat'];
            $datasets[3]["data"][] = $company['Pegawai'];
            }
        }
    
        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }


    
    







    public function getWorstRank($tingkat = null, $asetType = 'kelAset', $asetValue = null)
    {
        $companyNamePattern = "BPS Propinsi";
        $companyNamePattern2 = ["BPS Kabupaten%", "BPS Kota%"];
    
        if ($tingkat == 2) {
            $bpsIds = Company::where(function ($query) use ($companyNamePattern2) {
                foreach ($companyNamePattern2 as $pattern) {
                    $query->orWhere('name', 'like', $pattern);
                }
            })->pluck('id')->toArray();
        } elseif ($tingkat == 3) {
            $bpsIds = range(1, 25);
        } else {
            $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();
        }
    
        $labels = [];
        $datasets = [
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "stack" => "Stack 0",
            ],
        ];
    
        $companyCounts = [];
    
        foreach ($bpsIds as $companyId) {
            $query = Asset::join('companies', 'assets.company_id', '=', 'companies.id')
                ->join('models', 'assets.model_id', '=', 'models.id')
                ->join('categories', 'models.category_id', '=', 'categories.id')
                ->selectRaw('
                    companies.name,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                    SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
                ')
                ->where('assets.company_id', $companyId);
    
                if ($asetType == 'kelAset') {
                    if (!is_null($asetValue)) {
                        if ($asetValue == 1) {
                            // Aset TI
                            $query->whereIn('models.category_id', range(1, 97));
                        } elseif ($asetValue == 2) {
                            // Aset non-TI
                            $query->whereIn('models.category_id', range(118, 210));
                        }
                    } else {
                        $query->whereIn('models.category_id', range(1, 210));
                    }
                } elseif ($asetType == 'katAset') {
                    if (!is_null($asetValue)) {
                        $query->where('models.category_id', $asetValue);
                    }
                }
    
            $assetCounts = $query->first();
    
            $companyCounts[] = [
                'company_name' => $assetCounts->name,
                'Rusak Berat' => $assetCounts->worst_count,
                'Rusak Ringan' => $assetCounts->worse_count,
                'Baik' => $assetCounts->good_count
            ];
        }
    
        usort($companyCounts, function($a, $b) {
            return $b['Rusak Berat'] - $a['Rusak Berat'];
        });
    
        $topCompanies = array_slice($companyCounts, 0, 8, true);
    
        foreach ($topCompanies as $company) {
            $labels[] = $company['company_name'];
            $datasets[0]["data"][] = $company['Rusak Berat'];
            $datasets[1]["data"][] = $company['Rusak Ringan'];
            $datasets[2]["data"][] = $company['Baik'];
        }
    
        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }

    public function getRank($tingkat = null, $asetType = 'kelAset', $asetValue = null, $notes = null)
    {
        $companyNamePattern = "BPS Propinsi";
        $companyNamePattern2 = ["BPS Kabupaten%", "BPS Kota%"];
    
        if ($tingkat == 2) {
            $bpsIds = Company::where(function ($query) use ($companyNamePattern2) {
                foreach ($companyNamePattern2 as $pattern) {
                    $query->orWhere('name', 'like', $pattern);
                }
            })->pluck('id')->toArray();
        }  elseif ($tingkat == 3) {
            $bpsIds = range(1, 25);
        } else {
            $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();
        }
    
        $labels = [];
        $datasets = [
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "stack" => "Stack 0",
            ],
        ];
    
        $companyCounts = [];
    
        foreach ($bpsIds as $companyId) {
            $query = Asset::join('companies', 'assets.company_id', '=', 'companies.id')
                ->join('models', 'assets.model_id', '=', 'models.id')
                ->join('categories', 'models.category_id', '=', 'categories.id')
                ->selectRaw('
                    companies.name,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                    SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
                ')
                ->where('assets.company_id', $companyId);
    
                if ($asetType == 'kelAset') {
                    if (!is_null($asetValue)) {
                        if ($asetValue == 1) {
                            // Aset TI
                            $query->whereIn('models.category_id', range(1, 97));
                        } elseif ($asetValue == 2) {
                            // Aset non-TI
                            $query->whereIn('models.category_id', range(118, 210));
                        }
                    } else {
                        $query->whereIn('models.category_id', range(1, 210));
                    }
                } elseif ($asetType == 'katAset') {
                    if (!is_null($asetValue)) {
                        $query->where('models.category_id', $asetValue);
                    }
                }
    
            $assetCounts = $query->first();
    
            $companyCounts[] = [
                'company_name' => $assetCounts->name,
                'Rusak Ringan' => $assetCounts->worse_count,
                'Rusak Berat' => $assetCounts->worst_count,
                'Baik' => $assetCounts->good_count
            ];
        }
    
        usort($companyCounts, function($a, $b) use ($notes){
            if ($notes == 1) { 
                return $b['Rusak Berat'] - $a['Rusak Berat'];
            } elseif ($notes == 2) {
                return $b['Rusak Ringan'] - $a['Rusak Ringan'];
            } elseif ($notes == 3)  {
                return $b['Baik'] - $a['Baik'];
            }
        });
    
        $topCompanies = array_slice($companyCounts, 0, 8, true);
    
        foreach ($topCompanies as $company) {
            $labels[] = $company['company_name'];
            $datasets[0]["data"][] = $company['Rusak Ringan'];
            $datasets[1]["data"][] = $company['Rusak Berat'];
            $datasets[2]["data"][] = $company['Baik'];
        }
    
        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }


    public function getProvRank($asetType = 'kelAset', $asetValue = null, $notes = null)
    {
        $companyNamePattern = "BPS Propinsi";
        $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id', 'kode_wil')->toArray();       

        $companyCounts = [];
        foreach ($bpsIds as $kodeWil => $id) {
            $kodeProv = substr($kodeWil, 0, 2);
            $provdanturunan = [];  
            
            if ($id == 36) {
                $provdanturunan = Company::where('id', '>', 25)->where('kode_wil', 'like', $kodeProv . '%')->pluck('id')->toArray();
                $provdanturunan = array_merge($provdanturunan, range(1, 25));
            } elseif ($id > 25 && $id != 36) {
                $provdanturunan = Company::where('id', '>', 25)->where('kode_wil', 'like', $kodeProv . '%')->pluck('id')->toArray();
            } else {
                $provdanturunan[] = $id;
            }   

            $query = Asset::join('models', 'assets.model_id', '=', 'models.id')
    ->join('companies', 'assets.company_id', '=', 'companies.id')
    ->selectRaw('
        CASE 
            WHEN companies.name LIKE "Direktorat%" THEN "Propinsi DKI Jakarta"
            ELSE REPLACE(companies.name, "BPS ", "")
        END as name,
        SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
        SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
        SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
    ')
    ->whereIn('assets.company_id', $provdanturunan);
  

            if ($asetType == 'kelAset') {
                if (!is_null($asetValue)) {
                    if ($asetValue == 1) {
                        // Aset TI
                        $query->whereIn('models.category_id', range(1, 97));
                    } elseif ($asetValue == 2) {
                        // Aset non-TI
                        $query->whereIn('models.category_id', range(118, 210));
                    }
                } else {
                    $query->whereIn('models.category_id', range(1, 210));
                }
            } elseif ($asetType == 'katAset') {
                if (!is_null($asetValue)) {
                    $query->where('models.category_id', $asetValue);
                }
            }   

            $assetCounts = $query->first(); 

            if ($assetCounts) {
                $companyCounts[] = [
                    'company_name' => $assetCounts->name,
                    'Rusak Ringan' => $assetCounts->worse_count,
                    'Rusak Berat' => $assetCounts->worst_count,
                    'Baik' => $assetCounts->good_count
                ];
            }
        }   

        usort($companyCounts, function($a, $b) use ($notes){
            if ($notes == 1) { 
                return $b['Rusak Berat'] - $a['Rusak Berat'];
            } elseif ($notes == 2) {
                return $b['Rusak Ringan'] - $a['Rusak Ringan'];
            } elseif ($notes == 3)  {
                return $b['Baik'] - $a['Baik'];
            }
        }); 

        $labels = [];
        $datasets = [
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "stack" => "Stack 0",
            ],
        ];  

        $badCompanies = array_slice($companyCounts, 0, 8);
        foreach ($badCompanies as $company) {
            $labels[] = $company['company_name'];
            $datasets[0]["data"][] = $company['Rusak Ringan'];
            $datasets[1]["data"][] = $company['Rusak Berat'];
            $datasets[2]["data"][] = $company['Baik'];
        }   

        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }



    public function getHardwareNotes($id = null, $tingkat = null, $unit = null, $years = 'all', $status = null)
    {
        $companyNamePattern = "BPS Propinsi";
        $companyNamePattern2 = ["BPS Kabupaten%", "BPS Kota%"];     

        if ($tingkat == 3) {
            $bpsIds = Company::where(function ($query) use ($companyNamePattern2) {
                foreach ($companyNamePattern2 as $pattern) {
                    $query->orWhere('name', 'like', $pattern);
                }
            })->pluck('id')->toArray();
        } elseif ($tingkat == 2) {
            $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();  
        }       

        $query = Asset::join('models', 'assets.model_id', '=', 'models.id');

        if ($status == 1) {
            $query->where('assets.status_id', 1);
        } elseif ($status == 2) {
            $query->where('assets.status_id', 2)
                  ->whereNull('assets.assigned_to');
        } elseif ($status == 3) {
            $query->where('assets.status_id', 2)
                  ->whereNotNull('assets.assigned_to');
        } elseif ($status == 4) {
            $query->where('assets.status_id', 4);
        }
        
        if ($tingkat == 2 || $tingkat == 3) {
            $query->whereIn('assets.company_id', $bpsIds);
        } elseif ($tingkat == 4) {
            $query->where('assets.company_id', $unit);
        }

        if ($years != 'all') {
            $years = explode(',', $years);
            $query->whereIn(\DB::raw('YEAR(IFNULL(assets.purchase_date, assets.created_at))'), $years);
        } 

        $query->selectRaw('
                    CASE 
                        WHEN assets.notes LIKE "Baik%" THEN "Baik"
                        WHEN assets.notes LIKE "Rusak Berat%" THEN "Rusak Berat"
                        ELSE "Rusak Ringan"
                    END AS notes_category,
                    COUNT(*) as notes_count
                ');
        
        if (!is_null($id)) {
            if ($id == 1) {
                $query->whereIn('models.category_id', range(1, 97));
            } elseif ($id == 2) {
                $query->whereIn('models.category_id', range(118, 210));
            }
        }
        
        $assetsCountByNotes = $query->groupBy('notes_category')->get();
        
    
        $total = [];
    
        foreach ($assetsCountByNotes as $assetnotes) {
            $total[$assetnotes->notes_category]['label'] = $assetnotes->notes_category;
            $total[$assetnotes->notes_category]['count'] = $assetnotes->notes_count;
            $total[$assetnotes->notes_category]['color'] = $this->getColorForCategory($assetnotes->notes_category, $assetnotes->color);
        }
    
        return (new PieChartTransformer())->transformPieChartDate($total);
    }


    public function getWorstCat($id = null, $tingkat = null, $unit = null, $years = 'all')
    {
        $companyNamePattern = "BPS Propinsi";
        $companyNamePattern2 = ["BPS Kabupaten%", "BPS Kota%"]; 

        if ($tingkat == 3) {
            $bpsIds = Company::where(function ($query) use ($companyNamePattern2) {
                foreach ($companyNamePattern2 as $pattern) {
                    $query->orWhere('name', 'like', $pattern);
                }
            })->pluck('id')->toArray();
        } elseif ($tingkat == 2) {
            $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();
        }   

        $query = Asset::join('models', 'assets.model_id', '=', 'models.id')
            ->join('categories', 'models.category_id', '=', 'categories.id');   

        if ($tingkat == 2 || $tingkat == 3) {
            $query->whereIn('assets.company_id', $bpsIds);
        } elseif ($tingkat == 4) {
            $query->where('assets.company_id', $unit);
        }

        if ($years != 'all') {
            $years = explode(',', $years);
            $query->whereIn(\DB::raw('YEAR(IFNULL(assets.purchase_date, assets.created_at))'), $years);
        } 

        if (!is_null($id)) {
            if ($id == 1) {
                $query->whereIn('models.category_id', range(1, 97));
            } elseif ($id == 2) {
                $query->whereIn('models.category_id', range(118, 210));
            }
        }   

        $assetsCountByCategory = $query->selectRaw('
                categories.name as category_name,
                SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
            ')
            ->groupBy('categories.name')
            ->orderByDesc('worst_count')
            ->limit(5)
            ->get();    

        $labels = [];
        $datasets = [
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
            ],
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
            ],
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
            ],
        ];  

        foreach ($assetsCountByCategory as $assetnotes) {
            $labels[] = $assetnotes->category_name; 

            $datasets[0]["data"][] = $assetnotes->worst_count;
            $datasets[1]["data"][] = $assetnotes->worse_count;
            $datasets[2]["data"][] = $assetnotes->good_count;
        }   

        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }

    public function getAsetDisewa()
    {
        $assetsCountByCategory = Asset::join('models', 'assets.model_id', '=', 'models.id')
            ->join('categories', 'models.category_id', '=', 'categories.id')
            ->where('assets.notes', 'LIKE', '%Digunakan%Lain%')
            ->selectRaw('
                categories.name as category_name,
                COUNT(*) as total_assets,
                SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
            ')
            ->groupBy('categories.name')
            ->orderByDesc('total_assets')
            ->get();    

        $labels = [];
        $datasets = [
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            
        ];  

        foreach ($assetsCountByCategory as $assetnotes) {
            $labels[] = $assetnotes->category_name; 

            $datasets[0]["data"][] = $assetnotes->good_count;
            $datasets[1]["data"][] = $assetnotes->worse_count;
            $datasets[2]["data"][] = $assetnotes->worst_count;
        }   

        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }

    public function getAsetUnused()
    {
        $assetsCountByCategory = Asset::join('models', 'assets.model_id', '=', 'models.id')
            ->join('categories', 'models.category_id', '=', 'categories.id')   
            ->where('assets.notes', 'LIKE', '%Tidak%Digunakan%')
            ->selectRaw('
                categories.name as category_name,
                COUNT(*) as total_assets,
                SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
            ')
            ->groupBy('categories.name')
            ->orderByDesc('total_assets')
            ->get();    

        $labels = [];
        $datasets = [
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            
        ];  

        foreach ($assetsCountByCategory as $assetnotes) {
            $labels[] = $assetnotes->category_name; 

            $datasets[0]["data"][] = $assetnotes->good_count;
            $datasets[1]["data"][] = $assetnotes->worse_count;
            $datasets[2]["data"][] = $assetnotes->worst_count;
        }   

        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }

    
    public function getLatestCat($id = null, $tingkat = null, $unit = null, $years = 'all', $status = null)
    {
        $companyNamePattern = "BPS Propinsi";
        $companyNamePattern2 = ["BPS Kabupaten%", "BPS Kota%"];     

        if ($tingkat == 3) {
            $bpsIds = Company::where(function ($query) use ($companyNamePattern2) {
                foreach ($companyNamePattern2 as $pattern) {
                    $query->orWhere('name', 'like', $pattern);
                }
            })->pluck('id')->toArray();
        } elseif ($tingkat == 2) {
            $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();  
        }       

        $query = Asset::join('models', 'assets.model_id', '=', 'models.id')
            ->join('categories', 'models.category_id', '=', 'categories.id');

            if ($status == 1) {
                $query->where('assets.status_id', 1);
            } elseif ($status == 2) {
                $query->where('assets.status_id', 2)
                      ->whereNull('assets.assigned_to');
            } elseif ($status == 3) {
                $query->where('assets.status_id', 2)
                      ->whereNotNull('assets.assigned_to');
            } elseif ($status == 4) {
                $query->where('assets.status_id', 4);
            }
            
            if ($tingkat == 2 || $tingkat == 3) {
                $query->whereIn('assets.company_id', $bpsIds);
            } elseif ($tingkat == 4) {
                $query->where('assets.company_id', $unit);
            }

        $query->selectRaw('
                categories.name as category_name,
                COUNT(*) as total_assets,
                SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
            ');

            if ($years != 'all') {
                $years = explode(',', $years);
                $query->whereIn(\DB::raw('YEAR(IFNULL(assets.purchase_date, assets.created_at))'), $years);
            } 

            $query->groupBy('categories.name')
                    ->orderByDesc('total_assets');
       
            if (!is_null($id)) {
                if ($id == 1) {
                    $query->whereIn('models.category_id', range(1, 97));
                } elseif ($id == 2) {
                    $query->whereIn('models.category_id', range(118, 210));
                }
            }
    
        $assetsCountByCategory = $query->limit(30)->get();
    
        $labels = [];
        $datasets = [
            [
                "label" => "Baik",
                "backgroundColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Ringan",
                "backgroundColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            [
                "label" => "Rusak Berat",
                "backgroundColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "stack" => "Stack 1",
            ],
            
        ];
    
        foreach ($assetsCountByCategory as $assetnotes) {
            $labels[] = $assetnotes->category_name;
    
            $datasets[0]["data"][] = $assetnotes->good_count;
            $datasets[1]["data"][] = $assetnotes->worse_count;
            $datasets[2]["data"][] = $assetnotes->worst_count;
        }
    
        return [
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }
    
    private function getColorForCategory($category, $defaultColor)
    {
        switch ($category) {
            case 'Baik':
                return '#70AB79';
            case 'Rusak Berat':
                return '#EF845F';
            default:
                return ($defaultColor != '') ? $defaultColor : '#F7BD7F'; 
        }
    }

    public function getFirstValue($id = null, $tingkat = null, $unit = null, $years = 'all')
    {
        $companyNamePattern = "BPS Propinsi";
        $companyNamePattern2 = ["BPS Kabupaten%", "BPS Kota%"];     

        if ($tingkat == 3) { 
            // Level kabkota
            $bpsIds = Company::where(function ($query) use ($companyNamePattern2) {
                foreach ($companyNamePattern2 as $pattern) {
                    $query->orWhere('name', 'like', $pattern);
                }
            })->pluck('id')->toArray();
        } elseif ($tingkat == 2) {
            // Level provinsi
            $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();  
        }       

        $query = Asset::join('models', 'assets.model_id', '=', 'models.id');

            if ($tingkat == 2 || $tingkat == 3) {
                $query->whereIn('assets.company_id', $bpsIds);
            } elseif ($tingkat == 4) {
                $query->where('assets.company_id', $unit);
            }

        if (!is_null($id)) {
            if ($id == 1) {
                // Aset TI
                $query->whereIn('models.category_id', range(1, 97));
            } elseif ($id == 2) {
                // Aset non-TI
                $query->whereIn('models.category_id', range(118, 210));
            }
        } 

        $query->select(
            \DB::raw('YEAR(IFNULL(assets.purchase_date, assets.created_at)) AS year'),
            \DB::raw('SUM(purchase_cost) AS total_cost')
        );

        if ($years != 'all') {
            $years = explode(',', $years);
            $query->whereIn(\DB::raw('YEAR(IFNULL(assets.purchase_date, assets.created_at))'), $years);
        }  
        $assetsCountByYear = $query->groupBy('year')->get();

        $labels = [];
        $data = []; 

        foreach ($assetsCountByYear as $asset) {
            $labels[] = $asset->year; 
            $data[] = $asset->total_cost; 
        }   

        $result = [
            "labels" => $labels,
            "datasets" => [
                [
                    "label" => "Nilai Perolehan Pertama",
                    "borderColor" => "#00876C",
                    "data" => $data,
                    "fill" => false,
                    "tension" => 0.1
                ]
            ]
        ];  
        return $result;
    }

    public function getAssetbyTahun($id = null, $asetType = 'kelAset', $asetValue = null, $wil = 1)
    {
        if ($id != 'all') {
            $kodeWil = Company::where('id', $id)->pluck('kode_wil')->first();
        }   

        $query = Asset::join('models', 'assets.model_id', '=', 'models.id')
                ->selectRaw('
                    YEAR(IFNULL(assets.purchase_date, assets.created_at)) AS year,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                    SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                    SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
                '); 

                if ($wil == 1) {
                    if (isset($kodeWil) && substr($kodeWil, -2) == '00') {
                        $kodeProv = substr($kodeWil, 0, 2);
                
                        if ($id == 36) {
                            $bpsIds = Company::where('id', '>', 25)
                                ->where('kode_wil', 'like', $kodeProv . '%')
                                ->pluck('id')
                                ->toArray();
                            $query->whereIn('assets.company_id', $bpsIds);
                        } elseif ($id > 25 && $id != 36) {
                            $bpsIds = Company::where('kode_wil', 'like', $kodeProv . '%')
                                ->pluck('id')
                                ->toArray();
                            $query->whereIn('assets.company_id', $bpsIds);
                        }
                    }
                } else {
                    $query->where('assets.company_id', $id);
                }
                  

        if ($asetType == 'kelAset') {
            if (!is_null($asetValue)) {
                if ($asetValue == 1) {
                    // Aset TI
                    $query->whereIn('models.category_id', range(1, 97));
                } elseif ($asetValue == 2) {
                    // Aset non-TI
                    $query->whereIn('models.category_id', range(118, 210));
                }
            } else {
                $query->whereIn('models.category_id', range(1, 210));
            }
        } elseif ($asetType == 'katAset' && !is_null($asetValue)) {
            $query->where('models.category_id', $asetValue);
        }   

        $assetsCountByYear = $query->groupBy('year')->get();    

        $labels = [];
        $datasets = [
            [
                "label" => "Rusak Berat",
                "borderColor" => $this->getColorForCategory('Rusak Berat', '#EF845F'),
                "data" => [],
                "fill" => false,
                "tension" => 0.1,
            ],
            [
                "label" => "Rusak Ringan",
                "borderColor" => $this->getColorForCategory('Rusak Ringan', '#F7BD7F'),
                "data" => [],
                "fill" => false,
                "tension" => 0.1,
            ],
            [
                "label" => "Baik",
                "borderColor" => $this->getColorForCategory('Baik', '#70AB79'),
                "data" => [],
                "fill" => false,
                "tension" => 0.1,
            ],
        ];  

        foreach ($assetsCountByYear as $asset) {
            $labels[] = $asset->year; 
            $datasets[0]["data"][] = $asset->worst_count;
            $datasets[1]["data"][] = $asset->worse_count;
            $datasets[2]["data"][] = $asset->good_count;
        }       

        $result = [
            "labels" => $labels,
            "datasets" => $datasets
        ];  
        return response()->json($result);
    }


    public function getDataNasional($agg = 1, $asetType = 'kelAset', $asetValue = null) {
        $companyNamePattern = "BPS Propinsi";
        $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id', 'kode_wil')->toArray();     
    
        $petaId = [
            1 => 'id-3700', 11 => 'id-ac', 51 => 'id-ba',  36 => 'id-bt',
            17 => 'id-be', 34 => 'id-yo', 31 => 'id-jk', 75 => 'id-go', 
            15 => 'id-ja', 32 => 'id-jr', 33 => 'id-jt', 35 => 'id-ji',
            61 => 'id-kb', 63 => 'id-ks', 62 => 'id-kt', 64 => 'id-ki',
            65 => 'id-ku', 19 => 'id-bb', 21 => 'id-kr', 18 => 'id-1024',
            81 => 'id-ma', 82 => 'id-la', 52 => 'id-nb', 53 => 'id-nt',
            94 => 'id-pa', 91 => 'id-ib', 14 => 'id-ri', 76 => 'id-sr', 
            73 => 'id-se', 72 => 'id-st', 74 => 'id-sg',  71 => 'id-sw', 
            13 => 'id-sb', 16 => 'id-sl', 12 => 'id-su', 
        ];
    
        $rows = [];
    
        foreach ($bpsIds as $kodeWil => $id) {
            $kodeProv = substr($kodeWil, 0, 2);
            $provdanturunan = [];
    
            if ($id == 36) {
                $provdanturunan = Company::where('kode_wil', 'like', $kodeProv . '%')->pluck('id')->toArray();
                $provdanturunan = array_merge($provdanturunan, range(1, 25));
            } elseif ($id > 25 && $id != 36) {
                $provdanturunan = Company::where('kode_wil', 'like', $kodeProv . '%')->pluck('id')->toArray();
            }
    
            $query = Asset::join('models', 'assets.model_id', '=', 'models.id')
                    ->whereIn('assets.company_id', $provdanturunan);
    
            if ($asetType === 'kelAset') {
                if (!is_null($asetValue)) {
                    if ($asetValue == 1) {
                        // Aset TI
                        $query->whereIn('models.category_id', range(1, 97));
                    } elseif ($asetValue == 2) {
                        // Aset non-TI
                        $query->whereIn('models.category_id', range(118, 210));
                    }
                }
            } elseif ($asetType === 'katAset') {
                if (!is_null($asetValue)) {
                    $query->where('models.category_id', $asetValue);
                }
            }
    
            if ($agg == 1) { 
                $value = floatval($query->select(
                    \DB::raw('ROUND((SUM(assets.notes LIKE "Rusak Berat%") / COUNT(*)) * 100, 2) as worst_percentage')
                )
                ->value('worst_percentage'));
            } elseif ($agg == 2) { 
                $value = floatval($query->select(
                    \DB::raw('ROUND((SUM(assets.notes LIKE "Rusak Ringan%") / COUNT(*)) * 100, 2) as worse_percentage')
                )
                ->value('worse_percentage'));
            } elseif ($agg == 3) { 
                $value = floatval($query->select(
                    \DB::raw('ROUND((SUM(assets.notes LIKE "Baik%") / COUNT(*)) * 100, 2) as good_percentage')
                )
                ->value('good_percentage'));
            } 
    
            $id_area = isset($petaId[$kodeProv]) ? $petaId[$kodeProv] : '';
            $rows[] = [
                'id_area' => $id_area, 
                'value' => $value
            ];
        }
    
        return ['rows' => $rows];
    }


    
    public function getAsetSewaInfo()
{
    $assetsInfo = Asset::join('models', 'assets.model_id', '=', 'models.id')
        ->join('categories', 'models.category_id', '=', 'categories.id')
        ->join('companies', 'assets.company_id', '=', 'companies.id')
        ->where('assets.notes', 'LIKE', '%Digunakan%Lain%')
        ->select(
            'companies.name as unitkerja',
            'categories.name as category_name',
            'assets.asset_tag as nup',
            'assets._snipeit_nilai_buku_18 as nilaibuku',
            'assets.purchase_cost as harga',
            'assets.purchase_date',
            'assets.created_at',
            \DB::raw('
                CASE 
                    WHEN assets.purchase_date > 0 THEN assets.purchase_date
                    WHEN assets.created_at > 0 THEN assets.created_at
                END AS age_date'
            )
        )
        ->get();

    $assetsInfoData = $assetsInfo->map(function ($item) {
        $ageDate = $item->age_date;
        $now = new \DateTime();
        $ageDate = new \DateTime($ageDate);
        $interval = $now->diff($ageDate);
        $years = $interval->y;
        $months = $interval->m;
        $umur = "{$years} tahun {$months} bulan";

        return [
            'unitkerja' => $item->unitkerja,
            'category' => $item->category_name,
            'nup' => $item->nup,
            'umur' => $umur,
            'harga' => $item->harga,
            'nilaibuku' => $item->nilaibuku,
        ];
    });

    $total = $assetsInfoData->count();

    $result = [
        'total' => $total,
        'rows' => $assetsInfoData->toArray(),
    ];

    return response()->json($result);
}


public function getUnusedAsetInfo()
{
    $assetsInfo = Asset::join('models', 'assets.model_id', '=', 'models.id')
        ->join('categories', 'models.category_id', '=', 'categories.id')
        ->join('companies', 'assets.company_id', '=', 'companies.id')
        ->where('assets.notes', 'LIKE', '%Tidak%Digunakan%')
        ->select(
            'companies.name as unitkerja',
            'categories.name as category_name',
            'assets.asset_tag as nup',
            'assets._snipeit_nilai_buku_18 as nilaibuku',
            'assets.purchase_cost as harga',
            'assets.purchase_date',
            'assets.created_at',
            \DB::raw('
                CASE 
                    WHEN assets.purchase_date > 0 THEN assets.purchase_date
                    WHEN assets.created_at > 0 THEN assets.created_at
                END AS age_date'
            )
        )
        ->get();

    $assetsInfoData = $assetsInfo->map(function ($item) {
        $ageDate = $item->age_date;
        $now = new \DateTime();
        $ageDate = new \DateTime($ageDate);
        $interval = $now->diff($ageDate);
        $years = $interval->y;
        $months = $interval->m;
        $umur = "{$years} tahun {$months} bulan";

        return [
            'unitkerja' => $item->unitkerja,
            'category' => $item->category_name,
            'nup' => $item->nup,
            'umur' => $umur,
            'harga' => $item->harga,
            'nilaibuku' => $item->nilaibuku,
        ];
    });

    $total = $assetsInfoData->count();

    $result = [
        'total' => $total,
        'rows' => $assetsInfoData->toArray(),
    ];

    return response()->json($result);
}


    public function getHardwareInfo()
    {
        $this->authorize('index', Asset::class);

        $assetsInfo = Asset::select(
            'models.category_id',
            'categories.name as category_name',
            \DB::raw('COUNT(*) as total'),
            \DB::raw('SUM(assets.notes LIKE "Baik%") as good_count'),
            \DB::raw('SUM(assets.notes LIKE "Rusak%") as bad_count'),
            \DB::raw('CONCAT(ROUND(SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) / COUNT(*) * 100, 2), "%") as quality'),
            \DB::raw('SUM(
                CASE 
                    WHEN assets.notes LIKE "Rusak%" AND (assets.created_at > 0 OR assets.purchase_date > 0) AND DATEDIFF(NOW(), 
                    IF(assets.purchase_date > 0, assets.purchase_date, assets.created_at)) > 1825 THEN 1
                    ELSE 0
                END
            ) as moreyears_count'),
            \DB::raw('AVG(
                CASE 
                    WHEN assets.purchase_date > 0 THEN DATEDIFF(NOW(), assets.purchase_date)
                    WHEN assets.created_at > 0 THEN DATEDIFF(NOW(), assets.created_at)
                END
            ) as avg_lifespan'),
            \DB::raw('AVG(
                CASE 
                    WHEN assets.notes LIKE "Rusak%" AND (assets.created_at > 0 OR assets.purchase_date > 0) THEN DATEDIFF(NOW(), 
                    IF(assets.purchase_date > 0, assets.purchase_date, assets.created_at))
                END
            ) as avg_lifespan_bad')
        )
        ->join('models', 'assets.model_id', '=', 'models.id')
        ->leftJoin('categories', 'models.category_id', '=', 'categories.id')
        ->groupBy('models.category_id')
        ->havingRaw('quality > 0')
        ->get();
    
        $assetsInfoData= $assetsInfo->map(function ($item) {
            $days = $item->avg_lifespan;
            $months = floor($days / 30);
            $years = floor($months / 12);
            $remainingMonths = $months % 12;
            
            $daysbad = $item->avg_lifespan_bad;
            $monthsbad = floor($daysbad / 30);
            $yearsbad = floor($monthsbad / 12);
            $remainingMonthsbad = $monthsbad % 12;

            $daysgood = $item->avg_lifespan_good;
            $monthsgood = floor($daysgood / 30);
            $yearsgood = floor($monthsgood / 12);
            $remainingMonthsgood = $monthsgood % 12;

        
            return [
                'category_id' => $item->category_id,
                'category' => $item->category_name,
                'quality' => $item->quality,
                'badquality' => round(($item->bad_count/$item->total) * 100, 2),
                'badassets_count' => $item->bad_count,
                'moreyears_count' => $item->moreyears_count,
                'avggoodlifespan' => "{$yearsgood} tahun {$remainingMonthsgood} bulan",
                'avgbadlifespan' => "{$yearsbad} tahun {$remainingMonthsbad} bulan",
                'avglifespan' => "{$years} tahun {$remainingMonths} bulan",
                'total' => $item->total,
            ];
        });
        
        $total = $assetsInfoData->count();

        $result = [
            'total' => $total,
            'rows' => $assetsInfoData->toArray(),
        ];
        
        return response()->json($result);
    }


    public function getLaporan($tipe, $month = null, $year = null)
    {
        $startDate = null;
        $endDate = null;
    
        if ($month !== null && $year !== null) {
            $startDate = Carbon::create($year, $month, 1, 0, 0, 0)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();
        }
    
        $actionlogs = Actionlog::with(['item' => function ($query) {
            $query->select('id', 'name', 'model_id', 'purchase_cost', 'purchase_date', 'created_at');
        }])
            ->select('id', 'action_type', 'created_at', 'company_id', 'log_meta', 'item_type', 'item_id');
    
        if ($startDate && $endDate) {
            $actionlogs->whereDate('created_at', '>=', $startDate)
                       ->whereDate('created_at', '<=', $endDate);
        }
    
        $actionlogs = $actionlogs->get();
    
        $counts = [];
    
        foreach ($actionlogs as $log) {
            if ($log->item) {
                $model = AssetModel::find($log->item->model_id);
                if ($model) {
                    if ($tipe == "baru" && $log->action_type === 'create') {
                        $category_name = Category::find($model->category_id)->name;
                        if (!isset($counts[$category_name])) {
                            $counts[$category_name] = 0;
                        }
                        $counts[$category_name]++;
                    } elseif ($tipe == "rusak" && $log->action_type === 'update') {
                        $category_name = Category::find($model->category_id)->name;
                        if (!isset($counts[$category_name])) {
                            $counts[$category_name] = 0;
                        }
                        $logMeta = json_decode($log->log_meta, true);
                        if (isset($logMeta['notes'])) {
                            $oldNote = $logMeta['notes']['old'] ?? '';
                            $newNote = $logMeta['notes']['new'] ?? '';
                            if (strpos($oldNote, 'Baik') !== false && strpos($newNote, 'Rusak') !== false) {
                                $counts[$category_name]++;
                            }
                        }
                    }
                }
            }
        }
    
        $labels = array_keys($counts);
        $datasets = [
            [
                'data' => array_values($counts),
                'backgroundColor' => $tipe == 'baru' ? '#70AB79' : '#EF845F'
            ]
        ];
    
        $result = [
            'labels' => $labels,
            'datasets' => $datasets
        ];
    
        return response()->json($result);
    }
   

    public function getMonthlySumm($tipe, $month = null, $year = null)
{
    // $this->authorize('reports.view'); 
    
    $startDate = null;
    $endDate = null;

    if ($month !== null && $year !== null) {
        $startDate = Carbon::create($year, $month, 1, 0, 0, 0)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
    }

    $actionlogs = Actionlog::with(['item' => function ($query) {
        $query->select('id', 'name', 'model_id', 'purchase_cost', 'purchase_date', 'created_at');
    }])
    ->select('id', 'action_type', 'created_at', 'company_id', 'log_meta', 'item_type', 'item_id');

    if ($startDate && $endDate) {
        $actionlogs->whereDate('created_at', '>=', $startDate)
                   ->whereDate('created_at', '<=', $endDate);
    }

    $total = $actionlogs->count();
    $actionlogs = $actionlogs->get();
    $responseRows = [];
    $totalPurchaseCost = 0;

    $responseRows = [];
$companyPurchaseCosts = [];
$companyNewCounts = [];

foreach ($actionlogs as $log) {
    $company = Company::find($log->company_id);
    $log->company_name = $company ? $company->name : null;

    if ($log->item) {
        $model = AssetModel::find($log->item->model_id);
        $asset = Asset::find($log->item->id);

        if ($model) {
            $purchaseDate = Carbon::parse($log->item->purchase_date);
            $currentDate = Carbon::now();
            $ageInYears = $currentDate->diffInYears($purchaseDate);

            $log->item->nup = $asset ? $asset->asset_tag : null;
            $log->item->age = $ageInYears;
            $log->item->category_id = $model->category_id;
            $log->item->category_name = Category::find($model->category_id)->name;
        } else {
            $log->item->age = null;
            $log->item->nup = null;
            $log->item->category_id = null;
            $log->item->category_name = null;
        }

        if ($tipe == "rusak" && $log->action_type === 'update') {
            $logMeta = json_decode($log->log_meta, true);
            if (isset($logMeta['notes'])) {
                $oldNote = $logMeta['notes']['old'] ?? '';
                $newNote = $logMeta['notes']['new'] ?? '';
                if (strpos($oldNote, 'Baik') !== false && strpos($newNote, 'Rusak') !== false) {
                    $responseRows[] = [
                        'unit' => $log->company_name,
                        'kat' => $log->item->category_name,
                        'nup' => $log->item->nup,
                        'age' => $log->item->age
                    ];
                }
            }
        }

        if ($tipe == "baru" && $log->action_type === 'create') {
            $companyName = $log->company_name;
            $categoryName = $log->item->category_name;
            $purchaseCost = $log->item->purchase_cost;

            if (!isset($companyPurchaseCosts[$companyName])) {
                $companyPurchaseCosts[$companyName] = 0;
                $companyNewCounts[$companyName] = [];
            }

            $companyPurchaseCosts[$companyName] += $purchaseCost;

            if (!isset($companyNewCounts[$companyName][$categoryName])) {
                $companyNewCounts[$companyName][$categoryName] = 0;
            }

            $companyNewCounts[$companyName][$categoryName]++;
        }
    }
}

foreach ($companyPurchaseCosts as $companyName => $totalPurchaseCost) {
    $newCounts = [];
    foreach ($companyNewCounts[$companyName] as $categoryName => $count) {
        $newCounts[] = $count . ' ' . $categoryName;
    }

    $responseRows[] = [
        'unit' => $companyName,
        'total' => $totalPurchaseCost,
        'new' => implode(', ', $newCounts)
    ];
}

    return response()->json([
        'total' => $total,
        'rows' => $responseRows
    ], 200, ['Content-Type' => 'application/json;charset=utf8']);
}


}
