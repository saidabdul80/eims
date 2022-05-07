<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\User;
use App\Repositories\EnrolleeRepository;
use App\Repositories\ProviderRepository;
use App\Repositories\WardRepository;
use App\Repositories\LgaRepository;

class manageProvider extends Controller
{
    private $lgaRepository;
    private $wardRepository;
    private $enrolleeRepository;
    private $providerRepository;

    public function __construct(
        LgaRepository $lgaRepository,
        WardRepository $wardRepository,
        EnrolleeRepository $enrolleeRepository,
        ProviderRepository $providerRepository
    ){
        $this->lgaRepository = $lgaRepository;
        $this->wardRepository = $wardRepository;
        $this->enrolleeRepository = $enrolleeRepository;
        $this->providerRepository = $providerRepository;
    }



    public function index()
    {
        $providers = $this->providerRepository->get(['status' => '1']);
    	return view('providers.manage_providers', compact('providers'));
    }

    public function edit($code)
    {
       $data['provider'] = $this->providerRepository->find($code);
       $data['lgas'] = $this->lgaRepository->all();
       $data['wards']= $this->wardRepository->all();
    	return view('providers.edit', compact('data'));
    }

    public function view($code)
    {
       $provider = $this->providerRepository->find($code);
       $provider->hcplga = $this->lgaRepository->find($provider->hcplga);
       $provider->hpward = $this->wardRepository->find($provider->hcpward);
    	return view('providers.view', compact('provider'));
    }

    public function update(Request $request)
    {
       $id = $request->get('id');
       $data['hcpname'] = $request->get('hcpname');
       $data['hcpcategory'] = $request->get('hcpcategory');
       $data['hcptype'] = $request->get('hcptype');
       $data['hcplga'] = $request->get('hcplga');
       $data['hcpward'] = $request->get('ward');
       $data['hcpcap'] = $request->get('hcpcap');
       $data['serviceClaimType'] = $request->get('serviceClaimType');
       $data['hcpaddress'] = $request->get('hcpaddress');
       $data['hcpcontactphone'] = $request->get('hcpcontactphone');
       $data['hcpemailaddress'] = $request->get('hcpemailaddress');
       $data['hcpBankName'] = $request->get('hcpBankName');
       $data['hcpBankAccountName'] = $request->get('hcpBankAccountName');
       $data['hcpBankAccountNumber'] = $request->get('hcpBankAccountNumber');
       $data['sortCode'] = $request->get('sortCode');

       $update = $this->providerRepository->update($data, $id);
       $data = [];
       $data['provider'] = $this->providerRepository->find($id);
       $data['lgas'] = $this->lgaRepository->all();
       $data['wards']= $this->wardRepository->all();
        $data['message'] = $update ? 'Record is updated successfully...' : 'Oops! Something went wrong..';
        return Redirect::back()->with('success', 'Record is updated successfully...');
    	//return view('providers.edit', compact('data'));
    }




}
