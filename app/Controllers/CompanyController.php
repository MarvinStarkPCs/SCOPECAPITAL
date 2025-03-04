<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CompanyModel;
use App\Models\UserModel;

class CompanyController extends BaseController
{
    public function index()
    {
        $companyModel = new CompanyModel();
        $companies = $companyModel->findAll();
        return view("/extras_management/company/company", ["companies" => $companies]);
    }

    public function create()
    {
        $companyModel = new CompanyModel();

        // Validation rules
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'address' => 'permit_empty|min_length[5]|max_length[255]',
            'telephone' => 'required|min_length[7]|max_length[15]',
            'email' => 'required|valid_email|is_unique[company.email]',
            'representative' => 'required|min_length[3]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors-insert', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'telephone' => $this->request->getPost('telephone'),
            'email' => $this->request->getPost('email'),
            'representative' => $this->request->getPost('representative'),
        ];

        $companyModel->insert($data);
        return redirect()->to('/admin/extrasmanagement/company')->with('success', 'Company added successfully.');
    }

    public function update($id)
    {
        $companyModel = new CompanyModel();

        // Validation rules
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'address' => 'permit_empty|min_length[5]|max_length[255]',
            'telephone' => 'required|min_length[7]|max_length[15]',
            'email' => "required|valid_email|is_unique[company.email,id_company,{$id}]",
            'representative' => 'required|min_length[3]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors-update', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'telephone' => $this->request->getVar('telephone'),
            'email' => $this->request->getVar('email'),
            'representative' => $this->request->getVar('representative'),
        ];

        $companyModel->update($id, $data);

        return redirect()->to('/admin/extrasmanagement/company')->with('success', 'Company updated successfully.');
    }

    public function delete($id)
    {
        $companyModel = new CompanyModel();
        $userModel = new UserModel();

        try {
            // Check if the company is linked to any user
            if ($userModel->where('id_company', $id)->countAllResults() > 0) {
                return redirect()->to('/admin/extrasmanagement/company')
                                 ->with('error', 'This company is linked to a user and cannot be deleted.');
            }

            // Delete the company
            $companyModel->delete($id);

            return redirect()->to('/admin/extrasmanagement/company')
                             ->with('success', 'Company deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/extrasmanagement/company')
                             ->with('error', 'An error occurred while trying to delete the company.');
        }
    }
}
