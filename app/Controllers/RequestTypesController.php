<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\RequestTypesModel;
use App\Models\UserModel;

class RequestTypesController extends BaseController
{

    public function index()
    {
        $model = new RequestTypesModel();
        $data['request_types'] = $model->findAll();

        return view('extras_management/request_types/request_types', $data);
    }

    public function create()
    {
        $RequestTypesModel = new RequestTypesModel();

        // Definir reglas de validación
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'address' => 'permit_empty|min_length[5]|max_length[255]',
            'account_name' => 'required|min_length[3]|max_length[100]|is_unique[bank.account_name]',
        ];


        // Validar los datos antes de insertarlos
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors-insert', $this->validator->getErrors());
        }

        // Insertar los datos si pasan la validación
        $data = [
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'account_name' => $this->request->getPost('account_name'),
        ];

        $RequestTypesModel->insert($data);
        return redirect()->to('/admin/extrasmanagement/bank')->with('success', 'Bank added successfully');
    }


    public function update($id)
    {
        $RequestTypesModel = new RequestTypesModel();



        // Reglas de validación
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'address' => 'permit_empty|min_length[5]|max_length[255]',
            'account_name' => "required|min_length[3]|max_length[100]|is_unique[bank.account_name,id_bank,{$id}]",
        ];

        // Aplicar las reglas de validación
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors-update', $this->validator->getErrors());
        }

        // Preparar los datos para la actualización
        $data = [
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'account_name' => $this->request->getVar('account_name'),
        ];

        // Actualizar en la base de datos
        $RequestTypesModel->update($id, $data);

        return redirect()->to('/admin/extrasmanagement/bank')->with('success', 'Bank updated successfully.');
    }

    public function delete($id)
    {
        $RequestTypesModel = new RequestTypesModel();
        $userModel = new UserModel(); // Para verificar si el banco está vinculado a un usuario
    
        try {
            // Verificar si el banco está vinculado a algún usuario
            $isLinked = $userModel->where('id_bank', $id)->countAllResults();
    
            if ($isLinked > 0) {
                return redirect()->to('/admin/extrasmanagement/bank')
                                 ->with('error', 'Este banco está vinculado a un usuario y no puede ser eliminado.');
            }
    
            // Intentar eliminar el banco
            $RequestTypesModel->delete($id);
    
            return redirect()->to('/admin/extrasmanagement/bank')
                             ->with('success', 'Banco eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/extrasmanagement/bank')
                             ->with('error', 'Ocurrió un error al intentar eliminar el banco.');
        }
    }
    
    
}