<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\AssetsTransformer;
use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\Category;
use App\Models\Company;
use App\Models\Manufacturer;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Transformers\PieChartTransformer;

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
    

    public function getAgeGroup($id = null, $tingkat = null, $unit = null) 
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
        $percentages = [];
        foreach ($bpsIds as $companyId) {
            $query = Asset::join('models', 'assets.model_id', '=', 'models.id')
                ->where('assets.company_id', $companyId)
                ->where('assets.notes', 'like', 'Baik%');
            
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
            
            $countBaikNotes = $query->count();
            
            $labels[] = Company::where('id', $companyId)->value('name');
            $jumlahBaik[] = $countBaikNotes;
        }   
    
        array_multisort($jumlahBaik, SORT_DESC, $labels);  
    
        $labels = array_slice($labels, 0, 10);
        $jumlahBaik = array_slice($jumlahBaik, 0, 10);
        
        $datasets = [
            [
                "label" => "Jumlah Aset dengan Kondisi Baik",
                "backgroundColor" =>  '#00876C',
                "data" => $jumlahBaik,
            ]
        ];  
    
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

    public function getWorseRank($tingkat = null, $asetType = 'kelAset', $asetValue = null)
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
    
        usort($companyCounts, function($a, $b) {
            return $b['Rusak Ringan'] - $a['Rusak Ringan'];
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


    public function getHardwareNotes($id = null, $tingkat = null, $unit = null)
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
        if ($tingkat == 2 || $tingkat == 3) {
            $query->whereIn('assets.company_id', $bpsIds);
        } elseif ($tingkat == 4) {
            $query->where('assets.company_id', $unit);
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


    public function getWorstCat($id = null, $tingkat = null, $unit = null)
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

    
    public function getLatestCat($id = null, $tingkat = null, $unit = null)
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

        $query->selectRaw('
                categories.name as category_name,
                COUNT(*) as total_assets,
                SUM(CASE WHEN assets.notes LIKE "Rusak Berat%" THEN 1 ELSE 0 END) AS worst_count,
                SUM(CASE WHEN assets.notes LIKE "Rusak Ringan%" THEN 1 ELSE 0 END) AS worse_count,
                SUM(CASE WHEN assets.notes LIKE "Baik%" THEN 1 ELSE 0 END) AS good_count
            ')
            ->whereRaw('YEAR(COALESCE(NULLIF(assets.purchase_date, 0), assets.created_at)) >= YEAR(CURRENT_DATE()) - 5')
            ->groupBy('categories.name')
            ->orderByDesc('total_assets');
       
            if (!is_null($id)) {
                if ($id == 1) {
                    $query->whereIn('models.category_id', range(1, 97));
                } elseif ($id == 2) {
                    $query->whereIn('models.category_id', range(118, 210));
                }
            }
        $assetsCountByCategory = $query->limit(10)->get();
    
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

    public function getFirstValue($id = null, $tingkat = null, $unit = null)
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

        $assetsCountByYear = $query->select(
            \DB::raw('YEAR(IFNULL(assets.purchase_date, assets.created_at)) AS year'),
            \DB::raw('SUM(purchase_cost) AS total_cost')
        )
        ->whereRaw('YEAR(CURRENT_DATE()) - YEAR(IFNULL(assets.purchase_date, assets.created_at)) <= 5')
        ->groupBy('year')
        ->get();  

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
                    \DB::raw('ROUND((SUM(assets.notes LIKE "Rusak Berat%") / COUNT(*)) * 100, 2) as bad_percentage')
                )
                ->value('bad_percentage'));
            } elseif ($agg == 2) { 
                $value = floatval($query->select(
                    \DB::raw('(SUM(assets.notes LIKE "Rusak Berat%")) as bad_count')
                )
                ->value('bad_count'));
            } elseif ($agg == 3) { 
                $value = floatval($query->select(
                    \DB::raw('ROUND((SUM(assets.notes LIKE "Rusak Ringan%") / COUNT(*)) * 100, 2) as bad_percentage')
                )
                ->value('bad_percentage'));
            } elseif ($agg == 4) { 
                $value = floatval($query->select(
                    \DB::raw('(SUM(assets.notes LIKE "Rusak Ringan%")) as bad_count')
                )
                ->value('bad_count'));
            }
    
            $id_area = isset($petaId[$kodeProv]) ? $petaId[$kodeProv] : '';
            $rows[] = [
                'id_area' => $id_area, 
                'value' => $value
            ];
        }
    
        return ['rows' => $rows];
    }

}
