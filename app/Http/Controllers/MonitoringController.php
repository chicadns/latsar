<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;


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


    private function getCompanyInfo($companyId)
    {
        $company = \App\Models\Company::find($companyId);

        if (!$company) {
            return ["pusat", \App\Models\Company::all()];
        }

        $companyName = $company->name;

        if (strpos($companyName, "BPS Propinsi") !== false) {
            $kodeWil = "prov";
            $kodeProv = substr($company->kode_wil, 0, 2);
            $companies = \App\Models\Company::where('kode_wil', 'like', $kodeProv . '%')
                ->where(function ($query) {
                    $query->where('name', 'like', '%Propinsi%')
                        ->orWhere('name', 'like', '%Kabupaten%')
                        ->orWhere('name', 'like', '%Kota%');
                })
                ->get();
        } elseif (strpos($companyName, "BPS Kabupaten") !== false || strpos($companyName, "BPS Kota") !== false) {
            $kodeWil = "kabkot";
            $companies = \App\Models\Company::where('id', $companyId)->get();
        } else {
            $kodeWil = "pusat";
            $companies = \App\Models\Company::all();
        }

        return [$kodeWil, $companies];
    }

    public function getCategoryFilter()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);
            
            // $hardwares = $this->getCategories([1, 3, 6, 8, 9, 15, 17, 18, 19, 20, 21, 28, 29, 30, 47, 58, 60, 61, 69, 70, 71, 79, 80, 94, 97], $companyId);
            // $inoutputs = $this->getCategories([2, 4, 7, 24, 25, 26, 38, 40, 43, 46, 59, 62, 63, 64, 65, 66, 68, 73, 76, 83, 88, 89, 91, 92, 93], $companyId);
            // $networks = $this->getCategories([13, 31, 32, 35, 37, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 67, 82, 90, 95, 96], $companyId);
            // $additionals = $this->getCategories([5, 22, 23, 27, 33, 34, 39, 41, 42, 44, 45, 72, 74, 75, 77, 78, 81, 84, 85, 86, 87], $companyId);
            // $transports = $this->getCategories(range(129, 141), $companyId);
            // $supports = $this->getCategories(range(142, 159), $companyId);
            // $rumahdinas = $this->getCategories(range(118, 128), $companyId);
            // $publics = $this->getCategories(range(165, 210), $companyId);

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
            // return view('monitoring/explore-cat', compact('hardwares', 'inoutputs', 'networks', 'additionals', 'transports', 'rumahdinas', 'publics', 'supports', 'kodeWil' , 'companies'));
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

    public function getCondition()
    {
        if (Auth::user()->hasAccess('admin')) {
            $user = auth()->user();
            $companyId = $user->company_id;
            [$kodeWil, $companies] = $this->getCompanyInfo($companyId);
            
            return view('monitoring/kondisi-aset', compact('companies', 'kodeWil'));
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
            
            return view('monitoring/perolehan', compact('companies', 'kodeWil'));
        } 
    }
}
