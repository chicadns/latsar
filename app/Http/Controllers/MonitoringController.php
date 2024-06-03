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
    
    public function nasional()
    {
        if (Auth::user()->hasAccess('admin')) {
            $asset_stats = null;

            $user = auth()->user();
            $ti = $this->getCategoriesByRangeAndNotes(1,97);
            $nonti = $this->getCategoriesByRangeAndNotes(118, 210);

            return view('monitoring/map', compact('ti', 'nonti'));
        } 
    }

    public function getCategoriesByRangeAndNotes($start, $end)
    {
       return \App\Models\Category::whereIn('categories.id', range($start, $end))
           ->join('models', 'categories.id', '=', 'models.category_id')
           ->join('assets', 'models.id', '=', 'assets.model_id')
           ->where('assets.notes', 'like', 'Rusak%')
           ->groupBy('categories.id', 'categories.name') 
           ->havingRaw('COUNT(*) > 0')
           ->select('categories.id', 'categories.name')
           ->get();
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

    public function getUnitKerja($id){
        $bpsIds = [];
    
        if ($id != 'all') {
            $kodeWil = \App\Models\Company::where('id', $id)->pluck('kode_wil')->first();
            
            if ($id > 25){
                if (isset($kodeWil) && substr($kodeWil, -2) == '00') { 
                    $kodeProv = substr($kodeWil, 0, 2); 
                    $bpsIds = \App\Models\Company::where('id', '>', 25)->where('kode_wil', 'like', $kodeProv . '%')->select('id', 'name')->get()->toArray();
                } else {
                    $bpsIds = \App\Models\Company::where('id', $id)->select('id', 'name')->get()->toArray();
                }
            }
        } else {
            $bpsIds = \App\Models\Company::where('id', '<', 26)->select('id', 'name')->get()->toArray();
        }
    
        return response()->json($bpsIds);
    }    

    public function getTahun($tingkat = null, $unit = null)
{

    $years = \App\Models\Asset::select(
        \DB::raw('YEAR(IFNULL(assets.purchase_date, assets.created_at)) AS year ')
    )
        ->when($tingkat == 4, function ($query) use ($unit) {
            return $query->where('assets.company_id', $unit);
        })
        ->whereRaw('YEAR(IFNULL(assets.purchase_date, assets.created_at))')
        ->distinct()
        ->orderBy('year', 'desc')
        ->pluck('year');

    $startYear = $years->last();

    return $startYear;
}


    public function getCondition()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);
            $years = $this->getTahun(1, null);
            
            return view('monitoring/kondisi-aset', compact('companies', 'kodeWil', 'years'));
        } 
    }

    public function getLaporan(Request $request, $month = null, $year = null)
    {
        $this->authorize('reports.view');  

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
    
        $allowed_columns = [
            'id', 'created_at', 'action_type', 'note',
        ];
    
        $offset = is_numeric($request->input('offset')) ? intval($request->input('offset')) : 0;
        $limit = is_numeric($request->input('limit')) ? intval($request->input('limit')) : 15;
    
        $sort = in_array($request->input('sort'), $allowed_columns) ? e($request->input('sort')) : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';
    
        $total = $actionlogs->count();
    
        $actionlogs = $actionlogs->orderBy($sort, $order)
                                 ->skip($offset)
                                 ->take($limit)
                                 ->get();
    
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
    



        public function getSummaryBulanan()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);

            return view('monitoring/bulanan', compact('companies', 'kodeWil'));
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

    public function getPerolehan()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);
            $years = $this->getTahun(1, null);
            
            return view('monitoring/perolehan', compact('companies', 'kodeWil', 'years'));
        } 
    }
}
