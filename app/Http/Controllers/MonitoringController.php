<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Transformers\ActionlogsTransformer;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Company;
use App\Models\Actionlog;
use Illuminate\Http\Request;
use Carbon\Carbon;


/**
 *
 * @author Theresia R. <STIS>
 * @version 2024
 */
class MonitoringController extends Controller
{
    public function getLaporan($month = null, $year = null)
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
    
        $total = $actionlogs->count();
    
        $actionlogs = $actionlogs->get();
    
        $asetBaru = 0;
        $asetRusak = 0;
        $totalHarga = 0;
    
        foreach ($actionlogs as $log) {
            if ($log->action_type === 'create' && $log->item !== null) {
                $asetBaru++;
                $totalHarga += $log->item->purchase_cost;
            }
    
            if ($log->action_type === 'update') {
                $logMeta = json_decode($log->log_meta, true);
                if (isset($logMeta['notes'])) {
                    $oldNote = $logMeta['notes']['old'] ?? '';
                    $newNote = $logMeta['notes']['new'] ?? '';
                    if (strpos($oldNote, 'Baik') !== false && strpos($newNote, 'Rusak') !== false) {
                        $asetRusak++;
                    }
                }
            }
        }

        $totalRusak = Asset::where('notes', 'like', '%Rusak%')->count();
        $totalHargaFormatted = number_format($totalHarga, 0, ',', '.');
        $totalRusakFormatted = number_format($totalRusak, 0, ',', '.');
    
        return response()->json([
            'total' => $total,
            'rows' => $actionlogs,
            'asetBaru' => $asetBaru,
            'asetRusak' => $asetRusak,
            'totalHarga' => $totalHargaFormatted,
            'totalRusak' => $totalRusakFormatted,
        ], 200, ['Content-Type' => 'application/json;charset=utf8']);
    }

    public function getTahunanNilai($id = null, $tingkat = null, $unit = null, $years = null)
{
    $companyNamePattern = "BPS Propinsi";
    $companyNamePattern2 = ["BPS Kabupaten%", "BPS Kota%"];

    // Fetch the BPS IDs based on the tingkat value
    if ($tingkat == 3) {
        $bpsIds = Company::where(function ($query) use ($companyNamePattern2) {
            foreach ($companyNamePattern2 as $pattern) {
                $query->orWhere('name', 'like', $pattern);
            }
        })->pluck('id')->toArray();
    } elseif ($tingkat == 2) {
        $bpsIds = Company::where('name', 'like', "$companyNamePattern%")->pluck('id')->toArray();
    } elseif ($tingkat == 5) {
        $bpsIds = Company::where('id', '<', 26)->pluck('id')->toArray();
    }

    // Base query with joins
    $baseQuery = Asset::join('models', 'assets.model_id', '=', 'models.id')
        ->join('categories', 'models.category_id', '=', 'categories.id');

    // Filter by company IDs if tingkat is 2, 3, or 5
    if (isset($bpsIds)) {
        $baseQuery->whereIn('assets.company_id', $bpsIds);
    }

    // Filter by category ID ranges
    if (!is_null($id)) {
        if ($id == 1) {
            $baseQuery->whereIn('models.category_id', range(1, 97));
        } elseif ($id == 2) {
            $baseQuery->whereIn('models.category_id', range(118, 210));
        }
    }

    // Create query for the current year
    $currentYearQuery = clone $baseQuery;
    if ($years != null) {
        $currentYearQuery->whereYear(\DB::raw('IFNULL(assets.purchase_date, assets.created_at)'), $years);
    } else {
        // If no year is provided, use the current year
        $years = date('Y');
        $currentYearQuery->whereYear(\DB::raw('IFNULL(assets.purchase_date, assets.created_at)'), $years);
    }

    // Create query for the previous year
    $previousYearQuery = clone $baseQuery;
    $previousYearQuery->whereYear(\DB::raw('IFNULL(assets.purchase_date, assets.created_at)'), ($years - 1));

    // Execute queries and get results
    $currentYearResults = $currentYearQuery->selectRaw('
            SUM(assets.purchase_cost) AS dana_cat,
            COUNT(assets.id) AS asset_count
        ')->first();

    $previousYearResults = $previousYearQuery->selectRaw('
            SUM(assets.purchase_cost) AS dana_before
        ')->first();

    $dana_cat = $currentYearResults->dana_cat ?? 0;
    $asset_count = $currentYearResults->asset_count ?? 0;
    $dana_before = $previousYearResults->dana_before ?? 0;

    $perBefore = $dana_before > 0 ? round((($dana_cat / $dana_before)-1), 2) : 0;

    $totalAsetFormatted = $asset_count > 0 ? $asset_count : 0;

    return response()->json([
        'total' => round($dana_cat / 1000000000, 2),
        'asetBaru' => $totalAsetFormatted,
        'perBefore' => $perBefore,
    ]);
}

    



    public function getAgeInfo($id = null, $tingkat = null, $unit = null) 
{
    $assetsCountByAge = Asset::join('models', 'assets.model_id', '=', 'models.id')
        ->select(
            \DB::raw('
                CASE 
                    WHEN assets.purchase_date > 0 THEN ROUND(DATEDIFF(NOW(), assets.purchase_date) / 365, 2)
                    WHEN assets.created_at > 0 THEN ROUND(DATEDIFF(NOW(), assets.created_at) / 365, 2)
                END AS age'
            ),
            \DB::raw('SUM(CASE WHEN assets.notes LIKE "%" THEN 1 ELSE 0 END) AS total'),
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

    $total = $assetsCountByAge->sum('total');
    $good_count = $assetsCountByAge->sum('good_count');
    $worst_count = $assetsCountByAge->sum('worst_count');
    $older_than_10_years = $assetsCountByAge->filter(function ($asset) {
        return $asset->age > 10;
    })->sum('total');   

    return response()->json([
        'total' => number_format($total, 0, ',', '.'),
        'baik' => number_format($good_count, 0, ',', '.'),
        'berumur_lebih_10_tahun' => number_format($older_than_10_years, 0, ',', '.'),
        'rusak_berat' => number_format($worst_count, 0, ',', '.'),
    ], 200, ['Content-Type' => 'application/json;charset=utf8']);
}



    public function getCompanyInfo($companyId)
    {
        $company = \App\Models\Company::find($companyId);
    
        if (!$company) {
            $kodeWil = "pusat";
            return [$kodeWil, $this->getCompaniesWithSmallestYear()];
        }
    
        $companyName = $company->name;
        $kodeWil = "pusat"; 
    
        if (strpos($companyName, "BPS Propinsi") !== false) {
            $kodeWil = "prov";
            $kodeProv = substr($company->kode_wil, 0, 2);
            $companies = $this->getCompaniesWithSmallestYear(function ($query) use ($kodeProv) {
                $query->where('companies.id', '>', 25)
                    ->where('companies.kode_wil', 'like', $kodeProv . '%')
                    ->where(function ($query) {
                        $query->where('companies.name', 'like', '%Propinsi%')
                            ->orWhere('companies.name', 'like', '%Kabupaten%')
                            ->orWhere('companies.name', 'like', '%Kota%');
                    });
            });
    
        } elseif (strpos($companyName, "BPS Kabupaten") !== false || strpos($companyName, "BPS Kota") !== false) {
            $kodeWil = "kabkot";
            $companies = $this->getCompaniesWithSmallestYear(function ($query) use ($companyId) {
                $query->where('companies.id', $companyId);
            });
    
        } else {
            $companies = $this->getCompaniesWithSmallestYear();
        }
    
        return [$kodeWil, $companies];
    }

    public function getSummaryBulanan()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);

            return view('monitoring/bulanan', compact('companies', 'kodeWil'));
        } 
    }


    public function getCategories(array $categoryIds, $unitkerja = null)
    {
        $filteredCompanyIds = null; 

        if ($unitkerja !== null) {
            $company = \App\Models\Company::find($unitkerja);
            $companyName = $company->name;  

            if (strpos($companyName, "BPS Propinsi") !== false) {
                $kodeProv = substr($company->kode_wil, 0, 2);
                $filteredCompanyIds = \App\Models\Company::where('kode_wil', 'like', $kodeProv . '%')
                    ->where(function ($query) {
                        $query->where('name', 'like', '%Propinsi%')
                            ->orWhere('name', 'like', '%Kabupaten%')
                            ->orWhere('name', 'like', '%Kota%');
                    })
                    ->pluck('id')
                    ->toArray();
            } else {
                $filteredCompanyIds = [$unitkerja]; 
            }
        }   

        return \App\Models\Category::join('models', 'categories.id', '=', 'models.category_id')
            ->join('assets', 'models.id', '=', 'assets.model_id')
            ->whereIn('categories.id', $categoryIds)
            ->when($filteredCompanyIds !== null, function ($query) use ($filteredCompanyIds) {
                return $query->whereIn('assets.company_id', $filteredCompanyIds);
            })
            ->distinct()
            ->select('categories.id', 'categories.name')
            ->get();
    }

    public function getPropinsi(){
        $companies = \App\Models\Company::where('name', 'like', '%BPS Propinsi%')
            ->get(['name', 'id']);        

        $companies = $companies->map(function ($company) {
            $company->name = str_replace('BPS ', '', $company->name);
            $company->id = $company->id;
            return $company;
        });     

        return response()->json($companies);
    }


    public function getRank()
    {
        if (Auth::user()->hasAccess('admin')) {
            $asset_stats = null;

            $user = auth()->user();
            $companyId = $user->company_id;

            $ti = $this->getCategories(range(1, 97), $companyId);
            $nonti = $this->getCategories(range(118, 210), $companyId);

            return view('monitoring/peringkat', compact('ti', 'nonti'));
        } 
    }

    public function getRankGerak()
    {
        if (Auth::user()->hasAccess('admin')) {
            $asset_stats = null;

            $user = auth()->user();
            $companyId = $user->company_id;

            $ti = $this->getCategories([8,19,20,97], $companyId);

            return view('monitoring/peringkatBMNgerak', compact('ti'));
        } 
    }

    public function nasional()
    {
        if (Auth::user()->hasAccess('admin')) {
            $asset_stats = null;

            $user = auth()->user();
            $ti = $this->getCategoriesByRangeAndNotes(1,97);
            $nonti = $this->getCategoriesByRangeAndNotes(118, 210);

            return view('monitoring/nasional', compact('ti', 'nonti'));
        } 
    }

    public function getCategoriesByRangeAndNotes($start, $end)
    {
       return \App\Models\Category::whereIn('categories.id', range($start, $end))
           ->join('models', 'categories.id', '=', 'models.category_id')
           ->join('assets', 'models.id', '=', 'assets.model_id')
           ->groupBy('categories.id', 'categories.name') 
           ->havingRaw('COUNT(*) > 0')
           ->select('categories.id', 'categories.name')
           ->get();
    }

    public function getUnitKerja($id){
        $bpsIds = [];
    
        if ($id != 'ri' && $id != 'all') {
            $kodeWil = \App\Models\Company::where('id', $id)->pluck('kode_wil')->first();
            
            if ($id > 25){
                if (isset($kodeWil) && substr($kodeWil, -2) == '00') { 
                    $kodeProv = substr($kodeWil, 0, 2); 
                    $bpsIds = \App\Models\Company::where('id', '>', 25)->where('kode_wil', 'like', $kodeProv . '%')->select('id', 'name')->get()->toArray();
                } else {
                    $bpsIds = \App\Models\Company::where('id', $id)->select('id', 'name')->get()->toArray();
                }
            }
        } else if ($id == 'ri'){
            $bpsIds = \App\Models\Company::where('id', '<', 26)->select('id', 'name')->get()->toArray();
        }
    
        return response()->json($bpsIds);
    }    

    public function getUnitEselon($id) {
        $query = \App\Models\Company::query();
        $bpsIds = [];
    
        switch ($id) {
            case 2:
                $query->where('id', '<', 26);
                break;
            case 3:
                $query->where('name', 'like', '%Propinsi%');
                break;
            case 5:
                $query->where(function ($q) {
                    $q->where('name', 'like', '%Kabupaten%')
                      ->orWhere('name', 'like', '%Kota%');
                });
                break;
        }
    
        // Get the results as an associative array
        $results = $query->get(['id', 'name'])->toArray();
        
        // Convert the array into key-value pairs
        foreach ($results as $result) {
            $bpsIds[$result['id']] = $result['name'];
        }
    
        return $bpsIds;
    }

    public function getCondition()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);
            $bpsri = $this->getUnitEselon(2);
            $bpspr = $this->getUnitEselon(3);
            $bpskk = $this->getUnitEselon(5);
            $yearsri = $this->getTahun(2, null);
            $yearspr = $this->getTahun(3, null);
            $yearskk = $this->getTahun(5, null);
            $years = $this->getTahun(1, null);

            $ti = $this->getCategories(range(1, 97), $companyId);
            $nonti = $this->getCategories(range(118, 210), $companyId);
            
            return view('monitoring/kondisi-aset', compact('bpsri', 'bpspr', 'bpskk', 'companies', 'kodeWil', 'yearsri','yearspr','yearskk','years','ti', 'nonti'));
        } 
    }

    public function getTahun($tingkat = null, $unit = null)
    {
        $years = \App\Models\Asset::join('companies', 'companies.id', '=', 'assets.company_id')
            ->select(
                \DB::raw('YEAR(IFNULL(assets.purchase_date, assets.created_at)) AS year')
            )
            ->when($tingkat == 2, function ($query) use ($unit) {
                return $query->where('assets.company_id', '<', 26)->where('assets.company_id', $unit);
            })
            ->when($tingkat == 3, function ($query) use ($unit) {
                return $query->where('companies.name', 'like', '%Propinsi%')->where('assets.company_id', $unit);
            })
            ->when($tingkat == 5, function ($query) use ($unit) {
                return $query->where(function ($query) {
                    $query->where('companies.name', 'like', '%Kabupaten%')
                          ->orWhere('companies.name', 'like', '%Kota%');
                })->where('assets.company_id', $unit);
            })
            ->when($tingkat == 4, function ($query) use ($unit) {
                return $query->where('assets.company_id', $unit);
            })
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    
        $startYear = $years->last();
    
        return $startYear;
    }

    public function getPerolehan()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);
            $bpsri = $this->getUnitEselon(2);
            $bpspr = $this->getUnitEselon(3);
            $bpskk = $this->getUnitEselon(5);
            $years = date('Y');
            
            return view('monitoring/perolehan', compact('bpsri', 'bpspr', 'bpskk', 'companies', 'kodeWil', 'years'));
        } 
    }

    // public function getCompanyInfo($companyId)
    // {
    //     $company = \App\Models\Company::find($companyId);
    
    //     if (!$company) {
    //         $kodeWil = "pusat";
    //         return [$kodeWil, $this->getCompaniesWithSmallestYear()];
    //     }
    
    //     $companyName = $company->name;
    //     $kodeWil = "pusat"; 
    
    //     switch ($id) {
    //         case 2:
    //             $query->where('id', '<', 26);
    //             break;
    //         case 3:
    //             $query->where('name', 'like', '%Propinsi%');
    //             break;
    //         case 5:
    //             $query->where(function ($q) {
    //                 $q->where('name', 'like', '%Kabupaten%')
    //                   ->orWhere('name', 'like', '%Kota%');
    //             });
    //             break;
    //     }
    
    //     return [$kodeWil, $companies];
    // }
    
    

    






    
    



    
    private function getCompaniesWithSmallestYear($additionalQuery = null)
    {
        $query = \App\Models\Company::join('assets', 'assets.company_id', '=', 'companies.id')
            ->select(
                \DB::raw('MIN(YEAR(IFNULL(assets.purchase_date, assets.created_at))) AS smallest_year'),
                'companies.id',
                'companies.kode_wil',
                'companies.name'
            )
            ->groupBy('companies.id', 'companies.kode_wil', 'companies.name');
    
        if ($additionalQuery) {
            $additionalQuery($query);
        }
    
        return $query->get();
    }
    


    public function getCategoryFilter()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);

            $hardwares = $this->getCategories(array_merge(range(1, 94), [97]), $companyId);
            $tinowujud = $this->getCategories([95, 96], $companyId);
            $rumahdinas = $this->getCategories(range(118, 128), $companyId);
            $transports = $this->getCategories(range(129, 141), $companyId);
            $alatbesar = $this->getCategories(range(142, 159), $companyId);
            $renovasi = $this->getCategories([161], $companyId);
            $kontruksi = $this->getCategories(range(162, 164), $companyId);
            $jalan = $this->getCategories([165], $companyId);
            $bangunan = $this->getCategories(range(166, 210), $companyId);
            return view('monitoring/explore-cat', compact('hardwares', 'tinowujud', 'rumahdinas', 'transports', 'alatbesar', 'renovasi', 'kontruksi', 'jalan', 'bangunan', 'kodeWil' , 'companies'));
        } 
    }

    

    public function getMerek($categoryId, $filterunit = "pusat")
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $unitkerja = $user->company_id;

            $filteredCompanyIds = null; 

            if ($unitkerja !== null) {
                $company = \App\Models\Company::find($unitkerja);
                $companyName = $company->name;  

                if (strpos($companyName, "BPS Propinsi") !== false) {
                    $kodeProv = substr($company->kode_wil, 0, 2);
                    $filteredCompanyIds = \App\Models\Company::where('kode_wil', 'like', $kodeProv . '%')
                        ->where(function ($query) {
                            $query->where('name', 'like', '%Propinsi%')
                                ->orWhere('name', 'like', '%Kabupaten%')
                                ->orWhere('name', 'like', '%Kota%');
                        })
                        ->pluck('id')
                        ->toArray();
                } else {
                    $filteredCompanyIds = [$unitkerja]; 
                }
            }  

            $brands = \App\Models\Category::join('models', 'categories.id', '=', 'models.category_id')
            ->join('assets', 'models.id', '=', 'assets.model_id')
            ->join('manufacturers', 'manufacturers.id', '=', 'models.manufacturer_id')
            ->where('models.category_id', $categoryId)
            ->when($filterunit == "pusat", function ($query) use ($filteredCompanyIds) {
                if ($filteredCompanyIds !== null) {
                    return $query->whereIn('assets.company_id', $filteredCompanyIds);
                }
            }, function ($query) use ($filterunit) {
                return $query->where('assets.company_id', $filterunit);
            })
            ->distinct()
            ->select('manufacturers.id', 'manufacturers.name')
            ->get();

            return response()->json($brands);
        }
    }

    

    

    
    


  


    public function getUtilitasLainnya()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);
            
            return view('monitoring/utilitas-lainnya', compact('kodeWil'));
        } 
    }

    

    
}
