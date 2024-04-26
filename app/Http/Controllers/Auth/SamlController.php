<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Saml;
use App\Models\Company;
use App\Models\Department;
use App\Models\Location;
use App\Models\User;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Log;

/**
 * This controller provides the endpoint for SAML communication and metadata.
 *
 * @author Johnson Yi <jyi.dev@outlook.com>
 *
 * @since 5.0.0
 */
class SamlController extends Controller
{
    /**
     * @var Saml
     */
    protected $saml;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Saml $saml)
    {
        $this->saml = $saml;

        $this->middleware('guest', ['except' => ['metadata', 'sls']]);
    }

    /**
     * Return SAML SP metadata for Snipe-IT
     *
     * /saml/metadata
     *
     * @author Johnson Yi <jyi.dev@outlook.com>
     *
     * @since 5.0.0
     *
     * @param Request $request
     *
     * @return Response
     */
    public function metadata(Request $request)
    {
        $metadata = $this->saml->getSPMetadata();

        if (empty($metadata)) {
            \Log::debug('SAML metadata is empty - return a 403');
            return response()->view('errors.403', [], 403);
        }

        return response()->streamDownload(function () use ($metadata) {
            echo $metadata;
        }, 'snipe-it-metadata.xml', ['Content-Type' => 'text/xml']);
    }

    /**
     * Begin the SP-Initiated SSO by sending AuthN to the IdP.
     *
     * /login/saml
     *
     * @author Johnson Yi <jyi.dev@outlook.com>
     *
     * @since 5.0.0
     *
     * @param Request $request
     *
     * @return Redirect
     */
    public function login(Request $request)
    {
        $auth = $this->saml->getAuth();
        $ssoUrl = $auth->login(null, [], false, false, false, false);

        return redirect()->away($ssoUrl);
    }

    /**
     * Receives, parses the assertion from IdP and flashes SAML data
     * back to the LoginController for authentication.
     *
     * /saml/acs
     *
     * @author Johnson Yi <jyi.dev@outlook.com>
     *
     * @since 5.0.0
     *
     * @param Request $request
     *
     * @return Redirect
     */
    public function acs(Request $request)
    {
        $saml = $this->saml;
        $auth = $saml->getAuth();
        $auth->processResponse();
        $errors = $auth->getErrors();

        if (! empty($errors)) {
            Log::error('There was an error with SAML ACS: '.implode(', ', $errors));
            Log::error('Reason: '.$auth->getLastErrorReason());

            return redirect()->route('login')->with('error', trans('auth/message.signin.error'));
        }

        $samlData = $saml->extractData();

        /**
         * Add new users if doesn't exist
         * by Rihan Y. (yosral@bps.go.id) (11/10/2022)
         */
        $samlAttributes = $samlData['attributes'];
        //TODO: if eselon 2/3 filled, change the permissions to Admin Daerah or Admin Pusat group
        //      also check the company_id, department_id, location_id and manager_id 
        //      of the `user` and `locations` Table
        $id_nip = $samlAttributes['nip-lama'][0];
        $kode_wil = substr($samlAttributes['organisasi'][0], -5, 4);
        $permissions = '{"superuser":"0","admin":"0","import":"0","reports.view":"0","assets.view":"1","assets.create":"0","assets.edit":"0","assets.delete":"0","assets.checkin":"0","assets.checkout":"0","assets.audit":"0","assets.view.requestable":"0","accessories.view":"1","accessories.create":"0","accessories.edit":"0","accessories.delete":"0","accessories.checkout":"0","accessories.checkin":"0","consumables.view":"1","consumables.create":"0","consumables.edit":"0","consumables.delete":"0","consumables.checkout":"0","licenses.view":"1","licenses.create":"0","licenses.edit":"0","licenses.delete":"0","licenses.checkout":"0","licenses.keys":"0","licenses.files":"0","components.view":"1","components.create":"0","components.edit":"0","components.delete":"0","components.checkout":"0","components.checkin":"0","kits.view":"1","kits.create":"0","kits.edit":"0","kits.delete":"0","kits.checkout":"0","users.view":"1","users.create":"0","users.edit":"0","users.delete":"0","models.view":"1","models.create":"0","models.edit":"0","models.delete":"0","categories.view":"1","categories.create":"0","categories.edit":"0","categories.delete":"0","departments.view":"1","departments.create":"0","departments.edit":"0","departments.delete":"0","statuslabels.view":"0","statuslabels.create":"0","statuslabels.edit":"0","statuslabels.delete":"0","customfields.view":"0","customfields.create":"0","customfields.edit":"0","customfields.delete":"0","suppliers.view":"1","suppliers.create":"0","suppliers.edit":"0","suppliers.delete":"0","manufacturers.view":"1","manufacturers.create":"0","manufacturers.edit":"0","manufacturers.delete":"0","depreciations.view":"1","depreciations.create":"0","depreciations.edit":"0","depreciations.delete":"0","locations.view":"1","locations.create":"0","locations.edit":"0","locations.delete":"0","companies.view":"1","companies.create":"0","companies.edit":"0","companies.delete":"0","self.two_factor":"0","self.api":"0","self.edit_location":"0","self.checkout_assets":"0"}';
        $company_id = Company::where('kode_wil', $kode_wil)->first()->id;
        //TODO: Need adjusment with Dayanti's concepts of Department, Manager, and Company treeview
        //      add 'kode_wil' to `departments` Table so it could be founded by 
        //      'company_id' and 'kode_org' and 'kode_wil'
        $manager_id = Department::where('company_id', $company_id)->first()->manager_id;
        $department_id = Department::where('company_id', $company_id)->first()->department_id;
        
        //TODO: After adjusment with Dayanti's flow, update to adjust this codes
        // DB::table('locations')->upsert([
        //     ['company_id' => $company_id, 'department_id' => $department_id, 'kode_wil' => $kode_wil]
        // ], ['company_id', 'department_id', 'kode_wil'], ['manager_id']);
        // DB::table('departments')->upsert([
        //     ['company_id' => $company_id, 'kode_wil' => $kode_wil]
        // ], ['company_id', 'kode_wil'], ['manager_id']);
        //$locations_id = Location::where('manager_id', $id_nip)->first()->location_id;
        
        //TODO: input 'manager_id' to department based on `eselon` saml's attribute
        //      to `department` Table

        //TODO: make adjusment to photo of community on `foto` saml's attribute,
        //      so it can appeared in user profile/setting
        
        try{
            $user_saml = User::updateOrCreate(
            [
                'id' => $id_nip
            ],
            [
                'nip_baru' => $samlAttributes['nip'][0],
                'username' => $samlAttributes['username'][0],
                'email' => $samlAttributes['email'][0],
                'employee_num' => $id_nip,
                'created_by' => '0',
                'first_name' => $samlAttributes['first-name'][0],
                'last_name' => $samlAttributes['last-name'][0],
                'locale' => 'id',
                'activated' => '1',
                'jobtitle' => 'Staf '.$samlAttributes['jabatan'][0],
                'phone' => $kode_wil,
                'notes' => 'Akun SSO SAML BPS',
                'address' => $samlAttributes['alamat-kantor'][0],
                'country' => 'Indonesia',
                'password' => bcrypt(md5(rand())),
                'remote' => 'https://console.bps.go.id',
                //TODO: Location must be created on `locations` Table before assigned to user
                // 'location_id' => substr($samlAttributes['organisasi'][0], 5, -1),
                'city' => substr($samlAttributes['organisasi'][0], 2, 2),
                'state' => substr($samlAttributes['organisasi'][0], 0, 2),
                'zip' => substr($samlAttributes['organisasi'][0], 4, 3),
                'avatar' => $samlAttributes['foto'][0],
                'permissions' => $permissions,
                'company_id' => $company_id,
                'manager_id' => $manager_id,
                'department_id' => $department_id,
            ]
            );
        
        $update_assets_company_id = Asset::where('assigned_to', $id_nip)->update(['company_id' => $company_id]);
        // $user_saml->saveOrFail();
        $hasPenggunaRole = DB::table('users_groups')->where('user_id', $id_nip)->where('group_id', '4')->exists();
        
        if(!$hasPenggunaRole) {
            $user_saml->groups()->sync(['4' => ['user_id' => $id_nip]], false);    
        }
        } catch (\Exception $e){
            echo $e->getMessage();
            echo $e->errors();
        }
        return redirect()->route('login')->with('saml_login', $samlData);
    }

    /**
     * Receives LogoutRequest/LogoutResponse from IdP and flashes
     * back to the LoginController for logging out.
     *
     * /saml/sls
     *
     * @author Johnson Yi <jyi.dev@outlook.com>
     *
     * @since 5.0.0
     *
     * @param Request $request
     *
     * @return Redirect
     */
    public function sls(Request $request)
    {
        $auth = $this->saml->getAuth();
        $retrieveParametersFromServer = $this->saml->getSetting('retrieveParametersFromServer', false);
        $sloUrl = $auth->processSLO(true, null, $retrieveParametersFromServer, null, true);
        $errors = $auth->getErrors();

        if (! empty($errors)) {
            Log::error('There was an error with SAML SLS: '.implode(', ', $errors));
            Log::error('Reason: '.$auth->getLastErrorReason());

            return view('errors.403');
        }

        return redirect()->route('logout.get')->with(['saml_logout' => true,'saml_slo_redirect_url' => $sloUrl]);
    }
}
