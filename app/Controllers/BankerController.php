<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\BankerModel;
use App\Models\UserModel;

class BankerController extends BaseController
{

    public function index()
    {
        $bankerModel = new BankerModel();
        $banker = $bankerModel->findAll();
        return view("/extras_management/banker/banker", ["bankers" => $banker]);
    }

    public function create()
    {
        $bankerModel = new bankerModel();

        // Definir reglas de validación
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'telephone' => 'required|min_length[5]|max_length[255]',
            'email' => 'required|min_length[3]|max_length[100]|is_unique[banker.email]',
        ];


        // Validar los datos antes de insertarlos
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors-insert', $this->validator->getErrors());
        }

        // Insertar los datos si pasan la validación
        $data = [
            'name' => $this->request->getPost('name'),
            'telephone' => $this->request->getPost('telephone'),
            'email' => $this->request->getPost('email'),
        ];

        $bankerModel->insert($data);
        return redirect()->to('/admin/extrasmanagement/banker')->with('success', 'banker added successfully');
    }


    public function update($id)
    {
        $bankerModel = new bankerModel();



        // Reglas de validación
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'telephone' => 'permit_empty|min_length[5]|max_length[255]',
            'email' => "required|min_length[3]|max_length[100]|is_unique[banker.email,id_banker,{$id}]",
        ];

        // Aplicar las reglas de validación
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors-update', $this->validator->getErrors());
        }

        // Preparar los datos para la actualización
        $data = [
            'name' => $this->request->getVar('name'),
            'telephone' => $this->request->getVar('telephone'),
            'email' => $this->request->getVar('email'),
        ];

        // Actualizar en la base de datos
        $bankerModel->update($id, $data);

        return redirect()->to('/admin/extrasmanagement/banker')->with('success', 'banker updated successfully.');
    }

    public function delete($id)
    {
        $bankerModel = new bankerModel();
        $userModel = new UserModel(); // Para verificar si el banco está vinculado a un usuario
    
        try {
            // Verificar si el banco está vinculado a algún usuario
            $isLinked = $userModel->where('id_banker', $id)->countAllResults();
    
            if ($isLinked > 0) {
                return redirect()->to('/admin/extrasmanagement/banker')
                                 ->with('error', 'Este banco está vinculado a un usuario y no puede ser eliminado.');
            }
    
            // Intentar eliminar el banco
            $bankerModel->delete($id);
    
            return redirect()->to('/admin/extrasmanagement/banker')
                             ->with('success', 'Banco eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/extrasmanagement/banker')
                             ->with('error', 'Ocurrió un error al intentar eliminar el banco.');
        }
    }
    
    
}